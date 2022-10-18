<!DOCTYPE html>
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
@$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($justjava) {
    $ischecked[0] = "justjava";

    if (isset($_POST['justjava-price'])) {
        $justjava_price = $_POST['justjava-price'];
        $justjava_price = doubleval($justjava_price);
    }
}

if ($lait) {
    $ischecked[1] = "lait";

    if (isset($_POST['lait-single-price'])) {
        $lait_single_price = $_POST['lait-single-price'];
        $lait_single_price = doubleval($lait_single_price);
    }
    if (isset($_POST['lait-double-price'])) {
        $lait_double_price = $_POST['lait-double-price'];
        $lait_double_price = doubleval($lait_double_price);
    }
}

if ($cappuccino) {
    $ischecked[2] = "cappuccino";

    if (isset($_POST['cappuccino-single-price'])) {
        $cappuccino_single_price = $_POST['cappuccino-single-price'];
        $cappuccino_single_price = doubleval($cappuccino_single_price);
    }
    if (isset($_POST['cappuccino-double-price'])) {
        $cappuccino_double_price = $_POST['cappuccino-double-price'];
        $cappuccino_double_price = doubleval($cappuccino_double_price);
    }
}

foreach ($ischecked as $update) {
    switch ($update) {
        case 'justjava':
            $sql[0] = "UPDATE coffee SET price=" . $justjava_price . " WHERE name='Just Java'";
            break;
        case 'lait':
            $sql[1] = "UPDATE coffee SET price = CASE type WHEN 'single' THEN " . $lait_single_price . " WHEN 'double' THEN " . $lait_double_price . " ELSE price END WHERE name='Cafe au Lait'";
            break;
        case 'cappuccino':
            $sql[2] = "UPDATE coffee SET price = CASE type WHEN 'single' THEN " . $cappuccino_single_price . " WHEN 'double' THEN " . $cappuccino_double_price . " ELSE price END WHERE name='Iced Cappuccino'";
            break;
    }
}

foreach ($sql as $stmt) {
    if (mysqli_query($conn, $stmt)) {
        // echo nl2br("Record updated successfully.\n");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM coffee";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['name']) {
            case 'Just Java':
                $justjava_price = $row['price'];
                break;
            case 'Cafe au Lait':
                if ($row['type'] == 'Single') {
                    $lait_single_price = $row['price'];
                } elseif ($row['type'] == 'Double') {
                    $lait_double_price = $row['price'];
                }
                break;
            case 'Iced Cappuccino':
                if ($row['type'] == 'Single') {
                    $cappuccino_single_price = $row['price'];
                } elseif ($row['type'] == 'Double') {
                    $cappuccino_double_price = $row['price'];
                }
                break;
        }
    }
} else {
    echo "0 results";
}


mysqli_close($conn);
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>JavaJam Coffee House</title>
    <link rel="stylesheet" href="styling.css" />
    <script src="admin-price-validators.js"></script>
</head>

<body>
    <div id="wrapper">
        <header>
            <img src="javalogo.jpg" width="800" height="110" />
        </header>
        <div id="leftcolumn">
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="music.html">Music</a></li>
                    <li><a href="jobs.html">Jobs</a></li>
                    <li><a href="admin-price.html">Product Price Update</a></li>
                    <li><a href="admin-sales.html">Daily Sales Report</a></li>
                </ul>
            </nav>
        </div>
        <div id="rightcolumn">
            <div class="content">
                <h2>Coffee at JavaJam</h2>
                <form action="update-price.php" method="post" class="update-price">
                    <table border="1">
                        <tr>
                            <td><input type="checkbox" name="justjava" id="justjava" /></td>
                            <td class="coffee-name">Just Java</td>
                            <td>
                                Regular house blend, decaffeinated coffee, or flavor of the
                                day.
                                <br />
                                <span class="coffee-price">Endless Cup $<input type="text" size="2" name="justjava-price" id="justjava-price" value="<?php echo number_format($justjava_price, 2); ?>" disabled /></span>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="lait" id="lait" /></td>
                            <td class="coffee-name">Cafe au Lait</td>
                            <td>
                                House blended coffee infused into a smooth, steamed milk.
                                <br />
                                <label>
                                    <span class="coffee-price">Single $<input type="text" size="2" name="lait-single-price" id="lait-single-price" value="<?php echo number_format($lait_single_price, 2); ?>" disabled /></span>
                                </label>
                                <label>
                                    <span class="coffee-price">Double $<input type="text" size="2" name="lait-double-price" id="lait-double-price" value="<?php echo number_format($lait_double_price, 2); ?>" disabled /></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="cappuccino" id="cappuccino" />
                            </td>
                            <td class="coffee-name">Iced Cappuccino</td>
                            <td>
                                Sweetened espresso blended with icy-cold milk and served in a
                                chilled glass. <br />
                                <label>
                                    <span class="coffee-price">Single $<input type="text" size="2" name="cappuccino-single-price" id="cappuccino-single-price" value="<?php echo number_format($cappuccino_single_price, 2); ?>" disabled /></span>
                                </label>
                                <label>
                                    <span class="coffee-price">Double $<input type="text" size="2" name="cappuccino-double-price" id="cappuccino-double-price" value="<?php echo number_format($cappuccino_double_price, 2); ?>" disabled /></span>
                                </label>
                            </td>
                        </tr>
                    </table>

                    <input type="submit" value="Update" class="update-button" />
                </form>
            </div>
        </div>

        <script src="admin-price_script.js"></script>
        <footer>
            <small>
                <i>Copyright &copy; 2014 JavaJam Coffee House</i><br />
                <a href="mailto:jiajun@tham.com">lihao@lau.com</a>
            </small>
        </footer>
    </div>
</body>

</html>