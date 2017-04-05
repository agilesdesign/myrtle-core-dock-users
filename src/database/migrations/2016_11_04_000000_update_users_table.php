<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        	$table->dropColumn('name');
			$table->dropColumn('email');
			$table->string('timezone');
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->integer('deleted_by')->unsigned()->nullable()->default(null);
            $table->integer('updated_by')->unsigned()->nullable()->default(null);
            $table->timestamp('disabled_at')->nullable()->default(null);
            $table->timestamp('last_visit_at')->nullable()->default(null);
            $table->softDeletes();
        });
    }

	public function down()
	{
		//
	}
}
