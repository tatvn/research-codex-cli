<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'totalCategories' => Category::count(),
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalCustomers' => User::where('role', 'customer')->count(),
            'totalRevenue' => Order::where('status', 'completed')->sum('total_amount'),
            'pendingOrders' => Order::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recentOrders'));
    }
}
