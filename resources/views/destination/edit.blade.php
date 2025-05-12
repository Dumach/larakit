<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a Destination') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white oversflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="post" action="{{ route('destinations.update', ['destination' => $destination->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="space-y-12">

                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base/7 font-semibold text-gray-900">Edit a Destination</h2>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <!-- Text Input  -->
                                    <div class="sm:col-span-3">
                                        <label for="country" class="block text-sm/6 font-medium text-gray-900">Destination country</label>
                                        <div class="mt-2">
                                            <input type="text" name="country" id="country" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6" value="{{ $destination->country }}" required>
                                        </div>
                                    </div>
                                    @error('country')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <!-- TextArea  -->
                                    <!-- <div class="sm:col-span-3">
                                        <label for="content" class="block text-sm/6 font-medium text-gray-900">Label</label>
                                        <div class="mt-2">
                                            <textarea name="content" id="content" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6">{{ $destination->description }}</textarea>
                                        </div>
                                    </div>
                                    @error('content')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror -->

                                    <!-- Multiple Option -->
                                    <div class="sm:col-span-3">
                                        <label for="vehicle" class="block text-sm/6 font-medium text-gray-900">Mean of Transportation</label>
                                        <div class="mt-2 grid grid-cols-1">
                                            <select id="vehicle" name="vehicle" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6">
                                                <option>Bus</option>
                                                <option>Car</option>
                                                <option>Ship</option>
                                                <option>Plane</option>
                                            </select>
                                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('vehicle')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <!-- Edit Images -->
                                    <div class="sm:col-span-3">
                                        <label for="image" class="block text-sm/6 font-medium text-gray-900">Image</label>
                                        <div class="mt-2">
                                            <input type="file" name="image" id="image" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6">
                                        </div>
                                        @if ($destination->image)
                                        <div>
                                            <input type="checkbox" name="removeImage" id="removeImage">
                                            <label for="removeImage">Remove Image</label>
                                        </div>

                                        <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}">
                                        @endif
                                    </div>
                                    @error('image')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <!-- Date -->
                                    <div class="sm:col-span-4">
                                        <label for="date" class="block text-sm/6 font-medium text-gray-900">Start Date</label>
                                        <div class="mt-2">
                                            <input id="date" name="date" type="date" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6" value="{{ $destination->date }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('destination.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                            <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Save</button>
                        </div>
                    </form>

                    <div class="mx-auto right-0">
                        <form method="post" id="deleteform" action="{{ route('destination.destroy', ['destination' => $destination]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" form="deleteform" class=" rounded-md bg-violet-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-violet-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>