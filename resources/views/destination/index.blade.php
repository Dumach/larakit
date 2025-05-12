<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Destination Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-row justify-between align-top">

                        <h1>
                            Destination Section
                        </h1>

                        <!-- <a class="text-white bg-red-600 border rounded-md px-2 border-red-600 " href="{{ route('destinations.create') }}">Create</a> -->
                    </div>


                    <!-- Seach implement -->
                    <form method="GET" action="{{ route('destinations.index') }}" class="mb-4">
                        <div class="flex flex-col gap-y-2 w-[400px]">

                            <label for="searchBy">Keresés Alapján</label>
                            <select id="searchBy" name="searchBy" class="">
                                <option value="name" {{ $searchBy === 'name' ? 'selected' : '' }}>Cím</option>
                                <option value="Created_at" {{ $searchBy === 'Created_at' ? 'selected' : '' }}>Feltöltési dátum</option>
                                <!-- <option value="task.name" {{ $searchBy === 'task.name' ? 'selected' : '' }}>Feladat Címe</option> -->
                            </select>

                            <label for="search">Keresési Mező</label>
                            <input type="text" name="search" class="form-control"
                                value="{{ $search }}">

                            <label for="orderBy">Rendezés</label>
                            <select id="orderBy" name="orderBy" class="">
                                <option {{ $orderBy === 'name' ? 'selected' : '' }} value="name">Cím</option>
                                <option {{ $orderBy === 'created_ad' ? 'selected' : '' }} value="created_ad">Feltöltési dátum</option>
                                <!-- <option {{ $orderBy === 'task.name' ? 'selected' : '' }} value="task.name">Feladat</option> -->
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Keresés és Rendezés</button>
                        </div>
                    </form>


                    <!-- Destination Section -->
                    <section class="mt-8">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <!-- <th scope="col" class="px-6 py-3">User</th> -->
                                    <th scope="col" class="px-4 py-3">Country</th>
                                    <th scope="col" class="px-2 py-3">Mean of transport</th>
                                    <th scope="col" class="px-2 py-3">Action</th>
                                    <!-- <th scope="col" class="px-3 py-3">Creation Date</th>
                                    <th scope="col" class="px-4 py-3">Banner Image</th>
                                    <th scope="col" class="px-10 py-3">Description</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($destinations as $destination)
                                <tr class="bg-white border-b border-gray-200">

                                    <td class="px-3 py-4">
                                        <h2>{{ $destination->country }}</h2>
                                    </td>

                                    <td class="px-3 py-4">
                                        <p>{{ $destination->vehicle }}</p>
                                    </td>

                                    <td class="px-3 py-4">
                                        <a href="{{ route('destinations.show', [$destination->id]) }}" class="text-blue-600 hover:underline">
                                            Tovább
                                        </a>
                                    </td>

                                    <!-- <td class="px-2 py-4">
                                        <h3>
                                            @if ( $destination->travels()->count() > 0)
                                            {{ $destination->travels()->count() }}
                                            @else
                                            No Travels
                                            @endif
                                    </h3>
                                    </td> -->

                                    <!-- <td class="px-3 py-4">
                                        <h3>{{ $destination->created_at }}</h3>
                                    </td>

                                    <td class="px-4 py-1">
                                        <img class="w-32 h-24" src={{ $destination->image_url }}>
                                    </td>

                                    <td class="px-10 py-4">
                                        {{ $destination->description }}
                                    </td> -->
                                    <!-- @if ($destination->label)
                                    <div class="flex gap-2">
                                        @foreach (explode(' ', $destination->label) as $label)
                                        <span class="bg-slate-400 border-slate-400 p-0.5 rounded-lg">{{ $label }}</span>
                                        @endforeach
                                    </div>
                                    @endif -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-2">
                            <!-- If more than one: 
                            {{ $finished->appends(['search' => $search])->links() }} -->

                            {{ $destinations->links() }}
                        </div>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>