<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOdIssuesResourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('od_issues_resources', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->timestamps();
			$table->string('issue_id', 36)->index('fk_od_issues_resources_od_issues_idx');
			$table->string('resource_id', 36)->index('fk_od_issues_resources_hc_resources1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('od_issues_resources');
	}

}
