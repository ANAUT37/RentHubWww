
@extends('errors.minimal')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('footer')
    @include('Footers.full_footer')
@endsection