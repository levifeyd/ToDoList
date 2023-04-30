<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
