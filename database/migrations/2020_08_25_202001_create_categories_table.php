<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('c_name')->unique();
            $table->string('c_icon', 30)->nullable();
            $table->string('c_image', 100)->nullable();
            // $table->tinyInteger('parent_id')->unsigned();
            $table->tinyInteger('c_active')->unsigned();
            $table->integer('c_total_product')->nullable();
            $table->unsignedBigInteger('c_create_by')->nullable();
            $table->foreign('c_create_by')->references('id')->on('manager_admins');
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
        Schema::dropIfExists('categories');
    }
}