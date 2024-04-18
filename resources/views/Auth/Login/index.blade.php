@extends('Layouts.main')
@section('title', 'RêntHûb.es | Login')
@section('system-message')
@endsection
@section('header')
@include('Headers.header_manager')
@endsection
@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container mx-auto py-12 px-4">
        <div class="max-w-lg mx-auto bg-white p-10 rounded-lg ">
            <h1 class="text-2xl font-bold mb-6">Iniciar sesión</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Correo electrónico:</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Tu correo electrónico" autofocus :value="old('email')" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Tu contraseña" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex gap-1">
                        <input type="checkbox" id="remember_me" name="remember_me" value="remember">
                        <label for="remember_me">Recordarme</label>
                    </div>
                    <button type="submit"
                        class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">Iniciar
                        sesión</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container mx-auto text-center">
        <a href="{{ route('password.request') }}    " class="text-gray-600 hover:underline">¿Olvidaste tu contraseña?</a><br><br>
        <p>¿No tienes una cuenta? <a href="/signup" class="text-gray-600 hover:underline"> ¡Regístrate aquí!</a></p>
    </div>
    <br><br><br>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
