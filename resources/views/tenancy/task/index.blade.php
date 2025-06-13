<x-tenancy-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('task.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                            Create Task
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            {{-- Loop through tasks --}}
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="text-center" >{{ $task->id }}</td>
                                    <td class="text-center" >{{ $task->title }}</td>
                                    <td class="text-center" >{{ $task->description }}</td>
                                    <td class="text-center" >
                                        <a class="text-blue-500" href="{{ route('task.show', $task) }}">View</a> |
                                        <a class="text-yellow-500" href="{{ route('task.edit', $task) }}">Edit</a> |
                                        <form action="{{ route('task.destroy', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $tasks->links() }} {{-- Pagination links --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenancy-layout>
