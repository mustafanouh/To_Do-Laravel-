<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taske extends Model
{
    protected $fillable = [
        'title',
        'description',
        'isCompleted',
        'priority',
        'user_id'
    ];

    public   function category()
    {
        return $this->belongsTo(Category::class);
    }
}
