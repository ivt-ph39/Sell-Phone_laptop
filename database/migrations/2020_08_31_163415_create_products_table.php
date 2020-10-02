<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('p_name', 150)->unique();
            $table->unsignedInteger('p_number');
            $table->tinyInteger("p_active");
            $table->integer('p_price');
            $table->integer('p_sale')->nullable();
            $table->tinyInteger('p_hot');
            $table->integer('p_view')->nullable();
            $table->unsignedBigInteger('p_category_id');
            $table->string("p_avatar");
            $table->string('p_title', 100);
            // $table->text('p_keyword_seo')->nullable();
            $table->json("p_promotion")->nullable(); // khuyên mãi
            $table->json("p_technical")->nullable(); // Thông số kĩ thuật
            $table->longText('p_detail')->nullable();
            $table->unsignedBigInteger('p_created_by');
            $table->unsignedBigInteger('p_update_by')->nullable();
            $table->foreign('p_created_by')->references('id')->on('manager_admins');
            $table->foreign('p_category_id')->references('id')->on('categories');
            $table->foreign('p_update_by')->references('id')->on('manager_admins');

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
        Schema::dropIfExists('products');
    }
}