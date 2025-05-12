<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col justify-between align-top">

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Username</th>
                                    <th scope="col" class="px-6 py-3">Creation date</th>
                                    <th scope="col" class="px-6 py-3">Akció</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)

                                <tr class="bg-white border-b border-gray-200">
                                    
                                    <td class="px-6 py-4 text-blue-500 focus:underline">
                                        <!-- <img src="{{ $user->image_url }}"
                                        class="object-cover object-center"
                                        width="160" height="240"
                                        alt="{{ $user->title }}"> -->
                                            <a href="{{ route('users.show', ['user' => $user]) }}">
                                            <p>{{ $user->email }}</p>
                                        </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <h3 class="font-semibold text-lg">{{ $user->name }}</h3>
                                        </td>
                                        <td class="px-6 py-4">
                                            <h4>{{ $user->created_at }}</h4>
                                        </td>

                                    <td class="px-6 py-4">
                                        <form method="post" id="deleteform" action="{{ route('users.destroy', [$user])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" form="deleteform" class=" rounded-md bg-violet-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-violet-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>