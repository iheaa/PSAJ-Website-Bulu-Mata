@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Catalog</h1>
        <p class="mt-2 text-sm text-gray-600">Update product details.</p>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.catalogs.update', $catalog->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul role="list" class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                    <!-- Name -->
                    <div class="sm:col-span-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" value="{{ old('name', $catalog->name) }}"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                required>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="3"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
                                required>{{ old('description', $catalog->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price (IDR)</label>
                        <div class="mt-1">
                            <input type="text" name="price" id="price"
                                value="{{ old('price', number_format($catalog->price, 0, ',', '.')) }}"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                required>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="sm:col-span-3">
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                        <div class="mt-1">
                            <input type="number" step="1" name="stock" id="stock" value="{{ old('stock', $catalog->stock) }}"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                required>
                        </div>
                    </div>

                    <!-- Combined Image Preview -->
                    <div class="sm:col-span-6">
                        <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                        <div class="mt-2">
                            <div class="relative group h-64 w-full md:w-64 overflow-hidden rounded-md border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center cursor-pointer" onclick="document.getElementById('image').click()">
                                <img id="image-preview" src="{{ asset($catalog->image) }}" alt="{{ $catalog->name }}" class="max-h-full max-w-full object-contain">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="h-8 w-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-white font-medium">Change Image</span>
                                </div>
                            </div>
                            <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Click the image above to change it. PNG, JPG, GIF up to 2MB. Leave unchanged to keep the current image.</p>
                    </div>
                </div>

                <div class="pt-5 mt-5 border-t border-gray-200">
                    <div class="flex justify-end pt-4">
                        <a href="{{ route('admin.catalogs.index') }}"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const imgPreview = document.getElementById('image-preview');
            imgPreview.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection