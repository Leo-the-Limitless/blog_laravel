@extends("layouts.app")
@section("content")
<div class="container">
  @if($errors->any())
  @foreach($errors->all() as $error)
  <div class="alert alert-warning">
    {{ $error }}
  </div>
  @endforeach
  @endif
  <form method="post">
    @csrf
    <div class="mb-3">
      <label>Category Name</label>
      <input type="text" class="form-control" name="name" autocomplete="off">
    </div>
    <input type="submit" class="btn btn-primary" value="Add Category" />
  </form>
</div>
@endsection