<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /**
     * Add product for comparing, save in session
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function compare($id)
    {
        // Check if there is first product in session
        if (session()->has('product1_to_compare')) {

            // If there is first product in session, check if ID of first product is matching id
            // of currently passing id.
            if (session('product1_to_compare') === $id) {
                return redirect()->back()->with('error', 'Ne možete izabrati isti proizvod za poređenje.');
            }

            // Add second product for compare
            if (Product::find($id)) {
                session()->put('product2_to_compare', $id);
                // Go to page with products comparing
                return redirect()->route('comparing');
            }
            return redirect()->back()->with('error', 'Nepostojeci proizvod!');
        }

        // If first product doesn't exist in session, add it as first product
        // First check if exist in db
        if (Product::find($id)) {

            // Product exist, put into session
            session()->put('product1_to_compare', $id);
            return redirect()->route('watches.index')->with('success', 'Prvi proizvod uspesno dodat za poredjenje');
        }
    }

    /**
     * Display page with 2 products comparing
     */
    public function comparing()
    {
        // First check if there is both products in session
        if (!session()->has('product1_to_compare') || !session()->has('product2_to_compare')) {
            return abort(404);
        }

        // Retrieve products from db
        $product1 = Product::with('comments.user')->where('id', session('product1_to_compare'))->first();
        $product2 = Product::with('comments.user')->where('id', session('product2_to_compare'))->first();

        // Flush products from session
        session()->forget('product1_to_compare');
        session()->forget('product2_to_compare');

        return view('pages.compare', compact('product1', 'product2'));
    }
}
