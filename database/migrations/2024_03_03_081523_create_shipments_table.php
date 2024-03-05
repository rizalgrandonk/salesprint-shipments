<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('awb')->unique();
            $table->string('courier');
            $table->string('service');
            $table->string('status');
            $table->string('desc');
            $table->integer('amount');
            $table->integer('weight');
            $table->string('origin');
            $table->string('destination');
            $table->string('shipper');
            $table->string('receiver');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('shipments');
    }
};
