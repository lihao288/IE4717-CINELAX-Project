<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/my-bookings.css" />
  <title>CINELAX: My Bookings</title>
</head>

<?php

session_start();

$servername = "localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "cinelax";

$inputName = $_SESSION['inputName'];
$inputEmail = $_SESSION['inputEmail'];

// Create connection
@$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

$orderIDArray = array();
$userFound = false;

$tableList = array('ant_man', 'black_panther', 'doctor_strange', 'eternals', 'guardians', 'shangchi', 'spiderman', 'thor');
$tableListLength = count($tableList);

$count = $_SESSION['count'];
?>

<body>
  <header>
    <nav>
      <a href="../index.html" class="nav-heading">Cinelax</a>
      <div class="nav-links">
        <a href="../index.html">Home</a>
        <a href="../showtimes.html">Showtimes</a>
        <a href="../contact-us.html">Contact</a>
        <a href="../my-bookings-login.html" class="selected">My Bookings</a>
      </div>
    </nav>
  </header>
  <main class='my-bookings-container'>
    <!-- <div class="back-button">
        <a href="index.html">Back</a>
    </div>           -->
    <?php
    $total = $count;
    for ($i = 0; $i < $total; $i++) {
      if (isset($_POST["submit_" . ($i + 1)])) {
        $selectedOrderID = $_POST["orderID_" . ($i + 1) . ""];
        $selectedMovie = $_POST["movie_" . ($i + 1) . ""];
        $count--;
        // echo $count;
        $_SESSION['count'] = $count;

        switch ($selectedMovie) {
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

        $queryToMovie = "DELETE FROM " . $tableName . " WHERE OrderID = '" . $selectedOrderID . "';";
        $queryToCustomers = "DELETE FROM customers_info WHERE OrderID = '" . $selectedOrderID . "';";

        $stmt = $db->prepare($queryToMovie);
        $stmt->execute();

        $stmt = $db->prepare($queryToCustomers);
        $stmt->execute();
      }
    }
    ?>

    <?php
    $query = "SELECT * FROM customers_info WHERE CustomerName = '" . $inputName . "' AND CustomerEmail = '" . $inputEmail . "';";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();
    $num_results = $result->num_rows;

    if ($num_results > 0) {
      for ($i = 0; $i < $num_results; $i++) {
        $row = $result->fetch_assoc();
        array_push($orderIDArray, $row['OrderID']);
      }
      $userFound = true;
    }

    mysqli_free_result($result);
    ?>

    <?php

    if ($count == 0) {
      echo "<h4>Hello User,</h4>";
      echo "<h4>There is no booking details found under " . $inputName . " and " . $inputEmail . ".</h4>";
      echo "<h4>Please click the button below to book a movie.</h4>";
      echo "<a href='../showtimes.html' class='booking-button'>Book a Movie</a>";

      session_destroy();
    }

    if ($userFound && $count > 0) {

      echo "<h4>Hello " . $inputName . " ,</h4>";

      $count = 0;

      foreach ($tableList as $table) {
        foreach ($orderIDArray as $index => $orderID) {
          $query = "SELECT * FROM " . $table . " WHERE OrderID = '" . $orderID . "';";
          $stmt = $db->prepare($query);
          $stmt->execute();

          $result = $stmt->get_result();
          $num_results = $result->num_rows;

          if ($num_results > 0) {
            for ($i = 0; $i < $num_results; $i++) {
              $row = $result->fetch_assoc();
              $count += 1;

              $movie = $row['Movie'];
              switch ($movie) {
                case "Ant-Man":
                  $moviePoster = "../movie images & videos/Ant-man/Ant-Man.jpeg";
                  break;
                case "Black Panther":
                  $moviePoster =
                    "../movie images & videos/Black Panther/Black Panther.jpeg ";
                  break;
                case "Doctor Strange in the Multiverse of Madness":
                  $moviePoster =
                    "../movie images & videos/Doctor Strange/Doctor Strange in the Multiverse of Madness.jpeg ";
                  break;
                case "Eternals":
                  $moviePoster = "../movie images & videos/Eternals/Eternals.jpeg ";
                  break;
                case "Guardians of the Galaxy":
                  $moviePoster =
                    "../movie images & videos/Guardians of the Galaxy/Guardians of the Galaxy.jpeg ";
                  break;
                case "Shang-Chi":
                  $moviePoster =
                    "../movie images & videos/Shang Chi/Shang-Chi and The Legend of The Ten Rings.jpeg ";
                  break;
                case "Spider-Man: No Way Home":
                  $moviePoster =
                    "../movie images & videos/Spider-man/Spider-Man- No Way Home.jpeg ";
                  break;
                case "Thor: Love and Thunder":
                  $moviePoster =
                    "../movie images & videos/Thor/Thor- Love and Thunder poster.jpeg ";
                  break;
              }

              echo "<form id='form_" . $count . "' action='cancel-booking.php' method='post' class='my-bookings-details' onsubmit=\"javascript: return confirm('Do you want to cancel the booking?');\"'>";
              echo "<div class='my-bookings-box'>";
              echo "<img src='" . $moviePoster . "'/>";
              echo "<div class='my-bookings-text'><p>You have booked <input type='text' name='movie_" . $count . "' id='movie' class='movie' readonly value='" . $row['Movie'] . "' onfocus='this.blur()'> on <i>" . $row['TransactionTime'] . "</i></p>";
              echo "<p>Order ID: <input type='text' name='orderID_" . $count . "' id='orderID' readonly value='" . $row['OrderID'] . "' onfocus='this.blur()'></p>";
              echo "<p>Date: " . $row['BookingDate'] . "</p>";
              echo "<p>Cinema Hall: " . $row['Hall'] . "</p>";
              echo "<p>Time: " . $row['BookingTime'] . "</p>";
              echo "<p>Selected: " . $row['SelectedSeats'] . "</p>";
              echo "</div></div>";
              echo "<input type='submit' name='submit_" . $count . "' value='Cancel Booking' class='cancel-booking-button' ></form>";
            }
            $_SESSION['count'] = $count;
          }
        }
      }
    }

    $db->close();
    ?>
  </main>
  <footer>
    <div class="container">
      <!-- <small> -->
      <a class="footer-header"><i>Copyright &copy; CINELAX 2022</i></a>
      <a class="footer-nav" href="../index.html">Home</a>
      <a class="footer-nav" href="../showtimes.html">Showtimes</a>
      <a class="footer-nav" href="../contact-us.html">Contact Us</a>
      <a class="footer-nav" href="../my-bookings-login.html">My Bookings</a>
      <a class="footer-nav" href="#">About Us</a>
      <a class="footer-nav" href="#">F.A.Q</a>
      <a class="footer-nav" href="#">Terms of Service</a>
      <!-- </small> -->
    </div>
  </footer>
  <!-- Script -->
  <script src='../script/booking-script.js'></script>
</body>

</html>