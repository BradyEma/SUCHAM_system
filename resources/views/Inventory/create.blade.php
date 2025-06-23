@extends('layouts.app')

@section('content')
<div class="py-12 px-6">
    <h2 class="text-2xl font-bold text-sky-600 mb-4">Add New Item</h2>

    <form action="{{ route('inventory.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label>Item Name</label>
            <input type="text" name="item_name" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label>Category</label>
            <input type="text" name="category" class="w-full border rounded p-2">
        </div>

        <div>
            <label>Quantity</label>
            <input type="number" name="quantity" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label>Unit</label>
            <input type="text" name="unit" value="kg" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-sky-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
