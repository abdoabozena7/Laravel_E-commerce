@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="p-4 bg-white rounded shadow">
            <div class="text-gray-600">Categories</div>
            <div class="text-3xl font-bold">{{ $categoriesCount }}</div>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <div class="text-gray-600">Products</div>
            <div class="text-3xl font-bold">{{ $productsCount }}</div>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <div class="text-gray-600">Orders</div>
            <div class="text-3xl font-bold">{{ $ordersCount }}</div>
        </div>
    </div>
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-xl font-bold mb-2">Recent Orders</h2>
        <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">Order ID</th>
                    <th class="py-2 px-4 border">User</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Total</th>
                    <th class="py-2 px-4 border">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="py-2 px-4 border">{{ $order->id }}</td>
                    <td class="py-2 px-4 border">{{ $order->user->name }}</td>
                    <td class="py-2 px-4 border">{{ ucfirst($order->status) }}</td>
                    <td class="py-2 px-4 border">{{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-2 px-4 border">{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection