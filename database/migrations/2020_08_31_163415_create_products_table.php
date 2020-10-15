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
            $table->string("avatar");
            $table->string('title', 100);
            $table->json("promotion")->nullable(); // khuyên mãi
            $table->json("technical")->nullable(); // Thông số kĩ thuật
            $table->longText('description')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained()->OnDelete('set null');
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