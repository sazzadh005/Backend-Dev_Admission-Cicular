@extends('layout')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg text-center">
        <h2 class="text-3xl font-bold mb-6 text-blue-600">Welcome Back</h2>

        @if ($errors->has('email'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ $errors->first('email') }}</span>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4 text-left">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>
            <div class="mb-4 text-left">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Forgot Password link -->
            <div class="text-right mb-6">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Forgot your password?
                </a>
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:-translate-y-1">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
