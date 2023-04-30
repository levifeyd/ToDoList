<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tag;
use App\Models\ToDoList;
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
    public function create($id) {
        $list = ToDoList::query()->findOrFail($id);
        return view('items.create')->with(['list'=>$list]);
    }

    public function store($id, Request $request) {
        $request->validate([
            "name"=>'required|string|max:255'
        ]);
        $item = ToDoList::query()->findOrFail($id);
        DB::table('items')->insert([
            'name' => $request->get('name'),
            "image"=>null,
            "to_do_list_id"=>$id
        ]);
        return redirect()->back()->with('status','Новый пункт создан!');
    }

    public function edit($id) {
        $item = Item::query()->findOrFail($id);
        return view("items.edit",[
            "item"=>$item,
        ]);
    }
    public function update($id, Request $request) {
        $request->validate([
            "name"=>'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);
        $input = $request->all();

        if (isset($input['image']) && !isset($input['name'])) {
             $input['image'] = $this->changeAndDownloadImage($id, $request, $input);
            Item::query()->where('id', $id)->update(['image' => $input['image']]);
        } else if(!isset($input['image']) && isset($input['name'])) {
            Item::query()->where('id', $id)->update(['name' => $input['name']]);
        } else if(isset($input['image']) && isset($input['name'])){
            $input['image'] = $this->changeAndDownloadImage($id, $request, $input);
            Item::query()->where('id', $id)->update([
                'name' => $input['name'],
                'image' => $input['image']
            ]);
        } else {
            redirect()->back()->with('status','Данные списка не изменены!');
        }
        return redirect()->back()->with('status','Данные списка изменены!');
    }
    private function changeAndDownloadImage($id, $request, $input) {
        $item = Item::query()->findOrFail($id);
        Storage::disk('public')->delete('images'.$item->image);
        $input['image'] = str_replace("public/images", "", $request->file("image")->store("public/images"));
        return $input['image'];
    }
    public function delete($id)
    {
        $item = Item::query()->findOrFail($id);
        Storage::disk('public')->delete('images'.$item->image);
        Item::query()->where('id', $id)->update(['image'=> null]);
        return redirect()->route('dashboard')->with('status','Картинка удалена!');
    }
    public function createTag($id) {
        $item = Item::query()->findOrFail($id);
        return view('tags.create')->with(['item'=>$item]);
    }
    public function storeTag($id, Request $request) {
        $request->validate([
            "name"=>'required|string|max:255'
        ]);
        $item = Item::query()->findOrFail($id);
        $input = ["name"=>$request->get('name'), 'item_id'=>$item->id];
        $tag = Tag::query()->create($input);
        DB::table('items_tags')->insert(['item_id' => $item->id, 'tag_id' => $tag->id]);
        return redirect()->back()->with('status','Добавлен новый тег для списка !');
    }
}
