<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('users', function($table)
	    {
	    	$table->engine = 'InnoDB';

	        $table->increments('id')->unsigned();
	        $table->string('email')->unique();
	        $table->string('photo')->nullable()->default(NULL);
                $table->string('fullname');
	        $table->string('username')->unique();
                $table->string('website');
	        $table->string('password');
                $table->string('password_temp');
                $table->string('code');
                $table->integer('reputation',0);
                $table->text('bio');
                $table->boolean('active', false);
	        $table->boolean('is_admin', false);
                $table->softDeletes();
	        $table->timestamps();
	    });
	}

	public function down()
	{
	    Schema::drop('users');
	}

}
