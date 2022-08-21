<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAmbilKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ambil_kegiatans', function (Blueprint $table) {
            $table->string('realisasi')->default('-')->after('target');
            $table->date('mulai_kegiatan')->nullable()->after('realisasi');
            $table->date('selesai_kegiatan')->nullable()->after('mulai_kegiatan');
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
            $table->dropColumn('realisasi');
            $table->dropColumn('mulai_kegiatan');
            $table->dropColumn('selesai_kegiatan');
        });
    }
}
