@extends('layouts.my_layout')
@section('title', 'Home')
@section('content')
    @include('components.welcome_hero')
    @include('components.layanan')
    {{-- @include('components.testimoni') --}} <!--komentar-->
    <!-- @include('components.darurat') -->
@endsection
