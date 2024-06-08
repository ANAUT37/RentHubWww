@extends('Layouts.main')
@section('title', 'RêntHûb.es | Login')
@section('header')
@include('Headers.header_manager')
@endsection
@section('content')
<div class="container mx-auto py-12 px-4">
    <div class="max-w-lg mx-auto bg-white p-10 rounded-lg ">
        <h1 class="text-2xl font-bold mb-6">Ups! :S</h1>
        <p class="block text-gray-700  mb-2">Para acceder a este contenido debes iniciar sesión con una cuenta activa de RêntHûb.es</p>
        <p class="block text-gray-700  mb-2">Puedes <b><a href="/login" class="underline">inciar sesión aquí</a></b> o <b><a href="/signup" class="underline">crear una cuenta.</a></b></p>

    </div>
</div>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
