<x-base-layout>
    <x-base-body selected="Rent">
        <div class="mt-24 mx-10">
            <h2 class="font-bold text-3xl text-lilac-100">Select Payment</h2>
            <p class="text-lilac-100">Order ID : {{ $order->id }}</p>
            <p class="text-lilac-100">Customer : {{ auth()->user()->name }}</p>
        </div>
        <div class="mx-10 my-10 flex">
            <div class="w-60 text-sm font-medium text-gray-900 bg-white rounded-lg">
                <p aria-current="true" class="block w-full px-4 py-2 text-white font-bold bg-lilac-300">
                    BANK TRANSFER
                </p>
                <?php $bank_method = array('BCA Transfer' => 'bca', 'Mandiri Transfer' => 'mandiri', 'BNI Transfer' => 'bni', 'BRI Transfer' => 'bri', 'Permata Transfer' => 'permata') ?>
                @foreach($bank_method as $key => $value)
                <a href="{{ route('payment-details', [ $order->id, 'method' => $key]) }}" class="block w-full px-4 py-2 cursor-pointer {{ $selected_method == $key ? 'bg-white text-lilac-100' : 'bg-lilac-200 text-white' }} hover:bg-lilac-300 focus:outline-none focus:ring-2 focus:ring-blue-700">
                    <img src="{{ asset('images/logo-'. $value . '.png') }}" class="inline h-8 mr-2">
                    {{ $key }}
                </a>
                @endforeach
                <p aria-current="true" class="block w-full px-4 py-2 text-white font-bold bg-lilac-300 ">
                    TRANSFER E-WALLET
                </p>
                <?php $ewallet_method = array('ShopeePay' => 'shopeepay', 'DANA' => 'dana', 'Gopay' => 'gopay', 'OVO' => 'ovo') ?>
                @foreach($ewallet_method as $key => $value)
                <a href="{{ route('payment-details', [ $order->id, 'method' => $key]) }}" class="block w-full px-4 py-2 cursor-pointer {{ $selected_method == $key ? 'bg-white text-lilac-100' : 'bg-lilac-200 text-white' }} hover:bg-lilac-300 focus:outline-none focus:ring-2 focus:ring-blue-700">
                    <img src="{{ asset('images/logo-'. $value . '.png') }}" class="inline h-8 mr-2">
                    {{ $key }}
                </a>
                @endforeach
            </div>
            <div class="w-full max-w-5xl shadow p-10">
                <h2 class="font-bold text-3xl text-lilac-100 mb-2">{{ $selected_method }} Payment</h2>
                @if(in_array($selected_method, array_keys($bank_method)))
                <div class="bg-lilac-400 text-lilac-100 text-sm p-2 rounded-md border border-lilac-100">
                    <svg class="inline mx-1" width="18" height="18" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 1.875C7.75195 1.875 1.875 7.75195 1.875 15C1.875 22.248 7.75195 28.125 15 28.125C22.248 28.125 28.125 22.248 28.125 15C28.125 7.75195 22.248 1.875 15 1.875ZM15.9375 21.3281C15.9375 21.457 15.832 21.5625 15.7031 21.5625H14.2969C14.168 21.5625 14.0625 21.457 14.0625 21.3281V13.3594C14.0625 13.2305 14.168 13.125 14.2969 13.125H15.7031C15.832 13.125 15.9375 13.2305 15.9375 13.3594V21.3281ZM15 11.25C14.632 11.2425 14.2816 11.091 14.024 10.8281C13.7664 10.5652 13.6222 10.2118 13.6222 9.84375C13.6222 9.47568 13.7664 9.12228 14.024 8.85938C14.2816 8.59647 14.632 8.44501 15 8.4375C15.368 8.44501 15.7184 8.59647 15.976 8.85938C16.2336 9.12228 16.3778 9.47568 16.3778 9.84375C16.3778 10.2118 16.2336 10.5652 15.976 10.8281C15.7184 11.091 15.368 11.2425 15 11.25Z" fill="#9395DE"/>
                    </svg>
                    You can transfer from any banking service (m-banking, SMS banking or ATM)
                </div>
                @endif
                <div class="m-10">
                    <p class="font-bold">PRICING DETAILS</p>
                    <div class="grid lg:grid-rows-2 lg:grid-cols-2 my-2 gap-y-2">
                        <p>Honda Scoopy Smart Key  x1</p>
                        <p>IDR {{ $order->total_price - 4500 }}</p>
                        <p>Service Fee</p>
                        <p>IDR 4500</p>
                    </div>
                    <hr>
                    <div class="grid lg:grid-rows-1 lg:grid-cols-2 my-2">
                        <p>Total Price</p>
                        <p>IDR {{ $order->total_price }}</p>
                    </div>
                    <hr>
                </div>
                <div class="m-10 flex justify-end">
                    <a href="{{ route('get-virtual-account', [$order->id, 'method' => $selected_method ]) }}">
                        <x-button filled="true"> Pay with {{ $selected_method }} </x-button> 
                    </a>
                </div>
            </div>
        </div>
    </x-base-body>
</x-base-layout>