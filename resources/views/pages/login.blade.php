@extends('main')

@section('head')
    @vite(['resources/js/login.js', 'resources/scss/login.scss'])
@endsection

@section('content')
    <div class="container">
        <div class="login-card card">
            <img src="{{ mix('resources/assets/logo-black.png') }}" alt="logo-black" width="150" />
            <h4 class="card-title">Entrar como Utilizador Frequente</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Endereço de Correio Eletrónico</label>
                    <input type="email" name="email" autocomplete="username"
                        class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                        <div class="invalid-feedback">
                            Credenciais inválidas.
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Palavra-passe</label>
                    <input type="password" name="password" autocomplete="current-password"
                        class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                        <div class="invalid-feedback">
                            Credenciais inválidas.
                        </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember_me">
                    <label for="remember_me" class="form-check-label">Manter Sessão Iniciada</label>
                </div>

                <div class="mb-3">
                    <a href="{{ url('/register') }}">Ainda não tem conta?</a>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
