@extends('layout')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">All Circulars</h1>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">University Name</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Program Name</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Link</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Application Deadline</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($circulars as $circular)
                    <tr class="hover:bg-gray-50">
                        <!-- University Name -->
                        <td class="px-4 py-2 text-sm font-medium text-gray-900">
                            <a href="{{ route('circulars.show', $circular->id) }}" class="hover:underline text-blue-600">
                                {{ $circular->UniversityName }}
                            </a>
                        </td>

                        <!-- Program Name -->
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <a href="{{ route('circulars.show', $circular->id) }}" class="hover:underline text-blue-600">
                                {{ $circular->ProgramName }}
                            </a>
                        </td>

                        <!-- Link -->
                        <td class="px-4 py-2 text-sm text-blue-600 hover:underline">
                            <a href="{{ $circular->Link }}" target="_blank" rel="noopener noreferrer">
                                {{ Str::limit($circular->Link, 25) }}
                            </a>
                        </td>

                        <!-- Application Deadline -->
                        <td class="px-4 py-2 text-sm text-gray-700">
                            {{ \Carbon\Carbon::parse($circular->ApplicationDeadline)->format('M d, Y') }}
                        </td>

                        <!-- Status -->
                        <td class="px-4 py-2">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $circular->Status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $circular->Status }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-4 py-2 text-sm font-medium flex items-center space-x-2">
                            <!-- Show (Everyone) -->
                            <a href="{{ route('circulars.show', $circular->id) }}" class="text-green-600 hover:text-green-900" title="View">
                                👁️ Show
                            </a>

                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <!-- Edit (Admin only) -->
                                <a href="{{ route('circulars.edit', $circular->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                    ✏️ Edit
                                </a>

                                <!-- Delete (Admin only) -->
                                <form action="{{ route('circulars.destroy', $circular->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')" title="Delete">
                                        🗑️ Delete
                                    </button>
                                </form>
                            @else
                                <!-- Apply -->
                                    @guest
                                <!-- If not logged in, redirect to login -->
                                    <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-900" title="Login to Apply">
                                        📝 Apply
                                    </a>
                                    @endguest

                                    @auth
                                <!-- If logged in, go to application form -->
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
                                    @endauth
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No circulars found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
