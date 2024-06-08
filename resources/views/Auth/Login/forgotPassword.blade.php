@extends('Layouts.main')
@section('title', 'RêntHûb.es | Login')
@section('header')
@include('Headers.header_manager')
@endsection
@section('content')
<div class="container mx-auto py-12 px-4">
    <div class="max-w-lg mx-auto bg-white p-10 rounded-lg ">
        <h1 class="text-2xl font-bold mb-6">Contraseña olvidada</h1>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form action="{{ route('password.email') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-bold mb-2">Correo electrónico:</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600" :value="old('email')" autofocus placeholder="Tu correo electrónico" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="flex items-center justify-between">
                <a href="/login" class="text-gray-600 hover:underline">Volver</a>
                <button type="submit" class="bg-gray-100  px-4 py-2 rounded-md hover:bg-gray-200">Aceptar</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
