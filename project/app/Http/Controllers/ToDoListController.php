<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tag;
use App\Models\ToDoList;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    public function index() {
        $lists = ToDoList::all();
//        dd($lists);
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
    public function filterTag(Request $request) {
        $tagName = $request->get('name_tag');
        $tags = Tag::query()->where('name', $tagName)->pluck('item_id');
        $items = Item::query()->whereIn('id', $tags)->pluck('to_do_list_id');
        $lists = ToDoList::query()->whereIn('id', $items)->get();
        return view('dashboard',[
            'lists'=>$lists,
            'filtered_tags'=>$tags
        ]);
    }
}
