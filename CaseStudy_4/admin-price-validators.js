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
