@extends('errors.minimal')

@section('header')
    @include('Headers.header_manager')
@endsection
@section('title', __('RêntHûb.es | 404'))
@section('code', '404')
@section('message', __('Not Found'))
@section('footer')
    @include('Footers.full_footer')
@endsection

