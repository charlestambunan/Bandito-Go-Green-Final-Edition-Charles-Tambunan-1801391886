<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

//untuk taruh sweet alert di category controller
use Alert;
use Illuminate\Support\Facades\Auth;


class KategoriController extends Controller
{
    //Untuk menampilkan halaman kategori
    public function indeks()
    {
        //untuk menampilkan sub kategori
        $categorys = Category::orderBy('name','ASC')->get();
        return view('admin.category.index', compact('categorys'));
    }

    public function detil($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function buat(Request $request)
    {
        $temp = Category::where('name', $request->name)->first();
        if ($temp == null) {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            Alert::success('Data Kategori Berhasil Ditambahkan !');
        } else {
            Alert::error('Kategori sudah ada');
        }
        return redirect('category/admin/');

    }

    public function ubah(Request $request)
    {
        $temp = Category::where('name', $request->name)->first();
        if ($temp == null) {
            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->save();
            Alert::success('Info', 'Data Kategori Berhasil Diperbarui !');
        }else{
            Alert::error('Kategori sudah ada');
            return redirect('category/admin/detail/'.$request->id);
        }
        return redirect('category/admin/');
    }

    public function hapus($id)
    {
        Category::destroy($id);
        Alert::success('Info', 'Data Kategori Berhasil dihapus !');
        return redirect('category/admin');
    }

}
