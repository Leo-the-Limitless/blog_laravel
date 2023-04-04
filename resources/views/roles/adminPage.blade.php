@extends('layouts.app')

@section('content')
<div class="container">
<h1> Admin Panel </h1>
<a class="btn btn-primary" href="{{ url('/users-list') }}">See Users List</a>
</div>
@endsection