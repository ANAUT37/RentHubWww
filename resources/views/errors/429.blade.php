
@extends('errors.minimal')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('footer')
    @include('Footers.full_footer')
@endsection