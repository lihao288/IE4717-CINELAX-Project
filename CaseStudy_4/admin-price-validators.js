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
