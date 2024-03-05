<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model {
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
    ];

    protected $fillable = [
        'awb',
        'courier',
        'service',
        'status',
        'desc',
        'amount',
        'weight',
        'origin',
        'destination',
        'shipper',
        'receiver',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/shipments/' . $this->getKey());
    }
}
