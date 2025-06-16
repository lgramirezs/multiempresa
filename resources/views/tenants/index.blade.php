<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('tenants.create') }}"
                        class="nline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">Create
                        Tenant</a>
                    <table class="min-w-full bg-white dark:bg-gray-800 mt-10">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Dominio</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                                <tr>
                                    <td class="border px-4 py-2">{{ $tenant->id }}</td>
                                    <td class="border px-4 py-2">{{ $tenant->domains->pluck('domain')->join(', ') }}
                                    </td>
                                    <td class="border px-4 py-2 flex justify-center gap-6">
                                        <a href="{{ route('tenants-registers.index', $tenant) }}"
                                            class="text-blue-500 hover:underline">Show registers</a>
                                        |
                                        <a href="{{ route('tenants.edit', $tenant) }}"
                                            class="text-yellow-500 hover:underline">Edit</a>
                                        |
                                        <form action="{{ route('tenants.destroy', $tenant) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
