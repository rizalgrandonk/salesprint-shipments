<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LogisticController extends Controller
{
    public function province(Request $request) {
        $data = Province::all();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Success'
            ],
            'data' => $data
        ]);
    }
    
    public function city(Request $request, string $province_id) {
        $data = City::where('province_id', $province_id)->get();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Success'
            ],
            'data' => $data
        ]);
    }

    public function district(Request $request, string $city_id) {
        $data = District::where('city_id', $city_id)->get();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Success'
            ],
            'data' => $data
        ]);
    }

    public function cost(Request $request) {
        $validatedData = $request->validate([
            'origin' => ['required', 'string'],
            'destination' => ['required', 'string'],
            'courier' => ['required', 'string'],
            'weight' => ['required', 'integer'],
        ]);

        $res = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY', ''),
        ])->post(
            env(
                'RAJAONGKIR_BASE_URL',
                'https://rajaongkir.komerce.id/api/v1'
            ) . '/calculate/district/domestic-cost',
            [
                "origin" => $validatedData['origin'],
                "destination" => $validatedData['destination'],
                "weight" => (int) $validatedData['weight'],
                "courier" => $validatedData['courier']
            ]
        );

        if ($res->failed()) {
            $errorData = $res->json();

            if ($errorData) {
                return response()->json($errorData, $errorData['meta']['code']);
            }

            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'error',
                    'message' => "Failed to calculate cost"
                ]
            ], 500);
        }

        $data = $res->json();
        
        return response()->json($data);
    }
    
}