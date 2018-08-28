<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'product_id', 'name', 'body'];

    public function product()
    {
        return $this->belongsTo(Product::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
