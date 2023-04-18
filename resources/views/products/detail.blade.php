@extends("layouts.app")
@section("content")
<div class="container">
  @if(session('error'))
  <div class="alert alert-warning">
  {{ session('error') }}
  </div>
  @endif
  <div class="card mb-2">
    <div class="card-body">
      <h5 class="card-title">{{ $product->name }}</h5>
      <div class="card-subtitle mb-2 text-muted small">
        {{ $product->created_at->diffForHumans() }},
        Owner: <b>{{ $product->user->name }}</b>,
        Category: <b>{{ $product->category->name }}</b>
      </div>
      <p class="card-text">{{ $product->details }}</p>
      @if (auth()->user()->status == 2)
      <a class="btn btn-warning" href="{{ url("/products/delete/$product->id") }}">
        Delete
      </a>
      <a class="btn btn-primary" href="{{ url("/products/edit/$product->id") }}">
        Edit
      </a>
      @endif
    </div>
  </div>
  <ul class="list-group">
    <li class="list-group-item active">
      <b>Comments ({{ count($product->productComments) }})</b>
    </li>
    @foreach($product->productComments as $product_comment)
    <li class="list-group-item">
      <a href="{{ url("/product-comments/delete/$product_comment->id") }}"
      class="btn-close float-end">
      </a>
      {{ $product_comment->content }}
      <div class="small mt-2">
      By <b>{{ $product_comment->user->name }}</b>,
      {{ $product_comment->created_at->diffForHumans() }}
 </div>
    </li>
    @endforeach
  </ul>

  @auth
  <form action="{{ url('/product-comments/add') }}" method="post">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
    <input type="submit" value="Add Comment" class="btn btn-secondary">
  </form>
  @endauth
</div>
@endsection