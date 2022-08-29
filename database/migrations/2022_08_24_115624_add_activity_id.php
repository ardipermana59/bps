<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivityId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilai_pegawais', function (Blueprint $table) {
            //
            $table
                ->foreignId('activity_id')
                ->after('evaluator_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilai_pegawais', function (Blueprint $table) {
            //
            $table->dropColumn('activity_id');
        });
    }
}
