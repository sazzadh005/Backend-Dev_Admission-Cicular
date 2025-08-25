@extends('layout')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Create User</h2>
    {{-- Show Validation Errors --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>
        <div>
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">Create User</button>
        </div>
    </form>
</div>
@endsection