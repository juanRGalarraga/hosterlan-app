<?php

use App\Models\Publication;
use App\Models\PublicationDayAvailable;
use App\Enums\Publication\AvailableDayEnum;
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
        Schema::create('reservation_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Publication::class)->constrained('publications')->cascadeOnDelete();
            $table->foreignIdFor(PublicationDayAvailable::class)->constrained('publications')->cascadeOnDelete();
            $table->enum('state', AvailableDayEnum::forMigration())->default(AvailableDayEnum::Pending->name);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_guests');
    }
};
