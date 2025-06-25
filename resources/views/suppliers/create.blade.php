@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white flex justify-center items-start pt-10">
    <div class="w-full max-w-lg bg-gray-800 p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Register New Supplier</h2>

        @if($errors->any())
            <div class="bg-red-600 text-white px-4 py-2 rounded mb-4">
                <ul class="list-disc ml-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" required class="mt-1 w-full px-3 py-2 rounded bg-gray-700 text-white border border-gray-600">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 w-full px-3 py-2 rounded bg-gray-700 text-white border border-gray-600">
            </div>

            <div class="mb-4">
                <label for="pdf" class="block text-sm font-medium">PDF Document (optional)</label>
                <input type="file" name="pdf" id="pdf" accept="application/pdf" class="mt-1 block w-full text-sm text-gray-300 bg-gray-700 border border-gray-600 rounded">
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">Save Supplier</button>
            </div>
        </form>
    </div>
</div>
@endsection
