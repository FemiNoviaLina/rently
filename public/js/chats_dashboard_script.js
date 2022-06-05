/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/chats_dashboard_script.js ***!
  \************************************************/
var chatLists = document.querySelectorAll(".chat-list");
var channelName = 'channel';
chatLists.forEach(function (chat) {
  chat.addEventListener("click", function () {
    var id = chat.parentElement.querySelector(".chat_id").value;
    var url = chat.parentElement.querySelector(".chat_url").value;
    var formIdInput = document.querySelector('[name="to_id"]');
    formIdInput.value = id;
    channelName = 'channel-' + id;
    window.Echo.channel(channelName).listen('MessageSent', function (event) {
      if (event.message.from_id != -1) {
        $("#chat-body").append("\n                    <div class=\"flex justify-start w-full\">\n                        <div class=\"rounded bg-lilac-200 text-white text-sm p-2 m-2\">\n                            <p>".concat(event.message.message, "</p>\n                        </div>\n                    </div>\n                    "));
      }
    });
    console.log(url);
    $.ajax({
      type: "GET",
      url: url,
      success: function success(data) {
        if (data.success) {
          console.log(data.messages);
          data.messages.forEach(function (message) {
            if (message.from_id == -1) {
              $("#chat-body").append("\n                                    <div class=\"flex justify-end w-full\">\n                                        <div class=\"rounded bg-lilac-100 text-white text-sm p-2 m-2\">\n                                            <p>".concat(message.message, "</p>\n                                        </div>\n                                    </div>\n                                    "));
            } else {
              $("#chat-body").append("\n                                    <div class=\"flex justify-start w-full\">\n                                        <div class=\"rounded bg-lilac-200 text-white text-sm p-2 m-2\">\n                                            <p>".concat(message.message, "</p>\n                                        </div>\n                                    </div>\n                                    "));
            }
          });
        } else {
          alert("Can't fetch message");
        }
      }
    });
  });
});
$("#chat-form").submit(function (event) {
  event.preventDefault();
  var form = $("#chat-form");
  var url = form.attr('action');
  console.log(form.serialize());
  $.ajax({
    type: "POST",
    url: url,
    data: form.serialize(),
    success: function success(data) {
      console.log(data);

      if (data.success) {
        $("#chat-body").append("\n                        <div class=\"flex justify-end w-full\">\n                            <div class=\"rounded bg-lilac-100 text-white text-sm p-2 m-2\">\n                                <p>".concat(data.messages.message, "</p>\n                            </div>\n                        </div>\n                        "));
      } else {
        alert("Can't send message");
      }
    }
  });
});
/******/ })()
;