<?php

namespace App\Http\Controllers;

use App\Events\CheckoutEvent;
use App\Events\OrderCreate;
use Illuminate\Http\Request;
use App\Models\Item;
Use Illuminate\Support\Facades\Session;
Use App\Models\Order;
Use App\Models\OrderItem;
Use Illuminate\Support\Facades\Validator;
class MenuController extends Controller
{
    public function index(Request $request)
    {
        $tableNumber = $request->query('meja');
        if ($tableNumber) {
            Session::put('tableNumber', $tableNumber);
        }

        $items = Item::where('is_active', 1)->orderBy('name', 'asc')->get();

        return view('customer.menu', compact('items', 'tableNumber'));
    }

    public function cart()
    {
        $cart = Session::get('cart', []);
        return view('customer.cart', compact('cart'));
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
            unset($cart[$itemId]);
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

        if ($newQty < 1) {
            return response()->json(['success' => false]);
        }

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

        return view('customer.checkout', compact('cart','tableNumber'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        $tableNumber = Session::get('tableNumber');

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong.');
        }

        // Disini validasi dulu.
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:15'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['qty'];

            $itemDetails[] = [
                'id'       => $item['id'],
                'price'    => (int) ($item['price'] + ($item['price'] * 0.1)),
                'quantity' => $item['qty'],
                'name'     => substr($item['name'], 0, 50),
            ];
        }

        $user = \App\Models\User::firstOrCreate(
            ['phone' => $request->phone],
            ['fullname' => $request->fullname, 'role_id' => 4]
        );

        $order = Order::create([
            'order_code' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'subtotal' => $totalAmount,
            'tax' => $totalAmount * 0.1,
            'grand_total' => $totalAmount + ($totalAmount * 0.1),
            'status' => 'pending',
            'table_number' => $tableNumber,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        foreach ($cart as $itemId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'] * $item['qty'],
                'tax' => ($item['price'] * $item['qty']) * 0.1,
                'total_price' => ($item['price'] * $item['qty'] + (($item['price'] * $item['qty']) * 0.1))
            ]);
        }

        Session::forget('cart');

        if ($request->payment_method === 'tunai') {
            event(new OrderCreate($order));
            return redirect()->route('checkout.success', ['orderId' => $order->order_code]);
        }
        else {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_code,
                    'gross_amount' => (int) $order->grand_total,
                ],
                'customer_details' => [
                    'first_name' => $user->fullname ?? 'Guest',
                    'phone' => $user->phone,
                ],
                'payment_type' => 'qris',
                'item_details' => $itemDetails,
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                event(new OrderCreate($order));
                return response()->json(['snap_token' => $snapToken, 'order_code' => $order->order_code]);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

    }


    public function orderSuccess(Request $request, $orderId)
    {
        $order = Order::where('order_code', $orderId)->first();

        if (!$order) {
            return redirect()->route('menu')->with('error', 'Order tidak ditemukan.');
        }

        $orderItems = OrderItem::where('order_id', $order->id)->get();

        if ($order->payment_method === 'qris') {
            $order->status = 'settlement';
            $order->save();
        }

        return view('customer.success', compact('order', 'orderItems'));
    }


}
