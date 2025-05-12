<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Travel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="font-semibold text-3xl mb-4">Create a travel under: {{ $destination->country }}</h1>

                    <h2>Destination details:</h2>
                    <div class="flex flex-col p-2 ">
                        <img src="{{ $destination->image_url }}" class="w-40 h-32" alt="{{ $destination->name }}">
                        <h3 class="font-semibold text-lg">Transport by: {{ $destination->vehicle }}</h3>
                        <div class="mt-2">
                            <!-- <h3 class="font-semibold text-lg">Description:</h3> -->
                            <!-- <p class="text-justify">{{ $destination->description }}</p> -->

                        </div>
                    </div>
                    <div class="mt-6 flex flex-col gap-y-4">

                        <!-- Travel Section -->
                        <form method="post" action="/destinations/{{ $destination->id }}/travels" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="destination_id" name="destination_id" value="{{ $destination->id }}">


                            <div class="flex flex-col gap-4">

                                <div class="border-slate-400 p-4">

                                    <div class="sm:col-span-3">
                                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Price €</label>
                                        <div class="mt-2">
                                            <input type="number" name="price" id="price" class="block rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6">
                                        </div>
                                    </div>
                                    @error('price')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <!-- <div class="sm:col-span-3">
                                        <label for="description" class="block mb-2 text-sm font-medium ">Travel Description</label>
                                        <div class="mt-2">
                                            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm rounded-lg border" placeholder="Write your thoughts here..."></textarea>
                                        </div>
                                    </div>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror -->

                                    <!-- <div class="sm:col-span-3">
                                        <label for="image" class="block text-sm/6 font-medium text-gray-900">Image</label>
                                        <div class="mt-2">
                                            <input type="file" name="image" id="image" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6">
                                        </div>
                                    </div>
                                    @error('image')
                                    <span class="text-red-600 text-xs" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror -->


                                    <div class="sm:col-span-4">
                                        <label for="date" class="block text-sm/6 font-medium text-gray-900">Start Date</label>
                                        <div class="mt-2">
                                            <input id="date" name="date" type="date" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <br>
                                    <button type="submit" class="bg-green-500 border-solid rounded-md p-2 text-white">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>