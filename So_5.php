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
  function der_fib($rasu){

    $before = 1;
    $after = 1;
    $type = "$before $after";
    for($i=1; $i<$rasu-2; $i++){
        $has = $before + $after;
        $type = $type . "$has";

        $before = $after;
        $after = $has;
    }
    return $type;
}
    ?>
     <h2>No 5</h2>
    <form action="" method="POST">
        <label>Iterasi : </label>
        <input type="text" name ="fib">
        <button type="submit" name="now">Click me</button><br>
    </form>
     <?php
        if($_POST){
            echo "hasil=" . der_fib($_POST['fib']);
        }
     ?>
</body>
</html>