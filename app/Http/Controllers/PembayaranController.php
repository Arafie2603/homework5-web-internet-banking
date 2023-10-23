<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function pembayaran(Request $request)
    {

        $akun = new Akun();

        $user = User::with('akun')->find(Auth::user()->id);

        $produk = new Produk();

        $transaksi = new Transaksi();
        $produk->harga = $request->harga;




        if ($request->payment == 'saldo') {
            $saldoUser = $user->akun->saldo;
            $hargaProduk = $request->harga;
            $saldoBaruUser = $saldoUser - $hargaProduk;

            if($request->harga >= 50000) {
                $poin = $user->akun->poin;
                $poin += 10;
            }
        }else if($request->payment == 'poin') {
            $poinUser = $user->akun->poin;
            $hargaProduk = $request->harga;
            $poinBaru = $poinUser - $hargaProduk;
            
        }

        $transaksi->akun_id = Auth::user()->id;
        $transaksi->total_harga = $request->harga;
        $transaksi->total_item = 1;

        dd($poin);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
