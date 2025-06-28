<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'products'])->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('id', $search) // tìm theo ID chính xác
                ->orWhereHas('customer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $orders = $query->get();

        return view('orders.index', compact('orders'));
    }



    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('orders.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1'
        ]);

        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'order_date' => $validated['order_date'],
            'total_amount' => $validated['total_amount'],
        ]);

        foreach ($validated['products'] as $productData) {
            $product = Product::find($productData['product_id']);
            if ($product) {
                $order->products()->attach($product->id, [
                    'quantity' => $productData['quantity'],
                    'price' => $product->price, 
                ]);
            }
        }

        return redirect()->route('orders.index')->with('success', 'Tạo đơn hàng thành công.');
    }

    public function edit(Order $order)
    {  
        $products = Product::all();
        $customers = Customer::all();
        $order->load('products');
        return view('orders.edit', compact('order', 'products', 'customers'));
    }

    public function update(Request $request, Order $order)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'order_date' => 'required|date',
        'total_amount' => 'required|numeric|min:0',
        'products' => 'required|array|min:1',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1'
    ]);

    $order->update([
        'customer_id' => $validated['customer_id'],
        'order_date' => $validated['order_date'],
        'total_amount' => $validated['total_amount'],
    ]);

    $syncData = [];
    foreach ($validated['products'] as $productData) {
        $product = \App\Models\Product::find($productData['product_id']);
        $syncData[$productData['product_id']] = [
            'quantity' => $productData['quantity'],
            'price' => $product->price,
        ];
    }

    $order->products()->sync($syncData);

    return redirect()->route('orders.index')->with('success', 'Cập nhật đơn hàng thành công.');
}


    public function destroy(Order $order)
    {
        $order->products()->detach(); 
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Xoá đơn hàng thành công.');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'products']);
        return view('orders.show', compact('order'));
    }
}
