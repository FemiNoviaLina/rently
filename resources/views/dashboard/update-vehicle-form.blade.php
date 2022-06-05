<x-base-layout>
    <x-base-body selected="Product">
        <div class="h-screen">
            <h2 class="pt-24 mx-20 font-bold text-3xl text-lilac-100">Edit {{ $type }}</h2>
            <div class="w-full max-w-7xl mx-auto rent-form my-5 px-10 py-3 bg-white shadow-md rounded-lg ">
                <div class="mt-2 mx-10 flex items-end">
                    <img src="{{ asset('/storage/images/'. $vehicle['photo']) }}" alt="{{ $vehicle['name'] }}" class="w-80">
                    <div>
                        <div id="view-image">
                            <x-button filled="true">View Image</x-button>
                        </div>
                        <div id="update-image">
                            <x-button filled="true">Update Image</x-button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('update-vehicle', [$vehicle["id"]]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid spec-container lg:grid-cols-2 lg:grid-rows-5 gap-x-5 grid-cols-1 grid-row-10">
                        <div>
                            <x-label for="name" value="Vehicle Name" class="block font-bold text-base"/>
                            <x-input id="name" class="block" type="text" name="name" value="{{ $vehicle['name'] }}" required />
                        </div>
                        <div>
                            <x-label for="brand" value="Brand" class="block font-bold text-base"/>
                            @if($type == 'Motor')
                            <?php $brands = array('All', 'Honda', 'Suzuki', 'Yamaha') ?>
                            @else
                            <?php $brands = array('All', 'Honda', 'Suzuki', 'Toyota', 'Daihatsu', 'Nissan') ?>
                            @endif
                            <select name="brand" class="border-lilac-100 focus:ring focus:ring-lilac-200 focus:ring-opacity-50 block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($brands as $brand)    
                                <option value="{{ $brand }}" {{ $vehicle["brand"] == $brand ? "selected" : "" }}>{{ $brand }}</option>
                                @endforeach    
                            </select>
                        </div>
                        <div>
                            <x-label for="transmission" value="Transmission" class="block font-bold text-base"/>
                            <?php $transmissions = array('All', 'Manual', 'Automatic') ?>
                            <select name="transmission" class="border-lilac-100 focus:ring focus:ring-lilac-200 focus:ring-opacity-50 block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($transmissions as $transmission)
                                <option value="{{ $transmission }}" {{ $vehicle["transmission"] == $transmission ? "selected" : "" }}>{{ $transmission }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="fuel" value="Fuel Type" class="block font-bold text-base"/>
                            <?php $fuels = array('Pertamax', 'Pertalite') ?>
                            <select name="fuel" class="border-lilac-100 focus:ring focus:ring-lilac-200 focus:ring-opacity-50 block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($fuels as $fuel)
                                <option value="{{ $fuel }}" {{ $vehicle["fuel"] == $fuel ? "selected" : "" }}>{{ $fuel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="available_unit" value="Quantity" class="block font-bold text-base"/>
                            <x-input id="available_unit" class="block" type="number" name="available_unit" value="{{ $vehicle['available_unit'] }}" required />
                        </div>
                        <div>
                            <x-label for="cc" value="Vehicle's CC (Machine capacity)" class="block font-bold text-base"/>
                            <x-input id="cc" class="inline" type="number" name="cc" value="{{ $vehicle['cc'] }}" required />
                        </div>
                        <div>
                            <x-label for="year" value="Year" class="block font-bold text-base"/>
                            <x-input id="year" class="block" type="number" name="year" value="{{ $vehicle['year'] }}" required />
                        </div>
                        <div>
                            <x-label for="price" value="Price" class="block font-bold text-base"/>
                            <x-input id="price" class="block" type="number" name="price" value="{{ $vehicle['price'] }}" required />
                        </div>
                        <div>
                            <input type="hidden" name="type" value="{{ $vehicle['type'] }}">
                        </div>
                        <div class="flex justify-end mt-4">
                        <x-button type="submit" class="bg-lilac-100 hover:bg-lilac-200 text-lilac-100 font-bold py-2 px-4 rounded-full">
                            Update {{ $type }}
                        </x-button>
                    </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="lightbox" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bg-gray-300 bg-opacity-75 z-50 w-full md:inset-0 h-full flex items-center justify-center">
            <img src="{{ asset('/storage/images/'. $vehicle['photo']) }}" alt="{{ $vehicle['name'] }}" >
        </div>

        <div id="modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bg-gray-300 bg-opacity-75 z-50 w-full md:inset-0 h-full flex items-center justify-center">
            <div class="p-4 w-full max-w-3xl h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex justify-between items-start p-4 rounded-t border-b">
                        <h3 class="text-3xl font-semibold text-lilac-100">
                            Upload New Image
                        </h3>
                        <button type="button" id="close" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-lilac-100 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('update-vehicle-image', [$vehicle['id']]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <x-label for="photo" value="Upload Vehicle's Photo" class="block font-bold text-base"/>
                                <x-input id="photo" class="block" type="file" name="photo"  accept=".png, .jpg"  required />
                            </div>
                            <div class="flex justify-end">
                                <x-button type="submit" class="bg-lilac-100 hover:bg-lilac-200 text-lilac-100 font-bold py-2 px-4 rounded-full">
                                    Update Image
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/update_vehicle_script.js') }}" defer></script>
    </x-base-body>
</x-base-layout>