@extends('admin.layout.master')
@section('title', 'Dashboard | SISKEU')
@section('menuDashboard', 'active')

@section('content')
    @if (Auth()->user()->level_id == '1' || Auth()->user()->level_id == '2')
        @include('admin.index')
    @elseif(Auth()->user()->level_id == '3')
        @include('warga.index')
    @endif
@endsection
