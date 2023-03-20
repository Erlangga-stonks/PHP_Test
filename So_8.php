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
    function pyra($x){

        // Bintang 1
        for ($i = 1; $i <= $x; $i++) {
          for ($j = 1; $j <= $i; $j++) {
            echo "* ";
          }
          echo "<br>";
        }
        
        echo "<br>";
        
        // Bintang 2
        for ($i = 1; $i <= $x; $i++) {
          for ($j = 1; $j <= $x - $i; $j++) {
            echo "&nbsp;&nbsp;&nbsp;";
          }
          for ($j = 1; $j <= $i; $j++) {
            echo "* ";
          }
          echo "<br>";
        }
        
            echo "<br>";
        
        // Bintang 3
        for ($i = 1; $i <= $x; $i++) {
          for ($j = $x; $j >= $i; $j--) {
            echo "* ";
          }
          echo "<br>";
        }
        
        echo "<br>";
        
        // Bintang 4
        for ($i = $x; $i >= 1; $i--) {
          for ($j = 1; $j <= $x - $i; $j++) {
            echo "&nbsp;&nbsp;&nbsp;";
          }
          for ($j = 1; $j <= $i; $j++) {
            echo "* ";
          }
          echo "<br>";
        }
       
    }
    ?>


    <form action="" method="POST">
    <label>Input :</label>
    <input type="text" name="meta">
    <button type="submit">submit</button>
    </form>

    <?php
     if($_POST){
        echo "" . pyra($_POST['meta']);
     }
    ?>
</body>
</html>