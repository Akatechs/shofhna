<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('flags', function($table)
            {
                $table->increments('id');

                $table->integer('user_id')->unsigned()->default(0);
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                $table->integer('target_id')->unsigned()->default(0);
                $table->string('target_type',30);

                // the vote value, can be -1,0 or 1
                $table->string('type',30);

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
                    Schema::drop('flags');
	}

}
