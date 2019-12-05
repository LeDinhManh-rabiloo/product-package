<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('id_lang');
            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('url_key')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('products_langs');
    }
}
