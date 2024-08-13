<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Publication\PublicationState;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publications_available_days', function (Blueprint $table) {
            $table->unsignedBigInteger('publication_id')->primary();
            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
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
        Schema::dropIfExists('publications_available_days');
    }
};
