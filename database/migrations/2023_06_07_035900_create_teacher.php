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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('email');
            $table->string('fullname');
            $table->enum('gender',['male', 'female', 'none']);
            $table->string('password');
            $table->string('designation');
            $table->string('skills');
            $table->float('experience');
            $table->text('description');
            $table->string('photo');
            $table->string('facebook');
            $table->string('zalo');
            $table->string('phoneNumber');
            $table->string('twitter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
