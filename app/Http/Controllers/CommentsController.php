<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;

class CommentsController extends Controller
{
    public function store($brandSlug, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $product->comments()->create([
            'body'=>request('body'),
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
        ]);
        
    
        return back();

    }
}
