<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\Cart;

class ItemsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin-api')->only('create', 'edit', 'destroy');
    }

    public function slide()
    {
        $items = Item::orderBy('id', 'desc')->limit(10)->get();
        return response()->json(['items' => $items]);
    }

    public function index()
    {
        $items = Item::orderBy('id', 'desc')->get();
        return response()->json(['items' => $items]);
    }

    public function create()
    {
        $form = Item::form();

        return response()->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'reference' => 'required|max:255',
            'name' => 'required|max:255',
            'description' => 'required|max:3000',
            'category' => 'required|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $item = new Item($request->all());
        $item->save();

        return response()->json(['created' => true, 'item' => $item->id]);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return response()->json(['item' => $item]);
    }

    public function edit($id)
    {
        $form = Item::findOrFail($id);
        $form->categories = ['vente', 'acces', 'solaire', 'temps', 'video', 'alarme', 'incendie', 'rfid'];

        return response()->json(['form' => $form]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'reference' => 'required|max:255',
            'name' => 'required|max:255',
            'description' => 'required|max:3000',
            'category' => 'required|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $item = Item::findOrFail($id);

        $item->reference = $request->reference;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category = $request->category;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->stock = $request->stock;

        $item->save();

        return response()->json(['edited' => true, 'item' => $item->id]);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        Cart::where('item_id', $item->id)->delete();

        $item->delete();

        return response()->json(['deleted' => true]);
    }

    public function category($id)
    {
        $items = Item::where('category', $id)->get();

        return response()->json(['items' => $items]);
    }
}
