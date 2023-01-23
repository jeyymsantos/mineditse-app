@extends('layouts.master')

@section('title')
    <title> Staff </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('heading')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <h1> Hello, {{ Auth::user()->name }}! You are a staff. Features coming soon!</h1>
    </div>
@endsection
