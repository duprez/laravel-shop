<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Product;


Route::middleware('auth')->group(function() {

    // Products route

    Route::get('products', function() {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    })->name('products.index');


    Route::get('products/create', function() {
        return view('products.create');
    })->name('products.create');


    Route::post('products', function(Request $req) {
        $newProduct = new Product;
        $newProduct->description = $req->input('description');
        $newProduct->price = $req->input('price');
        $newProduct->save();

        return redirect()->route('products.index')->with('info', 'Producto creado correctamente');
    })->name('products.store');


    Route::delete('products/{id}', function($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('products.index')->with('info', 'Producto borrado correctamente');
    })->name('products.delete');


    Route::get('products/{id}/edit', function($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    })->name('products.edit');


    Route::put('products/{id}', function(Request $req, $id) {
        $product = Product::findOrFail($id);
        $product->description = $req->input('description');
        $product->price = $req->input('price');
        $product->save();

        return redirect()->route('products.index')->with('info', 'Producto actualizado correctamente');
    })->name('products.update');

});


Auth::routes();