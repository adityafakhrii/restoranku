<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalUsers = User::whereHas('role', function($query) {
            $query->where('role_name', '!=', 'guest');
        })->count();

        return view('admin.dashboard', [
            'totalItems' => $totalItems,
            'totalUsers' => $totalUsers,
        ]);
    }
}
