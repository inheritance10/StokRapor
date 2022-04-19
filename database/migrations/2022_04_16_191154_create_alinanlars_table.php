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
        Schema::create('alinanlar', function (Blueprint $table) {
            $table->id();
            $table->integer('malzeme_id');
            $table->double('alinan_miktar');
            $table->double('stok_miktar');
            $table->double('toplam_fiyat');
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
        Schema::dropIfExists('alinanlar');
    }
};
