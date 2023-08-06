<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komik', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('picture', 255)->nullable();
            $table->integer('last_episode');
            $table->unsignedBigInteger('id_genre');
            $table->unsignedBigInteger('id_status');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes(); // untuk softdelete tidak sepenuhnya terhapus dari database

            $table->index(['id_genre', 'id_status']);

            $table->foreign('id_genre')->references('id')->on('genre')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_status')->references('id')->on('status')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komik');
    }
}
