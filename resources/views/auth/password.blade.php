@extends('layout')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg text-center">
        <h2 class="text-3xl font-bold mb-6 text-blue-600">Reset Password</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc list-inside text-left">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4 text-left">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', request('email')) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <!-- New Password -->
            <div class="mb-4 text-left">
                <label for="password" class="block text-gray-700 font-semibold mb-2">New Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter new password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <!-- Confirm Password -->
            <div class="mb-6 text-left">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Confirm new password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:-translate-y-1">
                Reset Password
            </button>
        </form>

        <div class="mt-6 text-sm">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Back to Login</a>
        </div>
    </div>
</div>
@endsection
