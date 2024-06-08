@extends('errors.minimal')


@section('header')
    @include('Headers.header_manager')
@endsection
@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))
@section('footer')
    @include('Footers.full_footer')
@endsection
