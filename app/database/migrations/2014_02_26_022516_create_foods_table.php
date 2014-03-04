<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class CreateFoodsTable extends Migration {

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
	        $table->string('name');
	        $table->string('pic');
	        $table->string('type');
	        $table->float('price');
	        $table->integer('times');
	        $table->string('tag');
	        $table->string('status');
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
