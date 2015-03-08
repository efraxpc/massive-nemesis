<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDeSangreForeingkeyAgain extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->dropColumn('grupo_sanguineo_id');
		});

        Schema::table('users', function($table)
		{
			$table->integer('grupo_sanguineo_id')->unsigned()->nullable();
			$table->foreign('grupo_sanguineo_id')->references('id')->on('tipo_de_sangre');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('password_reminders');
        Schema::drop('users');
	}

}
