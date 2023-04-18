@extends("layouts.app")

@section("content")
<div class="container">
  @if(session('info'))
  <div class="alert alert-info">
    {{ session('info') }}
  </div>
  @endif
  
  <div class="row">
    <div class="col">
      {{ $articles->links() }}
    </div>
    <div class="col">
      @auth
      <form action={{ url('/articles/results') }} method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" 
          placeholder="Article Title" 
          name="title"
          autocomplete="off">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary">Search</button>
          </div>
        </div>
      </form>
      @endauth
    </div>
  </div>
  
  <h1>Articles List</h1>
  @if(auth()->user()->status == 2)
  <a
    class="nav-link text-primary"
    href="{{ url('/articles/add') }}"
    style="margin-bottom: 20px"
  >
    + Add Article
  </a>
  @endif
  @foreach($articles as $article)
  <div class="card mb-2">
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
</div>
@endsection