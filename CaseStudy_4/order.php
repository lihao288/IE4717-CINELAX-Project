<html>

<head>
  <title>JavaJam Order Entry Results</title>
</head>

<body>
  <h1>JavaJam Order Entry Results</h1>

  <?php
  $servername = "localhost";
  $username = "f32ee";
  $password = "f32ee";
  $dbname = "javajam";

  $justjava_qty = $_POST['qty-justjava'];
  $lait_qty = $_POST['qty-lait'];
  $cappuccino_qty = $_POST['qty-cappuccino'];

  if ($justjava_qty == 0 && $lait_qty == 0 && $cappuccino_qty == 0) {
    echo "Please enter amount for any coffees.";
    exit;
  }


  $lait_price = $_POST['sub-lait'];
  $cappuccino_price = $_POST['sub-cappuccino'];


  $lait_price = doubleval($lait_price);
  $cappuccino_price = doubleval($cappuccino_price);



  // Create connection
  @$db = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and bind parameters
  $query = "insert into orders (coffee, type, total_price, quantity) values (?, ?, ?, ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param('ssdi', $coffee, $type, $price, $quantity);

  if ($justjava_qty > 0) {
    $coffee = "Just Java";
    $type = null;
    $price = doubleval($_POST['sub-justjava']);
    $quantity = $justjava_qty;

    $stmt->execute();
  }
  if ($lait_qty > 0) {
    $coffee = "Cafe au Lait";
    $type = $_POST['laitButton'];
    $price = doubleval($_POST['sub-lait']);
    $quantity = $lait_qty;

    $stmt->execute();
  }
  if ($cappuccino_qty > 0) {
    $coffee = "Iced Cappuccino";
    $type = $_POST['cappuccinoButton'];
    $price = doubleval($_POST['sub-cappuccino']);
    $quantity = $cappuccino_qty;

    $stmt->execute();
  }

  // $stmt will be TRUE if insertion is successful
  if ($stmt) {
    echo  $stmt->affected_rows . " order inserted into database.";
    $stmt->close();
  } else {
    echo "An error has occurred.  The item was not added.";
  }

  $db->close();

  ?>
</body>

</html>