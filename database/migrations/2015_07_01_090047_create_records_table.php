<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function(Blueprint $table){
            $table->increments('id');
            $table->string('user_name');
            $table->string('sno');
            $table->integer('age');
            $table->string('gender', 3);
            $table->string('phone', 55);
            $table->string('phone_province', 22);
            $table->string('phone_city', 22);
            $table->string('phone_supplier', 22);
            $table->string('id_card', 33);
            $table->string('grade', 10);
            $table->string('degree', 20);
            $table->string('major', 55);
            $table->string('class_name', 99);
            $table->string('course_name', 99);
            $table->string('record_type', 20);
            $table->string('pay_type', 20);
            $table->string('pay_status', 20);
            $table->string('orgnazation', 55);
            $table->timestamps();
            $table->dateTime('deleted_at');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('records');
    }
}
