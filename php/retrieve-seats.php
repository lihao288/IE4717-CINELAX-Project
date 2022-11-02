<?php

$servername = "localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "cinelax";

// Create connection
@$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the selected movie and its respective name, time and date
for ($i = 0; $i < 8; $i++) {
  if (isset($_POST["submit_" . ($i + 1)])) {
    $movie = $_POST["movie_" . ($i + 1)];
    $time = $_POST["time_" . ($i + 1)];
    $date = $_POST["date_" . ($i + 1)];
  }
}

// loop through to get the table name
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

$selectedSeats = array();

$query = "SELECT * FROM " . $tableName . " WHERE BookingDate = '" . $date . "' AND BookingTime = '" . $time . "' AND PaymentDone = 1;";
$stmt = $db->prepare($query);
$stmt->execute();

$result = $stmt->get_result();
$num_results = $result->num_rows;

if ($num_results > 0) {
  for ($i = 0; $i < $num_results; $i++) {
    $row = $result->fetch_assoc();
    $selectedSeats[] = $row['SelectedSeats'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../styles/buy-ticket.css" />
  <title>CINELAX: Buy Ticket</title>
</head>

<body>
  <header>
    <nav>
      <a href="../index.html" class="nav-heading">Cinelax</a>
      <div class="nav-links">
        <a href="../index.html">Home</a>
        <a href="../showtimes.html">Showtimes</a>
        <a href="../contact-us.html">Contact</a>
        <a href="../my-bookings-login.html">My Bookings</a>
      </div>
    </nav>
  </header>
  <main class="ticket-container">
    <div class="ticket-content">
      <div class="ticket-steps">
        <div class="ticket-steps-details current">
          <div class="ticket-step-number">1</div>
          <h2 class="ticket-step-text">Seat & Personal Info</h2>
        </div>
        <div class="ticket-steps-details">
          <div class="ticket-step-number">2</div>
          <h2 class="ticket-step-text">Price & Payment Selection</h2>
        </div>
        <div class="ticket-steps-details">
          <div class="ticket-step-number">3</div>
          <h2 class="ticket-step-text">Confirmation</h2>
        </div>
      </div>
      <div class="ticket-seat-selection">
        <div class="ticket-poster-container">
          <img src="" alt="" id="movie-poster" />
        </div>
        <div class="ticket-seat-selection-content">
          <h3 class="ticket-instruction">
            Please select your seat(s). <br />
            You will receive a confirmation number at the end of the
            transaction.
          </h3>
          <form action="save-info.php" class="ticket-customer-form" method="post" onsubmit="return checkValue();">
            <div class="ticket-seating-plan">
              <ul class="ticket-showcase">
                <li>
                  <div class="ticket-seat not-available"></div>
                  <p>N/A</p>
                </li>
                <li>
                  <div class="ticket-seat available"></div>
                  <p>Available</p>
                </li>
                <li>
                  <div class="ticket-seat occupied"></div>
                  <p>Occupied</p>
                </li>
                <li>
                  <div class="ticket-seat selected"></div>
                  <p>Selected</p>
                </li>
              </ul>
              <div class="ticket-seating-plan-container">
                <div class="ticket-screen"></div>
                <div class="ticket-seat-row">
                  <div class="ticket-seat-number">1</div>
                  <div class="ticket-seat-number">2</div>
                  <div class="ticket-seat-number">3</div>
                  <div class="ticket-seat-number">4</div>
                  <div class="ticket-seat-number">5</div>
                  <div class="ticket-seat-number">6</div>
                  <div class="ticket-seat-number">7</div>
                  <div class="ticket-seat-number">8</div>
                </div>
                <div class="ticket-seat-row">
                  <div class="ticket-seat-letter">A</div>
                  <div class="ticket-seat" data-value="A01"></div>
                  <div class="ticket-seat" data-value="A02"></div>
                  <div class="ticket-seat" data-value="A03"></div>
                  <div class="ticket-seat" data-value="A04"></div>
                  <div class="ticket-seat" data-value="A05"></div>
                  <div class="ticket-seat" data-value="A06"></div>
                  <div class="ticket-seat" data-value="A07"></div>
                  <div class="ticket-seat" data-value="A08"></div>
                  <div class="ticket-seat-letter">A</div>
                </div>
                <div class="ticket-seat-row">
                  <div class="ticket-seat-letter">B</div>
                  <div class="ticket-seat" data-value="B01"></div>
                  <div class="ticket-seat " data-value="B02"></div>
                  <div class="ticket-seat" data-value="B03"></div>
                  <div class="ticket-seat" data-value="B04"></div>
                  <div class="ticket-seat" data-value="B05"></div>
                  <div class="ticket-seat " data-value="B06"></div>
                  <div class="ticket-seat" data-value="B07"></div>
                  <div class="ticket-seat" data-value="B08"></div>
                  <div class="ticket-seat-letter">B</div>
                </div>
                <div class="ticket-seat-row">
                  <div class="ticket-seat-letter">C</div>
                  <div class="ticket-seat" data-value="C01"></div>
                  <div class="ticket-seat" data-value="C02"></div>
                  <div class="ticket-seat" data-value="C03"></div>
                  <div class="ticket-seat " data-value="C04"></div>
                  <div class="ticket-seat " data-value="C05"></div>
                  <div class="ticket-seat" data-value="C06"></div>
                  <div class="ticket-seat" data-value="C07"></div>
                  <div class="ticket-seat" data-value="C08"></div>
                  <div class="ticket-seat-letter">C</div>
                </div>
                <div class="ticket-seat-row">
                  <div class="ticket-seat-letter">D</div>
                  <div class="ticket-seat not-available" data-value="D01"></div>
                  <div class="ticket-seat not-available" data-value="D02"></div>
                  <div class="ticket-seat" data-value="D03"></div>
                  <div class="ticket-seat" data-value="D04"></div>
                  <div class="ticket-seat" data-value="D05"></div>
                  <div class="ticket-seat" data-value="D06"></div>
                  <div class="ticket-seat " data-value="D07"></div>
                  <div class="ticket-seat" data-value="D08"></div>
                  <div class="ticket-seat-letter">D</div>
                </div>
                <div class="ticket-seat-row">
                  <div class="ticket-seat-letter">E</div>
                  <div class="ticket-seat" data-value="E01"></div>
                  <div class="ticket-seat" data-value="E02"></div>
                  <div class="ticket-seat" data-value="E03"></div>
                  <div class="ticket-seat " data-value="E04"></div>
                  <div class="ticket-seat " data-value="E05"></div>
                  <div class="ticket-seat" data-value="E06"></div>
                  <div class="ticket-seat" data-value="E07"></div>
                  <div class="ticket-seat" data-value="E08"></div>
                  <div class="ticket-seat-letter">E</div>
                </div>
                <div class="ticket-seat-row">
                  <div class="ticket-seat-number">1</div>
                  <div class="ticket-seat-number">2</div>
                  <div class="ticket-seat-number">3</div>
                  <div class="ticket-seat-number">4</div>
                  <div class="ticket-seat-number">5</div>
                  <div class="ticket-seat-number">6</div>
                  <div class="ticket-seat-number">7</div>
                  <div class="ticket-seat-number">8</div>
                </div>
              </div>
              <p class="ticket-seat-info">
                You have selected
                <!-- prettier-ignore --><input type="text" name="seat-count" id="seat-count" class="information center" size="1" value="0" readonly onfocus="this.blur();" />seat(s).
                <!-- with seat number(s): <span id="seat-number"></span>. -->
              </p>
            </div>
            <div class="ticket-details-box">
              <p class="ticket-details-text">
                You have selected
                <input type="text" name="movie-name" id="movie-name" class="information ticket-underline" size="" readonly onfocus="this.blur();" />at
                <span class="ticket-underline" id="cinema-branch">Jurong Point</span>.
              </p>
              <div class="ticket-details">
                <div class="ticket-details-first-row">
                  <div class="ticket-date">
                    <p class="ticket-date-text">
                      Date:
                      <!-- prettier-ignore --><input type="text" name="ticket-date-selected" id="ticket-date-selected" class="information" size="" readonly onfocus="this.blur();" />
                    </p>
                  </div>
                  <div class="ticket-cinema-hall">
                    <p class="ticket-cinema-hall-text">
                      Cinema Hall:
                      <!-- prettier-ignore --><input type="text" name="ticket-cinema-hall-selected" id="ticket-cinema-hall-selected" class="information" size="" readonly onfocus="this.blur();" />
                    </p>
                  </div>
                </div>
                <div class="ticket-details-second-row">
                  <div class="ticket-time">
                    <p class="ticket-time-text">
                      Time:
                      <!-- prettier-ignore --><input type="text" name="ticket-time-selected" id="ticket-time-selected" class="information" size="" readonly onfocus="this.blur();" />
                    </p>
                  </div>
                  <div class="ticket-cinema-seat">
                    <p class="ticket-cinema-seat-text">
                      Selected Seats:
                      <!-- prettier-ignore --><input type="text" name="ticket-cinema-seat-selected" id="ticket-cinema-seat-selected" class="information" size="" readonly onfocus="this.blur();" />
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <p class="ticket-total">
              Total Amount: S$<span id="ticket-price"></span>
            </p>
            <h3 class="ticket-customer-info-heading">Customer Information</h3>
            <div class="ticket-customer-info">
              <label for="customer-name" class="customer-name">Name: </label>
              <input type="text" name="customer-name" id="customer-name" class="customer-name" placeholder="Your name here" required />
              <label for="customer-mobileno" class="customer-mobileno">Mobile-No:
              </label>
              <input type="text" name="customer-mobileno" id="customer-mobileno" class="customer-mobileno" placeholder="Your phone number here" required />
              <label for="customer-email" class="customer-email">Email:
              </label>
              <input type="email" name="customer-email" id="customer-email" class="customer-email" placeholder="Your email here" required />
            </div>

            <input type="submit" value="Proceed to Payment" class="payment-button" />
            <!-- <a
                href="ticket-price-&-payment-options.html"
                class="payment-button"
                >Proceed to Payment</a
              > -->
          </form>
        </div>
      </div>
    </div>
  </main>
  <script src="../script/seat-script.js"></script>
  <script type="text/javascript">
    // var selectedSeats =
    <?php // echo '["' . implode('", "', $selectedSeats) . '"]' 
    ?>;

    var selectedSeats = [];
    <?php
    foreach ($selectedSeats as $val) {
      echo "selectedSeats.push('" . $val . "');";
    }
    ?>

    var splitSelectedSeats = [];
    selectedSeats.forEach((seat) => {
      if (seat.length > 3) {
        var splits = seat.split(",");
        splits.forEach((split) => {
          splitSelectedSeats.push(split);
        })
      } else {
        splitSelectedSeats.push(seat);
      }

    })

    const seatsContainer = document.querySelectorAll('.ticket-seat');
    seatsContainer.forEach((seat) => {
      splitSelectedSeats.forEach((data) => {
        if (data == seat.dataset.value) {
          seat.classList.add('occupied');
        }
      })
    })
  </script>
</body>

</html>