@extends('layouts.app')

@section('title')
    Register
@endsection

@section('content')
<main class="auth">
    <div class="auth__inner">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="field-group">
                <input name="name" placeholder="Username" type="text" required autocomplete="email">
            </div>
            <div class="field-group">
                <input name="email" placeholder="Email" type="text" required autocomplete="email">
            </div>
            <div class="field-group">
                <input name="password" placeholder="Password" type="password" required autocomplete="current-password">
            </div>
            <div class="field-group">
                <input name="password_confirmation" placeholder="Confirm Password" type="password" required autocomplete="new-password">
            </div>
            <div class="field-group">
                <button class="btn-primary" type="submit">Register</button>
            </div>
        </form>
    </div>
</main>

<div class="notifications">
        @error('name')
            <span class="msg error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        @error('email')
            <span class="msg error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        @error('password')
            <span class="msg error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div>
@endsection
