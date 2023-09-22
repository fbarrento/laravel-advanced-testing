<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="products" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 border dark:border-gray-600">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-300 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Name') }}</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-300 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Price')  }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600 divide-solid">
                            @forelse($products as $product)
                                @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-900 dark:text-gray-200">
                                        {{ __('No products found') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
