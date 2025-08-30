@extends('layout')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">All Applications</h1>

   

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Applicant Name</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">University</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Program</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Applied On</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($applications as $application)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-900">
                                {{ $application->user->name }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ $application->user->email }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ $application->portal->UniversityName }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ $application->portal->ProgramName }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                {{ $application->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <span @class([
                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                    'bg-green-100 text-green-800' => $application->status === 'Approved',
                                    'bg-red-100 text-red-800'    => $application->status === 'Rejected',
                                    'bg-yellow-100 text-yellow-800' => !in_array($application->status, ['Approved', 'Rejected']),
                                ])>
                                    {{ $application->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm font-medium space-x-2">
                                @if ($application->status === 'Approved' || $application->status === 'Rejected')
                                    <span class="text-gray-600">{{ $application->status }}</span>
                                @else
                                <!-- Accept -->
                                <form action="{{ route('applications.update', $application->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Approved">
                                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                        ✅ Approved
                                    </button>
                                </form>

                                <!-- Reject -->
                                <form action="{{ route('applications.update', $application->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        ❌ Reject
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">No applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
