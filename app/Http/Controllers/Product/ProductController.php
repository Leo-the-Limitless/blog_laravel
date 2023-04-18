<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Category;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function products() {
    $data = Product::latest()->paginate(5);
    return view('products.index', [
      'products' => $data
    ]);
  }

  public function detail($id) {
    $product = Product::find($id);

    return view('products.detail', [
      'product' => $product
    ]);
  }

  public function add() {

    if (Gate::denies('is-approved-user')) {
      abort(403);
    }
    
    $categories = Category::all();
    
    return view('products.add', [
      'categories' => $categories
    ]);
  }
  
  public function create(Request $request) {
    
    if (Gate::denies('is-approved-user')) {
      abort(403);
    }

    $validator = validator($request->all(), [
      'name' => 'required',
      'details' => 'required',
      'category_id' => 'required'
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator);
    }

    $product = new Product;
    $product->name = $request->name;
    $product->details = $request->details;
    $product->category_id = $request->category_id;
    $product->user_id = auth()->user()->id;
    $product->save();
    return redirect('/products');
  }

  public function delete($id) {
    $product = Product::find($id);

    if (Gate::denies('content-delete', $product)) {
      return back()->with('error', '⚠ Unauthorize ⚠');
    }

    $product->delete();

    foreach($product->productComments->all() as $comment) {
      $comment->delete();
    }

    return redirect('/products')->with('info', 'Product deleted');
  }

  public function edit($id) {
    $product = Product::find($id);

    if (Gate::denies('content-edit', $product)) {
      return back()->with('error', '⚠ Unauthorize ⚠');
    }

    $categories = Category::all();

    return view('products.edit', [
      'product' => $product,
      'categories' => $categories,
    ]);
  }

  public function update($id) {
    $product = Product::find($id);

    if (Gate::denies('content-edit', $product)) {
      return back()->with('error', '⚠ Unauthorize ⚠');
    }

    $validator = validator(request()->all(), [
      'name' => 'required',
      'details' => 'required',
      'category_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator);
    }

    $product->name = request()->name;
    $product->details = request()->details;
    $product->category_id = request()->category_id;
    $product->save();
    return redirect('/products')->with('info', 'Product Updated');
  }
}
