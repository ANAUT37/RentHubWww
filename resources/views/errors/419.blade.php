
@extends('errors.minimal')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
@section('footer')
    @include('Footers.full_footer')
@endsection