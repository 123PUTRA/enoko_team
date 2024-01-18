<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Store;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        // Mendapatkan toko pengguna yang sedang login
        $store = Store::where('user_id', auth()->id())->first();

        // Mengecek apakah toko ditemukan
        if ($store) {
            $barangs = $store->barangs;
            return view('barang.index', compact('barangs'));
        }
        return redirect('/')->with('error', 'Anda belum membuka toko. Silakan buka toko terlebih dahulu.');
    }

    // Menampilkan form untuk menambah barang
    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'quantity' => 'required|integer',
            'category' => 'required|string',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mendapatkan toko pengguna yang sedang login
        $store = Store::where('user_id', auth()->id())->first();

        // Mengecek apakah toko ditemukan
        if ($store) {
            // Menyimpan barang dengan mengaitkannya ke toko
            $barang = $store->barangs()->create([
                'nama_barang' => $request->nama_barang,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'quantity' => $request->quantity,
                'category' => $request->category,
            ]);

            // Proses penyimpanan gambar
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads'), $imageName);
                    $barang->update(['gambar_path' => $imageName]);
                }
            }

            return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
        }
    }



    public function category($category)
    {
        $barangs = Barang::where('category', $category)->get();

        return view('component.category', compact('barangs', 'category'));
    }



    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    // Menghapus barang dari database
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }

    //add to cart
    public function addToCart(Barang $barang)
    {
        // Pastikan barang ditemukan
        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan.');
        }

        // Cek apakah pengguna sudah login
        if (auth()->check()) {
            Cart::create([
                'user_id' => auth()->id(),
                'barang_id' => $barang->id,
                'quantity' => 1,
                'nama_barang' => $barang->nama_barang,
                'harga' => $barang->harga,
            ]);
        } else {
            // Jika belum login, tambahkan ke sesi 'cart'
            $cart = session()->get('cart', []);
            $cart[] = [
                'barang_id' => $barang->id,
                'quantity' => 1,
                'nama_barang' => $barang->nama_barang,
                'harga' => $barang->harga,
            ];
            session(['cart' => $cart]);
        }

        return redirect()->route('home')->with('success', 'Barang berhasil ditambahkan ke dalam keranjang.');
    }

    public function showCart()
    {
        if (auth()->check()) {
            // Mendapatkan isi keranjang dari database berdasarkan user_id
            $cart = Cart::where('user_id', auth()->id())->with('barang')->get();
        } else {
            // Jika belum login, ambil dari sesi 'cart'
            $cart = session()->get('cart', []);
        }

        // Menghitung total belanja
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }
        return view('component.cart', compact('cart', 'total'));
    }


    public function updateCart(Request $request, $id)
    {
        // Mendapatkan keranjang berdasarkan ID
        $cart = Cart::findOrFail($id);
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Mendapatkan jumlah stok barang yang tersedia
        $availableStock = $cart->barang->quantity;
        if ($request->input('quantity') > $availableStock) {
            return redirect()->route('cart.show')->with('error', 'Jumlah yang diminta melebihi stok barang yang tersedia.');
        }
        // Mengupdate jumlah barang
        $cart->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('cart.show')->with('success', 'Keranjang belanja berhasil diperbarui.');
    }


    public function removeFromCart($id)
    {
        try {
            // Mendapatkan keranjang berdasarkan ID
            $cart = Cart::findOrFail($id);

            // Menghapus barang dari keranjang
            $cart->delete();
            session()->flash('success', 'Barang berhasil dihapus dari keranjang.');
            return redirect()->route('cart.show');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus barang dari keranjang.');
            return redirect()->route('cart.show');
        }
    }



    // Proses checkout
    public function checkoutCart(Request $request)
    {
        // Mendapatkan isi keranjang dari database
        $cart = Cart::with('barang')->get();

        // Logika proses checkout

        // Setelah proses checkout,
        Cart::truncate();

        return redirect()->route('cart.show')->with('success', 'Pembelian berhasil.');
    }





    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $category = $request->input('category'); 

        $query = Barang::query();

        if ($category) {
            // Jika kategori diberikan, terapkan filter untuk pencarian pada kategori tersebut
            $query->whereHas('category', function ($categoryQuery) use ($category) {
                $categoryQuery->where('name', $category);
            });
        } else {
            // Jika tidak ada kategori, lakukan pencarian secara menyeluruh
            $query->orWhere('nama_barang', 'like', "%$searchQuery%")
                ->orWhereHas('store', function ($storeQuery) use ($searchQuery) {
                    $storeQuery->where('name', 'like', "%$searchQuery%");
                });
        }

        $barangs = $query->get();

        return view('component.searchPages', compact('barangs'));
    }







}