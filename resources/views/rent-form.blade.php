<x-base-layout>
    <x-base-body selected="Rent">
        <div class="vehicles-detail flex mt-12 mx-20">
            <div class="details-text lg:basis-1/2 mt-12 sm:basis-full md:basis-full">
                <h2 class="font-extrabold text-4xl text-lilac-100">Honda Scoopy Smart Key</h2>
                <h3 class="font-bold text-3xl text-lilac-100 mt-2">IDR 90000/day</h3>
                <div class="mt-2 grid spec-container grid-cols-2 grid-rows-2">
                    <div class="engine my-2 flex items-center">
                        <img src="{{ asset('/images/engine-icon.svg') }}" class="inline w-8" alt="trasmission">
                        <p class="font-bold inline pl-4">Automatic</p>
                    </div>
                    <div class="cc my-2 flex items-center">
                        <img src="{{ asset('/images/gear-icon.svg') }}" class="inline w-8" alt="cc">
                        <p class="font-bold inline pl-4">110cc</p>
                    </div>
                    <div class="year my-2 flex items-center">
                        <img src="{{ asset('/images/time-icon.svg') }}" class="inline w-8" alt="year">
                        <p class="font-bold inline pl-4">2022</p>
                    </div>
                    <div class="fuel my-2 flex items-center">
                        <img src="{{ asset('/images/fuel-icon.svg') }}" class="inline w-8" alt="fuel">
                        <p class="font-bold inline pl-4">Pertamax</p>
                    </div>
                </div>
            </div>
            <div class="details-pic lg:basis-1/2 sm:basis-full md:basis-full">
                <img src="{{ asset('images/motor-photo.png') }}" alt="scoopy" class="w-full h-full">
            </div>
        </div>
        <div class="rent-form mt-4 mx-20 px-20 py-10 bg-white shadow-md rounded-lg ">
            <h1 class="font-extrabold text-4xl text-lilac-100">Customer Rent Form</h1>
            <form action="" method="post" class="flex flex-wrap">
                @csrf
                <div class="left-col basis-1/2">
                    <x-label for="name" value="Full Name" class="block font-bold text-base pt-4"/>
                    <x-input id="name" class="block w-4/5" type="text" name="name" value="" required />
                    <x-label for="phone-1" value="Phone Number 1" class="block font-bold text-base pt-4"/>
                    <x-input id="phone-1" class="block w-4/5" type="text" name="phone-1" value="" required />
                    <x-label for="address-id" value="Address (ID)" class="block font-bold text-base pt-4"/>
                    <x-text-area id="address-id" class="block w-4/5" name="address-id" required />
                    <div class="date-time flex">
                        <div class="date basis-6/12">
                            <x-label for="pickup-date" value="Pick Up Date" class="block font-bold text-base pt-4"/>
                            <x-input id="pickup-date" class="block" type="date" name="pickup-date" value="{{ date('Y-m-d') }}" required />
                        </div>
                        <div class="time basis-3/12 ml-8">
                            <x-label for="pickup-time" value="Pick Up Time" class="block font-bold text-base pt-4"/>
                            <x-input id="pickup-time" class="block" type="time" name="pickup-time" value="{{ explode(' ', gmdate('Y-m-d h:i \G\M\T'))[1] }}" required />
                        </div>
                    </div>
                    <x-label for="pickup-location" value="Pickup Location" class="block font-bold text-base pt-4"/>
                    <x-input class="w-1 inline-block" type="radio" name="pickup-location" id="office-pickup-location-button" value="Rent.ly Office" checked required />
                    <x-label for="pickup-location" value="Rent.ly Office" class="inline-block text-base pl-2"/>
                    <br>
                    <x-input class="inline-block w-1" type="radio" name="pickup-location" id="pickup-location-button" value="My Location" required />
                    <x-label for="pickup-location" value="My Location" class="inline-block text-base pl-2"/>
                    <x-text-area id="my-pickup-location" class="block w-4/5" name="pickup-location" required disabled/>
                    <x-label for="upload" value="Upload Documents" class="block font-bold text-base pt-4"/>
                    <x-label for="id-card" value="1. Upload Your Citizen Identity Card" class="text-base pt-2"/>
                    <input type="file" name="id-card" id="id-card" accept=".png, .jpg, .pdf">
                    <x-label for="driver-licence" value="2. Upload Your Driver License (SIM C)" class="text-base pt-2"/>
                    <input type="file" name="driver-license" id="driver-license" accept=".png, .jpg, .pdf">
                    <x-label for="id-card-2" value="3. Upload Other ID Card" class="text-base pt-2"/>
                    <input type="file" name="id-card-2" id="id-card-2" accept=".png, .jpg, .pdf">
                </div>
                <div class="right-col basis-1/2">
                    <x-label for="email" :value="__('Email')" class="block font-bold text-base pt-4" />
                    <x-input id="email" class="block w-4/5" type="email" name="email" :value="old('email')" required />
                    <x-label for="phone-2" value="Phone Number 2" class="block font-bold text-base  pt-4"/>
                    <x-input id="phone-2" class="block w-4/5" type="text" name="phone-2" value="" required/>
                    <x-label for="address-mlg" value="Address (Malang)" class="block font-bold text-base  pt-4"/>
                    <x-text-area id="address-mlg" class="block w-4/5" name="address-mlg" required />
                    <div class="date-time flex">    
                        <div class="date basis-6/12">
                            <x-label for="dropoff-date" value="Pick Up Date" class="block font-bold text-base pt-4"/>
                            <x-input id="dropoff-date" class="block" type="date" name="dropoff-date" value="{{ date('Y-m-d', strtotime('tomorrow')) }}" required />
                        </div>
                        <div class="time basis-3/12 ml-8">
                            <x-label for="dropoff-time" value="Pick Up Time" class="block font-bold text-base pt-4"/>
                            <x-input id="dropoff-time" class="block" type="time" name="dropoff-time" value="{{ explode(' ', gmdate('Y-m-d h:i \G\M\T'))[1] }}" required />
                        </div>
                    </div>
                    <x-label for="dropoff-location" value="Drop off Location" class="block font-bold text-base pt-4"/>
                    <x-input class="w-1 inline-block" type="radio" name="dropoff-location" id="office-dropoff-location-button" value="Rent.ly Office" checked required />
                    <x-label for="dropoff-location" value="Rent.ly Office" class="inline-block text-base pl-2"/>
                    <br>
                    <x-input class="inline-block w-1" type="radio" name="dropoff-location" id="dropoff-location-button" value="My Location" required />
                    <x-label for="dropoff-location" value="My Location" class="inline-block text-base pl-2"/>
                    <x-text-area id="my-dropoff-location" class="block w-4/5" name="dropoff-location" required disabled/>
                    <x-label for="note" value="Note" class="block font-bold text-base pt-4"/>
                    <x-text-area id="note" class="block w-4/5 mb-5" name="note" required />
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
        </script>
    </x-base-body>
</x-base-layout>