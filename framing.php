<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Frame Price Estimator</title>
</head>
<body>

<?php
$widthErr = $heightErr = "";
$width = $height = $area = $cost = 0;
if (empty($_POST["width"])) {
    $genderErr = "Width is required";
} else {
    $gender = test_input($_POST["width"]);
}
if (empty($_POST["height"])) {
    $genderErr = "Height is required";
} else {
    $gender = test_input($_POST["Height"]);
}
?>
<h1>Frame Price Estimator</h1>
<p>Please enter your photo sizes to get a framing cost estimate</p>
<form method = "post" action=""
<input type="int" name="width" value="<?php echo $width;?>">;
</body>
</html>
