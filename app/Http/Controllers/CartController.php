<?php

namespace App\Http\Controllers;

use Alert;
use App\Category;
use App\City;
use App\Product;
use App\Transaction;
use Auth;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //Untuk menambahkan barang belanjaan , update barang belanjaan dan delete barang belanjaan
    public function __construct()
    {
        $this->category = Category::orderBy('name', 'ASC')->get();
    }

    public function indeks(Request $req)
    {
        $product = Product::where('id', $req->productId)
            ->where('stock', '>=', $req->qty)
            ->first();
        if ($product == null) {
            Alert::error('', 'Maaf stok tidak tersedia');
            return redirect('/product/detail/' . $req->productId);
        } else {
            $resultTransaction = Transaction::where('user_id', Auth::id())
                ->where('product_id', $req->productId)
                ->where('ekspedisi', '')
                ->where('status', '0')
                ->first();

            if ($resultTransaction == null){
                $resultTransactionCode = Transaction::where('user_id', Auth::id())
                    ->where('ekspedisi', '')
                    ->where('status', '0')
                    ->first();
                $code = "";
                if ($resultTransactionCode == null){
                    $code = "KX";
                    for ($i = 0 ; $i<3; $i++){
                        $code = $code.rand(0,9);
                    }
                }else{
                    $code = $resultTransactionCode->code;

                }

                $transaction = new Transaction();
                $transaction->code = $code;
                $transaction->user_id = Auth::id();
                $transaction->product_id = $product->id;
                $transaction->qty = $req->qty;
                $transaction->subtotal = $req->qty * $product->price;
                $transaction->ekspedisi = '';
                $transaction->status = '0';
                $transaction->save();
            }else{
                $updateTransaction = Transaction::find($resultTransaction->id);
                $updateTransaction->qty = $req->qty + $updateTransaction->qty;
                $updateTransaction->subtotal = ($req->qty * $product->price) + $updateTransaction->subtotal;
                $updateTransaction->save();
            }

            $updateProduct = Product::find($product->id);
            $updateProduct->stock = $product->stock - $req->qty;
            $updateProduct->save();

            return redirect('keranjang');
        }


    }

    public function keranjang()
    {
        $category = $this->category;
        $transaction = Transaction::join('products','transactions.product_id','products.id')
            ->select('transactions.code as code','products.id as productId','products.name as productName','products.price as productPrice', 'transactions.qty as transactionQty', 'transactions.subtotal as subtotal', 'transactions.id as transactionId')
            ->where('transactions.status','0')
            ->where('transactions.ekspedisi','')
            ->where('transactions.user_id',Auth::id())
            ->get();

        return view('homepage.keranjang', compact('category','transaction'));
    }

    //update barang belanjaan
    public function ubah(Request $req)
    {
        Cart::update($req->rowid, $req->qty);
        $category = $this->category;
        return redirect('keranjang');
    }
    //delete barang belanjaan
    public function hapus($rowid)
    {
        $transaction = Transaction::where('id',$rowid)->first();
        $updateProduct = Product::find($transaction->product_id);
        $updateProduct->stock = $updateProduct->stock + $transaction->qty;
        $updateProduct->save();

        Transaction::destroy($rowid);
        $category = $this->category;
        return redirect('keranjang');
    }

    //untuk mengisi formulir alamat setelah buyer checkout
    public function formulir($code)
    {
        $category = $this->category;
        $citys = City::orderBy('name','ASC')->get();
        return view('homepage.formulir', compact('category', 'citys','code'));
    }


    public function transaksi(Request $req)
    {
                //setelah melakukan transaksi pembelian barang dilanjutkan ke my order yang dilakukan si buyer
                return redirect('cart/myorder');

    }

    // Menambah Produk ke  Keranjang Belanja, Mengedit Keranjang Belanja - Frontend.

    //untuk menampilkan hasil belanjaan yang belum lunas pembayarannya
    public function orderSaya()
    {
        $category = $this->category;
        $transaction = Transaction::join('users','users.id', 'transactions.user_id')
            ->groupBy('code')
            ->orderBy('transactions.id', 'DESC')
            ->where('transactions.user_id', Auth::user()->id)
            ->where('transactions.status', '0')
            ->where('transactions.ekspedisi','not like','')
            ->get();

        return view('homepage.myorder', compact('category', 'transaction'));
    }

    //untuk menampilkan hasil belanjaan yang belum lunas pembayarannya melalui detail
    public function detil($code)
    {
        $transactionPengirim = Transaction::join('users','transactions.user_id', 'users.id')
            ->groupBy('code')
            ->where('code', $code)
            ->first();

        $transactionPenerima = Transaction::join('citys','citys.id', 'transactions.city_id')
            ->select('transactions.name','transactions.phone','transactions.address','citys.name as city','zip', 'pembayaran','ekspedisi','status')
            ->groupBy('code')
            ->where('code', $code)
            ->first();


        $transactiondetail = Transaction::join('products','products.id', 'transactions.product_id')
            ->where('code', $code)
            ->get();
        $category = $this->category;
        return view('homepage.detailtransaksi', compact('category', 'transactionPengirim', 'transactiondetail','transactionPenerima'));
    }

    public function produk()
    {
        $category = $this->category;
        $product = Product::where('user_id', Auth::user()->id)->get();
        return view('homepage.myproduct', compact('product', 'category'));
    }

    //untuk menambahkan product
    public function tambahProduk()
    {
        $category = $this->category;
        // $mycategorys = Category::where('parent_id',null)->get();
        return view('homepage.addproduct', compact('category'));
    }

     //untuk menyimpan product yang berhasil ditambahkan
    public function simpanProduk(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $request->file('file')->move('static/dist/img/', $filename);
        $product = new Product;
        $product->photo = 'static/dist/img/' . $filename;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->weight = $request->weight;
        $product->user_id = Auth::user()->id;
        $product->save();
        Alert::success('', 'Product Berhasil di Tambahkan');
        return redirect('addproduct');
    }

    //untuk edit product
    public function ubahProduk($id)
    {
        $category = $this->category;
        $product = Product::where('id',$id)->first();
        return view('homepage.editproduct', compact('product', 'category'));
    }
    //untuk menyimpan hasil edit product
    public function ubahProduk2(Request $request)
    {
        $id = $request->id;
        if ($file = $request->file('file')) {
            $filename = $file->getClientOriginalName();
            $request->file('file')->move('static/dist/img/', $filename);
            $img = 'static/dist/img/' . $filename;
        } else {
            $img = $request->tmp_image;
        }
        $product = Product::find($id);
        $product->photo = $img;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->user_id = Auth::user()->id;
        $product->weight = $request->weight;
        $product->save();
        Alert::success('', 'Product Berhasil di Update');
        return redirect('product');
    }

    public function hapusProduk($id)
    {
        $product = Product::find($id);
        $product->delete();
        Alert::success('', 'Product Berhasil di delete');
        return redirect('myproduct');
    }

    public function sejarah(){
        $category = $this->category;
        if (Auth::user()->role == 'buyer'){
            $transaction = Transaction::join('users','users.id', 'transactions.user_id')
                ->groupBy('code')
                ->orderBy('transactions.updated_at', 'DESC')
                ->where('transactions.user_id', Auth::user()->id)
                ->where('transactions.status', '1')
                ->get();
        }else if(Auth::user()->role == 'seller'){
            $transaction = Transaction::join('products','products.id', 'transactions.product_id')
                ->join('users','users.id', 'products.user_id')
                ->groupBy('code')
                ->orderBy('transactions.updated_at', 'DESC')
                ->where('users.id', Auth::user()->id)
                ->get();
        }


        return view('homepage.history', compact('category', 'transaction'));
    }
}
