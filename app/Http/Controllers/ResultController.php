<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Product;

class ResultController extends Controller
{
    public function articles(Request $request) {
        $articles = Article::all();
        $results = [];

        foreach($articles as $article) {
            if (strtolower($article->title) == strtolower($request->title)) {
                array_push($results, $article);
            }
        }

        return view('articles.results', [
            'results' => $results
        ]);
    }

    public function products(Request $request) {
        $products = Product::all();
        $results = [];

        foreach($products as $product) {
            if (strtolower($product->name) == strtolower($request->name)) {
                array_push($results, $product);
            }
        }

        return view('products.results', [
            'results' => $results
        ]);
    }
}