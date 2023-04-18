@extends('layouts.app')
@section('content')
<div class="container">
  @if(session('info'))
  <div class="alert alert-info">
  {{ session('info') }}
  </div>
  @endif

  <div class="row">
    <div class="col">
      {{ $products->links() }}
    </div>
    <div class="col">
      @auth
      <form action={{ url('/products/results') }} method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" 
          placeholder="Product Name" 
          name="name"
          autocomplete="off">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary">Search</button>
          </div>
        </div>
      </form>
      @endauth
    </div>
  </div>

  <h1>Products List</h1>
  @if(auth()->user()->status == 2)
  <a
    class="nav-link text-danger"
    href="{{ url('/products/add') }}"
    style="margin-bottom: 20px"
  >
    + Add Product
  </a>
  @endif
    @foreach($products as $product)
      <div class="card mb-2">
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