@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Categories</h1>
    <div class="mb-4">
        <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</a>
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">ID</th>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Description</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td class="py-2 px-4 border">{{ $category->id }}</td>
                    <td class="py-2 px-4 border">{{ $category->name }}</td>
                    <td class="py-2 px-4 border">{{ $category->description }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
@endsection