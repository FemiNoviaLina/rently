<x-base-layout>
    <x-base-body selected="Product">
        <div class="mt-24 mx-10 mb-4 text-lilac-100 text-3xl font-bold">
            {{ $type }} Inventory
        </div>
        <div class="mb-4 flex mx-10 items-center justify-between">
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
            <div class="flex">
                <a href="{{ route('add-'.strtolower($type) ) }}">
                    <button class="bg-mint-100 text-white text-sm rounded-md p-2 mx-1 hover:bg-mint-200">+ Add</button>
                </a>
                <div>
                <div>
                    <input type="hidden" name="token" value="z{{ csrf_token() }}">
                    <input type="hidden" name="delete_link" value="{{ route('delete-vehicle', [strtolower($type)]) }}">
                    <button id="delete-button" class="bg-red text-white text-sm rounded-md p-2 mx-1 hover:bg-opacity-80 flex disabled:bg-opacity-80" disabled> 
                        <svg class="mr-2" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.28125 0.691016C5.49219 0.2675 5.92578 0 6.39844 0H11.1016C11.5742 0 12.0078 0.2675 12.2187 0.691016L12.5 1.25H16.25C16.9414 1.25 17.5 1.80977 17.5 2.5C17.5 3.19023 16.9414 3.75 16.25 3.75H1.25C0.559766 3.75 0 3.19023 0 2.5C0 1.80977 0.559766 1.25 1.25 1.25H5L5.28125 0.691016V0.691016ZM15.4219 18.207C15.3594 19.2305 14.543 20 13.5508 20H3.94922C2.95898 20 2.13945 19.2305 2.07773 18.207L1.21484 5H16.25L15.4219 18.207Z" fill="white"/>
                        </svg>
                        Delete
                    </button>
                </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mx-10 my-4 text-sm">
            <p>Showing {{ count($vehicles) }} results from {{ $total_data }} records</p>
            <div>
                <p class="inline">Item per page</p>
                <form action="{{ request()->fullUrl() }}" method="get">
                    <select name="take" onchange="this.form.submit()" class="inline focus:ring focus:ring-lilac-200 focus:ring-opacity-50 appearance-none w-full bg-white border rounded shadow leading-tight text-sm focus:outline-none focus:shadow-outline">
                        @for ($i = 10; $i <= 50; $i+=10)
                        <option value="{{ $i }}" {{ $take == $i ? "selected" : "" }}>{{ $i }}</option>
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
                        <th class="px-2 py-3 border-b-2 border-blue-500">
                            <input type="checkbox" name="check" id="check-all" class="rounded-sm">
                        </th>
                        <th class="px-2 py-3 border-b-2 border-green-500">Vehicle ID</th>
                        <th class="px-2 py-3 border-b-2 border-red-500">Vehicle</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">Transmission</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">CC</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">Fuel Type</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">Rent Price</th>
                        <th class="px-2 py-3 text-center border-b-2 border-yellow-500 sm:text-left">Total Unit</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-normal text-gray-700" id="table-body">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    @foreach($vehicles as $vehicle)
                    @php
                        $routeName ="'" .route('update-' .strtolower($type), [$vehicle->id]). "'";
                    @endphp
                    <tr onclick="edit({{ $routeName }})" class="py-10 border-b border-gray-200 hover:bg-gray-300 cursor-pointer">
                    <td class="check flex flex-row items-center px-2 py-4">
                        <input type="checkbox" name="check" class="rounded-sm" value="{{ $vehicle->id }}"}}>
                    </td>
                    <td class="px-2 py-4">
                        {{ $vehicle->id }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $vehicle->name }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $vehicle->transmission }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $vehicle->cc }} CC
                    </td>
                    <td class="px-2 py-4">
                        {{ $vehicle->fuel }}
                    </td>
                    <td class="px-2 py-4">
                        IDR {{ $vehicle->price }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $vehicle->available_unit }}
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
        <script src="{{ asset('js/vehicles_dashboard_script.js') }}" defer></script>
        <script>
            const edit = (id) => {
                window.location.href = id;
            }
        </script>
    </x-base-body>
</x-base-layout>
