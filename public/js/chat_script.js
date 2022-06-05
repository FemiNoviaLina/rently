/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/chat_script.js ***!
  \*************************************/
var fetchMessage = function fetchMessage() {
  var url = $("input[name='fetch_link']").val();
  var messages = [];
  $.ajax({
    type: "GET",
    url: url,
    success: function success(data) {
      if (data.success) {
        console.log(data.messages);
        data.messages.forEach(function (message) {
          if (message.from_id == -1) {
            $("#message-area").append("\n                                <div class=\"flex justify-start w-full\">\n                                    <div class=\"rounded bg-lilac-200 text-white text-sm p-2 m-2\">\n                                        <p>".concat(message.message, "</p>\n                                    </div>\n                                </div>\n                                "));
          } else {
            $("#message-area").append("\n                                <div class=\"flex justify-end w-full\">\n                                    <div class=\"rounded bg-lilac-100 text-white text-sm p-2 m-2\">\n                                        <p>".concat(message.message, "</p>\n                                    </div>\n                                </div>\n                                "));
          }
        });
      } else {
        alert("Can't fetch messages");
      }
    }
  });
};

$("#send-form").submit(function (event) {
  event.preventDefault();
  var form = $("#send-form");
  var url = form.attr('action');
  console.log(url);
  $.ajax({
    type: "POST",
    url: url,
    data: form.serialize(),
    success: function success(data) {
      console.log(data);

      if (data.success) {
        $("#message-area").append("\n                        <div class=\"flex justify-end w-full\">\n                            <div class=\"rounded bg-lilac-100 text-white text-sm p-2 m-2\">\n                                <p>".concat(data.messages.message, "</p>\n                            </div>\n                        </div>\n                        "));
      } else {
        alert("Can't send message");
      }
    }
  });
});
var id = document.getElementById("user-id").value;
var channelName = 'channel-' + id;
console.log(channelName);
window.Echo.channel(channelName).listen('MessageSent', function (event) {
  console.log(event);

  if (event.message.from_id == -1) {
    $("#message-area").append("\n            <div class=\"flex justify-start w-full\">\n                <div class=\"rounded bg-lilac-200 text-white text-sm p-2 m-2\">\n                    <p>".concat(event.message.message, "</p>\n                </div>\n            </div>\n            "));
  }
});
fetchMessage();
/******/ })()
;