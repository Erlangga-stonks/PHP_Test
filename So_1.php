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
       $result= NULL;
       if(isset($_POST['check'])){
           $word= $_POST['Kalimat'];
           $abjad= $_POST['Abjad'];
           $split = str_split($word);
           foreach($split as $voc){
               if($voc == $abjad){
                   $result++;
               }
           }
        }
    ?>
    <h2>No 1</h2>
    <form action="" method="POST">
    <label>Kalimat:</label>
    <input type="text" name="Kalimat"><br>
    <label>Abjad :</label>
    <input type="text" name="Abjad"><br>
    <button type="submit" name="check">Check</button>  <br>
    <label >result: <?=$result?></label>
</form>
</body>
</html>