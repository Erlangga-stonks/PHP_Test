<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>No 3</h2>
    <form action="" method="POST">
    <label>Kalimat:</label>
    <input type="text" name="Kelimat"><br>
    <button type="submit" name="boom">Check</button><br>
    </form>
    <?php
    if(isset($_POST['boom'])){
        $click = $_POST['Kelimat'];
        $kata = "";
    for ($i = 0; $i < strlen($click); $i++) {
    if ($click[$i] != " ") {
    $kata .= $click[$i];
  } else {
    echo $kata . "<br>";
    $kata = "";
  }
}
echo $kata;
    }
    ?>
</body>
</html>
