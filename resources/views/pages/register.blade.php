@extends('main')

@section('head')
    @vite(['resources/js/login.js', 'resources/scss/login.scss'])
@endsection

@section('content')
    <div class="container">
        <div class="login-card card">
            <img src="{{ mix('resources/assets/logo-black.png') }}" alt="logo-black" width="150" />
            <h4 class="card-title">Registar-se como Utilizador Frequente</h4>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Nome</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" type="text"
                        name="name" required="required" />
                    @error('name')
                        <div class="invalid-feedback">
                            Nome inválido.
                        </div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Endereço de Correio Eletrónico</label>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
                        name="email" required="required" />
                    @error('email')
                        <div class="invalid-feedback">
                            Endereço de correio eletrónico inválido.
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Palavra-passe</label>
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                        name="password" required="required" />
                    @error('password')
                        <div class="invalid-feedback">
                            As palavras-passe não coincidem.
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Palavra-passe</label>
                    <input id="password_confirmation" class="form-control @error('password') is-invalid @enderror"
                        type="password" name="password_confirmation" required="required" />
                    @error('password')
                        <div class="invalid-feedback">
                            As palavras-passe não coincidem.
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <a href="{{ url('/login') }}">Já está registado(a)?</a>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Registar-se</button>
                </div>
            </form>
        </div>
    </div>
@endsection
