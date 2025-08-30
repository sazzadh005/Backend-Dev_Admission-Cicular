@extends('layout')

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-10">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-700 text-center md:text-left flex-1">User Profile</h2>
            <div class="flex gap-3 justify-center md:justify-end mt-4 md:mt-0">
                <a href="{{ route('users.edit', $user->id) }}" class="py-2 px-5 bg-blue-600 text-lg font-bold text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button class="py-2 px-5 bg-red-600 text-lg font-bold text-white rounded-lg hover:bg-red-700 transition">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="flex flex-col items-center space-y-4">
            <h3 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h3>
            <p class="text-xl"><span class="font-bold">Email:</span> {{ $user->email }}</p>
            <p class="text-xl"><span class="font-bold">Role:</span> {{ ucfirst($user->role ?? 'User') }}</p>
            <p class="text-xl"><span class="font-bold">Joined:</span> {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection