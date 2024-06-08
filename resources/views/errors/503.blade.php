
@extends('errors.minimal')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@section('footer')
    @include('Footers.full_footer')
@endsection