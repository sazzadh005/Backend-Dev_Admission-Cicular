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
                    <tr class="hover:bg-gray-50 cursor-pointer">
                        <td class="px-4 py-2 text-sm font-medium text-gray-900" onclick="window.location='{{ route('circulars.show', $circular->id) }}'">{{ $circular->UniversityName }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700" onclick="window.location='{{ route('circulars.show', $circular->id) }}'">{{ $circular->ProgramName }}</td>
                        <td class="px-4 py-2 text-sm text-blue-600 hover:underline">
                            <a href="{{ $circular->Link }}" target="_blank" rel="noopener noreferrer">{{ Str::limit($circular->Link, 25) }}</a>
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700" onclick="window.location='{{ route('circulars.show', $circular->id) }}'">{{ \Carbon\Carbon::parse($circular->ApplicationDeadline)->format('M d, Y') }}</td>
                        <td class="px-4 py-2" onclick="window.location='{{ route('circulars.show', $circular->id) }}'">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $circular->Status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $circular->Status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-sm font-medium flex items-center space-x-2">
                             <a href="{{ route('circulars.show', $circular->id) }}" class="text-green-600 hover:text-green-900" title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('circulars.edit', $circular->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M6 18H2v-4l10.536-10.536a2 2 0 012.828 0l3.536 3.536a2 2 0 010 2.828L14 18h-4zM16 10l-6 6M10 16l-6-6" />
                                </svg>
                            </a>
                            <form action="{{ route('circulars.destroy', $circular->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.013 21H7.987a2 2 0 01-1.92-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
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