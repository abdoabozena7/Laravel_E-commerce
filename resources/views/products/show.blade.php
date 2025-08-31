@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
        <p class="mb-2"><strong>Category:</strong> {{ $product->category->name }}</p>
        <p class="mb-2"><strong>Price:</strong> {{ number_format($product->price, 2) }}</p>
        <p class="mb-2"><strong>Stock:</strong> {{ $product->stock }}</p>
        <p class="mb-2"><strong>Target Gender:</strong> {{ ucfirst($product->target_gender) }}</p>
        <p class="mb-4"><strong>Description:</strong> {{ $product->description }}</p>
        @auth
        <form method="POST" action="{{ route('orders.store') }}" class="mb-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="mb-4">
                <label class="block mb-1">Quantity</label>
                <input type="number" name="quantity" value="1" min="1" class="p-2 border rounded">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add to Order</button>
        </form>
        @else
        <p>Please <a href="{{ route('login') }}" class="text-blue-600">login</a> to place an order.</p>
        @endauth
    </div>
</div>
@endsection