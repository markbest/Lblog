<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('articles', function($table) {
		    $table->integer('cat_id');
			$table->text('summary')->nullable();
			$table->integer('views')->default('1');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('articles', function($table) {
            $table->dropColumn('cat_id');
			$table->dropColumn('summary');
			$table->dropColumn('views');
        });
	}

}
