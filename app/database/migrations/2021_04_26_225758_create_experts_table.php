<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('experts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->String('name', 50);//唯一
            $table->String('portrait', 50);
            $table->String('department', 50);
            $table->String('title', 50);
            $table->String('position', 50);
            $table->String('hospital', 50);
            $table->String('introduction', 50);
            $table->String('edu', 50);
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
		Schema::drop('experts');
	}

}
