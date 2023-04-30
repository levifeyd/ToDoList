<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'image',
        'tag_id'
    ];
    public $timestamps = false;
    public function getTags() {
        return $this->hasMany(Tag::class, 'item_id');
    }
    public function getItem() {
        return $this->belongsTo(ToDoList::class, 'to_do_list_id');
    }
}
