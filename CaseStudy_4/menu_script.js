var laitPrice = 2.0,
  cappuccinoPrice = 4.75;

function laitChoice(price) {
  switch (price) {
    case "single":
      laitPrice = 2.0;
      break;
    case "double":
      laitPrice = 3.0;
      break;
    default:
      laitPrice = 2.0;
      break;
  }
}

function cappuccinoChoice(price) {
  switch (price) {
    case "single":
      cappuccinoPrice = 4.75;
      break;
    case "double":
      cappuccinoPrice = 5.75;
      break;
    default:
      cappuccinoPrice = 4.75;
      break;
  }
}

function computeCost() {
  var java = document.getElementById("qty-justjava");
  // if (java.value == null) {
  //   java.value = 0;
  // }
  if (isNaN(java.value)) {
    alert("Please enter an integer number");
  }
  var javaSub = document.getElementById("sub-justjava");
  javaSub.value = (java.value * 2.0).toFixed(2);

  if (javaSub.value < 0) {
    alert("Please enter a positive number");
    java.value = 0;
    java.focus();
    javaSub.value = 0;
  }

  var lait = document.getElementById("qty-lait");
  // if (lait.value == null) {
  //   lait.value = 0;
  // }
  var laitSub = document.getElementById("sub-lait");
  laitSub.value = (lait.value * laitPrice).toFixed(2);
  if (laitSub.value < 0) {
    alert("Please enter a positive number");
    lait.value = 0;
    lait.focus();
    laitSub.value = 0;
  }

  var cappuccino = document.getElementById("qty-cappuccino");
  // if (cappuccino.value == null) {
  //   cappuccino.value = 0;
  // }
  var cappuccinoSub = document.getElementById("sub-cappuccino");
  cappuccinoSub.value = (cappuccino.value * cappuccinoPrice).toFixed(2);

  if (cappuccinoSub.value < 0) {
    alert("Please enter a positive number");
    cappuccino.value = 0;
    cappuccino.focus();
    cappuccinoSub.value = 0;
  }

  // Compute the cost
	totalCost = parseFloat(javaSub.value) + parseFloat(laitSub.value) + parseFloat(cappuccinoSub.value);
	document.getElementById("total-cost").value = totalCost.toFixed(2);
	
} //* end of computeCost

function checkQty() {
  var java = document.getElementById("qty-justjava").value;
  var lait = document.getElementById("qty-lait").value;
  var cappuccino = document.getElementById("qty-cappuccino").value;

  if (java == 0 && lait == 0 && cappuccino == 0) {
    alert("Please buy at least one coffee");
    return false;
  }
  return true;
}
