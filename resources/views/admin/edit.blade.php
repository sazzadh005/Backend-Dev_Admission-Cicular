@extends('layout')

@section('content')
<div class="flex justify-center items-center min-h-[90vh]">
    <div class="bg-white shadow-lg p-8 rounded-2xl w-full max-w-lg">
        <h2 class="text-3xl font-bold text-center mb-6">Edit Profile</h2>
        @if(session('success'))
            <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-lg font-medium text-gray-700 mb-1">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg" />
            </div>
            <div>
                <label for="email" class="block text-lg font-medium text-gray-700 mb-1">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg" />
            </div>
            <div>
                <label for="password" class="block text-lg font-medium text-gray-700 mb-1">
                    New Password <span class="text-sm text-gray-400">(leave blank to keep current)</span>
                </label>
                <input type="password" id="password" name="password" autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg" />
            </div>
            <button type="submit"
                class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition text-lg mb-2">
                Update Profile
            </button>
        </form>
        <hr class="my-6">
        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-full py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition text-lg">
                Delete Profile
            </button>
        </form>
    </div>
</div>
@endsection