<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->string('slug');
            $table->string('price');
            $table->text('content');
            $table->string('discount');
            $table->string('img');
            $table->string('quantily');
            $table->string('weight');
            $table->string('memory');
            $table->string('webcam');
            $table->string('ram');
            $table->string('os');
            $table->string('battery');
            $table->string('bluetooth');
            $table->string('warranty');
            $table->string('cpu');
            $table->string('color');
            $table->string('keywords');
            $table->longText('description');
            $table->integer('view');
            $table->integer('status');
            $table->integer('id_category');
            $table->integer('id_user');
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
        Schema::drop('product');
    }
}
