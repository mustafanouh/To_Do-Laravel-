<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',

    ];

    public function  taskes()
    {
        return $this->hasMany(Taske::class);
    }

    protected static function booted()
    {
        static::deleting(function ($category) {
            $category->tasks()->delete();
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
