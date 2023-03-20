<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="" method="post">
    <label for="angka">Angka : </label>
    <input type="text" name="angka" id="angka">
    <button type="submit" name="submit">Submit</button>
</form>

    <?php
   if (isset($_POST['submit'])) {
    $angka = $_POST['angka'];

    for ($i = 1; $i <= $angka; $i++) {
        for ($j = 1; $j <= $angka; $j++) {
            if ($i % 2 == 1) {
                echo $j . " ";
            } else {
                echo ($angka - $j + 1) . " ";
            }
        }
        echo "<br>";
    }

   }
    
    ?>
</body>
</html>