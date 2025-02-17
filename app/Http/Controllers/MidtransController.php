<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Str;
Use Illuminate\Support\Facades\Session;
use App\Models\OrderItem;
use App\Models\User;


class MidtransController extends Controller
{
    public function webhookHandler(Request $request)
    {
        $order = Order::where('order_code', $request->order_id)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($request->transaction_status == 'settlement') {
            $order->status = 'paid';
        } elseif (in_array($request->transaction_status, ['cancel', 'deny', 'expire'])) {
            $order->status = 'failed';
        }

        $order->save();
        return response()->json(['message' => 'Webhook received']);
    }
}
