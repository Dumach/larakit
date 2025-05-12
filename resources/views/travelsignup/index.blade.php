<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Travels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-row justify-between align-top">

                        <h1>
                            My Travels
                        </h1>

                    </div>

                    <!-- Travel Section -->
                    <section class="mt-8">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <!-- <th scope="col" class="px-6 py-3">User</th> -->
                                    <th scope="col" class="px-4 py-3">Country</th>
                                    <th scope="col" class="px-3 py-3">Mean of transport</th>
                                    <th scope="col" class="px-3 py-3">Date</th>
                                    <th scope="col" class="px-3 py-3">Price</th>
                                    <th scope="col" class="px-3 py-3">Action</th>
                                    <!-- <th scope="col" class="px-3 py-3">Creation Date</th>
                                    <th scope="col" class="px-4 py-3">Banner Image</th>
                                    <th scope="col" class="px-10 py-3">Description</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($myTravelSignups as $travelSignup)
                                <tr class="bg-white border-b border-gray-200">

                                    <td class="px-3 py-4">
                                        <h2>{{ $travelSignup->travel->destination->country }}</h2>
                                    </td>

                                    <td class="px-3 py-4">
                                        <p>{{ $travelSignup->travel->destination->vehicle }}</p>
                                    </td>

                                    <td class="px-3 py-4">
                                        <p>{{ $travelSignup->travel->date }}</p>
                                    </td>

                                    <td class="px-3 py-4">
                                        <p>€ {{ $travelSignup->travel->price }}</p>
                                    </td>

                                    <td class="px-3 py-4 flex gap-x-4 items-center justify-center ">
                                        <a href="{{ route('destinations.show', [$travelSignup->travel->destination->id]) }}" class="text-blue-600 hover:underline">
                                            Megtekint
                                        </a>


                                        <form method="POST" id="deleteform" action="{{ route('travel-signups.destroy', [$travelSignup->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" form="deleteform" class="bg-red-500 text-white p-2">Leiratkoz</button>
                                        </form>

                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-2">
                            {{ $myTravelSignups->links() }}
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>