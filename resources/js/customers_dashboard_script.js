$("#table-body").on("click", "tr", () => {
    let row = $(event.target).closest("tr");
    $.get(row.children()[0].value,
    (data) => {
        console.log(data)
        $("#selected-user-name").html(data.customer.name);
        $("#selected-user-email").html(data.customer.email);
        $("#selected-user-phone-1").html(data.customer.phone_1);
        $("#selected-user-phone-2").html(data.customer.phone_2);
        $("#selected-user-address-id").html(data.customer.address_id);
        $("#selected-user-address-mlg").html(data.customer.address_mlg);

        $.each( data.orders, function( key, order ) {
            var color = "text-red";
            if(order.order_status == "PENDING"){
                color = "text-lilac-100";
            } else if(order.order_status == "WAITING_FOR_PAYMENT") {
                color = "text-yellow-100"
            } else if(order.order_status == "PAYMENT_DONE" || order.order_status == "COMPLETED") {
                color = "text-mint-100"
            }

            $("#order").append(
                `<div class="flex flex-wrap m-4 p-4 shadow-sm rounded justify-between">
                    <p class="font-bold basis-1/4 ${color}">${order.order_status}</p>
                    <p class="font-bold basis-2/4">${order.vehicle_name}</p>
                    <p class="basis-1/4">ID Order : ${order.order_id}</p>
                </div>`
            )
        });
        $("order").css('display', 'block')
    })
    $("#modal").css('display','flex');
});

$("#close").on("click", () => {
    $("#modal").css('display','none');
});

$("#customer-tab").on("click", () => {
    $("#customer-tab").css("border-bottom", "4px solid #7C7DDC");
    $("#order-tab").css("border-bottom", "none");
    $("#customer").css("display", "block");
    $("#order").css("display", "none");
});

$("#order-tab").on("click", () => {
    $("#customer-tab").css("border-bottom", "none");
    $("#order-tab").css("border-bottom", "4px solid #7C7DDC");
    $("#customer").css("display", "none");
    $("#order").css("display", "block");
});