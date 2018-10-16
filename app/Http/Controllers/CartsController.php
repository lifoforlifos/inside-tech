<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\User;
use App\Item;
use App\Payment;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CartsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:api')->except('checkout');
    }

    public function index()
    {
        $user = auth()->user()->id;
        $carts = Cart::where('user_id', $user)->get();

        if (count($carts) > 0) {
            return response()->json(['carts' => $carts]);
        } else {
            return response()->json(['error' => "You don't have any product in your cart!"], 422);
        }
    }

    public function create()
    {
        $form = Cart::form();

        return response()->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'item_id' => 'required',
            'quantity' => 'required'
        ]);

        $user = auth()->user()->id;

        $crt = Cart::where('item_id', $request->item_id)->where('user_id', $user)->first();

        if ($crt) {
            return response()->json(['error' => 'item already in cart'], 422);
        } else {
            $item = Item::where('id', $request->item_id)->first();

            $cart = new Cart();
            $cart->item_id = $request->item_id;
            $cart->quantity = $request->quantity;
            $cart->user_id = $user;
            $cart->price = $item->price;
            $cart->sub_total = $item->price * $request->quantity;
            $cart->item_name = $item->name;
            $cart->save();

            return response()->json(['saved' => true, 'cart' => $cart->id]);
        }
    }

    public function show($id)
    {
        $user = auth()->user()->id;
        $cart = Cart::where('id', $id)->where('user_id', $user)->first();

        return response()->json(['cart' => $cart]);
    }

    public function edit($id)
    {
        $user = auth()->user()->id;
        $form = Cart::where('id', $id)->where('user_id', $user)->first();

        return response()->json(['form' => $form]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'quantity' => 'required'
        ]);

        $user = auth()->user()->id;
        $cart = Cart::where('id', $id)->where('user_id', $user)->first();

        $item = Item::where('id', $cart->item_id)->first();
        $stock = $item->stock;

        if ($request->quantity > 0 && $request->quantity <= $stock) {
            $sub_total = $request->quantity * $cart->price;
            $cart->update(['quantity' => $request->quantity, 'sub_total' => $sub_total]);
            $carts = Cart::where('user_id', $user)->get();

            return response()->json(['edited' => true, 'carts' => $carts]);
        } else {
            if ($request->quantity <= 0) {
                return response()->json(['error' => 'the quantity must be greater than 0'], 422);
            } if ($request->quantity > $stock) {
                return response()->json(['error' => 'the quantity must be lesser than stock'], 422);
            }
        }
    }

    public function destroy($id)
    {
        $user = auth()->user()->id;
        $cart = Cart::where('id', $id)->where('user_id', $user)->first();

        $cart->delete();

        $carts = Cart::where('user_id', $user)->get();

        return response()->json(['deleted' => true, 'carts' => $carts]);
    }

    public function count()
    {
        if (auth()->user()) {
            $user = auth()->user()->id;
            $carts = Cart::where('user_id', $user)->get();
            $count = count($carts);
        } else {
            $count = 0;
        }

        return response()->json(['count' => $count]);
    }

    public function total()
    {
        $user = auth()->user()->id;
        $carts = Cart::where('user_id', $user)->get();

        $sub_total = [];

        foreach ($carts as $cart) {
            $sub_total[] = $cart->sub_total;
        }

        $total = 0;
        for ($i=0; $i < count($carts); $i++) {
            $total += $sub_total[$i];
        }

        return response()->json(['total' => $total]);
    }

    public function checkout(Request $request)
    {
        $amount = $request->total;
        $source = $request->stripeToken;
        $user_id = $request->user_id;

        try {
            $charge = Stripe::charges()->create([
                'amount' => $amount,
                'currency' => 'MAD',
                'source' => $request->stripeToken,
            ]);

            $payment = new Payment();
            $payment->user_id = $user_id;
            $payment->amount = $amount;
            $payment->save();

            $carts = Cart::where('user_id', $user_id)->get();

            // substract the quantity from stock
            foreach ($carts as $cart) {
                $item_id = $cart->item_id;
                $item = Item::where('id', $item_id)->first();

                $stock = $item->stock - $cart->quantity;

                $item->update(['stock' => $stock]);
            }

            // delete the carts
            for ($i=0; $i < count($carts); $i++) {
                $cart = $carts[$i];
                $cart->delete();
            }

            //success
            return redirect('/items');


        } catch (CardErrorException $e) {
            // save info to database for failed
            return response()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
