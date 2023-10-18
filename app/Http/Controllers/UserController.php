<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data_user = User::paginate(5);
        $user = User::where('id','=',Auth::User()->id)->firstOrFail();
        // return response()->json(array('success' => true, 'last_insert_id' => $user->id), 200);
        $lastId = $user->latest()->value('id');
        return view('admin.user', compact('user', 'data_user', 'lastId'));
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
        request()->validate([
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $data_user = User::where('id','=',$request->id)->first();
        if ($data_user) {
            return back()->with('info', 'User sudah terdaftar di dalam sistem');
        }

        $user->name = $request->name;
        $user->email = $request->password;
        $user->password = bcrypt($request->password);

        $user->save();
        return back()->with('success', 'Data berhasil ditambah');
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
