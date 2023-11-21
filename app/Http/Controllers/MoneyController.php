<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
	public function index()
	{
		return response()->json('Cashbox API');
	}

	public function money_return(Request $request)
	{
		// Use validator instead of validate so it wont't redirect on error
		$validator = $this->getValidationFactory()->make($request->all(), [
			// The amount of money to pay
			'total_wanted' => 'required|integer',

			// The amount of each coin given
			'amount_1' => 'required|integer',
			'amount_2' => 'required|integer',
			'amount_5' => 'required|integer',
			'amount_10' => 'required|integer',
			'amount_20' => 'required|integer',
			'amount_50' => 'required|integer',
			'amount_100' => 'required|integer',
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'Invalid request',
				'errors' => $validator->errors()
			], 400);
		}

		$total_wanted = $request->input('total_wanted');
		$amounts_given = $request->only([
			'amount_1',
			'amount_2',
			'amount_5',
			'amount_10',
			'amount_20',
			'amount_50',
			'amount_100',
		]);

		// Get the cashbox
		$cashbox = Cashbox::firstOrFail(); // Assuming there is only one cashbox

		// Update the cashbox & compute the remainder
		$total_given = 0;
		foreach ($amounts_given as $coin => $amount_given) {
			$cashbox->$coin += $amount_given;
			$total_given += Cashbox::getCoinValue($coin) * $amount_given;
		}
		$remainder = $total_given - $total_wanted;

		if ($remainder < 0) {
			return response()->json([
				'message' => 'Not enough money given',
				'remainder' => $remainder
			], 400);
		}

		// Return algorithm
		$return_amounts = [];
		// Iterate over the coins in reverse order (from the biggest value to the smallest value)
		foreach (array_reverse(Cashbox::getCoins()) as $coin) {
			$coin_value = Cashbox::getCoinValue($coin);

			// Compute the maximum amount of this coin we can return
			$return_amount_max = intdiv($remainder, $coin_value);
			// Cannot return more than we have
			$return_amounts[$coin] = min($cashbox->$coin, $return_amount_max);
			// Update the remainder
			$remainder = $remainder - $coin_value * $return_amounts[$coin];
		}

		// If we don't have enough money to pay
		if ($remainder > 0) {
			return response()->json([
				'message' => 'Not enough money to pay',
			], 400);
		}

		// Update the cashbox
		foreach ($return_amounts as $coin => $return_amount) {
			$cashbox->$coin -= $return_amount;
		}
		$cashbox->save();

		// Return the response
		return response()->json([
			'message' => 'Money returned successfully',
			'return_amounts' => $return_amounts
		], 200);
	}
}
