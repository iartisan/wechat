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
		 Schema::create('foods', function($table)
	    {
	        $table->increments('id');
	        $table->string('name')->unique();
	        $table->string('pic');
	        $table->integer('type');
	        $table->float('price');
	        $table->integer('times');
	        $table->string('tag');
	        $table->integer('status');
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
		//
	}

}
