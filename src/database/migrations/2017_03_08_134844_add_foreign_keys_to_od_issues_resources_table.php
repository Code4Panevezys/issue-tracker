<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOdIssuesResourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('od_issues_resources', function(Blueprint $table)
		{
			$table->foreign('resource_id', 'fk_od_issues_resources_hc_resources1')->references('id')->on('hc_resources')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('issue_id', 'fk_od_issues_resources_od_issues')->references('id')->on('od_issues')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('od_issues_resources', function(Blueprint $table)
		{
			$table->dropForeign('fk_od_issues_resources_hc_resources1');
			$table->dropForeign('fk_od_issues_resources_od_issues');
		});
	}

}
