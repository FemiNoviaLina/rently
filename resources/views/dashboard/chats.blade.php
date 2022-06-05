<x-base-layout>
    <x-base-body selected="Chat">
        <div class="min-h-screen flex justify-center items-center">
            <div class="flex shadow w-full max-w-5xl">
                <div id="chat-list" class="basis-1/2">
                    <div id="chat-list-head" class="shadow p-4">
                        <h2 class="font-extrabold text-lg text-lilac-100">Chat-list</h2>
                    </div>
                    @foreach($chatList as $chat)
                    <div class="chat-list shadow p-4 hover:bg-gray-100 cursor-pointer">
                        <input class="chat_id" type="hidden" name="user-id" value="{{ $chat['user_id'] }}">
                        <input class="chat_url" type="hidden" name="url" value="{{ route('fetch-admin-message', ['id' => $chat['user_id']]) }}">
                        <h2 class="font-bold text-md">{{ $chat['user_name'] }}</h2>
                    </div>
                    @endforeach
                </div>
                <div id="chat-area" class="basis-1/2">
                    <div id="chat-head" class="shadow p-4">
                        <h2 class="font-extrabold text-lg text-lilac-100">Customer</h2>
                    </div>
                    <div id="chat-body" class="shadow h-96 overflow-y-scroll">
                    </div>
                    <div class="shadow p-4">
                        <form id="chat-form" action="{{ route('send-message') }}" method="post" class="flex items-center">
                            @csrf
                            <input type="hidden" name="from_id" id="from_id" value="-1">
                            <input type="hidden" name="to_id" id="to_id" value="">
                            <x-input id="message" class="px-2 h-10" type="text" name="message" value="" required />
                            <x-button filled="true">Send</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/chats_dashboard_script.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </x-base-body>
</x-base-layout>