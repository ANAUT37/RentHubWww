@extends('Layouts.main')
@section('title', 'RêntHûb.es | Verification')
@section('header')
@include('Headers.header_manager')
@endsection
@section('content')
<div class="container mx-auto py-12 px-4">
    <div class="max-w-lg mx-auto bg-white p-10 rounded-lg ">
        <h1 class="text-2xl font-bold mb-6">Verificación en 2 pasos</h1>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form action="{{ route('login.verify') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="code" class="block text-gray-700 font-bold mb-2">Código de verificación:</label>
                <input type="number" id="code" name="code" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"  autofocus placeholder="Código" required>
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <div class="flex items-center justify-between">
                <a href="/login" class="text-gray-600 hover:underline">Volver</a>
                <button type="submit" class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">Aceptar</button>
            </div>
        </form>
        <!--  -->
    </div>
</div>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
