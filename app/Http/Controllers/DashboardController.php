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
}
