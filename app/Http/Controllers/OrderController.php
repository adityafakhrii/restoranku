<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(string $id)
    {
        $order = Order::findOrFail($id);
        if (Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'cashier') {
            $order->status = 'settlement';
        } elseif (Auth::user()->role->role_name == 'chef') {
            $order->status = 'cooked';
        }
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated to settlement.');
    }
}
