<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\User;
use Carbon\Carbon;
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

    public function receipt()
    {
        return view('pages.receipt');
    }

    public function pembayaran(Request $request)
    {

        $jumlah = Transaksi::count();
        $user = User::with('akun')->find(Auth::user()->id);
        $transaksi = new Transaksi();
        $transaksiDetail = new TransaksiDetail();
        $produk = new Produk();





        $akun = Akun::with('transaksis')->find($transaksi->akun_id);
        // $transaksi = Transaksi::with('transaksidetail')->find(Auth::user()->id);
        $data = Carbon::now();

        if ($request->payment == null) {
            return redirect()->back()->with('warning', 'silahkan pilih metode pembayaran terlebih dahulu');
        }


        // menyimpan value saldo dan harga
        $saldoUser = $user->akun->saldo;
        $hargaProduk = $request->harga;
        $harga = 0;
        // menyimpan value poin dan harga (poin)
        $poinUser = $user->akun->poin;
        $poinProduk = $request->poin;
        if ($request->payment == 'saldo') {

            $saldoBaruUser = $saldoUser - $hargaProduk;
            $harga = $hargaProduk;
            $user->akun->saldo = $saldoBaruUser;
            if ($request->harga >= 50000 && $request->payment == 'saldo') {
                $user->akun->poin += 10;
            }
        } else if ($request->payment == 'poin') {

            $poinBaru = $poinUser - $poinProduk;
            $harga = $request->poin;
            $user->akun->poin = $poinBaru;
        }



        if ($request->payment == 'saldo' && $hargaProduk > $saldoUser) {
            return redirect()->back()->with('error', 'Maaf saldo anda tidak mencukupi, silahkan isi terlebih dahulu');
        } else if ($request->payment == 'poin' && $poinProduk > $poinUser) {
            return redirect()->back()->with('error', 'Maaf poin anda tidak mencukupi');
        }

        // Transaksi
        $transaksi->akun_id = $user->akun->user_id;
        $transaksi->id_transaksi = date('Y') . str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);
        $transaksi->total_harga = $harga;
        $transaksi->total_item = 1;
        $transaksi->status = 'berhasil';
        $transaksi->akuns()->associate($user->akun)->save();


        $user->akun->save();


        //Transak siDetail
        $transaksiDetail->transaksi_id =  $transaksi->id_transaksi;
        $transaksiDetail->produk_id = $request->id_produk;
        $transaksiDetail->harga_satuan = $harga;
        $transaksiDetail->jumlah = 1;
        $transaksiDetail->save();

        // $produk =  Produk::where('id_produk', $id)->first();
        // $akun = Akun::with('transaksis')->find($transaksi->akun_id);

        $tranDetail = TransaksiDetail::with('produk')->where('produk_id', $request->id_produk)->first();

        // dd($tranDetail->produk->nama_produk);


        return view('pages.receipt', compact('data', 'transaksi', 'transaksiDetail', 'tranDetail'));
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
