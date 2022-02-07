<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCookieColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basket_books', function ($table) {
            $table->string('cookie')->nullable();
        });
    }

    public function down()
    {
        Schema::table('basket_books', function ($table) {
            $table->dropColumn('cookie');
        });
    }
}
