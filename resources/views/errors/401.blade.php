@extends('errors.minimal')

@section('header')
    @include('Headers.header_manager')
@endsection
@section('title', __('RêntHûb.es | Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
@section('footer')
    @include('Footers.full_footer')
@endsection

