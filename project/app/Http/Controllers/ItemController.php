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
//        $tags = Tag::all();
        return view('dashboard',[
            'items'=>$items,
//            'tag' =>$tags
        ]);
    }
    public function create() {
//        $tags = Tag::all();
        return view('items.create');
    }

    public function store(Request $request) {
        $request->validate([
            "name"=>'required|string|max:255'
        ]);
        $input = $request->all();
        Item::query()->create($input);
        return response('ok',200);
    }
//    public function show($id)
//    {
//        $item = Item::query()->findOrFail($id);
//        $tagsIds = DB::table('items_tags')->where('item_id', $id)
//            ->pluck('tag_id')->toArray();
//        $tags = Tag::query()->whereIn('id', $tagsIds)->get();
//        return view('items.show',[
//            'item'=>$item,
//            'tags'=>$tags
//        ]);
//    }

    public function edit($id) {
        $item = Item::query()->findOrFail($id);
//        $tags = Tag::all();
        return view("items.edit",[
            "item"=>$item,
//            "tags"=>$tags
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
    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $item = Item::query()->findOrFail($id);
        Storage::disk('public')->delete('images'.$item->image);
        Item::query()->where('id', $id)->update(['image'=> null]);
        return redirect()->route('dashboard')->with('status','Картинка удалена!');
    }
    public function storeTag($id, Request $request) {
        $request->validate([
            "name"=>'required|string|max:255'
        ]);
        $item= Item::query()->findOrFail($id);
        $input = ["name"=>$request->get('name'), 'item_id'=>$item->id];
        $tag = Tag::query()->create($input);
        DB::table('items_tags')->insert(['item_id' => $item->id, 'tag_id' => $tag->id]);
        return redirect()->back()->with('status','Добавлен новый тег для списка !');
    }
    public function createTag($id) {
        $item = Item::query()->findOrFail($id);
        return view('tags.create')->with(['item'=>$item]);
    }
}
