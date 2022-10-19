<html>

<head>
  <title>JavaJam Sales Report Results</title>
</head>

<body>
  <h1>JavaJam Sales Report Results</h1>

  <?php
  $servername = "localhost";
  $username = "f32ee";
  $password = "f32ee";
  $dbname = "javajam";

  if (!isset($_POST['product']) && !isset($_POST['category'])) {
    echo "No checkbox selected.";
    exit;
  }

  $justjava_qty = 0;
  $justjava_totalqty = 0;

  $lait_single_qty = 0;
  $lait_double_qty = 0;
  $lait_totalqty = 0;

  $cappuccino_single_qty = 0;
  $cappuccino_double_qty = 0;
  $cappuccino_totalqty = 0;

  $single_totalqty = 0;
  $double_totalqty = 0;

  $justjava_sales = 0.00;

  $lait_single_sales = 0.00;
  $lait_double_sales = 0.00;

  $cappuccino_single_sales = 0.00;
  $cappuccino_double_sales = 0.00;

  $single_sales = 0.00;
  $double_sales = 0.00;

  define('JUSTJAVA_PRICE', 2.00);
  define('LAIT_SINGLE_PRICE', 2.00);
  define('LAIT_DOUBLE_PRICE', 3.00);
  define('CAPPUCCINO_SINGLE_PRICE', 4.75);
  define('CAPPUCCINO_DOUBLE_PRICE', 5.75);

  // Create connection
  @$db = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and bind parameters
  $query = "SELECT * FROM orders";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      $coffee = $row['coffee'];
      $type = $row['type'];

      switch ($coffee) {
        case 'Just Java':
          $justjava_qty = $row['quantity'];
          $justjava_totalqty += $justjava_qty;
          $justjava_sales += $justjava_qty * JUSTJAVA_PRICE;
          break;
        case 'Cafe au Lait':
          if ($type == 'Single') {
            $lait_qty = $row['quantity'];
            $lait_single_qty += $lait_qty;
            $lait_totalqty += $lait_qty;
            $lait_single_sales += $lait_qty * LAIT_SINGLE_PRICE;
            break;
          } elseif ($type == 'Double') {
            $lait_qty = $row['quantity'];
            $lait_double_qty += $lait_qty;
            $lait_totalqty += $lait_qty;
            $lait_double_sales += $lait_qty * LAIT_DOUBLE_PRICE;
            break;
          }
        case 'Iced Cappuccino':
          if ($type == 'Single') {
            $cappuccino_qty = $row['quantity'];
            $cappuccino_single_qty += $cappuccino_qty;
            $cappuccino_totalqty += $cappuccino_qty;
            $cappuccino_single_sales += $cappuccino_qty * CAPPUCCINO_SINGLE_PRICE;
            break;
          } elseif ($type == 'Double') {
            $cappuccino_qty = $row['quantity'];
            $cappuccino_double_qty += $cappuccino_qty;
            $cappuccino_totalqty += $cappuccino_qty;
            $cappuccino_double_sales += $cappuccino_qty * CAPPUCCINO_DOUBLE_PRICE;
            break;
          }
      }
    }
  } else {
    echo "0 results";
  }

  $lait_sales = $lait_single_sales + $lait_double_sales;
  $cappuccino_sales = $cappuccino_single_sales + $cappuccino_double_sales;

  $single_sales = $lait_single_sales + $cappuccino_single_sales;
  $double_sales = $lait_double_sales + $cappuccino_double_sales;

  $single_totalqty = $lait_single_qty + $cappuccino_single_qty;
  $double_totalqty = $lait_double_qty + $cappuccino_double_qty;

  $best_coffee = 'Just Java';
  $best_type = 'NULL';
  $best_sales = $justjava_sales;

  if ($lait_single_sales > $best_sales) {
    $best_coffee = 'Cafe au Lait';
    $best_type = 'Single';
    $best_sales = $lait_single_sales;
  }
  if ($lait_double_sales > $best_sales) {
    $best_coffee = 'Cafe au Lait';
    $best_type = 'Double';
    $best_sales = $lait_double_sales;
  }
  if ($cappuccino_single_sales > $best_sales) {
    $best_coffee = 'Iced Cappuccino';
    $best_type = 'Single';
    $best_sales = $cappuccino_single_sales;
  }
  if ($cappuccino_double_sales > $best_sales) {
    $best_coffee = 'Iced Cappuccino';
    $best_type = 'Double';
    $best_sales = $cappuccino_double_sales;
  }

  if (isset($_POST['product'])) {
    echo "<table border='1'><thead>";
    echo "<td>Product</td>";
    echo "<td>Total Dollar Sales</td>";
    echo "<td>Quantity Sales</td>";
    echo "</thead>";
    echo "<tr><td>Just Java</td><td>$";
    echo ($justjava_sales);
    echo "</td><td>";
    echo ($justjava_totalqty);
    echo "</td></tr>";
    echo "<tr><td>Cafe au Lait</td><td>$";
    echo ($lait_sales);
    echo "</td><td>";
    echo ($lait_totalqty);
    echo "</td></tr>";
    echo "<tr><td>Iced Cappuccino</td><td>$";
    echo ($cappuccino_sales);
    echo "</td><td>";
    echo ($cappuccino_totalqty);
    echo "</td></tr>";
    echo "</table>";

    echo "<p>Cafe au Lait - ";
    echo ($lait_single_qty);
    echo " Single ($";
    echo ($lait_single_sales);
    echo "), ";
    echo ($lait_double_qty);
    echo " Double ($";
    echo ($lait_double_sales);
    echo ")<br/>";
    echo "Iced Cappuccino - ";
    echo ($cappuccino_single_qty);
    echo " Single ($";
    echo ($cappuccino_single_sales);
    echo "), ";
    echo ($cappuccino_double_qty);
    echo " Double ($";
    echo ($cappuccino_double_sales);
    echo ")</p>";

    echo "<p>Popular (with highest selling quantity sold) option (category) of best selling (highest $$) product is <strong>" . $best_type . "</strong> of <strong>" . $best_coffee . "</strong></p>";
  }

  if (isset($_POST['category'])) {
    echo "<table border='1'><thead>";
    echo "<td>Category</td>";
    echo "<td>Total Dollar Sales</td>";
    echo "<td>Quantity Sales</td>";
    echo "</thead>";
    echo "<tr><td>Null</td><td>$";
    echo ($justjava_sales);
    echo "</td><td>";
    echo ($justjava_totalqty);
    echo "</td></tr>";
    echo "<tr><td>Single</td><td>$";
    echo ($single_sales);
    echo "</td><td>";
    echo ($single_totalqty);
    echo "</td></tr>";
    echo "<tr><td>Double</td><td>$";
    echo ($double_sales);
    echo "</td><td>";
    echo ($double_totalqty);
    echo "</td></tr>";
    echo "</table>";

    echo "<p>Cafe au Lait - ";
    echo ($lait_single_qty);
    echo " Single ($";
    echo ($lait_single_sales);
    echo "), ";
    echo ($lait_double_qty);
    echo " Double ($";
    echo ($lait_double_sales);
    echo ")<br/>";
    echo "Iced Cappuccino - ";
    echo ($cappuccino_single_qty);
    echo " Single ($";
    echo ($cappuccino_single_sales);
    echo "), ";
    echo ($cappuccino_double_qty);
    echo " Double ($";
    echo ($cappuccino_double_sales);
    echo ")</p>";

    echo "<p>Popular (with highest selling quantity sold) option (category) of best selling (highest $$) product is <strong>" . $best_type . "</strong> of <strong>" . $best_coffee . "</strong></p>";
  }




  $result->free();
  $db->close();


  ?>
</body>

</html>