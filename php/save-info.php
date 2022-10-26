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
  $quantity = $_POST['seat-count'];
  $selectedSeats = $_POST['ticket-cinema-seat-selected'];

  if ($movie == null && $date == null && $time == null && $quantity == null && $selectedSeats == null) {
    echo "Please select at least one seat.";
    exit;
  }

  // Create connection
  @$db = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and bind parameters
  $query = "INSERT INTO ant_man(OrderId, Movie, BookingDate, BookingTime, Quantity, SelectedSeats) VALUES (UUID_SHORT(), 'Ant-Man', 'Wed Oct 26 2022', '10:30 AM', 3, 'A03,A04,A05')";
  // $query = "insert into orders (coffee, type, total_price, quantity) values (?, ?, ?, ?)";
  // $stmt = $db->prepare($query);
  // $stmt->bind_param('ssdi', $coffee, $type, $price, $quantity);

  $stmt->execute();

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