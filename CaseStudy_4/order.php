<?php
$servername = "localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "javajam";


if (!isset($_POST['justjava']) && !isset($_POST['lait']) && !isset($_POST['cappuccino'])) {

    echo "No checkbox selected.";
    exit;
}

$justjava = isset($_POST['justjava']);
$lait = isset($_POST['lait']);
$cappuccino = isset($_POST['cappuccino']);

// Create connection
@ $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($justjava) {
    $ischecked[0] = "justjava";

    if (isset($_POST['justjava-price'])) {
        $justjava_price=$_POST['justjava-price'];
        $justjava_price = doubleval($justjava_price);
    }
} 

if ($lait) {
    $ischecked[1] = "lait";

    if (isset($_POST['lait-single-price'])) {
        $lait_single_price=$_POST['lait-single-price'];
        $lait_single_price = doubleval($lait_single_price);
    }
    if (isset($_POST['lait-double-price'])) {
        $lait_double_price=$_POST['lait-double-price'];
        $lait_double_price = doubleval($lait_double_price);
    }
} 

if ($cappuccino) {
    $ischecked[2] = "cappuccino";

    if (isset($_POST['cappuccino-single-price'])) {
        $cappuccino_single_price=$_POST['cappuccino-single-price'];
        $cappuccino_single_price = doubleval($cappuccino_single_price);
    }
    if (isset($_POST['cappuccino-double-price'])) {
        $cappuccino_double_price=$_POST['cappuccino-double-price'];
        $cappuccino_double_price = doubleval($cappuccino_double_price);
    }
}

foreach ($ischecked as $update) {
    switch ($update) {
        case 'justjava':
            $sql[0] = "UPDATE coffee SET price=".$justjava_price." WHERE name='Just Java'";
            break;
        case 'lait':
            $sql[1] = "UPDATE coffee SET price = CASE type WHEN 'single' THEN ".$lait_single_price." WHEN 'double' THEN ".$lait_double_price." ELSE price END WHERE name='Cafe au Lait'";
            break;
        case 'cappuccino':
            $sql[2] = "UPDATE coffee SET price = CASE type WHEN 'single' THEN ".$cappuccino_single_price." WHEN 'double' THEN ".$cappuccino_double_price." ELSE price END WHERE name='Iced Cappuccino'";
            break;
    }
}

foreach ($sql as $stmt) {
    if (mysqli_query($conn, $stmt)) {
        echo nl2br("Record updated successfully.\n");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

