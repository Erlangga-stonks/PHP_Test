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
    $sub = "";
    if(isset($_POST['butto'])){
        $tgl = $_POST['tgl'];
        $bln = $_POST['bln'];
        $thn = $_POST['thn'];
        if($bln == 2){
            if($tgl >= 29 || 30 || 31){
                echo '<script language="javascript">';
                echo 'alert("ERROR: Bulan 02 hanya sampai tanggal 28!")';
                echo '</script>';
            }
        }
        $sub = $tgl . "-" . $bln . "-" .$thn;
    }
    ?>

<h2>No 2</h2>
    <form action="" method="POST">
        <label>Tanggal :</label>
        <input type="text" name="tgl"><br>
        <label>Bulan :</label>
        <input type="text" name="bln"><br>
        <label>Tahun :</label>
        <input type="text" name="thn"><br>
        <button type="submit" name="butto">click</button>
        <br>
        <label>Tanggal : <?=$sub?></label> <br>
    </form>
</body>
</html>