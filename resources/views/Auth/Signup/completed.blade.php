@extends('Layouts.main')
@section('title', 'RêntHûb.es | Reciente')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('content')
    <div class="container mx-auto py-12 px-4">
        <div class="max-w-lg mx-auto bg-white p-10 rounded-lg ">
            <h1 class="text-2xl font-bold mb-6">Registro completado</h1>
            <p>¡Enhorabuena! Tu cuenta se ha creado correctamente.</p>
            <p class="block text-gray-700  mb-2">Puedes <b><a href="/login" class="underline">inciar sesión aquí</a></b>.</p>
        </div>
    </div>

@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
