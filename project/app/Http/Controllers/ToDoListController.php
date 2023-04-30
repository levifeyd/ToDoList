<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ToDoList;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    public function index() {
        $lists = ToDoList::all();
        return view('dashboard',[
            'lists'=>$lists,
        ]);
    }
    public function create() {
        return view('lists.create');
    }

    public function store(Request $request) {
        $request->validate([
            "name"=>'required|string|max:255'
        ]);
        $input = $request->all();
        ToDoList::query()->create($input);
        return response('ok',200);
    }
}
