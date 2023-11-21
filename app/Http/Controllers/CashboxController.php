<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use Illuminate\Http\Request;

class CashboxController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(Cashbox::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// Not used
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'amount_1' => 'required|integer',
			'amount_2' => 'required|integer',
			'amount_5' => 'required|integer',
			'amount_10' => 'required|integer',
			'amount_20' => 'required|integer',
			'amount_50' => 'required|integer',
			'amount_100' => 'required|integer',
		]);

		$cashbox = Cashbox::create($request->all());

		return response()->json([
			'message' => 'Cashbox created successfully',
			'cashbox' => $cashbox
		], 201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$cashbox = Cashbox::findOrFail($id);

		return response()->json([
			'message' => 'Cashbox found successfully',
			'cashbox' => $cashbox
		], 200);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		// Not used
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$cashbox = Cashbox::findOrFail($id);

		$request->validate([
			'amount_1' => 'required|integer',
			'amount_2' => 'required|integer',
			'amount_5' => 'required|integer',
			'amount_10' => 'required|integer',
			'amount_20' => 'required|integer',
			'amount_50' => 'required|integer',
			'amount_100' => 'required|integer',
		]);

		$cashbox->update($request->all());

		return response()->json([
			'message' => 'Cashbox updated successfully',
			'cashbox' => $cashbox
		], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Cashbox::findOrFail($id)->delete();

		return response()->json([
			'message' => 'Cashbox deleted successfully'
		], 200);
	}
}
