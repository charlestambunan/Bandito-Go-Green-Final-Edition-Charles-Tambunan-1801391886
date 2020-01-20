<?php

namespace App\Http\Controllers;

use Alert;
use App\City;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    //membuat controller untuk melakukan insert, update dan delete dari kota yang tersedia
    public function indeks(){
        $citys= City::orderBy('name','ASC')->get();
        return view('admin.city.index', compact('citys'));
    }

    public function detail($id)
    {
        $city = City::where('id',$id)->first();
        return view('admin.city.edit', compact('city'));
    }

    public function buat(Request $request)
    {
        $temp = City::where('name', $request->name)->first();
        if ($temp == null) {
            $city = new City();
            $city->name = $request->name;
            $city->save();
            Alert::success('Data Kota Berhasil Ditambahkan !');
        } else {
            Alert::error('Kota sudah ada');
        }
        return redirect('city/admin/');

    }

    public function ubah(Request $request)
    {
        $temp = City::where('name', $request->name)->first();
        if ($temp == null) {
            $city = City::find($request->id);
            $city->name = $request->name;
            $city->save();
            Alert::success('Info', 'Data Kota Berhasil Diperbarui !');
        }else{
            Alert::error('Kota sudah ada');
            return redirect('city/admin/detail/'.$request->id);
        }
        return redirect('city/admin/');
    }

    public function hapus($id)
    {
        City::destroy($id);
        Alert::success('Info', 'Data Kota Berhasil dihapus !');
        return redirect('city/admin');
    }
}
