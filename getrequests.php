
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Frame Price Estimator</title>
</head>
<body>
<form method = "post" action="getrequests.php">
    <label for="password">Input Password:</label>
    <input type="text" id="password" name="password">
    <input type="submit">
</form>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];

    if ($password == "WannaTellMeHow") {
        $servername = "devweb2021.cis.strath.ac.uk";
        $username = "tmb19188";
        $password = "ePu0Eequeije";
        $conn = new mysqli($servername, $username, $password, $username);
        echo "<table><tr><th>Width</th><th>Height</th><th>Postage</th><th>E-Mail</th><th>Price (ex VAT)</th><th>Requested</th></tr>";
        echo "<table border = '1'><tr><th>Width</th><th>Height</th><th>Postage</th><th>E-Mail</th><th>Price (ex VAT)</th><th>Requested</th></tr>";
        // Next Day orders overdue by more than 1 day
        $sql = "SELECT * FROM `optin_clients` WHERE postage = 'NextDay' AND requested <= NOW() - INTERVAL 1 DAY";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td><b>" . $row["width"] . "</b></td><td><b>" . $row["height"] . "</b></td><td><b>" . $row["postage"] . "</b></td><td><b>" . $row["email"] . "</b></td><td><b>" . $row["price"] . "</b></td><td><b>" . $row["requested"] . "</b></td></tr>";
            }
        }
        // Rapid Orders overdue by more than 3 days
        $sql = "SELECT * FROM `optin_clients` WHERE postage = 'Rapid' AND requested <= NOW() - INTERVAL 3 DAY";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td><b>" . $row["width"] . "</b></td><td><b>" . $row["height"] . "</b></td><td><b>" . $row["postage"] . "</b></td><td><b>" . $row["email"] . "</b></td><td><b>" . $row["price"] . "</b></td><td><b>" . $row["requested"] . "</b></td></tr>";
            }
        }
        // Economy orders overdue by more than 7 days
        $sql = "SELECT * FROM `optin_clients` WHERE postage = 'Economy' AND requested <= NOW() - INTERVAL 7 DAY";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td><b>" . $row["width"] . "</b></td><td><b>" . $row["height"] . "</b></td><td><b>" . $row["postage"] . "</b></td><td><b>" . $row["email"] . "</b></td><td><b>" . $row["price"] . "</b></td><td><b>" . $row["requested"] . "</b></td></tr>";
            }
        }
        // Next Day orders made 1 day from now
        $sql = "SELECT * FROM `optin_clients` WHERE postage = 'NextDay' AND requested >= NOW() - INTERVAL 1 DAY";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["width"] . "</td><td>" . $row["height"] . "</td><td>" . $row["postage"] . "</td><td>" . $row["email"] . "</td><td>" . $row["price"] . "</td><td>" . $row["requested"] . "</td></tr>";
            }
        }
        // Rapid orders made 3 days from now
        $sql = "SELECT * FROM `optin_clients` WHERE postage = 'Rapid' AND requested >= NOW() - INTERVAL 3 DAY";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["width"] . "</td><td>" . $row["height"] . "</td><td>" . $row["postage"] . "</td><td>" . $row["email"] . "</td><td>" . $row["price"] . "</td><td>" . $row["requested"] . "</td></tr>";
            }
        }
        // Economy orders made 7 days from now
        $sql = "SELECT * FROM `optin_clients` WHERE postage = 'Economy' AND requested >= NOW() - INTERVAL 7 DAY";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["width"] . "</td><td>" . $row["height"] . "</td><td>" . $row["postage"] . "</td><td>" . $row["email"] . "</td><td>" . $row["price"] . "</td><td>" . $row["requested"] . "</td></tr>";
            }
        }
    }else{
        echo "Incorrect Password";
    }
}

?>
