const validateEmail = (email) => {
  return email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
};

const validatePolkadotAddress = (address) => {
  return address.match(/^(^1)(\w{47}$)/);
};

const enableSubmitStep2 = () => {
  const $button = $("#submit_step_2");

  if (validate() && validateAddress()) {
    $button.prop("disabled", false);
  } else {
    $button.prop("disabled", true);
  }
};

const validate = () => {
  const $result = $("#email-message");
  const email = $("#email").val();

  if (validateEmail(email)) {
    $result.text("Email is valid");
    $result.addClass("text-success");
    return true;
  } else {
    $result.text("Email is not valid");
    $result.removeClass("text-success");
  }
  return false;
};

const validateAddress = () => {
  const $result = $("#address-message");
  const address = $("#address").val();

  if (validatePolkadotAddress(address)) {
    $result.text("Address is valid");
    $result.addClass("text-success");
    return true;
  } else {
    $result.text("Address is not valid");
    $result.removeClass("text-success");
  }
  return false;
};

$("#email").on("input", function () {
  validate();
  enableSubmitStep2();
});

$("#address").on("input", function () {
  validateAddress();
  enableSubmitStep2();
});
