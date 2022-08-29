<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaPenilaiToTableAmbilKegiatans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ambil_kegiatans', function (Blueprint $table) {
            $table
            ->string('nama_penilai')
            ->after('activity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ambil_kegiatans', function (Blueprint $table) {
            $table->dropColumn('nama_penlai');
        });
    }
}
