<?php

namespace App\Http\Controllers;

use App\Models\Money;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    public function index()
    {
        return response()->json('Hello World');
    }

}
