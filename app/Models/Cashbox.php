<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
	use HasFactory, HasTimestamps;

	protected $table = 'cashboxes';

	protected $fillable = [
		'amount_1',
		'amount_2',
		'amount_5',
		'amount_10',
		'amount_20',
		'amount_50',
		'amount_100',
	];

	private static $coinValues = [
		'amount_1' => 1,
		'amount_2' => 2,
		'amount_5' => 5,
		'amount_10' => 10,
		'amount_20' => 20,
		'amount_50' => 50,
		'amount_100' => 100,
	];

	/**
	 * Get the value of the coin
	 *
	 * @param string $coin
	 * @return int
	 */
	public function getCoinValue(string $coin): int
	{
		return self::$coinValues[$coin];
	}

	/**
	 * Get the total amount of money in the cashbox
	 *
	 * @return int
	 */
	public function getTotal(): int
	{
		$total = 0;

		foreach (self::$coinValues as $coin => $value) {
			$total += $this->$coin * $value;
		}

		return $total;
	}
}
