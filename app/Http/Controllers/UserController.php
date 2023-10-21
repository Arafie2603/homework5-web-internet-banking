<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Akun;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = User::with('akun')->find(Auth::user()->id);

        if ($user->role_id == 1) {
            $data_user = User::paginate(5);
            $user = User::where('id', '=', Auth::user()->id)->firstOrFail();
            $lastId = $user->id;
            return view('admin.user', compact('user', 'data_user', 'lastId'));
        } else {
            try {
                $saldo = $user->akun->saldo;
            } catch (\Throwable $th) {
                $saldo = 0;
            }
            return view('pages.user', compact('saldo'));
        }
    }
    public function admin()
    {
        $user = User::all();
        return view('admin.user', compact('user'));
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
        request()->validate(
            [
                // 'password' => 'required',
                // 'password_ulang' => 'same:password',
                'password' => 'required|confirmed'
            ]
        );

        $user = User::with('akun')->all();
        $data_user = User::where('id', '=', $request->id)->first();
        if ($data_user) {
            return back()->with('info', 'Duplikat data (Data Pegawai sudah terdaftar di dalam sistem)');
        }

        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email->saldo = $request->saldo;
        $user->email->poin = $request->poin;
        $user->password = bcrypt($request->password);



        $user->save();
        return back()->with('success', 'Data Berhasil ditambah');
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
        request()->validate([
            'password_confirmation' => 'same:password_baru',
        ]);

        $user = User::findorfail($id);
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password_baru) {
            $user->password = bcrypt($request->password_baru);
        }

        $user->save();
        return back()->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('id','=',$id)->firstOrFail();
        $user->delete();
        return back()->with('info', 'Data berhasil dihapus');
    }
}
