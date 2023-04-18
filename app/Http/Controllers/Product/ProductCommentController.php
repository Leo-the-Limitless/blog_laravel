<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\ProductComment;

class ProductCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request) {
        $product_comment = new ProductComment();
        $product_comment->content = $request->content;
        $product_comment->product_id = $request->product_id;
        $product_comment->user_id = auth()->user()->id;
        $product_comment->save();
        return back();
    }

    public function delete($id)
    {
        $product_comment = ProductComment::find($id);
        if( Gate::allows('productComment-delete', $product_comment) ) {
            $product_comment->delete();
            return back();
        } else {
            return back()->with('error', 'Unauthorize');
        }
    }
}
