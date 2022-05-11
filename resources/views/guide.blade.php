<x-base-layout>
    <x-base-body selected="Guide">
        <div class="flex rounded-md mt-24 justify-center">
            <a href="#" aria-current="page" class="py-2 px-10 font-bold text-white bg-lilac-100 rounded-l-sm border border-lilac-100 transition duration-500 ">
                <svg class="fill-white inline mr-2" width="32" height="32" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_893_355)">
                    <path d="M42.3281 21.5C42.3281 33.0056 33.0022 42.3281 21.5 42.3281C9.99775 42.3281 0.671875 33.0056 0.671875 21.5C0.671875 10.0011 9.99775 0.671875 21.5 0.671875C33.0022 0.671875 42.3281 10.0011 42.3281 21.5ZM22.0589 7.55859C17.482 7.55859 14.5629 9.48662 12.2706 12.9133C11.9737 13.3572 12.073 13.9559 12.4986 14.2787L15.4128 16.4883C15.85 16.8198 16.4728 16.7409 16.8124 16.3101C18.3127 14.4072 19.3414 13.3037 21.625 13.3037C23.3407 13.3037 25.4629 14.4079 25.4629 16.0717C25.4629 17.3294 24.4246 17.9753 22.7305 18.9251C20.7549 20.0326 18.1406 21.4111 18.1406 24.8594V25.1953C18.1406 25.7519 18.5919 26.2031 19.1484 26.2031H23.8516C24.4081 26.2031 24.8594 25.7519 24.8594 25.1953V25.0834C24.8594 22.693 31.8457 22.5935 31.8457 16.125C31.8457 11.2537 26.7928 7.55859 22.0589 7.55859ZM21.5 28.3867C19.3697 28.3867 17.6367 30.1197 17.6367 32.25C17.6367 34.3802 19.3697 36.1133 21.5 36.1133C23.6303 36.1133 25.3633 34.3802 25.3633 32.25C25.3633 30.1197 23.6303 28.3867 21.5 28.3867Z" fill="white"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_893_355">
                    <rect width="47" height="47" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                How to Rent A Vehicle
            </a> 
            <a href="{{ url('/guide/rules') }}" class="py-2 px-10 font-bold text-lilac-100 bg-white rounded-r-sm border border-lilac-100 hover:bg-lilac-300 hover:text-white transition duration-500">
                <svg class="fill-lilac-100 inline mr-2" width="32" height="32" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.5002 4.70001C33.8872 4.70001 42.3002 13.113 42.3002 23.5C42.3002 33.887 33.8872 42.3 23.5002 42.3C13.1132 42.3 4.7002 33.887 4.7002 23.5C4.7002 13.113 13.1132 4.70001 23.5002 4.70001ZM26.1557 26.743L26.9782 11.562H20.0222L20.8447 26.743H26.1557ZM25.9442 34.639C26.5082 34.0985 26.8137 33.3465 26.8137 32.383C26.8137 31.396 26.5317 30.644 25.9677 30.1035C25.4037 29.563 24.5812 29.281 23.4767 29.281C22.3722 29.281 21.5497 29.563 20.9622 30.1035C20.3747 30.644 20.0927 31.396 20.0927 32.383C20.0927 33.3465 20.3982 34.0985 20.9857 34.639C21.5967 35.1795 22.4192 35.438 23.4767 35.438C24.5342 35.438 25.3567 35.1795 25.9442 34.639Z"/>
                </svg>    
                Rules for All Renters
            </a>
        </div>
        <div class="mt-4 mb-20 mx-20 px-20 py-10 bg-white shadow-md rounded-lg ">
            <ol class="relative border-l-2 border-lilac-100 ">                  
                <li class="mb-10 ml-4">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">1</div>
                    <h3 class="text-lg font-semibold ml-4">Pilih tipe kendaraan yang akan dirental</h3>
                    <p class="mb-4 text-base font-normal ml-4">Anda dapat memilih salah satu tipe kendaraan dengan memilih Rent Car atau Rent Motorcycle setelah klik "Rent" pada menu di atas.</p>
                </li>
                <li class="mb-10 ml-4">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">2</div>
                    <h3 class="text-lg font-semibold ml-4">Tetapkan waktu anda akan merental kendaraan</h3>
                    <p class="mb-4 text-base font-normal ml-4">Selanjutnya anda akan mengisi waktu kapan anda akan merental kendaraan dan mengembalikannya, ini bertujuan untuk melihat ketersediaan kendaraan.</p>
                </li>
                <li class="mb-10 ml-4">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">3</div>
                    <h3 class="text-lg font-semibold ml-4">Pilih kendaraan favorit anda</h3>
                    <p class="mb-4 text-base font-normal ml-4">Seluruh kendaraan yang tersedia akan ditampilkan. Anda dapat memilih kendaraan yang paling Anda sukai dengan klik "Rent now".</p>
                </li>
                <li class="mb-10 ml-4">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">4</div>
                    <h3 class="text-lg font-semibold ml-4">Isi customer rent form</h3>
                    <p class="mb-4 text-base font-normal ml-4">Isi formulir yang tersedia dengan data yang sebenarnya. Anda juga perlu mengupload 3 dokumen: ktp, sim, dan dokumen penting lain (BPJS/NPWP/Kartu Pelajar).</p>
                </li>
                <li class="mb-10 ml-4">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">5</div>
                    <h3 class="text-lg font-semibold ml-4">Lakukan pembayaran</h3>
                    <p class="mb-4 text-base font-normal ml-4">Jika pengajuan rental telah disetujui oleh admin, anda dapat segera melakukan pembayaran.</p>
                </li>
                <li class="mb-10 ml-4">
                    <div class="absolute w-8 h-8 bg-gray-200 rounded-full text-center font-bold text-white pt-1 -left-4 border border-lilac-100 bg-lilac-100">6</div>
                    <h3 class="text-lg font-semibold ml-4">Kendarai kendaraan pilihanmu</h3>
                    <p class="mb-4 text-base font-normal ml-4">Jika pembayaran telah diterima, kendaraan dapat langsung anda rental sesuai dengan lokasi dan waktu yang telah ditentukan.</p>
                </li>
            </ol>
        </div>
    </x-base-body>
</x-base-layout>