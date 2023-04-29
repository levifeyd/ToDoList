<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index() {
        $items = Item::all();
        return view('dashboard',[
            'items'=>$items,
        ]);
    }
    public function create() {
        $tags = Tag::all();
        return view('items.create')->with(['tags'=>$tags]);
    }

    public function store(Request $request) {
        $request->validate([
            "name"=>'required|string|max:255'
        ]);
        $input = $request->all();
        Item::query()->create($input);
        return response('ok',200);
    }
    public function show($id)
    {
        $item = Item::query()->findOrFail($id);
        $tagsIds = DB::table('items_tags')->where('item_id', $id)
            ->pluck('tag_id')->toArray();
        $tags = Tag::query()->whereIn('id', $tagsIds)->get();
        return view('items.show',[
            'item'=>$item,
            'tags'=>$tags
        ]);
    }

    public function edit($id) {
        $item = Item::query()->findOrFail($id);
        $tags = Tag::all();
        return view("items.edit",[
            "item"=>$item,
            "tags"=>$tags
        ]);
    }
    public function update($id, Request $request) {
        $request->validate([
            "name"=>'string|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $input = $request->all();
        $input['image'] = str_replace("public/images", "", $request->file("image")->store("public/images"));

        $item = Item::query()->findOrFail($id);
        $item->update($input);
        return redirect()->back()->with('status','Данные списка изменены!');
    }
}
