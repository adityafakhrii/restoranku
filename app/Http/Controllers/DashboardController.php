<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalUsers = User::whereHas('role', function($query) {
            $query->where('role_name', '!=', 'guest');
        })->count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('grand_total');

        return view('admin.dashboard', [
            'totalItems' => $totalItems,
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue
        ]);
    }

    public function sales()
    {
        $orders = Order::with('user')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total_orders')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $temp = [];
        $i = 0;
        foreach ($orders as $order) {
            $temp[$i] = $order->total_orders;
            $i++;
        }

        return response()->json($temp);
    }
}
