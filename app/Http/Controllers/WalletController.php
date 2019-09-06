<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return redirect()->route('welcome');
    }

    public function contract() {
        $contract = json_decode(Storage::get('MaharlikaCoin.json'));
        return response()->json($contract->abi);
    }
}
