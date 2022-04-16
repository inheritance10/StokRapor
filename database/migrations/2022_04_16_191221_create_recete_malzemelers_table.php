<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recete_malzemeler', function (Blueprint $table) {
            $table->id();
            $table->integer('recete_id');
            $table->integer('malzemeler_id');
            $table->double('recete_malzeme_miktar');
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
        Schema::dropIfExists('recete_malzemeler');
    }
};
