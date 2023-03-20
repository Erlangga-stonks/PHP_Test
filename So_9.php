<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php
        function separate($number){
        $panjang = strlen($number);
        $output = "";

        for ($i = 0; $i < $panjang; $i++) {
            $output .= $number[$i];
            if (($panjang - $i - 1) % 3 == 0 && $i != $panjang - 1) {
                $output .= ".";
            }
        }
            echo $output;
    }
        ?>

        <form action="" method="POST">
        <label>Input :</label>
        <input type="text" name="rupi">
        <button type="input">click me</button>
        </form>

        <?php
        if($_POST){
            echo "" . separate($_POST['rupi']);
        }

        ?>
</body>
</html>


<!--<?php

?>-->