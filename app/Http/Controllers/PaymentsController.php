<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;
use App\Cart;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }

    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->get();
        return response()->json(['payments' => $payments]);
    }

    public function user($id)
    {
        $payments = Payment::where('user_id', $id)->get();
        return response()->json(['payments' => $payments]);
    }
}
