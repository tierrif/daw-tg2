@extends('main')
<div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email" autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password">Email: </label>
            <input type="password" name="password" autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div>
            <input type="checkbox" name="remember_me" >
            <label for="remember_me">Remember me</label>
        </div>

        <div>
            <a href="{{ route('password.request') }}">
                Forgot your password?
            </a>
        </div>

        <div>
            <input type="submit" name="Login">
        </div>
        </div>
    </form>
</div>