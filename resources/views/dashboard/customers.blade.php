<x-base-layout>
    <x-base-body selected="Customer">
        <div class="mt-24 mb-4 flex mx-10">
            <form action="" method="get">
                <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 stroke-lilac-100"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </span>
                <x-input id="search-order" class="py-2 text-sm pl-10" type="search" placeholder="Search" name="order_query" value="" autocomplete="on" required />
                </div>
            </form>
        </div>

        <div class="flex justify-between items-center mx-10 my-4 text-sm">
            <p>Showing result 1-10 Result</p>
            <div>
                <p class="inline">Item per page</p>
                <select name="item_per_page" class="inline focus:ring focus:ring-lilac-200 focus:ring-opacity-50 appearance-none w-full bg-white border rounded shadow leading-tight text-sm focus:outline-none focus:shadow-outline">
                    @for ($i = 10; $i <= 50; $i+=10)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="flex flex-col mx-10">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center">
                    <thead class="border-b bg-gray">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                <input type="checkbox" name="check" id="check-all" class="rounded-sm">
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                Order ID
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                Vehicle
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                Pick up time
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                Drop off time
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                Customer
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                Status
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                Total price
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                                Action
                            </th>
                        </tr>
                    </thead class="border-b">
                    <tbody>
                        <tr class="bg-white border-b">
                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                            <input type="checkbox" name="check" class="rounded-sm">
                        </td>
                        <td class="text-sm text-gray-900 font-regular px-6 py-2 whitespace-nowrap">
                            
                        </td>
                        <td class="text-sm text-gray-900 font-regular px-6 py-2 whitespace-nowrap">
                            
                        </td>
                        <td class="text-sm text-gray-900 font-regular px-6 py-2 whitespace-nowrap">
                            
                        </td>
                        <td class="text-sm text-gray-900 font-regular px-6 py-2 whitespace-nowrap">
                            
                        </td>
                        <td class="text-sm text-gray-900 font-regular px-6 py-2 whitespace-nowrap">
                            
                        </td>
                        <td class="text-sm text-gray-900 font-regular px-6 py-2 whitespace-nowrap">
                            
                        </td>
                        <td class="text-sm text-gray-900 font-regular px-6 py-2 whitespace-nowrap">
                            
                        </td>
                        <td class="text-sm text-gray-900 font-regular px-6 py-2 whitespace-nowrap">
                            
                        </td>
                        </tr class="bg-white border-b">
                        
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </x-base-body>
</x-base-layout>
