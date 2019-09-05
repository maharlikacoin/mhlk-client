<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('authWallet')->except('login');
    }

    public function index() {
        return view('wallet.index');
    }

    public function login(Request $request) {
        session(['authAddress' => $request->address]);
        return view('wallet.index');
    }

    public function logout() {
        session()->flush();
        return redirect()->route('test');
    }
}
