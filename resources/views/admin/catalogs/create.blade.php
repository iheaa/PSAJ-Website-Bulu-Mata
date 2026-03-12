@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Create Catalog</h1>
        <p class="mt-2 text-sm text-gray-600">Add a new product to your catalog.</p>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.catalogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
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
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
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
                                required>{{ old('description') }}</textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Brief description of the product.</p>
                    </div>

                    <!-- Price -->
                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price (IDR)</label>
                        <div class="mt-1">
                            <input type="text" name="price" id="price" placeholder="e.g. 150.000" value="{{ old('price') }}"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                required>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="sm:col-span-3">
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                        <div class="mt-1">
                            <input type="number" step="1" name="stock" id="stock" value="{{ old('stock', 0) }}"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                                required>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="sm:col-span-6">
                        <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative group h-64 overflow-hidden" id="image-container">
                            <div class="space-y-1 text-center flex flex-col items-center justify-center w-full h-full absolute inset-0 bg-white" id="upload-prompt">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center z-20 relative">
                                    <label for="image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" class="sr-only" required accept="image/*" onchange="previewImage(event)">
                                    </label>
                                    <p class="pl-1 relative z-20">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 z-20 relative mt-1">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            
                            <!-- Image Preview Area -->
                            <div id="preview-area" class="hidden absolute inset-0 w-full h-full flex items-center justify-center bg-gray-50 p-2 z-10">
                                <img id="image-preview" src="#" alt="Preview" class="max-h-full max-w-full object-contain cursor-pointer" onclick="document.getElementById('image').click()">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity" onclick="document.getElementById('image').click()">
                                    <span class="text-white font-medium">Change Image</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-5 mt-5">
                    <div class="flex justify-end">
                        <a href="{{ route('admin.catalogs.index') }}"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
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
            document.getElementById('upload-prompt').classList.add('hidden');
            const previewArea = document.getElementById('preview-area');
            previewArea.classList.remove('hidden');
            
            const imgPreview = document.getElementById('image-preview');
            imgPreview.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        document.getElementById('upload-prompt').classList.remove('hidden');
        document.getElementById('preview-area').classList.add('hidden');
        document.getElementById('image-preview').src = '#';
    }
}
</script>
@endsection