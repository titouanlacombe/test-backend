<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Cashboxes holding cash in values 1, 2, 5, 10, 20, 50, 100
		Schema::create('cashboxes', function (Blueprint $table) {
			$table->id();

			// Number of coins/bills in the cashbox for each value
			$table->unsignedBigInteger('amount_1')->default(0);
			$table->unsignedBigInteger('amount_2')->default(0);
			$table->unsignedBigInteger('amount_5')->default(0);
			$table->unsignedBigInteger('amount_10')->default(0);
			$table->unsignedBigInteger('amount_20')->default(0);
			$table->unsignedBigInteger('amount_50')->default(0);
			$table->unsignedBigInteger('amount_100')->default(0);

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
		Schema::dropIfExists('cashboxes');
	}
};
