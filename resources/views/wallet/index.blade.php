@extends('layouts.wallet')

@section('contents')
    <wallet-header
        address="{{ session('authAddress') }}"
        logout="{{ route('wallet.logout') }}"
    ></wallet-header>

    <wallet-main
        address="{{ session('authAddress') }}"
    ></wallet-main>

    <wallet-footer
        about-us="{{ route('about-us') }}"
        team="{{ route('team') }}"
        terms: {{ route('terms') }}
        privacy: {{ route('privacy') }}
        whitepaper: {{ route('whitepaper') }}
    ></wallet-footer>
@endsection
