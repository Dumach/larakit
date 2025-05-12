<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Destination Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a class="text-blue-500 hover:underline" href="{{ route('destinations.index') }}">Vissza</a>

                    <h1 class="font-semibold text-3xl mt-6 mb-4">{{ $destination->country }}</h1>


                    <div class="flex flex-col m-4 p-2 ">
                        @if ($destination?->image_url)
                        <img class="w-40 h-32" src="{{ $destination->image_url }}" alt="{{ $destination->title }}">
                        @endif
                        <div class="mt-10">
                            <h3 class="font-semibold text-lg">Details:</h3>

                            <p class="text-justify">Mean of Transportation: {{ $destination->vehicle }}</p>

                        </div>
                        <!-- @if ($destination->label)
                        <div class="flex gap-2">
                            @foreach (explode(' ', $destination->label) as $label)
                            <span class="bg-slate-400 border-slate-400 p-0.5 rounded-lg">{{ $label }}</span>
                            @endforeach
                        </div>
                        @endif -->
                    </div>

                    <div class="flex gap-4 mt-4">
                        @if (Auth::user()?->is($destination->user))
                        <a class="text-red-600 px-4 py-2 mx-2" href="{{ route('destinations.edit', ['destination' => $destination->id]) }}">Edit</a>
                        @endif

                        @auth
                        <a class="text-violet-600 px-4 py-2 mx-2" href="{{ route('travels.create', ['destination' => $destination]) }}">Add New Travel</a>
                        @endauth
                    </div>


                    <!-- Travel Section -->
                    <section class="mt-8">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                    <th scope="col" class="px-6 py-3">Price</th>
                                    <th scope="col" class="px-6 py-3">Signed Up</th>
                                    <!-- <th scope="col" class="px-6 py-3">Due Date</th> -->
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($travels as $travel)
                                <tr class="bg-white border-b border-gray-200">

                                    <td class="px-6 py-4">
                                        <a class="text-blue-500 hover:underline" href="{{ route('travels.edit', ['destination' => $destination, 'travel' => $travel]) }}">
                                            <h2>{{ $travel->date }}</h2>
                                        </a>
                                    </td>


                                    <!-- <td class="px-6 py-4">
                                        <img class="w-32 h-24" src="{{ $travel->image_url }}" alt="{{ $travel->title }}">
                                        <strong>{{ $travel->date }}</strong>
                                    </td> -->

                                    <td class="px-6 py-4">
                                        <p>€ {{ $travel->price }}</p>
                                    </td>

                                    <td class="px-2 py-4">
                                        @php
                                        $isSignedUp = \App\Models\TravelSignup::where('user_id', Auth::id())
                                        ->where('travel_id', $travel->id)
                                        ->exists();
                                        @endphp

                                        @if ($isSignedUp)
                                        <span class="text-green-600 font-semibold">Yes</span>
                                        @else
                                        <span class="text-red-600 font-semibold">No</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($destination->created_by()->is(auth()->user()) || auth()->user()?->is_admin == true)
                                        <!-- Delete Form Begins -->
                                        <p>
                                        <form method="POST" id="deleteform" action="{{ route('travels.destroy', [$destination->id, $travel->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" form="deleteform" class="bg-red-500 text-white p-2">Töröl</button>
                                        </form>
                                        </p>
                                        @elseif (! $isSignedUp)
                                        <!-- Signup Form Begins -->
                                        <p>
                                        <form method="POST" id="signupform" action="{{ route('travel-signups.store', ['travel_id' => $travel->id]) }}">
                                            @csrf

                                            <button type="submit" form="signupform" class="bg-blue-500 text-white p-2">Sign Up</button>
                                        </form>
                                        </p>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-2">
                            {{ $travels->links() }}
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>