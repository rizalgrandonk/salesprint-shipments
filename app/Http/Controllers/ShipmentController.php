<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller {
    public function track(Request $request) {
        $queryAwb = $request->query('awb');
        if (!$queryAwb) {
            return response()->json([
                'error' => 'AWB is required',
                'message' => 'AWB is required'
            ], 400);
        }

        $shipment = Shipment::where('awb', $queryAwb)->first();
        if (!$shipment) {
            return response()->json([
                'error' => 'Data not found',
                'message' => 'Data not found'
            ], 400);
        }

        return response()->json([
            'message' => 'Successfully tracked package',
            'summary' => [
                'awb' => $shipment->awb,
                'courier' => $shipment->courier,
                'service' => $shipment->service,
                'status' => $shipment->status,
                'date' => $shipment->created_at->format('Y-m-d h:i:s'),
                'desc' => $shipment->desc,
                'amount' => $shipment->amount,
                'weight' => $shipment->weight,
            ],
            'detail' => [
                'origin' => $shipment->origin,
                'destination' => $shipment->destination,
                'shipper' => $shipment->shipper,
                'receiver' => $shipment->receiver,
            ]
        ], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShipmentRequest $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment) {
        //
    }
}
