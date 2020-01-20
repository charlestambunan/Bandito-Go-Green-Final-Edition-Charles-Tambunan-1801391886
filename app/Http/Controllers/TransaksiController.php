<?php

namespace App\Http\Controllers;

use Alert;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransaksiController extends Controller
{
    //untuk menampilkan transaksi melalui Controller Transaction dan dilakukan order berdasarkan id dan mengklasifikasikan berdasarkan kode yang ada
    public function indeks()
    {
        $transactions = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->groupBy('transactions.code')
            ->select('transactions.code', 'users.username as name', DB::raw("sum(subtotal)  as total"))
            ->where('transactions.status', '0')
            ->orderBy('transactions.id', 'DESC')
            ->get();
        return view('admin.transaction.index', compact('transactions'));
    }

    //untuk mengubah status pembayaran pada riwayat transaksi
    public function setuju($code)
    {
        Transaction::where('code', $code)->update(['status' => '1']);
        Alert::success('Data Berhasil diperbaharui');
        return redirect('transaction/admin');
    }

    public function periksa(Request $request)
    {
        Transaction::where('code', $request->code)
            ->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'city_id'=>$request->city,
                'zip'=>$request->zip,
                'pembayaran'=>$request->pembayaran,
                'ekspedisi'=>$request->ekspedisi
            ]);
        return redirect('cart/myorder');
    }
}
