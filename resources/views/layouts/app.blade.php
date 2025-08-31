<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-commerce App') }}</title>
    {{-- Include compiled CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <nav class="bg-black shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-gray-800">Egensolve</a>
                <div class="hidden md:flex space-x-4">
                    <a href="{{ route('products.index') }}" class="text-black-700 hover:text-gray-900">Products</a>
                    <a href="{{ route('categories.index') }}" class="text-black-700 hover:text-gray-900">Categories</a>
                    <a href="{{ route('orders.index') }}" class="text-black-700 hover:text-gray-900">Orders</a>
                    <a href="{{ route('dashboard') }}" class="text-gray-black hover:text-gray-900">Dashboard</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                </form>
                @endauth
            </div>
        </div>
    </nav>
    <main class="py-6">
        @yield('content')
    </main>
</body>
</html>