<x-base-layout>
    <x-base-body selected="My order">
        <div class="mt-24 mx-20">
            <h2 class="font-bold text-3xl text-lilac-100">Transfer Payment Instructions</h2>
            <p class="text-lilac-100" >{{ 'Payment ID : '. $order->transaction_id }}</p>
            <p class="text-lilac-100" >{{ 'Customer   : '. auth()->user()->name }}</p>
        </div>
        <div class="mt-4 mb-20 px-20 py-10 bg-white shadow-md rounded-lg w-full max-w-7xl m-auto">
            <ol class="relative border-l-2 border-lilac-100 ">                  
                <li class="mb-10 ml-4">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">1</div>
                    <h3 class="text-lg font-semibold ml-4">Complete the Payment Before:</h3>
                    <p class="mb-4 text-base font-normal ml-4">{{ $order->payment_expiry_time }}</p>
                </li>
                <li class="mb-10 ml-4">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">2</div>
                    <h3 class="text-lg font-semibold ml-4">Please Transfer to:</h3>
                    <div class="px-4">
                        <div class="flex bg-gray-300 items-center gap-4 px-2 w-8/12">
                            <img src="{{ asset('images/logo-'.strtolower(explode(' ', $order->payment_method)[0]).'.png') }}" class="h-3/6">
                            <h2 class="font-bold">{{ $order->payment_method }}</h2>
                        </div>
                        <div class="px-2 grid lg:grid-rows-2 lg:grid-cols-2 my-2 gap-y-2">
                            <p>Virtual Account Number</p>
                            <p>{{ $order->virtual_account }}</p>
                            <p>Recipient Name</p>
                            <p>business.ly</p>
                        </div>
                        <hr class="w-8/12">
                            <div class="px-2 grid lg:grid-rows-1 lg:grid-cols-2 my-2">
                                <p class="font-bold">Total Price</p>
                                <p class="font-bold">IDR {{ $order->total_price }}</p>
                            </div>
                        <hr class="w-8/12">
                    </div>
                </li>
                <li class="mb-10 ml-4 px-2">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">3</div>
                    <div class="px-2" >
                        <h3 class="text-lg font-semibold">Have You Paid?</h3>
                        <p class="text-base font-normal">Confirm your payment here</p>
                    </div>
                    <a href="{{ route('check-payment', [$order->id]) }}">
                        <x-button>Confirm Payment</x-button>
                    </a>
                </li>
            </ol>
        </div>
    </x-base-body>
</x-base-layout>