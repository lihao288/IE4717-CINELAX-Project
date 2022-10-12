<?php
$servername = "localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "javajam";

$ischecked = '';


if (isset($_POST['justjava-price'])) {
    $justjava_price=$_POST['justjava-price'];
    $justjava_price = doubleval($justjava_price);
    echo $justjava_price;
}


if (isset($_POST['justjava'])) {
    $justjava = $_POST['justjava'];
    $ischecked = "justjava";
} else {
    exit;
}


// Create connection
@ $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

switch ($ischecked) {
    case 'justjava':
        $sql = "UPDATE coffee SET price='".$justjava_price."' WHERE name='Just Java'";
        break;
}


if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

