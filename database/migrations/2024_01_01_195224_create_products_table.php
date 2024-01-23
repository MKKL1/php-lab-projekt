<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('cost');
            $table->decimal('saleCost')->nullable();
            $table->integer('quantity');
            $table->string('description')->nullable();
            $table->foreignId('image_id');
            $table->foreign('image_id')
                ->references('id')
                ->on('images');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
