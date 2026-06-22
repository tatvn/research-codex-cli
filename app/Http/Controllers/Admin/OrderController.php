<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function create(): View
    {
        $customers = User::where('role', 'customer')->get();
        $products = Product::where('status', true)->get();

        return view('admin.orders.create', compact('customers', 'products'));
    }

    public function store(OrderRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $order = Order::create([
                'user_id' => $data['user_id'],
                'status' => $data['status'],
                'total_amount' => 0,
            ]);

            $totalAmount = 0;

            foreach ($data['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $totalAmount += $item['quantity'] * $item['price'];
            }

            $order->update(['total_amount' => $totalAmount]);
        });

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Tạo đơn hàng thành công.');
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items.product']);

        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        $order->load('items.product');
        $customers = User::where('role', 'customer')->get();
        $products = Product::where('status', true)->get();

        return view('admin.orders.edit', compact('order', 'customers', 'products'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', Order::STATUSES)],
        ]);

        $order->update([
            'status' => $request->input('status'),
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Cập nhật đơn hàng thành công.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Xóa đơn hàng thành công.');
    }
}
