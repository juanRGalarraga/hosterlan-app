<?php

use App\Enums\Reservation\ReservationStateEnum;
use App\Models\Guest;
use App\Models\AvailableDay;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AvailableDay::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Guest::class)->constrained()->cascadeOnDelete();
            $table->enum('state', ReservationStateEnum::forMigration())->default(ReservationStateEnum::PreReserved->name);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
