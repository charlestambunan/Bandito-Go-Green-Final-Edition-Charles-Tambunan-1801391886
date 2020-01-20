<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BerandaController extends Controller
{
    //untuk membuat halaman pencarian barang
    //untuk Menampilkan Kategori dan Sub Kategori - Frontend menggunakan construct

    //untuk menampilkan product
    public function indeks()
    {
        $category = Category::orderBy('name','ASC')->get();
        if (Auth::user() == null || Auth::user()->role == "buyer"){
            $products = Product::orderBy('name', 'ASC')
                ->paginate(8);
        }else {
            $products = Product::orderBy('name', 'ASC')
                ->where('user_id',Auth::id())
                ->paginate(8);
        }
        return view('homepage.homepage', compact('products', 'category'));

    }

    //untuk menampilkan subkategori di halaman produk
    public function produk()
    {
        $category = Category::orderBy('name','ASC')->get();
        $products = null;
        if (Auth::user() == null || Auth::user()->role == "buyer"){
            $products = Product::orderBy('name', 'ASC')
                ->paginate(8);
        }else {
            $products = Product::orderBy('name', 'ASC')
                ->where('user_id',Auth::id())
                ->paginate(8);
        }
        return view('homepage.product', compact('products', 'category'));
    }

    //13.5. Menampikan Produk Berdasarkan Kategori
    public function produkKategori($categoryId)
    {
        $category = Category::orderBy('name','ASC')->get();
        $products = null;
        if (Auth::user() == null || Auth::user()->role == "buyer"){
            $products = Product::orderBy('name', 'ASC')
                ->where('category_id',$categoryId)
                ->paginate(8);
        }else {
            $products = Product::orderBy('name', 'ASC')
                ->where('user_id',Auth::id())
                ->where('category_id',$categoryId)
                ->paginate(8);
        }

        return view('homepage.product', compact('products', 'category'));
    }

    //untuk menampilkan detail produk
    public function detil($id)
    {
        $products = Product::join('users', 'products.user_id', '=', 'users.id')
            ->select('products.id','products.name','products.photo', 'products.description','products.stock','products.weight','products.price','users.phone as phone','users.name as user_name')
            ->where('products.id', $id)->first();

        $category = Category::orderBy('name','ASC')->get();

        return view('homepage.detail', compact('products', 'category'));
    }

    //untuk menampilkan detail penjual
    public function seller()
    {
        $category = null;
        $user = null;
        if (Auth::user()){
            if (Auth::user()->role == 'admin'){
                $user = User::orderBy('name', 'ASC')
                    ->get();
            }else{
                $category = Category::orderBy('name','ASC')->get();
                $user = User::orderBy('name', 'ASC')
                    ->where('role', '=', 'seller')
                    ->get();
            }
        }else{
            $category = Category::orderBy('name','ASC')->get();
            $user = User::orderBy('name', 'ASC')
                ->where('role', '=', 'seller')
                ->get();
        }

        return view('homepage.seller', compact('category', 'user'));
    }

    //untuk melakukan register

    public function daftar()
    {
        $category = Category::orderBy('name','ASC')->get();
        return view('homepage.register', compact('category'));
    }

    public function profilSaya(){
        $category = Category::orderBy('name','ASC')->get();
        $user = Auth::user();
        return view('homepage.myprofil', compact('category','user'));
    }

    public function ubahProfil(Request $req){
        $user = Auth::user();

        if($file = $req->file('file')){
            $filename = $file->getClientOriginalName();
            $req->file('file')->move('static/dist/img/', $filename);
            $img = 'static/dist/img/' .$filename;

        }
        else{
            $img = $req->tmp_image;
        }

        $tempUser = User::where('email',$req->email)->first();

        if ($tempUser == null){
            $updateUser = User::find($user->id);
            $updateUser->name = $req->name;
            if ( $req->file('file')) $updateUser->photo = $img;
            $updateUser->username = $req->username;
            $updateUser->email = $req->email;
            $updateUser->password = Hash::make($req->password);
            $updateUser->address = $req->address;
            $updateUser->phone = $req->phone;
            $updateUser->gender = $req->gender;
            $updateUser->birthday = $req->birthday;
            $updateUser->role = $req->role;
            $updateUser->save();
            Alert::success('Info', 'Berhasil mengupdate data!');
        }else{
            if ($tempUser->id == $user->id){
                $updateUser = User::find($user->id);
                $updateUser->name = $req->name;
                if ( $req->file('file')) $updateUser->photo = $img;
                $updateUser->username = $req->username;
                $updateUser->email = $req->email;
                $updateUser->password = Hash::make($req->password);
                $updateUser->address = $req->address;
                $updateUser->phone = $req->phone;
                $updateUser->gender = $req->gender;
                $updateUser->birthday = $req->birthday;
                $updateUser->role = $req->role;
                $updateUser->save();
                Alert::success('Info', 'Berhasil mengupdate data!');
            }else{
                Alert::error('Info', 'Email sudah terdaftar');
                return redirect('myprofil');
            }
        }
        return redirect('/');
    }

    public function detilSeller($id){
        $category = Category::orderBy('name','ASC')->get();
        $user = User::find($id);
        return view('homepage.detailseller', compact('category','user'));
    }
}
