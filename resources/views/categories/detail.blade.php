@extends("layouts.app")

@section("content")
<div class="container">
  <h3 class="text-primary"
  style="text-align:center">
  Category: {{ $category_name }}
  </h3>
  <h5>Articles({{ count($articles) }})</h5>
  @foreach($articles as $article)
  <div class="card border-primary mb-2">
    <div class="card-body">
      <h5 class="card-title">{{ $article->title }}</h5>
      <div class="card-subtitle mb-2 text-muted small">
        {{ $article->created_at->diffForHumans() }}
      </div>
      <p class="card-text">{{ $article->body }}</p>
      <a class="card-link" href="{{ url("/articles/detail/$article->id") }}">
      View Detail &raquo;
      </a>
    </div>
  </div>
  @endforeach
  <br />
  <h5>Products({{ count($products) }})</h5>
  @foreach($products as $product)
    <div class="card border-danger mb-2">
      <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <div class="card-subtitle mb-2 text-muted small">
          {{ $product->created_at->diffForHumans() }}
        </div>
        <p class="card-text">{{ $product->details }}</p>
        <a class="card-link" href="{{ url("/products/detail/$product->id") }}">
          View Detail &raquo;
        </a>
      </div>
    </div>
  @endforeach
</div>
@endsection