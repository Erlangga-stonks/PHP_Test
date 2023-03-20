<?php
require_once "connect.php";
$nik = $tanggal_masuk = $nama = $alamat = $tanggal_keluar = $kota = $gelar = $gender = "";
$nik_err = $tanggal_masuk_err = $nama_err = $alamat_err = $tanggal_keluar_err = $kota_err = $gelar_err = $gender_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // validasi

    // nik
    $input_nik = trim($_POST["nik"]);
    if(empty($input_nik)){
        $nik_err = "Tolong masukkan nik.";
    } elseif(!preg_match("/^[a-zA-Z0-9]{12}$/", $input_nik)){
        $nik_err = "Tolong masukkan nik yang benar.";
    }else{
        $nik = $input_nik;
    }

    // nama
    $input_nama = trim($_POST["nama"]);
    if(empty($input_nama)){
        $nama_err = "Tolong masukkan nama.";
    } elseif(!preg_match("/^[a-zA-Z ]{3,}$/", $input_nama)){
        $nama_err = "Tolong masukkan nama yang benar.";
    } elseif(strlen($input_nama) > 50){ 
        $nama_err = "Nama terlalu panjang.";
    } else{
        $nama = $input_nama;
    }

    // Alamat
    $input_alamat = trim($_POST["alamat"]);
    if(empty($input_alamat)){
        $alamat_err = "Tolong masukkan alamat.";
    } elseif(!preg_match("/\b(jalan|jl)\b/i", $input_alamat)) {
        $alamat_err = "Alamat harus mengandung kata 'jalan' atau 'jl'.";
    } elseif(strlen($input_alamat) < 5){
        $alamat_err = "Alamat minimal 5 karakter.";
    } else{
        $alamat = $input_alamat;
    }

    // kota
    $input_kota = trim($_POST["kota"]);
    if(empty($input_kota)){
        $kota_err = "Tolong memasukkan nama kota dengan benar.";     
    } else{
        $kota = $input_kota;
    }
    //gender
    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Tolong memasukkan nama kota dengan benar.";     
    } else{
        $gender = $input_gender;
    }
    //gelar
    $input_gelar = trim($_POST["gelar"]);
    if(empty($input_gelar)){
    $gelar_err = "Tolong memasukkan gelar dengan benar.";     
    } elseif(!in_array($input_gelar, array("SMA", "SMK", "S1", "D3", "D4", "S2", "S3"))){
    $gelar_err = "Gelar yang dimasukkan tidak valid.";
    } else{
    $gelar = $input_gelar;
    }

    //tanggal masuk
    $input_tanggal_masuk = trim($_POST["tanggal_masuk"]);
    if(empty($input_tanggal_masuk)){
        $tanggal_masuk_err = "Tolong memasukkan nama kota dengan benar.";     
    } else{
        $tanggal_masuk = $input_tanggal_masuk;
    }
    // tanggal keluar
    // $input_tanggal_keluar = trim($_POST["tanggal_keluar"]);
    // if(empty($input_tanggal_keluar)){
    //     $tanggal_keluar_err = "Tolong memasukkan nama kota dengan benar.";     
    // } else{
    //     $tanggal_keluar = $input_tanggal_keluar;
    // }

    if(empty($nik_err) && empty($tanggal_masuk_err) && empty($nama_err) && empty($alamat_err) && empty($kota_err) && empty($gelar_err) && empty($gender_err) ){

        $sql = "INSERT INTO karyawan (nik , nama, alamat , tanggal_masuk , kota , gelar , gender ) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_nik, $param_nama, $param_alamat, $param_tanggal_masuk, $param_kota , $param_gelar, $param_gender);
            
            // Set parameters
            $param_nik = $nik;
            $param_nama = $nama;
            $param_alamat = $alamat;
            $param_tanggal_masuk = $tanggal_masuk;
            $param_kota = $kota;
            $param_gelar = $gelar;
            $param_gender = $gender;
            // $param_tanggal_keluar = $tanggal_keluar;
            // var_dump($gelar);
            // die();

            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "tolong refresh kembali.";
            }
        }         
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Input Karyawan Table</title>
</head>
<body>
<style>
   .wrapper{
            width: 600px;
            margin: 0 auto;
        }
</style>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Tolong isi data karyawan.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control <?php echo (!empty($nik_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nik; ?>">
                            <span class="invalid-feedback"><?php echo $nik_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control <?php echo (!empty($nama_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nama; ?>">
                            <span class="invalid-feedback"><?php echo $nama_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control <?php echo (!empty($alamat_err)) ? 'is-invalid' : ''; ?>"><?php echo $alamat; ?></textarea>
                            <span class="invalid-feedback"><?php echo $alamat_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" name="kota" class="form-control <?php echo (!empty($kota_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $kota; ?>">
                            <span class="invalid-feedback"><?php echo $kota_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>gelar {Tolong masukkan gelar S1, S2, S3 , D3, D4, SMA, SMK harus huruf balok}</label>
                            <input type="text" name="gelar" class="form-control <?php echo (!empty($gelar_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gelar; ?>">
                            <span class="invalid-feedback"><?php echo $gelar_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" required>
                                <option value="">gender</option>
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $gender_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Tanggal masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="<?php echo $tanggal_masuk; ?>">
                            <span class="invalid-feedback"><?php echo $tanggal_masuk_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>  
                </div>
            </div>        
        </div>
    </div>
</body> 
</html>