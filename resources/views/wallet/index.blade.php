@extends('layouts.wallet')

@section('contents')
    <wallet-header
        address="{{ session('authAddress') }}"
        logout="{{ route('wallet.logout') }}"
    ></wallet-header>

    @include('wallet.main')

    @include('wallet.footer')
@endsection
