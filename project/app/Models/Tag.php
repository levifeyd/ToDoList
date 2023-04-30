<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'item_id',
    ];
    public $timestamps = false;
    public function getItem() {
        return $this->belongsTo(Tag::class, 'item_id');
    }
}
