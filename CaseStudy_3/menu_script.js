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
  var java = document.getElementById("justjava").value;
  if (java == null) {
    java = 0;
  }
  var javaSub = document.getElementById("sub-justjava");
  javaSub.value = java * 2.0;

  var lait = document.getElementById("lait").value;
  if (lait == null) {
    lait = 0;
  }
  var laitSub = document.getElementById("sub-lait");
  laitSub.value = lait * laitPrice;

  var cappuccino = document.getElementById("cappuccino").value;
  if (cappuccino == null) {
    cappuccino = 0;
  }
  var cappuccinoSub = document.getElementById("sub-cappuccino");
  cappuccinoSub.value = cappuccino * cappuccinoPrice;

  // Compute the cost

  document.getElementById("total-cost").value = totalCost =
    parseFloat(javaSub.value) +
    parseFloat(laitSub.value) +
    parseFloat(cappuccinoSub.value);
} //* end of computeCost
