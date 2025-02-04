<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
Use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        $items = Item::where('is_active', 1)->orderBy('name', 'asc')->get();
        return view('menu', compact('items'));
    }

    public function cart()
    {
        $cart = Session::get('cart', []);
        return view('cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $menuId = $request->input('id');
        $menu = Item::find($menuId);

        if (!$menu) {
            return response()->json(['success' => 'Menu tidak ditemukan'], 404);
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$menuId])) {
            $cart[$menuId]['qty'] += 1;
        } else {
            $cart[$menuId] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'image' => $menu->img,
                'qty' => 1
            ];
        }

        Session::put('cart', $cart);

        return response()->json(['success' => 'Berhasil ditambahkan ke keranjang!', 'cart' => $cart]);
    }

    public function removeFromCart(Request $request)
    {
        $itemId = $request->input('itemId');

        $cart = session()->get('cart', []);
        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);  // Hapus item dari keranjang
            session()->put('cart', $cart);

            session()->flash('success', 'Item berhasil dihapus dari keranjang!');
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function update(Request $request)
    {
        $itemId = $request->input('itemId');
        $newQty = $request->input('qty');

        // Validasi
        if ($newQty < 1) {
            return response()->json(['success' => false]);
        }

        // Temukan item di keranjang berdasarkan ID
        $cart = session()->get('cart', []);
        if (isset($cart[$itemId])) {
            $cart[$itemId]['qty'] = $newQty;
            session()->put('cart', $cart);
            session()->flash('success', 'Jumlah item berhasil diperbarui!');
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }



    public function clearCart()
    {
        Session::forget('cart');
        return redirect()->route('cart')->with('success', 'Keranjang berhasil dikosongkan!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong.');
        }

        // Lakukan proses checkout disini (misal simpan data ke order)
        return view('checkout', compact('cart'));
    }
}
