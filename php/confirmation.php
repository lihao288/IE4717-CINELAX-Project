<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/confirmation.css" />
  <title>CINELAX: Showtimes</title>
</head>

<?php

session_start();

$servername = "localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "cinemalax";

$tableName = '';
$orderID = $_SESSION['orderID'];
$movie = $_SESSION['movieName'];

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

$query = "SELECT * FROM " . $tableName . " WHERE OrderID = '" . $orderID . "';";
$stmt = $db->prepare($query);
$stmt->execute();

$result = $stmt->get_result();
$num_results = $result->num_rows;

for ($i = 0; $i < $num_results; $i++) {
  $row = $result->fetch_assoc();
  $movie = $row['Movie'];
  $date = $row['BookingDate'];
  $time = $row['BookingTime'];
}

$payment = TRUE;

$query = "UPDATE " . $tableName . " SET PaymentDone = " . ($payment ? 1 : 0) . " WHERE OrderID = '" . $orderID . "';";
$stmt = $db->prepare($query);
$stmt->execute();

session_destroy();

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

  <main class="confirmation-container">
    <div class="confirmation-content">
      <div class="ticket-steps">
        <div class="ticket-steps-details">
          <div class="ticket-step-number">1</div>
          <h2 class="ticket-step-text">Seat & Personal Info</h2>
        </div>
        <div class="ticket-steps-details">
          <div class="ticket-step-number">2</div>
          <h2 class="ticket-step-text">Price & Payment Selection</h2>
        </div>
        <div class="ticket-steps-details current">
          <div class="ticket-step-number">3</div>
          <h2 class="ticket-step-text">Confirmation</h2>
        </div>
      </div>
      <div class="confirmation-text">
        <p>
          You have booked <span class="underline"><?php echo $movie ?></span> for
          <span class="underline"><?php echo $date ?></span> at
          <span class="underline"><?php echo $time ?></span>. <br />
        </p>
        <p>
          A confirmation e-mail has been sent to your inbox. Please refer to
          the e-mail for more information or make changes to your booking.
          <br />
        </p>
        <p>Thank you! <br /></p>
        <p class="small">You may leave this page now.</p>
      </div>
      <a href="../index.html" class="home-button">Back to Home</a>
    </div>
  </main>
  <!-- Script -->
</body>

</html>