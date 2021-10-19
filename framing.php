<html>

<head>
    <meta charset="UTF-8">
    <title>Frame Price Estimator</title>
</head>
<body>

<?php
$widthErr = $heightErr = $emailErr = "";
$p_width = $_GET["width"];
$p_height = $_GET["height"];

if(!(empty($_GET["width"]) || empty($_GET["height"]))) {
    if ($_GET["measure"] == "mm") {
        $p_width = $p_width / 1000;
        $p_height = $p_height / 1000;
    } elseif ($_GET["measure"] == "cm") {
        $p_width = $p_width / 100;
        $p_height = $p_height / 100;
    } elseif ($_GET["measure"] == "inch") {
        $p_width = $p_width / 39.97;
        $p_height = $p_height / 39.97;
    }


$p_area = $p_width * $p_height;
$length = max($p_width,$p_height);

if($_GET["delivery"] == "Economy"){
    $postage = 2 * $length + 4;
}elseif($_GET["delivery"] == "Rapid"){
    $postage = 3 * $length + 8;
}elseif($_GET["delivery"] == "NextDay"){
    $postage = 5 * $length + 12;
}
$price = (pow($p_area,2) + (100 * $p_area) + +6);
$priceNoVAT = (pow($p_area,2) + (100 * $p_area) + +6);
$priceNoVAT = round($priceNoVAT,2);
}
?>

<h1>Frame Price Estimator</h1>
<p>Please enter your photo sizes to get a framing cost estimate</p>
<form method = "get" action="framing.php">
    <p>Photo Width: <input type="number" name="width" >
        <span class="error">* <?php echo $widthErr;?></span>
        <select name="measure">
            <option value="mm">mm</option>
            <option value="cm">cm</option>
            <option value="inch">inch</option>
        </select></p>
    <p>Photo Height: <input type="number" name="height">
        <span class="error">* <?php echo $heightErr;?></span></p>

    <input type="radio" id = "economy" name="delivery" value="Economy" checked>
    <label for="economy">Economy</label>

    <input type="radio" id="rapid" name="delivery" value="Rapid">
    <label for="rapid">Rapid</label>

    <input type="radio" id="nextDay" name="delivery" value="NextDay">
    <label for="nextDay">NextDay</label><br><br>

    <input type="checkbox" id="VAT" name = "VAT" checked>
    <label for="VAT">Include VAT in price</label><br><br>

    <input type="text" id="email" name="email">
    <label for="email">Email Address:</label><br><br>

    <input type="checkbox" id="Opt" name = "Opt" >
    <label for="Opt">Recieve mail and future information about my framing calculation</label><br>

    <br><br>

    <input type="submit">

</form>
<?php
$servername = "devweb2021.cis.strath.ac.uk";
$username = "tmb19188";
$password = "ePu0Eequeije";
$conn = new mysqli($servername, $username, $password, $username);

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(empty($_GET["width"])||empty($_GET["height"])){
        if(empty($_GET["width"])){
            echo "Width is Required.<br>";
        }
        if(empty($_GET["height"])){
            echo "Height is Required.<br>";
        }
    }elseif($p_width > 2 || $p_width < 0.2 || $p_height > 2 || $p_height < 0.2 ){
        if(min($p_height, $p_width) > 2) {
            echo "We do not provide frames that wide<br>";
        }elseif(min($p_height, $p_width) < 0.2){
            echo "We do not provide frames that short<br>";
        }
    }else{
        if((isset($_GET['Opt']))) {

            if(filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
             if (isset($_GET['VAT'])) {
                    $price = $price * 1.2;
                    $postage = $postage * 1.2;
                    echo "Your total comes to: " . money_format('%.2n', $price) . " plus " . $_GET["delivery"] . " postage of " . money_format('%.2n', $postage) . " giving a total price of " . money_format('%.2n', $price + $postage) . " including VAT <br>";
                 } else {
                    echo "Your total comes to: " . money_format('%.2n', $price) . " plus " . $_GET["delivery"] . " postage of " . money_format('%.2n', $postage) . " giving a total price of " . money_format('%.2n', $price + $postage) . "<br>";
                 }

                 mail($_GET["email"], "CS312 Purchase", "Thank you for your purchase of a " . $p_width . "x" . $p_height . " metre(s) frame.<br>Your delivery option is: " . $_GET["delivery"] . ".\n.Your final cost will be " . money_format('%.2n', $price + $postage) . "<br>");

                if (isset($_GET['Opt'])) {

                    if ($conn->connect_error) {
                        die ("connectionFailed " . $conn->connect_error);
                    }
                    $sqlwidth = mysqli_real_escape_string($conn, $_GET['width']);
                    $sqlheight = mysqli_real_escape_string($conn, $_GET['height']);
                    $sqldelivery = mysqli_real_escape_string($conn, $_GET['delivery']);
                    $sqlemail = mysqli_real_escape_string($conn, $_GET['email']);
                    $sqlprice = mysqli_real_escape_string($conn, $priceNoVAT);
                    $today = mysqli_real_escape_string($conn, date("Y-m-d H:i"));

                    $sql = "INSERT INTO optin_clients (width, height, postage, email, price, requested) 
                    VALUES ('$sqlwidth','$sqlheight','$sqldelivery','$sqlemail','$sqlprice','$today')";

                    if ($conn->query($sql) === TRUE) {
                        echo "\r\n";
                        // This is just a placeholder
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }else{
                echo "Invalid Email<br>";
            }
            }else{
                if (isset($_GET['VAT'])) {
                    $price = $price * 1.2;
                    $postage = $postage * 1.2;
                    echo "Your total comes to: " . money_format('%.2n', $price) . " plus " . $_GET["delivery"] . " postage of " . money_format('%.2n', $postage) . " giving a total price of " . money_format('%.2n', $price + $postage) . " including VAT <br>";
                } else {
                    echo "Your total comes to: " . money_format('%.2n', $price) . " plus " . $_GET["delivery"] . " postage of " . money_format('%.2n', $postage) . " giving a total price of " . money_format('%.2n', $price + $postage) . "<br>";
                }
            }
        }
    }

?>
 <p>* required fields</p>
</body>
</html>

