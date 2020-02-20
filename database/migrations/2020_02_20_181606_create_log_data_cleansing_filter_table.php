<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogDataCleansingFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_data_cleansing_filter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id');
            $table->integer('score');
            $table->mediumText('title_correct_suggestion')->nullable();
            $table->mediumText('name_correct_suggestion')->nullable();
            $table->mediumText('email_correct_suggestion')->nullable();
            $table->mediumText('date_of_birth_correct_suggestion')->nullable();
            $table->mediumText('address_correct_suggestion')->nullable();
            $table->mediumText('city_correct_suggestion')->nullable();
            $table->mediumText('region_correct_suggestion')->nullable();
            $table->mediumText('postcode_correct_suggestion')->nullable();
            $table->mediumText('country_code_correct_suggestion')->nullable();
            $table->mediumText('telephone_correct_suggestion')->nullable();
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
        Schema::dropIfExists('log_data_cleansing_filter');
    }
}
