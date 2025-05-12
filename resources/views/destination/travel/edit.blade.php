<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a Travel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white oversflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="post" action="{{ route('travels.update', ['destination' => $travel->destination, 'travel' => $travel]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="destination_id" id="destination_id" value="{{ $travel->destination->id }}">

                        <div class="space-y-12">

                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base/7 font-semibold text-gray-900">Edit a Travel</h2>


                                <div class="mt-10 flex flex-col gap-x-6 gap-y-8 ">

                                    <div class="sm:col-span-3">
                                        <label for="price" class="block text-sm/6 font-medium text-gray-900">Travel price</label>
                                        <div class="mt-2">
                                            <input type="number" name="price" id="price" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6" value="{{ $travel->price }}" required>
                                        </div>
                                    </div>
                                    @error('price')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <!-- <div class="sm:col-span-3">
                                        <label for="label" class="block text-sm/6 font-medium text-gray-900">Description</label>
                                        <div class="mt-2">
                                            <textarea name="description" id="description" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6">{{ $travel->description }}</textarea>
                                        </div>
                                    </div>
                                    @error('description')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror -->


                                    <!-- <div class="sm:col-span-3">
                                        <label for="image" class="block text-sm/6 font-medium text-gray-900">Image</label>
                                        <div class="mt-2">
                                            <input type="file" name="image" id="image" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6">
                                        </div>
                                        @if ($travel->image)
                                            <div>
                                                <input type="checkbox" name="removeImage" id="removeImage">
                                                <label for="removeImage">Remove Image</label>
                                            </div>

                                            <img src="{{ $travel->image_url }}" alt="{{ $travel->travel }}">
                                        @endif
                                    </div>
                                    @error('image')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror -->

                                    <div class="sm:col-span-4">
                                        <label for="date" class="block text-sm/6 font-medium text-gray-900">Start Date</label>
                                        <div class="mt-2">
                                            <input id="date" name="date" type="date" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6" value="{{ $travel->date }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('destinations.show', ['destination' => $travel->destination]) }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                            <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Save</button>
                        </div>
                    </form>

                    <div class="mx-auto right-0">
                        <form method="post" id="deleteform" action="{{ route('travels.destroy', ['destination' => $travel->destination, 'travel' => $travel]) }}">
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