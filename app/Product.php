<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'brand_id', 'user_id', 'name', 'slug', 'details', 'price', 'description', 'image', 'thumbnail'];

    /* Relations */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function user(){
        return $this->belongsTo('App\User');
    }

}

