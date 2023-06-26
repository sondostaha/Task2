<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'category_id'
    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class , CategoryPost::class ,'post_id','category_id');
    }
}
