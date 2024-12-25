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
        Schema::create('leaves', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('post_id');
//            $table->date('startdate');
//            $table->date('enddate');
//            $table->unsignedBigInteger('tag');
//            $table->string('title');
//            $table->text('content');
//            $table->unsignedBigInteger('stage_id')->default(2)->;
//            $table->unsignedBigInteger('authorized_id')->nullable();
//            $table->unsignedBigInteger('user_id');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};