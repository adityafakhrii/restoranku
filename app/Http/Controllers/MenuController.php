<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
Use Illuminate\Support\Facades\Session;
Use App\Models\Order;
Use App\Models\OrderItem;

class MenuController extends Controller
{
    // public function index($table)
    public function index(Request $request)
    {
        $tableNumber = $request->query('meja');
        if ($tableNumber) {
            // Simpan ke session
            Session::put('tableNumber', $tableNumber);
        }

        $items = Item::where('is_active', 1)->orderBy('name', 'asc')->get();
        // return view('menu', compact('items', 'table'));
        return view('menu', compact('items', 'tableNumber'));
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

        $tableNumber = Session::get('tableNumber');

        // Lakukan proses checkout disini (misal simpan data ke order)
        return view('checkout', compact('cart','tableNumber'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        $tableNumber = Session::get('tableNumber');

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung total harga
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['qty'];
        }

        // Buat user baru atau temukan user yang sudah ada
        $user = \App\Models\User::firstOrCreate(
            ['phone' => $request->phone, 'fullname' => $request->fullname, 'role_id' => 4]
        );

        // Buat transaksi order
        $order = Order::create([
            'order_code' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'table_number' => $tableNumber,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        // Simpan order_code ke session
        // Session::put('order_id', $order->order_id);

        // Simpan item-item ke order_item
        foreach ($cart as $itemId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'total_price' => $item['price'] * $item['qty']
            ]);
        }

        // Kosongkan keranjang
        Session::forget('cart');
        // Session::forget('tableNumber');

        // Redirect ke halaman konfirmasi
        // return redirect()->route('order.success', ['order_code' => $order->order_code]);

        // Redirect ke halaman konfirmasi dengan order_code dan order_id
        return redirect()->route('checkout.success', ['order_code' => $order->order_code, 'order_id' => $order->id]);
    }

    public function orderSuccess(Request $request, $orderId)
    {
        $orderId = Order::where('order_code', $orderId)->first();
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        if (!$orderId) {
            return redirect()->route('menu')->with('error', 'Order tidak ditemukan.');
        }

        return view('order.success', compact('orderId','orderItems'));
    }


}
