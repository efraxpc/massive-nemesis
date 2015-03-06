<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
		    $table->string('grupoSanguineo',30);
		    $table->string('eps',30)->after('grupoSanguineo');
		    $table->longText('observacionesGenerales')->after('eps');
		    $table->string('facebook',30)->after('observacionesGenerales');
		    $table->string('twitter',30)->after('facebook');
		    $table->dateTime('fechaNacimiento')->after('twitter');
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
