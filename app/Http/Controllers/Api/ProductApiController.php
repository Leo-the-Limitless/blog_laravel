<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        return Product::all();
    }
    
    public function store()
    {
        $product = new Product;
        $product->name = request()->name;
        $product->details = request()->details;
        $product->category_id = request()->category_id;
        $product->user_id = request()->user_id;
        $product->save();

        return $product;
    }
    
    public function show($id)
    {
        return Product::find($id);
    }
   
    public function update($id)
    {
        $product = Product::find($id);
        $fields = [
            'name',
            'details',
            'category_id',
            'user_id',
        ];

        foreach($fields as $field) {
            if(request()->$field) {
                $product->$field = request()->$field;
            }
        }

        $product->save();

        return $product;
    }
    
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return $product;
    }
}
