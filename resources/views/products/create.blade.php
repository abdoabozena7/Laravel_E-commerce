@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Add Product</h1>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Category</label>
            <select name="category_id" class="w-full p-2 border rounded">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="description" class="w-full p-2 border rounded">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Price</label>
            <input type="number" step="0.01" name="price" class="w-full p-2 border rounded" value="{{ old('price') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Stock</label>
            <input type="number" name="stock" class="w-full p-2 border rounded" value="{{ old('stock') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Image URL</label>
            <input type="text" name="image_url" class="w-full p-2 border rounded" value="{{ old('image_url') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Target Gender</label>
            <select name="target_gender" class="w-full p-2 border rounded">
                <option value="male" {{ old('target_gender') == 'male' ? 'selected' : '' }}>Men</option>
                <option value="female" {{ old('target_gender') == 'female' ? 'selected' : '' }}>Women</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
    </form>
</div>
@endsection