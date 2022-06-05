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
            <p>Showing {{ count($customers) }} results from {{ $total_data }} records</p>
            <div>
                <p class="inline">Item per page</p>
                <form action="{{ request()->fullUrl() }}" method="get">
                    <select name="take" onchange="this.form.submit()" class="inline focus:ring focus:ring-lilac-200 focus:ring-opacity-50 appearance-none w-full bg-white border rounded shadow leading-tight text-sm focus:outline-none focus:shadow-outline">
                        @for ($i = 10; $i <= 50; $i+=10)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </form>
            </div>
        </div>

        <div class="items-center w-full px-4 py-2 mx-auto my-5 bg-white rounded-lg shadow-md max-w-7xl">
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                <table class="w-full border border-collapse table-auto">
                <thead class="">
                    <tr class="text-base font-bold text-left bg-gray-100">
                        <th class="px-2 py-3 border-b-2 border-green-500">Customer ID</th>
                        <th class="px-2 py-3 border-b-2 border-red-500">Name</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">Email</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">Phone Number 1</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">Phone Number 2</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">Profile Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-normal text-gray-700" id="table-body">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    @foreach($customers as $customer)
                    <tr class="py-10 border-b border-gray-200 hover:bg-gray-300 cursor-pointer">
                    <input type="hidden" name="link" id="link-{{ $customer->id }}" value="{{ route('customer-details', [$customer->id]) }}">
                    <td class="px-2 py-4">
                        {{ $customer->id }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $customer->name }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $customer->email }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $customer->phone_1 ? $customer->phone_1 : '-' }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $customer->phone_2 ? $customer->phone_2 : '-' }}
                    </td>
                    <td class="px-2 py-4">
                        @if($customer->completed == 'true')
                        <div class="bg-lilac-400 text-lilac-100 text-xs rounded-full p-2 text-center">Complete</div>
                        @else
                        <div class="bg-light-red text-red text-xs rounded-full p-2 text-center">Incomplete</div>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <div class="flex flex-col items-center w-full px-4 py-2 space-y-2 text-sm text-gray-500 sm:justify-between sm:space-y-0 sm:flex-row">
                <div class="flex items-center justify-between space-x-2">
                    @if($page != 1)
                    <form action="{{ request()->fullUrl() }}" method="get">
                        <input type="hidden" name="page" value="{{ $page - 1 }}">
                        <input type="hidden" name="take" value="{{ $take }}">
                        <a onclick="$(this).closest('form').submit()" class="hover:text-lilac-100 cursor-pointer">Previous</a>
                    </form>
                    @endif
                    <div class="flex flex-row space-x-1">
                        @php $total_page = ceil($total_data / $take) @endphp
                        @for ($i = 1; $i <= $total_page; $i++)
                        @if($i == $page)
                        <div class="flex px-2 py-px text-lilac-100 bg-blue-400 border border-blue-400">{{ $i }}</div>
                        @else
                        <form action="{{ request()->fullUrl() }}" method="get">
                            <input type="hidden" name="page" value="{{ $i }}">
                            <input type="hidden" name="take" value="{{ $take }}">
                            <div onclick="$(this).closest('form').submit()" class="flex px-2 py-px border hover:bg-lilac-200 hover:text-white cursor-pointer">{{ $i }}</div>
                        </form>
                        @endif
                        @endfor
                    </div>
                    @if($page != $total_page)
                    <form action="{{ request()->fullUrl() }}" method="get">
                        <input type="hidden" name="page" value="{{ $page + 1 }}">
                        <input type="hidden" name="take" value="{{ $take }}">
                        <p onclick="$(this).closest('form').submit()" class="hover:text-lilac-100 cursor-pointer">Next</p>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div id="modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bg-gray-300 bg-opacity-75 z-50 w-full md:inset-0 h-full flex items-center justify-center">
            <div class="p-4 w-full max-w-3xl h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex justify-between items-start p-4 rounded-t border-b">
                        <h3 class="text-3xl font-semibold text-lilac-100">
                            Customer Details
                        </h3>
                        <button type="button" id="close" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-lilac-100 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <div class="border-b">
                        <ul class="flex mx-2">
                            <li id="customer-tab" class="p-2 cursor-pointer hover:bg-gray-300 border-b-4 border-lilac-100">Customer Details</li>
                            <li id="order-tab" class="p-2 cursor-pointer hover:bg-gray-300">Order History</li>
                        </ul>
                    </div>
                    <div id="customer" class="p-2">
                        <div class="mx-6 my-4 grid spec-container lg:grid-cols-2 lg:grid-rows-3 gap-x-5 grid-cols-1 grid-row-6 auto-rows-auto">
                            <div class="my-2">
                                <p class="font-bold">Customer Name</p>
                                <p id="selected-user-name"></p>
                            </div>
                            <div class="my-2">
                                <p class="font-bold">Customer Email</p>
                                <p id="selected-user-email"></p>
                            </div>
                            <div class="my-2">
                                <p class="font-bold">Phone Number 1</p>
                                <p id="selected-user-phone-1"></p>
                            </div>
                            <div class="my-2">
                                <p class="font-bold">Phone Number 2</p>
                                <p id="selected-user-phone-2"></p>
                            </div>
                            <div class="my-2">
                                <p class="font-bold">Address (ID)</p>
                                <p id="selected-user-address-id"></p>
                            </div>
                            <div class="my-2">
                                <p class="font-bold">Address (MLG)</p>
                                <p id="selected-user-address-mlg"></p>
                            </div>
                        </div>
                    </div>
                    <div id="order" class="hidden p-2"></div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/customers_dashboard_script.js') }}" defer></script>
    </x-base-body>
</x-base-layout>
