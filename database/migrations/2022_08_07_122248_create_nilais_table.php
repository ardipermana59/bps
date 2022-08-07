<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ambil_kegiatan_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('target_realisasi')->default(0);
            $table->unsignedInteger('kerjasama')->default(0);
            $table->unsignedInteger('ketepatan_waktu')->default(0);
            $table->unsignedInteger('kualitas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}
