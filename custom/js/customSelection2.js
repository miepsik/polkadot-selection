$(function () {
  function call(id) {
    var hist = document.getElementById(id).innerHTML;
    var data = {
      history: hist,
      user: document.getElementById("user").innerText,
    };

    $.ajax({
      url: "call.php",
      type: "GET",
      data: {
        method: "POST",
        url: "research-vs.w3f.tech:15005/next",
        data: data,
      },
      success: function (response) {
        update(response);
      },
      error: function (error) {
        console.log("Something went wrong", error);
      },
    });
  }

  function update(response) {
    var d = document.getElementById("placeholder");
    d.innerHTML = response;
  }

  $(document).ready(function () {
    call("a1");
  });

  $("#placeholder").on("click", "#a", function () {
    call("a1");
  });

  $("#placeholder").on("click", "#b", function () {
    call("b1");
  });
});
