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
        // Admin
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('grand_total');

        // Cashier
        $totalPendingOrders = Order::where('status', 'pending')->whereDate('created_at', date('Y-m-d'))->count();
        $totalTodayOrders = Order::whereDate('created_at', date('Y-m-d'))->count();
        $totalCompletedOrders = Order::where('status', 'cooked')->count();
        $todayRevenue = Order::whereDate('created_at', date('Y-m-d'))->sum('grand_total');

        // Chef
        $todayUncookedOrders = Order::where('status', 'settlement')->whereDate('created_at', date('Y-m-d'))->count();
        $totalCookedOrders = Order::where('status', 'cooked')->whereDate('created_at', date('Y-m-d'))->count();
        $todayOrders = Order::whereDate('created_at', date('Y-m-d'))->count();


        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalPendingOrders' => $totalPendingOrders,
            'totalTodayOrders' => $totalTodayOrders,
            'totalCompletedOrders' => $totalCompletedOrders,
            'todayRevenue' => $todayRevenue,
            'todayUncookedOrders' => $todayUncookedOrders,
            'totalCookedOrders' => $totalCookedOrders,
            'todayOrders' => $todayOrders
        ]);
    }

    public function sales()
    {
        $orders = Order::with('user')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total_orders')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Inisialisasi 12 bulan dengan default 0
        $monthlyData = array_fill(1, 12, 0);

        // Masukkan total order ke bulan yang sesuai
        foreach ($orders as $order) {
            $monthlyData[(int)$order->month] = $order->total_orders;
        }

        // Ubah ke array numerik dari bulan Jan–Dec (0-based index untuk JS)
        return response()->json(array_values($monthlyData));
    }
}
