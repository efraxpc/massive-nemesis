<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangingFileNamesInUsersTableAndRenameThem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
		    $table->dateTime('serial_marco')->after('fechaNacimiento');
		    $table->renameColumn('observacionesGenerales', 'observaciones_generales');
		    $table->renameColumn('fechaNacimiento', 'fecha_nacimiento');
		    $table->renameColumn('grupoSanguineo', 'grupo_sanguineo');
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
