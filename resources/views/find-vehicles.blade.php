<x-base-layout>
    <x-base-body selected="true">
        <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-">
            <div class="w-full max-w-2xl mt-6 px-8 py-20 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <h3 class="font-bold text-center text-3xl text-lilac-100 mt-2">Search for {{ $type }} Rent</h3>
                <form action=" {{ '/'.strtolower($type).'s' }}" method="get" class=" mt-8">
                    <x-label for="pickup" value="Pick up" class="block font-bold text-base mt-6"/>
                    <div class="date-time flex flex-wrap lg:flex-row">
                        <x-input id="pickup-date" class="block lg:basis-8/12 md:w-full min-w-fit sm:mt-2 lg:mt-0" type="date" name="pickup_date" value="{{ date('Y-m-d') }}" required />
                        <x-input id="pickup-time" class="block lg:basis-3/12 lg:ml-2 md:w-full min-w-fit sm:mt-2 lg:mt-0 " type="time" name="pickup_time" value="{{ explode(' ', gmdate('Y-m-d h:i \G\M\T'))[1] }}" required />
                    </div>
                    <x-label for="dropoff" value="Drop off" class="block font-bold text-base mt-6"/>
                    <div class="date-time flex flex-wrap lg:flex-row ">
                        <x-input id="dropoff-date" class="block lg:basis-8/12 md:w-full min-w-fit sm:mt-2 lg:mt-0 " type="date" name="dropoff_date" value="{{ date('Y-m-d', strtotime('tomorrow')) }}" required />
                        <x-input id="dropoff-time" class="block lg:basis-3/12 lg:ml-2 md:w-full min-w-fit sm:mt-2 lg:mt-0" type="time" name="dropoff_time" value="{{ explode(' ', gmdate('Y-m-d h:i \G\M\T'))[1] }}" required />
                    </div>
                    <input type="hidden" name="type" value="{{ strtolower($type) }}">
                    <div class="mt-6 flex justify-center">
                        <x-button filled="true">Rent Now</x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-base-body>
</x-base-layout>