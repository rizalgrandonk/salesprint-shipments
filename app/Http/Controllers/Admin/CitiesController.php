<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\BulkDestroyCity;
use App\Http\Requests\Admin\City\DestroyCity;
use App\Http\Requests\Admin\City\IndexCity;
use App\Http\Requests\Admin\City\StoreCity;
use App\Http\Requests\Admin\City\UpdateCity;
use App\Jobs\PopulateCitiesJob;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CitiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCity $request
     * @return array|Factory|View
     */
    public function index(IndexCity $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(City::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'province_id', 'province', 'city_id', 'city_name'],

            // set columns to searchIn
            ['id', 'province_id', 'province', 'city_id', 'city_name'],

            function ($query) {
                $query->addSelect('cities.*');
                $query->addSelect([
                    'has_districts' => DB::raw(
                        'EXISTS(SELECT 1 FROM districts WHERE districts.city_id = cities.city_id) as has_districts'
                    )
                ]);
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.city.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.city.create');

        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCity $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCity $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the City
        $city = City::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/cities'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/cities');
    }

    /**
     * Display the specified resource.
     *
     * @param City $city
     * @throws AuthorizationException
     * @return void
     */
    public function show(City $city)
    {
        $this->authorize('admin.city.show', $city);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(City $city)
    {
        $this->authorize('admin.city.edit', $city);


        return view('admin.city.edit', [
            'city' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCity $request
     * @param City $city
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCity $request, City $city)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values City
        $city->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/cities'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/cities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCity $request
     * @param City $city
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCity $request, City $city)
    {
        $city->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCity $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCity $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    City::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function populate()
    {
        PopulateCitiesJob::dispatch();

        return redirect()
            ->route('admin/cities/index')
            ->withSuccess(__('Populate cities is started!'));
    }

    public function populate_districts(Request $request, City $city)
    {
        try {
            $res = Http::retry(3, 1000)->withHeaders([
                'Key' => env('RAJAONGKIR_API_KEY', ''),
            ])->get(
                env(
                    'RAJAONGKIR_BASE_URL',
                    'https://rajaongkir.komerce.id/api/v1'
                ) . '/destination/district/' . $city->city_id
            );

            if ($res->failed()) {
                throw $res->error();
            }

            $data = $res->json();
            $listDistricts = $data['data'];

            $dataToUpsert = array_map(function ($val) use ($city) {
                return [
                    'province' => $city->province,
                    'province_id' => $city->province_id,
                    'city_id' => $city->city_id,
                    'city_name' => $city->city_name,
                    'district_id' => $val['id'],
                    'district_name' => $val['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $listDistricts);

            District::upsert(
                $dataToUpsert,
                ['district_id'],
                ['province', 'province_id', 'city_name', 'city_id', 'district_name', 'updated_at'] 
            );

            return redirect()
                ->route('admin/provinces/index')
                ->withSuccess(__('Cities for ' . $city->city_name . ' populated successfully.'));

        } catch (\Exception $e) {
            return redirect()->route('admin/provinces/index')
                ->withError(__('Error: ' . $e->getMessage()));
        }
    }
}
