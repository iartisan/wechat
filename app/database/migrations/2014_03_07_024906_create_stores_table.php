<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stores', function(Blueprint $table) {
			$table->increments('id');
			$table->string('address');
			$table->integer('phone');
			$table->string('message');
			$table->string('keyword');
			$table->float('pointer_x');
			$table->float('pointer_y');
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
