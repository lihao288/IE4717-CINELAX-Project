function justJava_isChecked(event) {
  var isChecked = event.target.checked;
  var price = document.getElementById("justjava-price");

  // console.log(price.value);

  if (!isChecked) {
    price.disabled = true;
    return false;
  } else {
    price.disabled = false;
    price.focus();
  }
}

function checkPrice() {
  var justjavaPrice = document.getElementById("justjava-price");
  var laitSinglePrice = document.getElementById("lait-single-price");
  var laitDoublePrice = document.getElementById("lait-double-price");
  var cappuccinoSinglePrice = document.getElementById(
    "cappuccino-single-price"
  );
  var cappuccinoDoublePrice = document.getElementById(
    "cappuccino-double-price"
  );

  if (isNaN(justjavaPrice.value)) {
    alert("Please enter number only.");
    justjavaPrice.focus();
    return false;
  }
  if (isNaN(laitSinglePrice.value)) {
    alert("Please enter number only.");
    laitSinglePrice.focus();
    return false;
  }
  if (isNaN(laitDoublePrice.value)) {
    alert("Please enter number only.");
    laitDoublePrice.focus();
    return false;
  }
  if (isNaN(cappuccinoSinglePrice.value)) {
    alert("Please enter number only.");
    cappuccinoSinglePrice.focus();
    return false;
  }
  if (isNaN(cappuccinoDoublePrice.value)) {
    alert("Please enter number only.");
    cappuccinoDoublePrice.focus();
    return false;
  }
  return true;
}

function lait_isChecked(event) {
  var isChecked = event.target.checked;

  var singlePrice = document.getElementById("lait-single-price");
  var doublePrice = document.getElementById("lait-double-price");

  if (!isChecked) {
    singlePrice.disabled = true;
    doublePrice.disabled = true;
    return false;
  } else {
    singlePrice.disabled = false;
    doublePrice.disabled = false;
    singlePrice.focus();
  }
}

function cappuccino_isChecked(event) {
  var isChecked = event.target.checked;

  var singlePrice = document.getElementById("cappuccino-single-price");
  var doublePrice = document.getElementById("cappuccino-double-price");

  if (!isChecked) {
    singlePrice.disabled = true;
    doublePrice.disabled = true;
    return false;
  } else {
    singlePrice.disabled = false;
    doublePrice.disabled = false;
    singlePrice.focus();
  }
}
