<x-base-layout>
    <x-base-body selected="Rent">
        <div class="vehicles-detail flex flex-wrap mt-12 mx-20">
            <div class="details-text lg:basis-1/2 mt-12 sm:basis-full md:basis-full">
                <h2 class="font-extrabold text-4xl text-lilac-100">{{ $vehicle->name }}</h2>
                <h3 class="font-bold text-3xl text-lilac-100 mt-2">IDR {{ $vehicle->price }}/day</h3>
                <div class="mt-2 grid spec-container lg:grid-cols-2 lg:grid-rows-2">
                    <div class="engine my-2 flex items-center">
                        <img src="{{ asset('/images/engine-icon.svg') }}" class="inline w-8" alt="transmission">
                        <p class="font-bold inline pl-4">{{ $vehicle->transmission }}</p>
                    </div>
                    <div class="cc my-2 flex items-center">
                        <img src="{{ asset('/images/gear-icon.svg') }}" class="inline w-8" alt="cc">
                        <p class="font-bold inline pl-4">{{ $vehicle->cc }}cc</p>
                    </div>
                    <div class="year my-2 flex items-center">
                        <img src="{{ asset('/images/time-icon.svg') }}" class="inline w-8" alt="year">
                        <p class="font-bold inline pl-4">{{ $vehicle->year }}</p>
                    </div>
                    <div class="fuel my-2 flex items-center">
                        <img src="{{ asset('/images/fuel-icon.svg') }}" class="inline w-8" alt="fuel">
                        <p class="font-bold inline pl-4">{{ $vehicle->fuel }}</p>
                    </div>
                </div>
            </div>
            <div class="details-pic lg:basis-1/2 sm:basis-full md:basis-full">
                <img src="{{ asset('storage/images/'. $vehicle->photo) }}" alt="scoopy" class="w-4/5 h-4/5 mt-10">
            </div>
        </div>
        <div class="w-full max-w-7xl mx-auto rent-form my-4 px-20 py-10 bg-white shadow-md rounded-lg ">
            <h1 class="font-extrabold text-4xl text-lilac-100">Customer Rent Form</h1>
            @if($errors->any())
            <div class="bg-red bg-opacity-75 text-white p-2 rounded-md border border-red">
                <p>Data tidak sesuai</p>
            </div>
            @endif
            <form action="{{ url('rent/'.$vehicle->type.'/'.$vehicle->id) }}" method="post" enctype="multipart/form-data" class="flex flex-wrap">
                @csrf
                <div class="left-col basis-1/2">
                    <x-label for="name" value="Full Name" class="block font-bold text-base pt-4"/>
                    <x-input id="name" class="block w-4/5" type="text" name="name" value="{{ auth()->user()->name }}" required />
                    <x-label for="phone_1" value="Phone Number 1" class="block font-bold text-base pt-4"/>
                    <x-input id="phone-1" class="block w-4/5" type="text" name="phone_1" value="{{ auth()->user()->phone_1 }}" required />
                    <x-label for="address_id" value="Address (ID)" class="block font-bold text-base pt-4"/>
                    <x-text-area id="address-id" class="block w-4/5" name="address_id" required />
                    <div class="date-time flex">
                        <div class="date basis-6/12">
                            <x-label for="pickup_date" value="Pick Up Date" class="block font-bold text-base pt-4"/>
                            <x-input id="pickup-date" class="block" type="date" name="pickup_date" value="{{ date('Y-m-d') }}" required />
                        </div>
                        <div class="time basis-3/12 ml-8">
                            <x-label for="pickup_time" value="Pick Up Time" class="block font-bold text-base pt-4"/>
                            <x-input id="pickup-time" class="block" type="time" name="pickup_time" value="{{ explode(' ', gmdate('Y-m-d h:i \G\M\T'))[1] }}" required />
                        </div>
                    </div>
                    <x-label for="pickup_location" value="Pickup Location" class="block font-bold text-base pt-4"/>
                    <x-input class="w-1 inline-block" type="radio" name="pickup_location" id="office-pickup-location-button" value="Rent.ly Office" checked required />
                    <x-label for="pickup_location" value="Rent.ly Office" class="inline-block text-base pl-2"/>
                    <br>
                    <x-input class="inline-block w-1" type="radio" name="pickup_location" id="pickup-location-button" value="My Location" required />
                    <x-label for="pickup_location" value="My Location" class="inline-block text-base pl-2"/>
                    <x-text-area id="my-pickup-location" class="block w-4/5" name="pickup_location" required disabled/>
                    <x-label for="upload" value="Upload Documents" class="block font-bold text-base pt-4"/>
                    <x-label for="id_card" value="1. Upload Your Citizen Identity Card" class="text-base pt-2"/>
                    <input type="file" name="id_card" id="id-card" accept=".png, .jpg, .pdf" required>
                    <x-label for="driver_licence" value="2. Upload Your Driver License (SIM C)" class="text-base pt-2"/>
                    <input type="file" name="driver_license" id="driver-license" accept=".png, .jpg, .pdf" required>
                    <x-label for="id_card_2" value="3. Upload Other ID Card" class="text-base pt-2"/>
                    <input type="file" name="id_card_2" id="id-card-2" accept=".png, .jpg, .pdf" required>
                </div>
                <div class="right-col basis-1/2">
                    <x-label for="email" :value="__('Email')" class="block font-bold text-base pt-4" />
                    <x-input id="email" class="block w-4/5" type="email" name="email" value="{{ auth()->user()->email }}" required />
                    <x-label for="phone-2" value="Phone Number 2" class="block font-bold text-base  pt-4"/>
                    <x-input id="phone-2" class="block w-4/5" type="text" name="phone_2" value="{{ auth()->user()->phone_2 }}" required/>
                    <x-label for="address-mlg" value="Address (Malang)" class="block font-bold text-base  pt-4"/>
                    <x-text-area id="address-mlg" class="block w-4/5" name="address_mlg" required />
                    <div class="date-time flex">    
                        <div class="date basis-6/12">
                            <x-label for="dropoff_date" value="Drop Off Date" class="block font-bold text-base pt-4"/>
                            <x-input id="dropoff-date" class="block" type="date" name="dropoff_date" value="{{ date('Y-m-d', strtotime('tomorrow')) }}" required />
                        </div>
                        <div class="time basis-3/12 ml-8">
                            <x-label for="dropoff_time" value="Drop Off Time" class="block font-bold text-base pt-4"/>
                            <x-input id="dropoff-time" class="block" type="time" name="dropoff_time" value="{{ explode(' ', gmdate('Y-m-d h:i \G\M\T'))[1] }}" required />
                        </div>
                    </div>
                    <x-label for="dropoff_location" value="Drop off Location" class="block font-bold text-base pt-4"/>
                    <x-input class="w-1 inline-block" type="radio" name="dropoff_location" id="office-dropoff-location-button" value="Rent.ly Office" checked required />
                    <x-label for="dropoff_location" value="Rent.ly Office" class="inline-block text-base pl-2"/>
                    <br>
                    <x-input class="inline-block w-1" type="radio" name="dropoff_location" id="dropoff-location-button" value="My Location" required />
                    <x-label for="dropoff_location" value="My Location" class="inline-block text-base pl-2"/>
                    <x-text-area id="my-dropoff-location" class="block w-4/5" name="dropoff_location" required disabled/>
                    <x-label for="note" value="Note" class="block font-bold text-base pt-4"/>
                    <x-text-area id="note" class="block w-4/5 mb-5" name="note" />
                    <x-button filled="true">Rent Now</x-button>
                </div>
            </form>
        </div>

        <script>
            const pickupLocationButton = document.getElementById('pickup-location-button');
            const officePickupLocation = document.getElementById('office-pickup-location-button');
            const pickupLocationArea = document.getElementById('my-pickup-location');
            const dropoffLocationButton = document.getElementById('dropoff-location-button');
            const officeDropoffLocation = document.getElementById('office-dropoff-location-button');
            const dropoffLocationArea = document.getElementById('my-dropoff-location');
            const addressID = document.getElementById('address-id');
            const addressMlg = document.getElementById('address-mlg')

            pickupLocationButton.onclick = (event) => {
                pickupLocationArea.disabled = false;
            }

            officePickupLocation.onclick = (event) => {
                pickupLocationArea.disabled = true;
            }

            dropoffLocationButton.onclick = (event) => {
                dropoffLocationArea.disabled = false;
            }

            officeDropoffLocation.onclick = (event) => {
                dropoffLocationArea.disabled = true;
            }

            addressID.textContent = "{{ auth()->user()->address_id }}";
            addressMlg.textContent = "{{ auth()->user()->address_mlg }}";
        </script>
    </x-base-body>
</x-base-layout>