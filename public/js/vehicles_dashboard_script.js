/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/vehicles_dashboard_script.js ***!
  \***************************************************/
$("#check-all").on("click", function () {
  if ($("#check-all").prop("checked")) {
    $("input[type=checkbox]").prop("checked", true);
  } else {
    $("input[type=checkbox]").prop("checked", false);
  }
});
$('input[type="checkbox"]').change(function () {
  if ($('input[type=checkbox]').is(":checked")) {
    $("#delete-button").prop('disabled', false);
  } else {
    $("#delete-button").prop('disabled', true);
  }
});
$('#delete-button').on('click', function () {
  var link = $("input[name=delete_link]").val();
  var token = $("input[name=_token]").val();
  var ids = [];
  $('input[type="checkbox"]:checked').each(function () {
    ids.push($(this).val());
  });
  $.ajax({
    type: "POST",
    url: link,
    data: {
      "_token": token,
      "ids": ids
    },
    success: function success(data) {
      if (data.success) {
        window.location.href = "/dashboard/vehicles/" + data.type;
      } else {
        alert("Can't delete this vehicle");
      }
    }
  });
});
/******/ })()
;