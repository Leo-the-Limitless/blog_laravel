@extends("layouts.app")

@section("content")
<div class="container">
  @if(session('info'))
  <div class="alert alert-info">
    {{ session('info') }}
  </div>
  @endif
  
  <h2>Category List</h2>
  @if(auth()->user()->status == 2)
  <a href="{{ '/categories/add' }}"
  class="nav-link text-success"
  style="margin-bottom: 20px">
    + Add Category
  </a>
  @endif
  <ul class="list-group list-group-flush">
    @foreach($categories as $category)
    <li class="list-group-item">
      <a href="{{ url("/categories/detail/$category->id") }}"
      class="nav-link text-dark">
      {{ $category->name }}
      </a>
    </li>
    @endforeach
  </ul>
</div>
@endsection