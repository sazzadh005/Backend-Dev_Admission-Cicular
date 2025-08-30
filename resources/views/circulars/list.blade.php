@extends('layout')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">My Applications</h1>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">University Name</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Program Name</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Application Deadline</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($applications as $application)
                        <tr class="hover:bg-gray-50">
                            <!-- University Name -->
                            <td class="px-4 py-2 text-sm font-medium text-gray-900">
                                {{ $application->portal->UniversityName }}
                            </td>

                            <!-- Program Name -->
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ $application->portal->ProgramName }}
                            </td>

                            <!-- Deadline -->
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($application->portal->ApplicationDeadline)->format('M d, Y') }}
                            </td>

                            <!-- Status -->
                            <td class="px-4 py-2">
                                <span @class([
                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                    'bg-green-100 text-green-800' => $application->status === 'Approved',
                                    'bg-red-100 text-red-800'    => $application->status === 'Rejected',
                                    'bg-yellow-100 text-yellow-800' => !in_array($application->status, ['Approved', 'Rejected']),
                                ])>
                                    {{ $application->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">You haven’t applied to any circulars yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
