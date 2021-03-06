<x-base-layout>
    <x-base-body selected="My Order">
        <div>
        <h1 class="font-bold text-3xl text-lilac-100 mt-24 ml-20">Your order's progress</h1>
        <h2 class="font-bold text-xl text-lilac-100 ml-20">Lihat progress dari pengajuan rental yang telah dilakukan</h2>
        </div>
        @if(count($orders) == 0)
        <div class="h-96 mt-20 mb-32 flex justify-center items-center">
            <div class="flex flex-col items-center w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <p> You haven't rent any vehicle </p>
                <div class="flex mt-5">
                    <a href="{{ url('/find/car') }}">
                        <x-button filled="true">Find car</x-button>
                    </a>
                    <a href="{{ url('/find/motor') }}">
                        <x-button filled="true">Find motor</x-button>
                    </a>
                </div>
            </div>
        </div>
        @else
        @foreach($orders as $order)
        <div class="w-full max-w-7xl mx-auto my-4 px-10 py-4 bg-white shadow-md rounded-lg">
            <div class="flex flex-wrap justify-between">
                <p class="font-bold">{{ $order->name }}</p>
                <p>Waktu pengajuan: {{ $order->created_at }}</p>
            </div>
            <div class="flex mt-2">
                @if($order->order_status == 'PENDING')
                <svg width="28" height="28" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.3958 3.16675C10.6653 3.16675 3.5625 10.2696 3.5625 19.0001C3.5625 27.7306 10.6653 34.8334 19.3958 34.8334C28.1263 34.8334 35.2292 27.7306 35.2292 19.0001C35.2292 10.2696 28.1263 3.16675 19.3958 3.16675ZM28.5 20.5834H17.8125V9.50008H20.9792V17.4167H28.5V20.5834Z" fill="#7C7DDC"/>
                </svg>
                <p class="ml-2 font-bold text-lilac-100"> Tim Rent.ly sedang meninjau pengajuan Anda. Pembayaran dapat dilakukan setelah pengajuan disetujui.  </p>
                @elseif($order->order_status == 'REJECTED')
                <svg width="28" height="24" viewBox="0 0 43 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_892_988)">
                    <path d="M0 4.75C0 2.12637 2.12637 0 4.75 0H16.625V9.5C16.625 10.8137 17.6863 11.875 19 11.875H28.5V14.7398C23.0152 16.291 19 21.3305 19 27.3125C19 31.6988 21.1598 35.573 24.4699 37.948C24.2398 37.9777 23.9949 38 23.75 38H4.75C2.12637 38 0 35.8699 0 33.25V4.75ZM19 9.5V0L28.5 9.5H19ZM21.375 27.3125C21.375 21.4121 26.1621 16.625 32.0625 16.625C37.9629 16.625 42.75 21.4121 42.75 27.3125C42.75 33.2129 37.9629 38 32.0625 38C26.1621 38 21.375 33.2129 21.375 27.3125ZM36.4637 24.5887C36.9312 24.1285 36.9312 23.3715 36.4637 22.9113C36.0035 22.4438 35.2465 22.4438 34.7863 22.9113L32.0625 25.6352L29.3387 22.9113C28.8785 22.4438 28.1215 22.4438 27.6613 22.9113C27.1938 23.3715 27.1938 24.1285 27.6613 24.5887L30.3852 27.3125L27.6613 30.0363C27.1938 30.4965 27.1938 31.2535 27.6613 31.7137C28.1215 32.1812 28.8785 32.1812 29.3387 31.7137L32.0625 28.9898L34.7863 31.7137C35.2465 32.1812 36.0035 32.1812 36.4637 31.7137C36.9312 31.2535 36.9312 30.4965 36.4637 30.0363L33.7398 27.3125L36.4637 24.5887Z" fill="#FF5050"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_892_988">
                    <rect width="42.75" height="38" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                <p class="ml-2 font-bold text-red"> Pengajuan rental ditolak. Mohon periksa kembali data dan dokumen yang anda input. </p>
                @elseif($order->order_status == 'WAITING_FOR_PAYMENT')
                <svg width="28" height="24" viewBox="0 0 43 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_892_986)">
                    <path d="M0 4.75C0 2.12637 2.12637 0 4.75 0H16.625V9.5C16.625 10.8137 17.6863 11.875 19 11.875H28.5V14.7398C23.0152 16.291 19 21.3305 19 27.3125C19 31.6988 21.1598 35.573 24.4699 37.948C24.2398 37.9777 23.9949 38 23.75 38H4.75C2.12637 38 0 35.8699 0 33.25V4.75ZM19 9.5V0L28.5 9.5H19ZM42.75 27.3125C42.75 33.2129 37.9629 38 32.0625 38C26.1621 38 21.375 33.2129 21.375 27.3125C21.375 21.4121 26.1621 16.625 32.0625 16.625C37.9629 16.625 42.75 21.4121 42.75 27.3125ZM35.3801 24.0988L30.875 28.6039L28.7449 26.4738C28.2848 26.0063 27.5277 26.0063 27.0676 26.4738C26.6 26.934 26.6 27.691 27.0676 28.1512L30.0363 31.1199C30.4965 31.5875 31.2535 31.5875 31.7137 31.1199L37.0574 25.7762C37.525 25.316 37.525 24.559 37.0574 24.0988C36.5973 23.6313 35.8402 23.6313 35.3801 24.0988Z" fill="#25DE8D"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_892_986">
                    <rect width="42.75" height="38" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                <p class="ml-2 font-bold text-mint-100"> Pengajuan rental telah disetujui. Silahkan lakukan pembayaran. </p>
                @elseif($order->order_status == 'PAYMENT_DONE')
                <svg width="28" height="28" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.0001 3.1665C10.2696 3.1665 3.16675 10.2693 3.16675 18.9998C3.16675 27.7303 10.2696 34.8332 19.0001 34.8332C27.7306 34.8332 34.8334 27.7303 34.8334 18.9998C34.8334 10.2693 27.7306 3.1665 19.0001 3.1665ZM15.835 25.9871L9.95608 20.1208L12.1917 17.8788L15.8318 21.5126L24.214 13.1304L26.4528 15.3693L15.835 25.9871Z" fill="#25DE8D"/>
                </svg>
                <p class="ml-2 font-bold text-mint-100"> Pembayaran telah diterima. Kendaraan dapat dirental pada waktu yang telah ditentukan. </p>
                @elseif($order->order_status == 'CANCELED')
                <svg width="28" height="28" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.0001 3.1665C10.2442 3.1665 3.16675 10.244 3.16675 18.9998C3.16675 27.7557 10.2442 34.8332 19.0001 34.8332C27.7559 34.8332 34.8334 27.7557 34.8334 18.9998C34.8334 10.244 27.7559 3.1665 19.0001 3.1665ZM25.8084 25.8082C25.6619 25.955 25.4879 26.0714 25.2964 26.1509C25.1049 26.2303 24.8995 26.2712 24.6922 26.2712C24.4848 26.2712 24.2795 26.2303 24.0879 26.1509C23.8964 26.0714 23.7224 25.955 23.5759 25.8082L19.0001 21.2323L14.4242 25.8082C14.1282 26.1042 13.7267 26.2705 13.308 26.2705C12.8893 26.2705 12.4878 26.1042 12.1917 25.8082C11.8957 25.5121 11.7294 25.1106 11.7294 24.6919C11.7294 24.4846 11.7702 24.2793 11.8495 24.0878C11.9289 23.8963 12.0452 23.7223 12.1917 23.5757L16.7676 18.9998L12.1917 14.424C11.8957 14.128 11.7294 13.7264 11.7294 13.3078C11.7294 12.8891 11.8957 12.4876 12.1917 12.1915C12.4878 11.8955 12.8893 11.7291 13.308 11.7291C13.7267 11.7291 14.1282 11.8955 14.4242 12.1915L19.0001 16.7673L23.5759 12.1915C23.7225 12.0449 23.8965 11.9286 24.0881 11.8493C24.2796 11.77 24.4849 11.7291 24.6922 11.7291C24.8995 11.7291 25.1047 11.77 25.2963 11.8493C25.4878 11.9286 25.6618 12.0449 25.8084 12.1915C25.955 12.3381 26.0713 12.5121 26.1506 12.7036C26.2299 12.8952 26.2708 13.1004 26.2708 13.3078C26.2708 13.5151 26.2299 13.7203 26.1506 13.9119C26.0713 14.1034 25.955 14.2774 25.8084 14.424L21.2326 18.9998L25.8084 23.5757C26.4101 24.1773 26.4101 25.1907 25.8084 25.8082Z" fill="#FF5050"/>
                </svg>
                <p class="ml-2 font-bold text-red"> Pengajuan dibatalkan. </p>
                @elseif($order->order_status == 'COMPLETED')
                    <svg width="28" height="28" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.0001 3.1665C10.2601 3.1665 3.16675 10.2598 3.16675 18.9998C3.16675 27.7398 10.2601 34.8332 19.0001 34.8332C27.7401 34.8332 34.8334 27.7398 34.8334 18.9998C34.8334 10.2598 27.7401 3.1665 19.0001 3.1665ZM14.7092 25.7923L9.02508 20.1082C8.87849 19.9616 8.76221 19.7876 8.68288 19.596C8.60355 19.4045 8.56272 19.1992 8.56272 18.9919C8.56272 18.7846 8.60355 18.5793 8.68288 18.3878C8.76221 18.1963 8.87849 18.0223 9.02508 17.8757C9.17167 17.7291 9.34569 17.6128 9.53722 17.5335C9.72875 17.4541 9.93403 17.4133 10.1413 17.4133C10.3486 17.4133 10.5539 17.4541 10.7454 17.5335C10.937 17.6128 11.111 17.7291 11.2576 17.8757L15.8334 22.4357L26.7267 11.5423C27.0228 11.2463 27.4243 11.08 27.843 11.08C28.2617 11.08 28.6632 11.2463 28.9592 11.5423C29.2553 11.8384 29.4216 12.2399 29.4216 12.6586C29.4216 13.0773 29.2553 13.4788 28.9592 13.7748L16.9417 25.7923C16.7953 25.9391 16.6213 26.0556 16.4297 26.135C16.2382 26.2145 16.0329 26.2554 15.8255 26.2554C15.6181 26.2554 15.4128 26.2145 15.2213 26.135C15.0297 26.0556 14.8557 25.9391 14.7092 25.7923Z" fill="#66E9AF"/>
                    </svg>
                    <p class="ml-2 font-bold text-mint-100"> Rent process completed </p>
                @endif
            </div>
            <div class="flex justify-end">
                @if($order->order_status == 'WAITING_FOR_PAYMENT')
                <a href="{{ route('payment-details', [ $order->id ]) }}">
                    <x-button filled=true>Pay now</x-button>
                </a>
                @endif
                <x-button filled=true>View details</x-button>
            </div>
        </div>
        @endforeach
        @endif
    </x-base-body>
</x-base-layout>