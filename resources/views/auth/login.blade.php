@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <main class="auth">
        <div class="auth__inner">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="field-group">
                    <input name="email" placeholder="Email" type="text" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                <div class="field-group">
                    <input name="password" placeholder="Password" type="password" required autocomplete="current-password">
                </div>
                <div class="field-group">
                    <button class="btn-primary" type="submit">Login</button>
                </div>
                <div class="field-group">
                    <div class="field-group__cols">
                        <div class="field-group__row auth-login__remember">
                            <div class="checkbox-wrap">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Remember</label>
                            </div>
                        </div>
                        <div class="field-group__row auth-login__reset">
                            <a href="{{ route('password.request') }}">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
