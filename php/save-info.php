<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/payment.css" />
  <title>CINELAX: Showtimes</title>
</head>

<?php

session_start();
// var_dump($_SESSION);

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

$_SESSION['movieName'] = $movie;
$_SESSION['orderID'] = $orderID;

// Prepare and bind parameters
$queryToMovie = "INSERT INTO " . $tableName . "(OrderId, Movie, BookingDate, BookingTime, Hall, Quantity, SelectedSeats, TransactionTime) VALUES ('" . $orderID . "', '" . $movie . "', '" . $date . "', '" . $time . "', '" . $hall . "', " . $quantity . ", '" . $selectedSeats . "', '" . $transactionTime . "');";
$queryToCustomer = "INSERT INTO customers_info (OrderId, CustomerName, CustomerMobileNo, CustomerEmail) VALUES ('" . $orderID . "', '" . $customerName . "', '" . $customerMobileNo . "', '" . $customerEmail . "');";
// $query = "INSERT INTO ant_man(OrderId, Movie, BookingDate, BookingTime, Quantity, SelectedSeats) VALUES (?, ?, ?, ?, ?, ?)";
// $stmt = $db->prepare($query);
// $stmt->bind_param('isssis', UUID_SHORT(),);
// $stmt->execute();

// $result = $db->multi_query($query);
$stmt = $db->prepare($queryToMovie);
$stmt->execute();

// echo $stmt->affected_rows . " order inserted into database.";

$stmt = $db->prepare($queryToCustomer);
$stmt->execute();


$query = "SELECT * FROM " . $tableName . " WHERE OrderID = '" . $orderID . "';";
$stmt = $db->prepare($query);
$stmt->execute();

$result = $stmt->get_result();
$num_results = $result->num_rows;

// echo "<p>Number of records found: " . $num_results . "</p>";

for ($i = 0; $i < $num_results; $i++) {
  $row = $result->fetch_assoc();
  $ticketsBought = $row['Quantity'];
}

$result->free();
$db->close();

define('TICKET_PRICE', 10.50);
define('CONVENIENCE_FEE', 2.00);

$subTicket = $ticketsBought * TICKET_PRICE;

$convenienceQty = 1;
$subConvenience = $convenienceQty * CONVENIENCE_FEE;

$total = $subTicket + $subConvenience;
?>

<body>
  <header>
    <nav>
      <h1 class="nav-heading">Cinelax</h1>
      <div class="nav-links">
        <a href="../index.html">Home</a>
        <a href="../showtimes.html">Showtimes</a>
        <a href="../contact-us.html">Contact</a>
        <a href="../my-bookings-login.html">My Booking</a>
      </div>
    </nav>
  </header>
  <input type="hidden" name="orderID" id="orderID">
  <input type="hidden" name="movieName" id="movieName">
  <main class="payment-container">
    <div class="payment-content">
      <div class="ticket-steps">
        <div class="ticket-steps-details">
          <div class="ticket-step-number">1</div>
          <h2 class="ticket-step-text">Seat & Personal Info</h2>
        </div>
        <div class="ticket-steps-details current">
          <div class="ticket-step-number">2</div>
          <h2 class="ticket-step-text">Price & Payment Selection</h2>
        </div>
        <div class="ticket-steps-details">
          <div class="ticket-step-number">3</div>
          <h2 class="ticket-step-text">Confirmation</h2>
        </div>
      </div>
      <div class="ticket-price">
        <h2 class="ticket-price-heading">Ticket Price</h2>
        <div class="ticket-price-content">
          <table class="ticket-price-table">
            <col style="width: 50%" />
            <thead>
              <th class="left">Ticket Type</th>
              <th>Ticket Price</th>
              <th>Quantity</th>
              <th>Total Amount</th>
            </thead>
            <tr>
              <td class="first-row left">Standard Price</td>
              <td class="first-row">S$ <?php echo number_format(TICKET_PRICE, 2); ?></td>
              <td class="first-row"><?php echo $ticketsBought; ?></td>
              <td class="first-row">S$ <?php echo number_format($subTicket, 2); ?></td>
            </tr>
            <tr>
              <td class="left">Convenience Fee</td>
              <td>S$ <?php echo number_format(CONVENIENCE_FEE, 2); ?></td>
              <td><?php echo $convenienceQty; ?></td>
              <td>S$ <?php echo number_format($subConvenience, 2); ?></td>
            </tr>
          </table>
          <p class="ticket-total-price">
            Total: S$ <span id="total-price"><?php echo number_format($total, 2); ?></span>
          </p>
        </div>
      </div>
      <div class="payment-method">
        <h2 class="payment-method-heading">Payment Method</h2>
        <form class="payment-method-content" action="confirmation.php" method="POST">
          <div class="input-container">
            <input type="image" src="../movie images & videos/Payment/visa.jpg" alt="">
          </div>
          <div class="input-container">
            <input type="image" src="../movie images & videos/Payment/mastercard.png" alt="">
          </div>
          <div class="input-container">
            <input type="image" src="../movie images & videos/Payment/paynow.jpg" alt="">
          </div>
        </form>
      </div>
    </div>
  </main>
  <!-- Script -->
  <script>
    let orderID = '<?php echo $orderID ?>';
    localStorage.setItem('orderID', orderID);

    const orderID = document.getElementById('orderID');
    const movieName = document.getElementById('movieName');

    orderID.value = localStorage.getItem('orderID');
    movieName.value = localStorage.getItem('Movie');
  </script>
</body>

</html>