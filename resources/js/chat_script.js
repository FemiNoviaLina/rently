const fetchMessage = () => {
    let url = $("input[name='fetch_link']").val();
    let messages = [];
    $.ajax(
        {
            type: "GET",
            url,
            success: function (data) {
                if (data.success) {
                    console.log(data.messages)
                    data.messages.forEach(message => {
                        if(message.from_id == -1) {
                            $("#message-area").append(
                                `
                                <div class="flex justify-start w-full">
                                    <div class="rounded bg-lilac-200 text-white text-sm p-2 m-2">
                                        <p>${message.message}</p>
                                    </div>
                                </div>
                                `
                            )
                        } else {
                            $("#message-area").append(
                                `
                                <div class="flex justify-end w-full">
                                    <div class="rounded bg-lilac-100 text-white text-sm p-2 m-2">
                                        <p>${message.message}</p>
                                    </div>
                                </div>
                                `
                            )
                        }
                    });
                } else {
                    alert("Can't fetch messages");
                }
            }
        }
    )
}

$("#send-form").submit((event) => {
    event.preventDefault();

    let form = $("#send-form");
    let url = form.attr('action');

    console.log(url);

    $.ajax(
        {
            type: "POST",
            url,
            data: form.serialize(), 
            success: function (data) {
                console.log(data)
                if(data.success) {
                    $("#message-area").append(
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

let id = document.getElementById("user-id").value;
let channelName = 'channel-' + id;
console.log(channelName);

window.Echo.channel(channelName).listen('MessageSent', (event) => {
    console.log(event);
    if(event.message.from_id == -1) {
        $("#message-area").append(
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

fetchMessage();