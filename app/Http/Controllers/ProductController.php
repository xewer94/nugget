<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Brand;
use DB;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        if(request()->brand) {

            $products = Product::with('brand')->whereHas('brand', function($query) {
                $query->where('slug', request()->brand);
            })
                ->paginate(10);
            $brands = Brand::all();

        } else {

        $products = Product::orderBy('created_at','desc')->paginate(6);
        $brands = Brand::all();
        }

        return view('products.index')->with([
            'products' => $products,
            'brands' => $brands,
        ]);

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('products.create', [
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        // Handle File Upload
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Add watch
        $product = new Product;

        $test = $product->create($request->except('image'));
        $test->slug = str_slug($test->name);
        $test->user_id = auth()->user()->id;
        $test->image = $fileNameToStore;
        $test->update();


        return redirect('/watches')->with('success', 'Watch added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::with('brand')->whereHas('category', function ($query) use ($slug){
            $query->where('name', $slug);
        });

        if (request()->brand) {
            $brand = request()->brand;
            $products = $products->whereHas('brand', function ($query) use ($brand) {
                $query->where('slug', $brand);
            });
        }

        $products = $products->paginate(10);

        return view('products.index', compact('brands', 'categories', 'products'));
    }

    public function showProduct($brandSlug, $productSlug)
    {
        $product = Product::with('comments.user')->where('slug', $productSlug)->first();

        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        // Check for correct user
        if(auth()->user()->id !==$product->user_id){
            return redirect('/watches')->with('error', 'Unauthorized Page');
        }

        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required'
        ]);

         // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Add watch
        $product = new Product;
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->details = $request->input('details');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if($request->hasFile('cover_image')){
            $product->cover_image = $fileNameToStore;
        }
        $product->save();

        return redirect('/watches')->with('success', 'Watch updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        // Check for correct user
        if(auth()->user()->id !==$product->user_id){
            return redirect('/watches')->with('error', 'Unauthorized Page');
        }

        if($product->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$product->cover_image);
        }
        
        $product->delete();
        return redirect('/watches')->with('success', 'Watch deleted');
    }
}
