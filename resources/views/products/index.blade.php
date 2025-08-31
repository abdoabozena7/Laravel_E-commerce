@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Products</h1>
    <div class="mb-4">
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</a>
    </div>
    <div class="mb-4 bg-white p-4 rounded shadow">
        <form method="GET" action="{{ route('products.index') }}">
            <div class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block mb-1">Category</label>
                    <select name="category" class="p-2 border rounded">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-1">Min Price</label>
                    <input type="number" step="0.01" name="min_price" value="{{ request('min_price') }}" class="p-2 border rounded">
                </div>
                <div>
                    <label class="block mb-1">Max Price</label>
                    <input type="number" step="0.01" name="max_price" value="{{ request('max_price') }}" class="p-2 border rounded">
                </div>
                <div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Filter</button>
                    <a href="{{ route('products.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded ml-2">Reset</a>
                </div>
                <div>
                    <label class="block mb-1">Gender</label>
                    <select name="gender" class="p-2 border rounded">
                        <option value="">All</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Men</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Women</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-4">
        @foreach ($products as $product)
        <div class="bg-white rounded shadow p-4 flex flex-col">
            @if ($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-40 w-full object-cover rounded">
            @else
            <div class="h-40 w-full bg-gray-200 flex items-center justify-center rounded text-gray-500">No Image</div>
            @endif
            <h3 class="text-lg font-semibold mt-3">{{ $product->name }}</h3>
            <p class="text-gray-600">{{ number_format($product->price, 2) }} $</p>
            <p class="text-sm text-gray-500">Category: {{ $product->category->name }}</p>
            <p class="text-sm text-gray-500">Gender: {{ ucfirst($product->target_gender) }}</p>
            <div class="mt-3 flex space-x-2">
                <a href="{{ route('products.show', $product) }}" class="text-blue-500">Details</a>
                <a href="{{ route('products.edit', $product) }}" class="text-yellow-500">Edit</a>
                <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Are you sure?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection