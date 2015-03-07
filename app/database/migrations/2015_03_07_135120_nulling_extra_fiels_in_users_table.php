<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullingExtraFielsInUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			DB::statement('ALTER TABLE users MODIFY eps varchar(30) null');
			DB::statement('ALTER TABLE users MODIFY observaciones_generales varchar(30) null');

			DB::statement('ALTER TABLE users MODIFY facebook varchar(30) null');
			DB::statement('ALTER TABLE users MODIFY twitter varchar(30) null');
			DB::statement('ALTER TABLE users MODIFY fecha_nacimiento varchar(30) null');
			DB::statement('ALTER TABLE users MODIFY serial_marco varchar(30) null');
			DB::statement('ALTER TABLE users MODIFY grupo_sanguineo_id varchar(30) null');

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
