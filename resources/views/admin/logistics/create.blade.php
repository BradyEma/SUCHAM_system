@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-6 bg-gray-50">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg shadow-md p-6 text-white mb-6">
        <h2 class="text-2xl font-bold">Add New Logistics Entry</h2>
        <p class="opacity-90">Fill in the details below to register a new logistics operation</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
             <form action="{{ route('admin.logistics.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Driver/Transporter Name</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            </div>

            <div>
                <label for="vehicle_no" class="block text-sm font-medium text-gray-700">Vehicle Number</label>
                <input type="text" name="vehicle_no" id="vehicle_no" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            </div>

            <div>
                <label for="route" class="block text-sm font-medium text-gray-700">Route / Destination</label>
                <input type="text" name="route" id="route"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('logistics') }}"
                   class="mr-4 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i> Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 text-sm font-semibold text-white bg-primary-700 rounded-md hover:bg-primary-800">
                    <i class="fas fa-save mr-2"></i> Save Entry
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
