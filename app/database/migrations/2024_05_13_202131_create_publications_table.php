<?php

use App\Models\RentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Publication\StateEnum;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('');
            $table->float('price')->nullable();
            $table->string('ubication')->default('');
            $table->text('description')->nullable();
            $table->integer('bathroom_count')->default(1);
            $table->boolean('pets')->default(0);
            $table->integer('number_people')->default(1);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('state', StateEnum::forMigration())->default(StateEnum::Published->name);
            $table->foreignIdFor(RentType::class)->default(1);
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
