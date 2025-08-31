@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Login</h2>
    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login.perform') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full p-2 border rounded" />
        </div>
        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" name="password" required class="w-full p-2 border rounded" />
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Login</button>
    </form>
    <p class="mt-4 text-center">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-600">Register here</a>
    </p>
</div>
@endsection