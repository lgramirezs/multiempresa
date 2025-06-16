<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenant') }} {{ $tenant['id'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-8">
                        Next, you are going to see the tasks of the tenant {{ $tenant['id'] }}:
                    </h2>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Tenant</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            {{-- Loop through tasks --}}
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="text-center">{{ $task['id'] }}</td>
                                    <td class="text-center">{{ $task['title'] }}</td>
                                    <td class="text-center">{{ $task['description'] }}</td>
                                    <td class="text-center">{{ $tenant['id'] }}</td>
                                    {{-- <td class="text-center">
                                        <div class="mt-4">
                                            <img src="{{ asset($task['image_url']) }}" alt="{{ $task['title'] }}"
                                                class="w-full h-auto rounded-lg">
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
