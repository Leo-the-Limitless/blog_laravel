<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\Article;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function detail($id) {
        $all_articles = Article::all();
        $all_products = Product::all();
        $categories = Category::all();

        $articles = [];
        $products = [];

        foreach($categories as $category) {
            if($category->id == $id) {
                $category_name = $category->name;
            }
        }

        foreach($all_articles as $article) {
            if($article->category_id == $id) {
                array_push($articles, $article);
            }
        }

        foreach($all_products as $product) {
            if($product->category_id == $id) {
                array_push($products, $product);
            }
        }

        return view('categories.detail', [
            'articles' => $articles,
            'products' => $products,
            'category_name' => $category_name,
        ]);
    }

    public function add() {
        if (Gate::denies('is-approved-user')) {
            abort(403);
        }

        return view('categories.add');
    }

    public function create(Request $request) {
        if (Gate::denies('is-approved-user')) {
            abort(403);
        }

        $validator = validator($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect('/categories')->with('info', 'Category Added');
    }
}
