<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    public function index()
    {
        return Article::all();
    }
    
    public function store()
    {
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = request()->user_id;
        $article->save();

        return $article;
    }
    
    public function show($id)
    {
        return Article::find($id);
    }
   
    public function update($id)
    {
        $article = Article::find($id);
        $fields = [
            'title',
            'body',
            'category_id',
            'user_id',
        ];

        foreach($fields as $field) {
            if(request()->$field) {
                $article->$field = request()->$field;
            }
        }

        $article->save();

        return $article;
    }
    
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return $article;
    }
}
