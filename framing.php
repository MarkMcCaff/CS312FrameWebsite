
<html>

<head>
    <meta charset="UTF-8">
    <title>Frame Price Estimator</title>
</head>
<body>

<h1>Frame Price Estimator</h1>
<p>Please enter your photo sizes to get a framing cost estimate</p>
<form method = "get" action="framing.php">
    <p>Photo Width: <input type="number" name="width" >
        <select name="measure">
            <option value="mm">mm</option>
            <option value="cm">cm</option>
            <option value="inch">inch</option>
        </select></p>
    <p>Photo Height: <input type="number" name="height"> </p>

    <input type="radio" id = "economy" name="delivery" value="Economy" checked>
    <label for="economy">Economy</label>

    <input type="radio" id="rapid" name="delivery" value="Rapid">
    <label for="rapid">Rapid</label>

    <input type="radio" id="nextDay" name="delivery" value="NextDay">
    <label for="nextDay">NextDay</label><br>
    <br>
    <br>
    <input type="checkbox" id="VAT" name = "VAT">
    <label for="VAT">Include VAT in price</label><br>
    <br>
    <input type="submit">
</form>
<?php
$p_width = $_GET["width"];
$p_height = $_GET["height"];

if($_GET["measure"] == "mm"){
    $p_width = $p_width/1000;
    $p_height = $p_height/1000;
}elseif($_GET["measure"] == "cm"){
    $p_width = $p_width/100;
    $p_height = $p_height/100;
}elseif($_GET["measure"] == "inch") {
    $p_width = $p_width / 39.97;
    $p_height = $p_height / 39.97;
}
$p_area = ($p_width/1000) * ($p_height/1000);
$length = max($p_width,$p_height);

if($_GET["delivery"] == "Economy"){
    $postage = 2 * $length + 4;
}elseif($_GET["delivery"] == "Rapid"){
    $postage = 3 * $length + 8;
}elseif($_GET["delivery"] == "NextDay"){
    $postage = 5 * $length + 12;
}
$price = (pow($p_area,2) + (100 * $p_area) + +6);

if($_GET("VAT") == "on"){
    $price = $price * 1.2;
}
echo "Your total comes to: ".money_format('%.2n',$price). " plus ".$_GET["delivery"]." postage of ".money_format('%.2n',$postage). " giving a total price of " .money_format('%.2n', $price+$postage);
?>

</body>
</html>

