@extends('layouts.app')
@section('content')
<div class="container">
  @foreach($users as $user)
  <div class="card">
    <div class="card-body row">
      <div class="col">
        {{ $user->id }}
      </div>
      <div class="col">
        {{ $user->name }}
      </div>
      <div class="col">
        {{ $user->email }}
      </div>
      <div class="col">
        {{ $user->created_at->format('d-m-Y') }}
      </div>
      <div class="col">
        <a href="{{ url("/users-list/approve/$user->id") }}" class="btn btn-success">
          Approve
        </a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection