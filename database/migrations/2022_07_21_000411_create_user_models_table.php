<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // php artisan make:model UserModel --migration => create user_models table alongside migrations
    // php artisan migrate => create user_models table
    // php artisan migrate:rollback => drop user_models table
    // php artisan migrate:reset => drop user_models table and create new one
    // php artisan migrate:fresh => drop user_models table and create new one and migrate
    // php artisan migrate:refresh => drop user_models table and create new one and migrate and seed
    // php artisan migrate:status => show status of migrations
    // php artisan migrate:make => create new migration file

    // php artisan migrate:make CreateUserModelsTable => create new migration file with name CreateUserModelsTable
    // php artisan migrate:make CreateUserModelsTable --table=user_models => create new migration file with name CreateUserModelsTable and table name user_models
    // php artisan migrate:make CreateUserModelsTable --table=user_models --path=database/migrations => create new migration file with name CreateUserModelsTable and table name user_models and save it in database/migrations folder
    // php artisan migrate:make CreateUserModelsTable --table=user_models --path=database/migrations --create => create new migration file with name CreateUserModelsTable and table name user_models and save it in database/migrations folder and create table
    // php artisan migrate:make CreateUserModelsTable --table=user_models --path=database/migrations --create --foreign => create new migration file with name CreateUserModelsTable and table name user_models and save it in database/migrations folder and create table and add foreign key


    public function up()
    {
        Schema::create('user_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->integer('phone');
            $table->integer("age");
            $table->longText('description')->nullable();
            $table->string('gender');
            $table->string('password');
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
        Schema::dropIfExists('user_models');
    }
}
