<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        $items = Item::all();
        return response($items->toJson(), 200)->header('Content-Type', 'application/json');
    }

    public function store(Request $request) {
        $item = new Item;

        $item->name = $request->name;
        $item->status = $request->status;
        $item->my_list_id = $request->my_list_id;

        $item->save();
    }

    public function show($id) {
        return Item::where('id', $id)->toJson();
    }

    public function update(Request $request, $id) {
        $item = Item::find($id);

        $item->name = $request->name;
        $item->status = $request->status;

        $item->save();
    }

    public function destroy($id) {
        $item = Item::find($id);

        $item->delete();
    }
}
