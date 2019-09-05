@extends('layouts.welcome')

@section('contents')
    <div class="nk-wrap">
        @include('welcome.header')

        @include('welcome.main')

        @include('welcome.footer')
    </div>

    @include('welcome.login')
@endsection
