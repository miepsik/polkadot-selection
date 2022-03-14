selected = [];

function select(id) {
  if (selected.includes(id)) {
    const index = selected.indexOf(id);
    if (index > -1) {
      selected.splice(index, 1);
    }
    document.getElementById("b" + id).classList.remove("selected");
    enableSubmitStep3();
    return;
  }

  if (selected.length >= 7) {
    return;
  }

  selected.push(id);
  document.getElementById("b" + id).classList.add("selected");
  enableSubmitStep3();
}

function proceed() {
  if (selected.length !== 7) {
    return false;
  }
  $.ajax({
    type: "POST",
    url: "storeSelection.php",
    data: { selected: selected, table: "selected" },

    success: function (obj, textstatus) {
      window.console.log(obj);
      window.console.log("red");
      window.location.href = "checkpoint3.php";
      return false;
    },
  });
}

const enableSubmitStep3 = () => {
  const $button = $("#submit_step_3");

  if (selected.length === 7) {
    $button.prop("disabled", false);
    $("table button:not(.selected)").prop("disabled", true);
  } else {
    $button.prop("disabled", true);
    $("table button:not(.selected)").prop("disabled", false);
  }
};
