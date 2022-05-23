<x-base-layout>
    <x-base-body selected="Product">
        <div class="h-screen">
            <h2 class="pt-24 mx-20 font-bold text-3xl text-lilac-100">New {{ $type }}</h2>

            <div class="w-full max-w-7xl mx-auto rent-form my-12 px-20 py-10 bg-white shadow-md rounded-lg ">
                <form action="{{ route('add-vehicle', [strtolower($type)]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid spec-container lg:grid-cols-2 lg:grid-rows-5 gap-x-5 grid-cols-1 grid-row-10">
                        <div>
                            <x-label for="name" value="Vehicle Name" class="block font-bold text-base"/>
                            <x-input id="name" class="block" type="text" name="name" required />
                        </div>
                        <div>
                            <x-label for="brand" value="Brand" class="block font-bold text-base"/>
                            @if($type == 'Motor')
                            <?php $brands = array('All', 'Honda', 'Suzuki', 'Yamaha') ?>
                            @else
                            <?php $brands = array('All', 'Honda', 'Suzuki', 'Toyota', 'Daihatsu', 'Nissan') ?>
                            @endif
                            <select name="brand" class="focus:ring focus:ring-lilac-200 focus:ring-opacity-50 block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($brands as $brand)    
                                <option value="{{ $brand }}">{{ $brand }}</option>
                                @endforeach    
                            </select>
                        </div>
                        <div>
                            <x-label for="transmission" value="Transmission" class="block font-bold text-base"/>
                            <?php $transmissions = array('All', 'Manual', 'Automatic') ?>
                            <select name="transmission" class="focus:ring focus:ring-lilac-200 focus:ring-opacity-50 block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($transmissions as $transmission)
                                <option value="{{ $transmission }}">{{ $transmission }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="fuel" value="Fuel Type" class="block font-bold text-base"/>
                            <?php $fuels = array('Pertamax', 'Pertalite') ?>
                            <select name="fuel" class="focus:ring focus:ring-lilac-200 focus:ring-opacity-50 block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($fuels as $fuel)
                                <option value="{{ $fuel }}">{{ $fuel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="available_unit" value="Quantity" class="block font-bold text-base"/>
                            <x-input id="available_unit" class="block" type="number" name="available_unit" required />
                        </div>
                        <div>
                            <x-label for="cc" value="Vehicle's CC (Machine capacity)" class="block font-bold text-base"/>
                            <x-input id="cc" class="inline" type="number" name="cc" required />
                        </div>
                        <div>
                            <x-label for="year" value="Year" class="block font-bold text-base"/>
                            <x-input id="year" class="block" type="number" name="year" required />
                        </div>
                        <div>
                            <x-label for="price" value="Price" class="block font-bold text-base"/>
                            <x-input id="price" class="block" type="number" name="price" required />
                        </div>
                        <div>
                            <x-label for="photo" value="Upload Vehicle's Photo" class="block font-bold text-base"/>
                            <x-input id="photo" class="block" type="file" name="photo"  accept=".png, .jpg, .pdf"  required />
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-button type="submit" class="bg-lilac-100 hover:bg-lilac-200 text-lilac-100 font-bold py-2 px-4 rounded-full">
                            Add New {{ $type }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-base-body>
</x-base-layout>