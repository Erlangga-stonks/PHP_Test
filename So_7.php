<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="" method="get">
        <label>Nilai Awal :</label>
        <input type="text" name="fore"><br>
        <label>Iterasi : </label>
        <input type="text" name="iteration"> <br>
        <button type="submit">submit</button>
    </form>
    <?php
    $start_value = $_GET['fore'];
    $iterations = $_GET['iteration'];
    
    for ($i = 0; $i < $iterations; $i++) {
        echo $start_value."\n";
        $start_value = incrementCounter($start_value);
    }

    function incrementCounter($value) {
        $last_char = substr($value, -1);
        if ($last_char == "9") {
            return incrementCounter(substr($value, 0, -1))."A";
        } 
        elseif ($last_char == "Z") {
            return incrementCounter(substr($value, 0, -1))."0";
        } else {
            return substr($value, 0, -1).chr(ord($last_char) + 1);
        }
    }

    ?>

</body>
</html>