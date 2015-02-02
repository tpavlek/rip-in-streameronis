<?php

use Illuminate\Database\Migrations\Migration;

class AddUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(\Illuminate\Database\Schema\Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('display_name');
            $table->string('username');
            $table->string('email');

            $table->string('stripe_customer_id')->nullable();


            $table->primary('id');
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
        Schema::drop('users');
    }

}
