<?php

use App\Models\RentType;
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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('price');
            $table->string('ubication');
            $table->text('description')->nullable();
            $table->integer('room_count');
            $table->integer('bathroom_count');
            $table->boolean('pets')->default(0);
            $table->integer('number_people');
            $table->enum('state', PublicationState::forMigration())->default(PublicationState::Available->value);
            $table->foreignIdFor(RentType::class)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
