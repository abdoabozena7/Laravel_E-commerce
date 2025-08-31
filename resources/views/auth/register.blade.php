@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Register</h2>
    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full p-2 border rounded" />
        </div>
        <div class="mb-4">
            <label class="block mb-1">Gender</label>
            <select name="gender" required class="w-full p-2 border rounded">
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full p-2 border rounded" />
        </div>
        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" name="password" required class="w-full p-2 border rounded" />
        </div>
        <div class="mb-4">
            <label class="block mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full p-2 border rounded" />
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Register</button>
    </form>
    <p class="mt-4 text-center">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-600">Login here</a>
    </p>
</div>
@endsection