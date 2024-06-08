@extends('Layouts.main')
@section('title', 'RêntHûb.es | Reset')
@section('system-message')
@endsection
@section('header')
    @include('Headers.header_manager')
@endsection
@section('content')
    <div class="container mx-auto py-12 px-4">
        <div class="max-w-lg mx-auto bg-white p-10 rounded-lg ">
            <h1 class="text-2xl font-bold mb-6">Recuperar contraseña</h1>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="mb-6">
                    <label for="email" :value="__('Correo electrónico')" class="block text-gray-700 font-bold mb-2">Correo
                        electrónico:</label>
                    <input
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        id="email" type="email" name="email"
                        value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" :value="__('Nueva contraseña')" class="block text-gray-700 font-bold mb-2">Nueva
                        contraseña:</label>
                    <input
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        id="password" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" :value="__('Confirmar nueva contraseña')"
                        class="block text-gray-700 font-bold mb-2">Confirmar nueva contraseña:</label>

                    <input
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        id="password_confirmation" type="password" name="password_confirmation"
                        required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="bg-gray-100 rounded-md px-4 py-2 hover:bg-gray-200">
                        {{ __('Confirmar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
