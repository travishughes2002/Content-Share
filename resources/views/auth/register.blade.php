@extends('layouts.app')

@section('title')
    Register
@endsection

@section('content')
<main class="auth">
    <div class="auth__inner">
        <h1>Register</h1>
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
            <div class="field-group auth-register__login">
                <a href="{{ route('login') }}">Login Instead </a>
            </div>
        </form>
    </div>
</main>
@endsection
