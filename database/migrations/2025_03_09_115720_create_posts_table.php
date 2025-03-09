<?php

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
        //table name should be plural
        // posts table ==>(id , title(varchar) , description (TEXT), created_at (DATETIME))
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', length: 100);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
