<?php

namespace App\Http\Controllers;

use Alert;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //untuk mengecek apakah seller atau buyer
    public function __construct(){
        $this->category = Category::orderBy('name', 'ASC')->get();
    }

    public function register()
    {
        $category = $this->category;
        return view('homepage.register', compact('category'));
    }

    protected function create(Request $req)
    {
        //untuk check validasi di form registrasi user untuk menjadi seller dan buyer melalui controller
        $user = User::where('email',$req->email)->first();
        if ($user == null){
            $userCreate = new User();
            $userCreate->name = $req->name;
            $userCreate->photo = "static/dist/img/avatar5.png";
            $userCreate->username = $req->username;
            $userCreate->email = $req->email;
            $userCreate->password = Hash::make($req->password);
            $userCreate->address = $req->address;
            $userCreate->phone = $req->phone;
            $userCreate->gender = $req->gender;
            $userCreate->birthday = $req->birthday;
            $userCreate->role = $req->role;
            $userCreate->save();
            Alert::success('', 'Pendaftaran selesai');
            return redirect('/');
        }else{
            Alert::error('', 'Email sudah pernah digunakan');
            return redirect('auth/register');
        }
    }

    public function verif($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user->status == "0") {
            $user->status = "1";
        }
        $user->save();
        Alert::success('', 'Verifikasi Sukses,silahkan login');
        return redirect('auth/register');
    }
    public function login(Request $request)
    {
        $email =  $request->email;
        $pwd   =  $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $pwd])) {
            $cek = User::where('id', Auth::user()->id)->first();
            if ($cek->status == 0) {
                Alert::success('', 'Anda berhasil masuk');
                return redirect('/');
            } else {
                return redirect()->back();
            }
        } else {
            Alert::error('', 'Maaf Email atau password tidak sesuai');
            return redirect('/');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }


}
