<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            "name"=>'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
//        $item = Item::query()->findOrFail($id);
        $input = $request->all();

        if (isset($input['image']) && !isset($input['name'])) {
            $input['image'] = str_replace("public/images", "", $request->file("image")->store("public/images"));
            Item::query()->where('id', $id)->update(['image' => $input['image']]);
        } else if(!isset($input['image']) && isset($input['name'])) {
            Item::query()->where('id', $id)->update(['name' => $input['name']]);
        } else if(isset($input['image']) && isset($input['name'])){
            Item::query()->where('id', $id)->update($input);
        } else {
            redirect()->back()->with('status','Данные списка не изменены!');
        }
        return redirect()->back()->with('status','Данные списка изменены!');
    }
    public function delete($id) {
        $item = Item::query()->findOrFail($id);
        Storage::disk('public')->delete('images'.$item->image);
        $item->update(['image', null]);
        return redirect()->route('dashboard')->with('status','Картинка удалена!');
    }
}
