<html>

<head>
  <title>Movie Order Result</title>
</head>

<body>
  <h1>Movie Order Result</h1>

  <?php
  $servername = "localhost";
  $username = "f32ee";
  $password = "f32ee";
  $dbname = "cinemalax";

  $movie = $_POST['movie-name'];
  $date = $_POST['ticket-date-selected'];
  $time = $_POST['ticket-time-selected'];
  $hall = $_POST['ticket-cinema-hall-selected'];
  $quantity = $_POST['seat-count'];
  $selectedSeats = $_POST['ticket-cinema-seat-selected'];

  if (!isset($_POST['ticket-cinema-seat-selected']) || $quantity == 0) {
    echo "No movie has been selected.";
    exit;
  }

  $customerName = $_POST['customer-name'];
  $customerMobileNo = $_POST['customer-mobileno'];
  $customerEmail = $_POST['customer-email'];

  switch ($movie) {
    case 'Ant-Man':
      $tableName = 'ant_man';
      break;
    case 'Black Panther':
      $tableName = 'black_panther';
      break;
    case 'Doctor Strange in the Multiverse of Madness':
      $tableName = 'doctor_strange';
      break;
    case 'Eternals':
      $tableName = 'eternals';
      break;
    case 'Guardians of the Galaxy':
      $tableName = 'guardians';
      break;
    case 'Shang-Chi':
      $tableName = 'shangchi';
      break;
    case 'Spider-Man: No Way Home':
      $tableName = 'spiderman';
      break;
    case 'Thor: Love and Thunder':
      $tableName = 'thor';
      break;
  }

  // Create connection
  @$db = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  function generate_random_letters()
  {
    $random = '';
    for ($i = 0; $i < 6; $i++) {
      $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
    }
    return $random;
  }

  $orderID = generate_random_letters();

  date_default_timezone_set('Asia/Singapore');
  $transactionTime = date('Y/m/d H:i:s');

  // Prepare and bind parameters
  $query = "INSERT INTO " . $tableName . "(OrderId, Movie, BookingDate, BookingTime, Hall, Quantity, SelectedSeats, TransactionTime) VALUES ('" . $orderID . "', '" . $movie . "', '" . $date . "', '" . $time . "', '" . $hall . "', " . $quantity . ", '" . $selectedSeats . "', '" . $transactionTime . "');";
  $query .= "INSERT INTO customers_info (OrderId, CustomerName, CustomerMobileNo, CustomerEmail) VALUES ('" . $orderID . "', '" . $customerName . "', '" . $customerMobileNo . "', '" . $customerEmail . "');";
  // $query = "INSERT INTO ant_man(OrderId, Movie, BookingDate, BookingTime, Quantity, SelectedSeats) VALUES (?, ?, ?, ?, ?, ?)";
  // $stmt = $db->prepare($query);
  // $stmt->bind_param('isssis', UUID_SHORT(),);
  // $stmt->execute();

  $result = $db->multi_query($query);


  // $stmt will be TRUE if insertion is successful
  if ($result) {
    echo $db->affected_rows . " order inserted into database.";
    $db->close();
  } else {
    echo "An error has occurred. The item was not added.";
  }
  ?>
</body>

</html>