<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    public function getItems() {
        return $this->hasMany(Item::class, 'to_do_list_id');
    }
}
