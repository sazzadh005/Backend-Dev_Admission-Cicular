@extends('layout')
@section('content')
<div class="flex justify-center items-center min-h-[90vh]">
    <div class="bg-white shadow-lg p-8 rounded-2xl w-full max-w-lg">
        <h2 class="text-3xl font-bold text-center mb-6">Edit Circular</h2>
        @if(session('success'))
            <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('circulars.update', $circular->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label for="UniversityName" class="block text-lg font-medium text-gray-700 mb-1">University Name</label>
                <input type="text" id="UniversityName" name="UniversityName" value="{{ old('UniversityName', $circular->UniversityName) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg" />
            </div>
            <div>
                <label for="ProgramName" class="block text-lg font-medium text-gray-700 mb-1">Program Name</label>
                <input type="text" id="ProgramName" name="ProgramName" value="{{ old('ProgramName', $circular->ProgramName) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg" />
            </div>
            <div>
                <label for="Description" class="block text-lg font-medium text-gray-700 mb-1">Description</label>
                <textarea id="Description" name="Description"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg">{{ old('Description', $circular->Description) }}</textarea>
            </div>
            <div>
                <label for="Link" class="block text-lg font-medium text-gray-700 mb-1">Link</label>
                <input type="text" id="Link" name="Link" value="{{ old('Link', $circular->Link) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg" /> 
            </div>
            <div>
                <label for="ApplicationDeadline" class="block text-lg font-medium text-gray-700 mb-1">Application Deadline</label>
                <input type="date" id="ApplicationDeadline" name="ApplicationDeadline" value="{{ old('ApplicationDeadline', $circular->ApplicationDeadline) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg" />
            </div>
            <button type="submit"
                class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition text-lg mb-2">
                Update Circular
            </button>
        </form>
        <hr class="my-6">
        <form action="{{ route('circulars.destroy', $circular->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this circular? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-full py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition text-lg">
                Delete Circular
            </button>
        </form>
    </div>
</div>
@endsection