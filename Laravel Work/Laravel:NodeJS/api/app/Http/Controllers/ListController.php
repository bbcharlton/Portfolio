<?php

namespace App\Http\Controllers;

use App\MyList;
use Illuminate\Http\Request;

class ListController extends Controller {
    public function index() {
        $lists = MyList::all();
        return response($lists->toJson(), 200)->header('Content-Type', 'application/json');
    }

    public function store(Request $request) {
        $list = new MyList;

        $list->name = $request->name;

        $list->save();
    }

    public function show($id) {
        return MyList::with('items')->where('id', $id)->get();
    }
}
