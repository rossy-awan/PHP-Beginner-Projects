@extends('layout')
@section('content')
<h2 class="title">Hello, {{ auth()->user()->name }}</h2>
<form method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit" style="background:#dc2626">Logout</button>
</form>
@endsection