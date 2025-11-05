<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Referensi ke tabel users
            $table->foreignId('submission_id')->constrained()->onDelete('cascade'); // Referensi ke tabel submissions
            $table->timestamps(); // Menyimpan waktu vote
        });
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }
}

