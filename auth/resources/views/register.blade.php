@extends('layout')
@section('content')
<h2 class="title">Register</h2>
<form method="POST" action="{{ url('/register') }}">
  @csrf
  <div class="field">
    <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
    @error('name')<div class="error">{{ $message }}</div>@enderror
  </div>
  <div class="field">
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
    @error('email')<div class="error">{{ $message }}</div>@enderror
  </div>
  <div class="field">
    <input type="password" name="password" placeholder="Password" required>
    @error('password')<div class="error">{{ $message }}</div>@enderror
  </div>
  <div class="field">
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
  </div>
  <button type="submit">Register</button>
</form>
<p>Already have an account? <a class="link" href="{{ route('login') }}">Login</a></p>
@endsection