<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalCategories' => Category::count(),
            'totalProducts' => Product::count(),
        ];
        return view('admin.dashboard', $data);
    }
}
