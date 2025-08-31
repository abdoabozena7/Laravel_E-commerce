@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>
        <p class="mb-2"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p class="mb-2"><strong>Total:</strong> {{ number_format($order->total_amount, 2) }}</p>
        <p class="mb-2"><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
        <h2 class="text-xl font-bold mt-6 mb-2">Items</h2>
        <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">Product</th>
                    <th class="py-2 px-4 border">Quantity</th>
                    <th class="py-2 px-4 border">Price</th>
                    <th class="py-2 px-4 border">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td class="py-2 px-4 border">{{ $item->product->name }}</td>
                    <td class="py-2 px-4 border">{{ $item->quantity }}</td>
                    <td class="py-2 px-4 border">{{ number_format($item->price, 2) }}</td>
                    <td class="py-2 px-4 border">{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection