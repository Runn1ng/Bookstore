<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->increments('pub_id');
            $table->string('name', 50);
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('cat_id');
            $table->string('name', 50);
        });

        Schema::create('books', function (Blueprint $table) {
            $table->increments('book_id');
            $table->string('title', 50);
            $table->unsignedBigInteger('pub_id');
            $table->unsignedBigInteger('cat_id');
            $table->string('author', 50);
            $table->unsignedSmallInteger('pages');
            $table->unsignedInteger('price');
            $table->year('dat')->comment('Год издания');
            $table->string('image', 50);
        });

        Schema::create('basket_books', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedInteger('count');
        });

        
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->string('patronymic', 50)->nullable();
            $table->string('email')->unique();
            $table->string('login')->unique();
            $table->string('password');
            $table->boolean('subscribe')->default(false);
            $table->boolean('is_admin')->default(false);
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('order_id');
            $table->datetime('order_date');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedInteger('dostavka');
            $table->unsignedInteger('bonus');
        });

        Schema::create('order_books', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedInteger('count');
            $table->unsignedInteger('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publishers');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('books');
        Schema::dropIfExists('basket_books');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_books');
    }
}
