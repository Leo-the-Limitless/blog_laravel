@extends("layouts.app")
@section("content")
<div class="container">
  @if($results)
    <h2>Products({{ count($results) }})</h2>
    @foreach($results as $result)
    <div class="card mb-2">
      <div class="card-body">
        <h5 class="card-title">{{ $result->name }}</h5>
        <div class="card-subtitle mb-2 text-muted small">
          {{ $result->created_at->diffForHumans() }}
        </div>
        <p class="card-text">{{ $result->details }}</p>
        <a class="card-link" href="{{ url("/products/detail/$result->id") }}">
        View Detail &raquo;
        </a>
      </div>
    </div>
    @endforeach
    <a href="{{ url('/products') }}" class="text-muted">&laquo; back</a>
    @else
    <h3>No products found</h3>
    <a href="{{ url('/products') }}" class="text-muted">&laquo; back</a>
  @endif
</div>
@endsection