@extends('Layouts.main')
@section('title', 'RêntHûb.es | Login')
@section('header')
@include('Headers.header_manager')
@endsection
@section('content')
<div class="container mx-auto py-12 px-4">
    <div class="max-w-lg mx-auto bg-white p-10 rounded-lg ">
        <h1 class="text-2xl font-bold mb-6">Contraseña olvidada</h1>
        <h2>Te hemos enviado un correo a <b>{{ $email }}</b> con las instrucciones a seguir para reestablecer tu contraseña.</h2>
        <br><br>
        <p>¿Sigues teniendo problemas para iniciar sesión?</p><a href="/help" class="text-gray-600 hover:underline">Ponte en contacto con <b>Support</b></a><br><br>
        <a href="/login" class="text-gray-600 hover:underline">Volver a Inicio de sesión</a>
    </div>
</div>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
