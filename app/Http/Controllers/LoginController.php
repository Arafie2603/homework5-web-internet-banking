<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }
    public function profile()
    {
        return view('pages.profile');
    }
    public function login(Request $request)
    {
        // $data = User::where('email', $request->email)->firstOrFail();
        // if($data) {
        //     if(Hash::check($request->password, $data->password)){
        //         session(['berhasil_login' => true]);
        //         
        //     }
        // }
        // return Redirect::to('/')->with('message', 'email atau password salah');
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
           
            $result = User::where('email', $email)->first();

            session([
                'berhasil_login'=>true,
                'name'=>$result->name,
                'email'=>$result->email,
                'amount' => $result->amount,
                'address' => $result->address,
                'id'=>$result->id
            ]);

            return redirect('/dashboard');
           

        }else{
            return Redirect::to('/')->with('message', 'email atau password salah');
        }
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name'  =>  'required|max:255',
            'email' =>'required|email|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'name.required' =>  'Nama harus diisi',
            'name.max' =>  'karakter Nama terlalu panjang',
            'email.required' =>  'email harus diisi',
            'email.email'   =>  'email tidak valid',
            'email.max' =>  'karakter email terlalu panjang',
            
        ]);

        try {
            User::where('id',session()->get('id'))->update([
                'name'  =>  $request->name,
                'email' => $request->email,
            ]);
            $user = User::find(session('id'));
            $id = session()->get('id');
         
            $result = User::where('id',session()->get('id'))->first();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/storage', $imageName);
                $user->image = 'storage/' . $imageName;
            }
    
            $user->save();

            session([
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
            ]);

            session()->forget('name'); 
            session()->forget('email');
            session()->forget('image');
            session([
                'name'  =>  $result->name,
                'email' =>  $result->email,
                'image' => time().'.'.$request->image->extension(),
            ]);

            return redirect()->back()->with('success','data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','data gagal diupdate');
            
        }
    }



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
