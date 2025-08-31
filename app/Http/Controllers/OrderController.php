<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

/**
 * OrderController manages listing, viewing, and placing orders.
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the orders with optional status filter.
     */
    public function index(Request $request)
    {
        $query = Order::with('user');

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Regular users should only see their own orders
        if (auth()->check() && (!(auth()->user()->role ?? false) || auth()->user()->role !== 'admin')) {
            $query->where('user_id', auth()->id());
        }

        $orders = $query->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Authorize that the user may view the order
        if (auth()->id() !== $order->user_id && (auth()->user()->role ?? '') !== 'admin') {
            abort(403);
        }

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    /**
     * Store a newly created order in storage.
     *
     * A simple implementation that creates an order with a single product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_amount' => $product->price * $request->quantity,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully.');
    }
}