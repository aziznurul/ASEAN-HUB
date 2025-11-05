<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->integer('rank')->nullable()->after('is_finalist'); // Add rank column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('rank'); // Remove rank column if rolling back migration
        });
    }
};
