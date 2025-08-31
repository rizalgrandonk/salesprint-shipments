<?php

namespace App\Jobs;

use App\Models\City;
use App\Models\District;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PopulateDistrictsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $cities = City::all();

            foreach ($cities as $city) {
                $res = Http::retry(3, 1000)->withHeaders([
                    'Key' => env('RAJAONGKIR_API_KEY', ''),
                ])->get(
                    env(
                        'RAJAONGKIR_BASE_URL',
                        'https://rajaongkir.komerce.id/api/v1'
                    ) . '/destination/district/' . $city->city_id
                );

                if ($res->failed()) {
                    Log::channel('stderr')->info(
                        'Failed to populate districts: ' . $res->error()->getMessage()
                    );
                    return;
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

                Log::channel('stderr')->info('Districts populated for province: ' . $city->city_name);

                sleep(10);
            }
            
            Log::channel('stderr')->info('Districts populated successfully.');
        } catch (\Exception $e) {
            Log::channel('stderr')->info('Failed to populate districts: ' . $e->getMessage());
        }
    }
}
