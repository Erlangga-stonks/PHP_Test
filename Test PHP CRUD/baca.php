<?php
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

    require_once "connect.php";
    

    $sql = "SELECT * FROM karyawan WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        

        $param_id = trim($_GET["id"]);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $nik = $row["nik"];
                $nama = $row["nama"];
                $alamat = $row["alamat"];
                $tanggal_masuk = $row["tanggal_masuk"];
                $kota = $row["kota"];
                $gelar = $row["gelar"];
                $gender = $row["gender"];
                $tanggal_keluar = $row["tanggal_keluar"];
            } else{
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else{
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>NIK</label>
                        <p><b><?php echo $row["nik"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <p><b><?php echo $row["nama"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <p><b><?php echo $row["alamat"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <p><b><?php echo $row["kota"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Gelar</label>
                        <p><b><?php echo $row["gelar"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <p><b><?php echo $row["gender"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Tanggal_masuk</label>
                        <p><b><?php echo $row["tanggal_masuk"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Tanggal_keluar</label>
                        <p><b><?php echo $row["tanggal_keluar"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>