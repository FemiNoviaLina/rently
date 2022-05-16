<x-base-layout>
    <x-base-body selected="My order">
        <div class="mt-24 mx-20">
            <h2 class="font-bold text-3xl text-lilac-100">Konfirmasi Pembayaran</h2>
        </div>
        <div class="flex justify-center">
            <div class="w-full max-w-7xl shadow rounded-lg p-10 my-6">
                <p>Order ID : {{ $order->id }}</p>
                <p>Name : {{ auth()->user()->name }}</p>
                <p>Email : {{ auth()->user()->email }}</p>
                <p>Total Price : {{ $order->total_price }}</p>
                <p>Payment Status : {{ $order->payment_status }}</p>
                <p>Payment Method : {{ $order->payment_method }}</p>
                <p>Pay Before : {{ $order->payment_expiry_time }}</p>
                <p>Virtual Account : {{ $order->virtual_account }}</p>
                <a href="{{ route('check-payment', [$order->id]) }}">
                    <x-button filled="true">Konfirmasi Pembayaran</x-button>
                </a>
            </div>
        </div>
    </x-base-body>
</x-base-layout>