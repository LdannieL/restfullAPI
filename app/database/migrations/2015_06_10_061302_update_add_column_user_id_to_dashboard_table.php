<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddColumnUserIdToDashboardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dashboard', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			// $table->dropColumn('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dashboard', function(Blueprint $table)
		{
			$table->dropColumn('user_id');
			// $table->integer('user_id')->unsigned();
		});
	}

}
