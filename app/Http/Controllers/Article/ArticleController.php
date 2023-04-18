<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $data = Article::latest()->paginate(5);
    return view('articles.index', [
      'articles' => $data
    ]);
  }

  public function detail($id)
  {
    $data = Article::find($id);
    return view('articles.detail', [
      'article' => $data
    ]);
  }
  
  public function add()
  {
    if (Gate::denies('is-approved-user')) {
      abort(403);
    }
    
    $categories = Category::all();
    
    return view('articles.add', [
      'categories' => $categories
    ]);
  }
  
  public function create(Request $request)
  {
    if (Gate::denies('is-approved-user')) {
      abort(403);
    }
    
    $validator = validator($request->all(), [
      'title' => 'required',
      'body' => 'required',
      'category_id' => 'required',
    ]);
    
    if ($validator->fails()) {
      return back()->withErrors($validator);
    }
    
    $article = new Article;
    $article->title = $request->title;
    $article->body = $request->body;
    $article->category_id = $request->category_id;
    $article->user_id = auth()->user()->id;
    $article->save();
    return redirect('/articles');
  }
  
  public function delete($id)
  {
    $article = Article::find($id);

    if (Gate::denies('content-delete', $article)) {
      return back()->with('error', '⚠ Unauthorize ⚠');
    }
    
    $article->delete();

    foreach($article->comments->all() as $comment) {
      $comment->delete();
    }
    
    return redirect('/articles')->with('info', 'Article deleted');
  }
  
  public function edit($id)
  {
    $article = Article::find($id);

    if (Gate::denies('content-edit', $article)) {
      return back()->with('error', '⚠ Unauthorize ⚠');
    }
    
    $autofillers = [
      "title" => $article->title, 
      "body" => $article->body,
      "category_id" => $article->category_id
    ];
    
    $categories = Category::all();
    
    return view('articles.edit', [
      'autofillers' => $autofillers, 
      'categories' => $categories
    ]);
  }
  
  public function update($id)
  {
    $article = Article::find($id);

    if (Gate::denies('content-edit', $article)) {
      return back()->with('error', '⚠ Unauthorize ⚠');
    }

    $validator = validator(request()->all(), [
      'title' => 'required',
      'body' => 'required',
      'category_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator);
    }

    $article->title = request()->title;
    $article->body = request()->body;
    $article->category_id = request()->category_id;
    $article->save();
    return redirect('/articles')->with('info', 'Article Updated');
  }
}