<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			

    Schema::create('notifications', function($table)
                {
                    $table->engine = 'InnoDB';
     
                    $table->increments('id')->unsigned();
     
                    $table->integer('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users');
                   
                    $table->string('event_type');
                    $table->boolean('read')->default(false);
                    $table->mediumText('properties')->default('');
                   
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
		Schema::drop('notifications');
	}

}
