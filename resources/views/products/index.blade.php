<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Add new product</a>
                    @endif
                    <table id="products" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 border dark:border-gray-600">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-300 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Name') }}</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-300 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Price (USD)')  }}
                                    </span>
                                </th>

                                <th class="px-6 py-3 bg-gray-300 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Price (EUR)')  }}
                                    </span>
                                </th>
                                @if (auth()->user()->is_admin)
                                <th class="px-6 py-3 bg-gray-300 dark:bg-gray-700 text-left">

                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600 divide-solid">
                            @forelse($products as $product)
                                <tr class="bg-white dark:bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-900 dark:text-gray-100">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-900 dark:text-gray-100">
                                        {{ $product->price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-900 dark:text-gray-100">
                                        {{ $product->price_eur }}
                                    </td>
                                    @if (auth()->user()->is_admin)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-900 dark:text-gray-100 text-right">

                                                <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                    Edit</a>

                                            <form action="{{ route('products.delete', $product) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button onclick="return confirm('Are you sure?')" class="bg-red-600 text-white">Delete</x-danger-button>
                                            </form>

                                        </td>


                                    @endif
                                </tr>
                                @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-900 dark:text-gray-100">
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
