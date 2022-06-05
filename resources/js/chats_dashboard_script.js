const chatLists = document.querySelectorAll(".chat-list");
let channelName = 'channel'

chatLists.forEach((chat) => { 
    chat.addEventListener("click", () => {
        const id = chat.parentElement.querySelector(".chat_id").value;
        const url = chat.parentElement.querySelector(".chat_url").value;
        const formIdInput = document.querySelector('[name="to_id"]');
        formIdInput.value = id;
        channelName = 'channel-' + id;
        window.Echo.channel(channelName).listen('MessageSent', (event) => {
            if(event.message.from_id != -1) {
                $("#chat-body").append(
                    `
                    <div class="flex justify-start w-full">
                        <div class="rounded bg-lilac-200 text-white text-sm p-2 m-2">
                            <p>${event.message.message}</p>
                        </div>
                    </div>
                    `
                )
            }
        });
        console.log(url);
        $.ajax(
            {
                type: "GET",
                url, 
                success: (data) => {
                    if (data.success) {
                        console.log(data.messages)
                        data.messages.forEach(message => {
                            if(message.from_id == -1) {
                                $("#chat-body").append(
                                    `
                                    <div class="flex justify-end w-full">
                                        <div class="rounded bg-lilac-100 text-white text-sm p-2 m-2">
                                            <p>${message.message}</p>
                                        </div>
                                    </div>
                                    `
                                )
                            } else {
                                $("#chat-body").append(
                                    `
                                    <div class="flex justify-start w-full">
                                        <div class="rounded bg-lilac-200 text-white text-sm p-2 m-2">
                                            <p>${message.message}</p>
                                        </div>
                                    </div>
                                    `
                                )
                            }
                        });
                    } else {
                        alert("Can't fetch message")
                    }
                }
            }
        )
    });
});

$("#chat-form").submit((event) => {
    event.preventDefault();

    let form = $("#chat-form");
    let url = form.attr('action');

    console.log(form.serialize());

    $.ajax(
        {
            type: "POST",
            url,
            data: form.serialize(), 
            success: function (data) {
                console.log(data)
                if(data.success) {
                    $("#chat-body").append(
                        `
                        <div class="flex justify-end w-full">
                            <div class="rounded bg-lilac-100 text-white text-sm p-2 m-2">
                                <p>${data.messages.message}</p>
                            </div>
                        </div>
                        `
                    )
                } else {
                    alert("Can't send message");
                }
            }
        } 
    )
})

