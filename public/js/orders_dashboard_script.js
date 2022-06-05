/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/orders_dashboard_script.js ***!
  \*************************************************/
$("#table-body").on("click", "tr", function () {
  var row = $(event.target).closest("tr");
  $.get(row.children()[0].value, function (data) {
    console.log(data);
    $("#selected-id").html(data[0].id);
    $("#selected-transaction-id").html(data[0].transaction_id ? data[0].transaction_id : "N/A");
    $("#selected-application-date").html(data[0].created_at);
    $("#selected-total-price").html("IDR " + data[0].total_price);
    $("#selected-payment-expiry-time").html(data[0].payment_expiry_time ? data[0].payment_expiry_time : "N/A");
    $("#selected-payment-method").html(data[0].payment_method ? data[0].payment_method : "N/A");
    $("#selected-pickup-time").html(data[0].pickup_date + " " + data[0].pickup_time);
    $("#selected-dropoff-time").html(data[0].dropoff_date + " " + data[0].dropoff_time);
    $("#selected-pickup-location").html(data[0].pickup_address);
    $("#selected-dropoff-location").html(data[0].dropoff_address);
    $("#selected-note").html(data[0].note);
    $("#selected-user-name").html(data[0].user_name);
    $("#selected-user-email").html(data[0].email);
    $("#selected-user-phone-1").html(data[0].phone_1);
    $("#selected-user-phone-2").html(data[0].phone_2);
    $("#selected-user-address-id").html(data[0].address_id);
    $("#selected-user-address-mlg").html(data[0].address_mlg);
    $("#selected-id-card-1").attr("src", "/storage/id-card/" + data[0].id_card);
    $("#selected-id-card-2").attr("src", "/storage/id-card/" + data[0].id_card_2);
    $("#selected-driver-license").attr("src", "/storage/driver-license/" + data[0].driver_license);
    $("#selected-vehicle-id").html(data[0].vehicles_id);
    $("#selected-vehicle-type").html(data[0].type);
    $("#selected-vehicle-name").html(data[0].vehicle_name);
    $("#selected-vehicle-price").html(data[0].price);
    $("#selected-vehicle-fuel").html(data[0].fuel);
    $("#selected-vehicle-cc").html(data[0].cc);
    $("#selected-vehicle-transmission").html(data[0].transmission);
    $("#selected-vehicle-year").html(data[0].year);
    $("#selected-vehicle-unit").html(data[0].available_unit);
    $("#selected-vehicle-year").html(data[0].year);
    $("#selected-vehicle-image").attr("src", "/storage/images/" + data[0].photo);
  });
  $("#modal").css('display', 'flex');
});
$("#close").on("click", function () {
  $("#modal").css('display', 'none');
});
$("#customer-tab").on("click", function () {
  $("#customer-tab").css("border-bottom", "4px solid #7C7DDC");
  $("#order-tab").css("border-bottom", "none");
  $("#vehicle-tab").css("border-bottom", "none");
  $("#customer").css("display", "block");
  $("#order").css("display", "none");
  $("#vehicle").css("display", "none");
});
$("#order-tab").on("click", function () {
  $("#order-tab").css("border-bottom", "4px solid #7C7DDC");
  $("#customer-tab").css("border-bottom", "none");
  $("#vehicle-tab").css("border-bottom", "none");
  $("#order").css("display", "block");
  $("#customer").css("display", "none");
  $("#vehicle").css("display", "none");
});
$("#vehicle-tab").on("click", function () {
  $("#vehicle-tab").css("border-bottom", "4px solid #7C7DDC");
  $("#order-tab").css("border-bottom", "none");
  $("#customer-tab").css("border-bottom", "none");
  $("#vehicle").css("display", "block");
  $("#order").css("display", "none");
  $("#customer").css("display", "none");
});
/******/ })()
;