<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 20)->nullable();
            $table->string('name', 150);
            $table->date('date_of_birth');
            $table->mediumText('address');
            $table->string('city', 50);
            $table->string('region', 50);
            $table->string('postcode', 10);
            $table->string('country_code', 2);
            $table->string('telephone', 20);
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
        Schema::dropIfExists('customers');
    }
}
