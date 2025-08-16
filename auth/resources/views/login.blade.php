@extends('layout')
@section('content')
<h2 class="title">Login</h2>
<form method="POST" action="{{ url('/login') }}">
  @csrf
  <div class="field">
    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
  </div>
  <div class="field">
    <input type="password" name="password" placeholder="Password" required>
  </div>
  @error('error_message')<div class="error">{{ $message }}</div>@enderror
  <div class="field">
    <label><input type="checkbox" name="remember"> Remember me</label>
  </div>
  <button type="submit">Login</button>
</form>
<p>Don’t have an account? <a class="link" href="{{ route('register') }}">Register</a></p>
@endsection