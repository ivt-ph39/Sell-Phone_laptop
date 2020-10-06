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
            $table->string('name', 150)->unique();
            $table->unsignedInteger('quantity');
            $table->boolean("active");
            $table->integer('price');
            $table->integer('sale')->nullable();
            $table->boolean('hot');
            $table->integer('view')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string("avatar");
            $table->string('title', 100);
            $table->json("promotion")->nullable(); // khuyên mãi
            $table->json("technical")->nullable(); // Thông số kĩ thuật
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('manager_admins');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
            $table->softDeletes();
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