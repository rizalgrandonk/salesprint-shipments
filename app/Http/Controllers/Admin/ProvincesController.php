<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Province\BulkDestroyProvince;
use App\Http\Requests\Admin\Province\DestroyProvince;
use App\Http\Requests\Admin\Province\IndexProvince;
use App\Http\Requests\Admin\Province\StoreProvince;
use App\Http\Requests\Admin\Province\UpdateProvince;
use App\Models\City;
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

class ProvincesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexProvince $request
     * @return array|Factory|View
     */
    public function index(IndexProvince $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Province::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'province_id', 'province'],

            // set columns to searchIn
            ['id', 'province_id', 'province'],

            function ($query) {
                $query->addSelect('provinces.*');
                $query->addSelect([
                    'has_cities' => DB::raw(
                        'EXISTS(SELECT 1 FROM cities WHERE cities.province_id = provinces.province_id) as has_cities'
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

        return view('admin.province.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.province.create');

        return view('admin.province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProvince $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreProvince $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Province
        $province = Province::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/provinces'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/provinces');
    }

    /**
     * Display the specified resource.
     *
     * @param Province $province
     * @throws AuthorizationException
     * @return void
     */
    public function show(Province $province)
    {
        $this->authorize('admin.province.show', $province);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Province $province
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Province $province)
    {
        $this->authorize('admin.province.edit', $province);


        return view('admin.province.edit', [
            'province' => $province,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProvince $request
     * @param Province $province
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateProvince $request, Province $province)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Province
        $province->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/provinces'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/provinces');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyProvince $request
     * @param Province $province
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyProvince $request, Province $province)
    {
        $province->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyProvince $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyProvince $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Province::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function populate()
    {
        try {
            $res = Http::retry(3, 1000)->withHeaders([
                'Key' => env('RAJAONGKIR_API_KEY', ''),
            ])->get(
                env(
                    'RAJAONGKIR_BASE_URL',
                    'https://rajaongkir.komerce.id/api/v1'
                ) . '/destination/province'
            );

            if ($res->failed()) {
                throw $res->error();
            }

            $data = $res->json();
            $listProvince = $data['data'];

            $dataToUpsert = array_map(function ($prov) {
                return [
                    'province' => $prov['name'],
                    'province_id' => $prov['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $listProvince);

            Province::upsert(
                $dataToUpsert,
                ['province_id'],
                ['province', 'updated_at'] 
            );

            return redirect()
                ->route('admin/provinces/index')
                ->withSuccess(__('Provinces populated successfully.'));

        } catch (\Exception $e) {
            return redirect()->route('admin/provinces/index')
                ->withError(__('Error: ' . $e->getMessage()));
        }
    }

    public function populate_cities(Request $request, Province $province)
    {
        try {
            $res = Http::retry(3, 1000)->withHeaders([
                'Key' => env('RAJAONGKIR_API_KEY', ''),
            ])->get(
                env(
                    'RAJAONGKIR_BASE_URL',
                    'https://rajaongkir.komerce.id/api/v1'
                ) . '/destination/city/' . $province->province_id
            );

            if ($res->failed()) {
                throw $res->error();
            }

            $data = $res->json();
            $listCities = $data['data'];

            $dataToUpsert = array_map(function ($prov) use ($province) {
                return [
                    'province' => $province->province,
                    'province_id' => $province->province_id,
                    'city_id' => $prov['id'],
                    'city_name' => $prov['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $listCities);

            City::upsert(
                $dataToUpsert,
                ['city_id'],
                ['province', 'province_id', 'city_name', 'updated_at'] 
            );

            return redirect()
                ->route('admin/provinces/index')
                ->withSuccess(__('Cities for ' . $province->province . ' populated successfully.'));

        } catch (\Exception $e) {
            return redirect()->route('admin/provinces/index')
                ->withError(__('Error: ' . $e->getMessage()));
        }
    }
}
