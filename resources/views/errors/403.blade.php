
@extends('errors.minimal')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('footer')
    @include('Footers.full_footer')
@endsection