<?php
$servername = "localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "javajam";

// Create connection
@$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM coffee WHERE name='Just Java'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while ($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Price: $" . $row["price"] . "<br>";
  }
} else {
  echo "0 results";
}
mysqli_close($conn);
