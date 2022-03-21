var counter = 1;

$(function () {
  function call(id) {
    var plac = document.getElementById("placeholder");
    plac.firstElementChild.innerHTML =
      '<h3 class="text-white font-weight-bold">Please wait for next question</h3>';
    var hist = document.getElementById(id).innerHTML;
    var data = {
      history: hist,
      user: document.getElementById("user").innerText,
      type: document.getElementById("type").innerText,
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
        enableSubmitStep4();
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
    var hist = "";
    var data = {
      history: hist,
      user: document.getElementById("user").innerText,
      type: document.getElementById("type").innerText,
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
          if (response.indexOf("counter=9;") >= 0) {
            counter = 9;
              enableSubmitStep4();
          }
      },
      error: function (error) {
        console.log("Something went wrong", error);
      },
    });
  });

  $("#placeholder").on("click", "#a", function () {
    call("a1");
  });

  $("#placeholder").on("click", "#b", function () {
    call("b1");
  });

  const enableSubmitStep4 = () => {
    counter++;
    const $button = $("#submit_step_4");
    const $counter = $("#counter");
    if (counter < 6)
      $counter.html(counter);

    if (counter > 5) {
      $button.removeClass("disabled");
    }
  };
});
