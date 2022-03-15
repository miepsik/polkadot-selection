selected = [];

function select(id) {
  if (selected.includes(id)) {
    const index = selected.indexOf(id);
    if (index > -1) {
      selected.splice(index, 1);
    }
    objs = document.querySelectorAll("[data-coil='b" + id + "']");
    objs.forEach(function (x) {
      x.classList.remove("selected");
    });
    enableSubmitStep5();
    return;
  }
  if (selected.length >= 7) {
    return;
  }
  selected.push(id);
  objs = document.querySelectorAll("[data-coil='b" + id + "']");
  objs.forEach(function (x) {
    x.classList.add("selected");
  });
  enableSubmitStep5();
}

function proceed() {
  if (selected.length !== 7) {
    return false;
  }
  $.ajax({
    type: "POST",
    url: "storeSelection.php",
    data: { selected: selected, table: "final" },

    success: function (obj, textstatus) {
      window.console.log(obj);
      window.console.log("red");
      window.location.href = "checkpoint5.php";
      return false;
    },
  });
}

const enableSubmitStep5 = () => {
  const $button = $("#submit_step_5");

  if (selected.length === 7) {
    $button.prop("disabled", false);
    $("table button:not(.selected)").prop("disabled", true);
  } else {
    $button.prop("disabled", true);
    $("table button:not(.selected)").prop("disabled", false);
  }
};
