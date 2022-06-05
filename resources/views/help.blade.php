<x-base-layout>
    <x-base-body selected="Help">
        <div class="flex min-h-screen pt-24">
            <div id="faq" class="px-10 py-36 basis-1/2">
                <h2 class="font-extrabold text-3xl text-lilac-100 mb-5">Frequently Asked Question</h2>
                <div class="shadow rounded-md transition hover:bg-gray-100 my-4">
                    <div class="accordion-header cursor-pointer transition flex justify-between px-5 items-center h-16 hover:text-lilac-100">
                        <h3 class="font-bold text-md text-lilac-100">Where is Rent.ly office?</h3>
                        <p class="text-2xl">+</p>
                    </div>
                    <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                        <p class="leading-6 font-light text-sm text-justify pb-5">
                        We're currently operating in Malang, East Java. You can find Rent.ly office near Malang Station, Jl. Trunojoyo No.3, Kiduldalem, Kec. Klojen, Malang city.
                        </p>
                    </div>
                </div>
                <div class="shadow rounded-md transition hover:bg-gray-100 my-4">
                    <div class="accordion-header cursor-pointer transition flex justify-between px-5 items-center h-16 hover:text-lilac-100">
                        <h3 class="font-bold text-md text-lilac-100">How does Rent.ly work?</h3>
                        <p class="text-2xl">+</p>
                    </div>
                    <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                        <p class="leading-6 font-light text-sm text-justify pb-5">
                        Enter your delivery and return dates and times, choose your vehicle, complete a short verification and payment process, sit back and we deliver and pick up your vehicle to your door! You can return the car at any address in our service area.
                        </p>
                    </div>
                </div>
                <div class="shadow rounded-md transition hover:bg-gray-100 my-4">
                    <div class="accordion-header cursor-pointer transition flex justify-between px-5 items-center h-16 hover:text-lilac-100">
                        <h3 class="font-bold text-md text-lilac-100">Do I need to refuel the vehicle before my return?</h3>
                        <p class="text-2xl">+</p>
                    </div>
                    <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                        <p class="leading-6 font-light text-sm text-justify pb-5">
                        Regarding to our rules, the amount of fuel at the end of use / at the time of return must be the same as the fuel at the beginning of use.
                        But actually you may return the vehicle at any fuel level. If it is below the fuel level at the start of the trip, we will refuel it for you and charge you at local market rates! If you received a vehicle lower than full, we only charge up to that level.
                        </p>
                    </div>
                </div>
                <div class="shadow rounded-md transition hover:bg-gray-100 my-4">
                    <div class="accordion-header cursor-pointer transition flex justify-between px-5 items-center h-16 hover:text-lilac-100">
                        <h3 class="font-bold text-md text-lilac-100">What payment methods does Rent.ly accept?</h3>
                        <p class="text-2xl">+</p>
                    </div>
                    <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                        <p class="leading-6 font-light text-sm text-justify pb-5">
                        We accept all major bank transfers and e-wallet transfers.
                        We do not accept cash or any debit card payments for the booking cost.
                        </p>
                    </div>
                </div>
            </div>
            <div id="chat" class="basis-1/2">
            @auth
            <div class="px-10 py-20">
                <div class="shadow p-4" >
                    <h2 class="font-extrabold text-lg text-lilac-100">Rent.ly Admin</h2>
                </div>
                <div id="message-area" class="shadow p-4 h-96 overflow-y-scroll overflow-x-hidden">
                    <input type="hidden" name="fetch_link" value="{{ route('fetch-message') }}">
                </div>
                <div class="shadow p-4" >
                    <input id="user-id" type="hidden" name="from_id" value="{{ auth()->user()->id }}">
                    <form action="{{ route('send-message') }}" method="post" class="flex items-center" id="send-form">
                        @csrf
                        <input type="hidden" name="to_id" value="-1">
                        <x-input id="message" class="px-2 h-10" type="text" name="message" value="" required />
                        <x-button filled="true">Send</x-button>
                    </form>
                </div>
            </div>
            @endauth
            @guest
            <div class="px-10 py-60">
                <h2 class="font-extrabold text-3xl text-lilac-100 mb-5">Do you have more questions?</h2>
                <p class="mb-5">Login to ask us via chat, or</p>
                <a href="mailto:customer@rently.com">
                    <button class="bg-lilac-100 text-white py-2 px-4 rounded-full">Ask us via email</button>
                </a>
            </div>
            @endguest
            </div>
        </div>
        <script>
            const accordionHeader = document.querySelectorAll(".accordion-header");

            accordionHeader.forEach((header) => { 
                header.addEventListener("click", () => {
                    const accordionContent = header.parentElement.querySelector(".accordion-content");
                    let accordionMaxHeight = accordionContent.style.maxHeight;

                    if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
                        accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 64}px`;
                    } else {
                        accordionContent.style.maxHeight = `0px`;
                    }
                });
            });
        </script>
        <script src="{{ asset('js/chat_script.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </x-base-body>
</x-base-layout>
    