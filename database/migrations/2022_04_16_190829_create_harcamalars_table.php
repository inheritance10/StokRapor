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
        Schema::create('harcamalar', function (Blueprint $table) {
            $table->id();
            $table->integer('malzeme_id');
            $table->string('harcama_turu')->comment('satış veya bozulma vb');
            $table->double('harcama_miktari');
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
        Schema::dropIfExists('harcamalar');
    }
};
