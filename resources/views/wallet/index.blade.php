@extends('layouts.wallet')

@section('contents')
    <wallet-header
        address="{{ session('authAddress') }}"
        logout="{{ route('wallet.logout') }}"
    ></wallet-header>

    <wallet-main
        address="{{ session('authAddress') }}"
    ></wallet-main>

    @include('wallet.footer')
@endsection
