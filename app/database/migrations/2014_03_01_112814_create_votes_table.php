<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('votes', function($table)
            {
                $table->increments('id');

                $table->integer('user_id')->unsigned()->default(0);
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                $table->integer('target_id')->unsigned()->default(0);
                $table->string('target_type',30);
                
                // the vote value, can be -1,0 or 1
                $table->tinyInteger('vote');
                
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
		Schema::drop('votes');
	}

}
