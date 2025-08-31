<?php

namespace App\Jobs;

use App\Models\City;
use App\Models\Province;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PopulateCitiesJob implements ShouldQueue
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
            $provinces = Province::all();

            foreach ($provinces as $province) {
                $res = Http::retry(3, 1000)->withHeaders([
                    'Key' => env('RAJAONGKIR_API_KEY', ''),
                ])->get(
                    env(
                        'RAJAONGKIR_BASE_URL',
                        'https://rajaongkir.komerce.id/api/v1'
                    ) . '/destination/city/' . $province->province_id
                );

                if ($res->failed()) {
                    Log::channel('stderr')->info('Failed to populate cities: ' . $res->error()->getMessage());
                    return;
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

                Log::channel('stderr')->info('Cities populated for province: ' . $province->province);

                sleep(10);
            }
            
            Log::channel('stderr')->info('Cities populated successfully.');
        } catch (\Exception $e) {
            Log::channel('stderr')->info('Failed to populate cities: ' . $e->getMessage());
        }
    }
}
