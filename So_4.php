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
    function terbilang($numb) {
        $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
      
        if ($numb < 12)
          return " " . $angka[$numb];
        elseif ($numb < 20)
          return terbilang($numb - 10) . " belas";
        elseif ($numb < 100)
          return terbilang($numb / 10) . " puluh" . terbilang($numb % 10);
        elseif ($numb < 200)
          return "seratus" . terbilang($numb - 100);
        elseif ($numb < 1000)
          return terbilang($numb / 100) . " ratus" . terbilang($numb % 100);
        elseif ($numb < 2000)
          return "seribu" . terbilang($numb - 1000);
        elseif ($numb < 1000000)
          return terbilang($numb / 1000) . " ribu" . terbilang($numb % 1000);
        elseif ($numb < 1000000000)
          return terbilang($numb / 1000000) . " juta" . terbilang($numb % 1000000);
    }
    
    ?>
     <h2>No 4</h2>
    <form action="" method="POST">
        <label>Iterasi : </label>
        <input type="text" name ="iter">
        <button>Click me</button><br>

    </form>
        <?php
        if($_POST){
            echo ucwords(terbilang($_POST['iter']));
        }
        ?>
</body>
</html>