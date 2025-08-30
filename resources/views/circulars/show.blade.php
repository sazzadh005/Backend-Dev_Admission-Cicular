@extends('layout')

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-10">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-700 text-center md:text-left flex-1">{{ $circular->UniversityName }}</h2>
            <div class="flex gap-3 justify-center md:justify-end mt-4 md:mt-0">
                @guest
                        <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-900" title="Login to Apply">
                                        📝 Apply
                        </a>
                @endguest

                @if (Auth::check() && Auth::user()->role === 'user')
                        @if(in_array($circular->id, $appliedCircularIds))
                            <!-- User already applied -->
                            <button class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed" disabled>
                                ✅ Applied
                            </button>
                        @else
                            <!-- User not applied yet -->
                            <form action="{{ route('application.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="portal_id" value="{{ $circular->id }}">
                                <button type="submit" class="bg-purple-600 text-white px-3 py-1 rounded">
                                    📝 Apply
                                </button>
                            </form>
                        @endif
                @endif
                @if (Auth::check() && Auth::user()->role === 'admin')
                
                <a href="{{ route('circulars.edit', $circular->id) }}" class="py-2 px-5 bg-blue-600 text-lg font-bold text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="{{ route('circulars.destroy', $circular->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button class="py-2 px-5 bg-red-600 text-lg font-bold text-white rounded-lg hover:bg-red-700 transition">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
                
                @endif
                
            </div>
        </div>
        <div class="flex flex-col items-center space-y-4">
            <h3 class="text-2xl font-semibold text-gray-800">{{ $circular->UniversityName }}</h3>
            <p class="text-xl"><span class="font-bold">Program Name:</span> {{ $circular->ProgramName }}</p>
            <p class="text-xl"><span class="font-bold">Description:</span> {{ $circular->Description }}</p>
            <p class="text-xl"><span class="font-bold">Link:</span> <a href="{{ $circular->Link }}" class="text-blue-600 hover:underline">{{ $circular->Link }}</a></p>
            <p class="text-xl"><span class="font-bold">Application Deadline:</span> {{ $circular->ApplicationDeadline }}</p>
        </div>
    </div>
</div>
@endsection