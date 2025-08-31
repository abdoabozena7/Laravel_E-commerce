@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Orders</h1>
    <div class="mb-4 bg-white p-4 rounded shadow">
        <form method="GET" action="{{ route('orders.index') }}">
            <div class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block mb-1">Status</label>
                    <select name="status" class="p-2 border rounded">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Filter</button>
                    <a href="{{ route('orders.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded ml-2">Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">Order ID</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Total</th>
                    <th class="py-2 px-4 border">Created at</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="py-2 px-4 border">{{ $order->id }}</td>
                    <td class="py-2 px-4 border">{{ ucfirst($order->status) }}</td>
                    <td class="py-2 px-4 border">{{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-2 px-4 border">{{ $order->created_at->format('Y-m-d') }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('orders.show', $order) }}" class="text-blue-500">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>
@endsection