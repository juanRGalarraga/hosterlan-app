<?php

use App\Enums\Publication\AvailableDayEnum;
use App\Models\Guest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Publication;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('available_days', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Publication::class)->constrained('publications')->onDelete('cascade');
            $table->date('since');
            $table->date('to');
            $table->enum('state', AvailableDayEnum::forMigration())->default(AvailableDayEnum::Available->name);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_days');
    }
};
