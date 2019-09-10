@extends('layouts.welcome')

@section('contents')
    <div class="nk-wrap">
        @include('welcome.header')

        @include('welcome.main')

        @include('layouts.footer')
    </div>

    @include('welcome.login')
    <div class="preloader"><span class="spinner spinner-round"></span></div>
@endsection
