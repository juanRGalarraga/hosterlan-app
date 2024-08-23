<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Publication\PublicationState;
use App\Models\Publication;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publication_day_availables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Publication::class)->constrained('publications')->onDelete('cascade');
            $table->datetime('since');
            $table->datetime('to');
            $table->enum('state', PublicationState::forMigration())->default(PublicationState::Available->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_day_availables');
    }
};
