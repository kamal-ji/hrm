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
        Schema::create('binary_trees', function (Blueprint $table) {
    $table->unsignedBigInteger('user_id')->primary();
    $table->unsignedBigInteger('parent_id')->nullable()->index();
    $table->enum('position', ['left', 'right'])->nullable();
    $table->text('path')->nullable(); 
    $table->integer('left_count')->default(0); // Total people on left leg
    $table->integer('right_count')->default(0); // Total people on right leg
    $table->integer('total_downlines')->default(0);
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binary_trees');
    }
};
