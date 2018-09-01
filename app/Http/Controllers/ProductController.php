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
        $this->middleware('auth', ['except' => ['index', 'show', 'showProduct', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        // If there is brand in request, get products based on selected brand
        if(request()->brand) {

            // Eager load brand relation for product (optional, will still works without it but with more db queries)
            $products = Product::with('brand')
                // Get products where brand is equal to brand value from request form
                ->whereHas('brand', function($query) {
                    $query->where('slug', request()->brand);
                })
                ->paginate(10);
            $brands = Brand::all();

        }
        // If there isn't brand in form request, load all products sorted by created date descending
        else {

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

        // Get object instance of product model
        $product = new Product;

        // Insert product fields into db except field for image
        $createdProduct = $product->create($request->except('image'));

        // Since product is created, his object model instance is stored in $createdProduct,
        // that means that we can directly update that product without doing "Product::find(..)"
        $createdProduct->slug = str_slug($createdProduct->name);
        $createdProduct->user_id = auth()->user()->id;
        $createdProduct->image = $fileNameToStore;
        $createdProduct->update();


        return redirect('/watches')->with('success', 'Watch added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categorySlug)
    {
        $brands = Brand::all();
        $categories = Category::all();

        // Eager load brand relation, not necessary, will still work but with more db queries
        $products = Product::with('brand')
            // Get products who has category slug equal to slug value from url parameter $categorySlug
            ->whereHas('category', function ($query) use ($categorySlug){
                $query->where('name', $categorySlug);
            });

        // Since we building product db query with eloquent, we can chain "where" clauses
        // If there is brand value in form request query, get it...
        if (request()->brand) {
            $brand = request()->brand;

            // Chain "where" clause - where product's brand slug is ...
            $products = $products->whereHas('brand', function ($query) use ($brand) {
                $query->where('slug', $brand);
            });
        }

        // Chain pagination and run product query to receive result
        $products = $products->paginate(10);

        return view('products.index', compact('brands', 'categories', 'products'));
    }

    public function showProduct($brandSlug, $productSlug)
    {
        // Eager load nested relationship, load comments for products and users-authors of comments
        $product = Product::with('comments.user')
            // Get products where slug is equal to $productSlug
            ->where('slug', $productSlug)
            // Get first product with above condition
            ->first();

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
    public function update(ProductCreateRequest $request, $id)
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
        }

        // Get product instance
        $product = Product::find($id);

        // Since variable $product have product object instance, we can fill data and update it
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->details = $request->input('details');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if($request->hasFile('image')){
            $product->image = $fileNameToStore;
        }
        $product->update();

        return redirect('/dashboard')->with('success', 'Watch updated');
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

        if($product->image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/image/'.$product->image);
        }
        
        $product->delete();
        return redirect('/watches')->with('success', 'Watch deleted');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {

            // Get brands list
            $brands = Brand::all();

            // Search for products
            $products = Product::with('brand')
                // Get product's collection where name is similar to search value
                ->where('name', 'like', '%'.$request->search.'%')
                ->paginate(10);

            return view('products.index', compact('brands', 'products'));
        }
    }
}
