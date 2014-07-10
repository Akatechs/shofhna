<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table)
                {
                    
                    $table->increments('id');
                    $table->string('slug')->unique();
                    
                    $table->string('title')->default('');
                    
                    
                    
                    
                    $table->longText('content')->default('');
                    
                    $table->string('link')->default('');
                    $table->integer('sumvotes')->default(0);
                    $table->integer('views')->default(0);

                    $table->integer('user_id')->unsigned()->default(0);
                    $table->foreign('user_id')->references('id')->on('users');
                    
                    $table->integer('community_id')->unsigned()->default(0);
                    $table->foreign('community_id')->references('id')->on('communities');
                    $table->softDeletes();
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
		Schema::drop('posts');
	}
        
        

}
