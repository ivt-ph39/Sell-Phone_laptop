<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('adminName', 100);
            $table->string('email', 100)->unique();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->tinyInteger('level')->nullable();
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
        Schema::dropIfExists('manager_admins');
    }
}