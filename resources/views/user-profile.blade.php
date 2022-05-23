<x-base-layout>
    <x-base-body selected="">
        <h1 class="font-bold text-3xl text-lilac-100 mt-24 ml-20">Let's Complete Your Profile</h1>
        <h2 class="font-bold text-xl text-lilac-100 ml-20">Regarding to our terms, we need more information for vehicle rental purposes</h2>
        <div class="min-h-screen flex flex-col items-center sm:pt-0 bg-">
            <form action="{{ '/me/profile' }}" method="post" class="w-11/12 max-w-7xl mt-4 px-12 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg grid spec-container lg:grid-cols-2 lg:grid-rows-4 gap-x-5 grid-cols-1 grid-row-8">
                <div>
                    <x-label for="name" value="Full Name" class="block font-bold text-base"/>
                    <x-input id="name" class="block" type="text" name="name" value="{{ Auth::user()->name }}" required disabled />
                </div>
                <div>
                    <x-label for="email" value="Email" class="block font-bold text-base"/>
                    <x-input id="email" class="block" type="email" name="email" value="{{ Auth::user()->email }}" required disabled />
                </div>
                <div>
                    <x-label for="phone_1" value="Phone Number 1" class="block font-bold text-base"/>
                    <x-input id="phone-1" class="block" type="text" name="phone_1" value="{{ Auth::user()->phone_1 }}" required autofocus />
                </div>
                <div>
                    <x-label for="phone_2" value="Phone Number 2" class="block font-bold text-base"/>
                    <x-input id="phone-2" class="block" type="text" name="phone_2" value="{{ Auth::user()->phone_2 }}" required />
                </div>
                <div>
                    <x-label for="address_id" value="Address (According to your ID card)" class="inline-block font-bold text-base"/>
                    <x-text-area id="address-id" class="block" name="address_id" value="{{ Auth::user()->address_id }}" required/>
                </div>
                <div>
                    <x-label for="address_mlg" value="Address (Malang)" class="inline-block font-bold text-base"/>
                    <x-text-area id="address-mlg" class="block" name="address_mlg" value="{{ Auth::user()->address_mlg }}" required/>
                </div>
                <div class="flex items-center">
                    <x-button filled="true" class="px-0">Save</x-button>
                </div>
                @csrf
            </form>
        </div>
    </x-base-body>
</x-base-layout>