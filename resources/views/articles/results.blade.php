@extends("layouts.app")
@section("content")
<div class="container">
  @if($results)
    <h2>Articles({{ count($results) }})</h2>
    @foreach($results as $result)
    <div class="card mb-2">
      <div class="card-body">
        <h5 class="card-title">{{ $result->title }}</h5>
        <div class="card-subtitle mb-2 text-muted small">
          {{ $result->created_at->diffForHumans() }}
        </div>
        <p class="card-text">{{ $result->body }}</p>
        <a class="card-link" href="{{ url("/articles/detail/$result->id") }}">
        View Detail &raquo;
        </a>
      </div>
    </div>
    @endforeach
    <a href="{{ url('/articles') }}" class="text-muted">&laquo; back</a>
    @else
    <h3>No articles found</h3>
    <a href="{{ url('/articles') }}" class="text-muted">&laquo; back</a>
  @endif
</div>
@endsection