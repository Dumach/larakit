<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
                        <h1 class="text-2xl font-bold mb-4">User Details</h1>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium">Name:</label>
                            <p class="text-gray-900">{{ $user->name }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium">Email:</label>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>
                        <div class="flex flex-row gap-x-2 mt-6">
                            <td class="px-6 py-4">
                                <form method="post" id="deleteform" action="{{ route('users.destroy', [$user])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" form="deleteform" class=" rounded-md bg-violet-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-violet-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Delete</button>
                                </form>
                            </td>

                            <a href="{{ route('users.edit', [$user]) }}" class="px-4 py-2 bg-green-500 rounded hover:bg-green-600">
                                Edit
                            </a>
                            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>