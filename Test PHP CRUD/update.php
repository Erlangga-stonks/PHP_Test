<?php
require_once "connect.php";
$nik = $tanggal_masuk = $nama = $alamat = $tanggal_keluar = $kota = $gelar = $gender = "";
$nik_err = $tanggal_masuk_err = $nama_err = $alamat_err = $tanggal_keluar_err = $kota_err = $gelar_err = $gender_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    // validasi
    $id = $_POST['id'];

    // nik
    $input_nik = trim($_POST["nik"]);
    if(empty($input_nik)){
        $nik_err = "Tolong masukkan nik.";
    } elseif(!preg_match("/^[a-zA-Z0-9]{12}$/", $input_nik)){
        $nik_err = "Tolong masukkan nik yang benar.";
    } else{
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
        //tanggal keluar
        $input_tanggal_keluar = trim($_POST["tanggal_keluar"]);
        if(empty($input_tanggal_keluar)){
            $tanggal_keluar_err = "Tolong memasukkan nama kota dengan benar.";     
        }
        elseif($input_tanggal_keluar <= $input_tanggal_masuk){
            $tanggal_keluar_err = "Tanggal keluar tidak boleh sama atau kurang dari tanggal masuk";
        }
        else{
            $tanggal_keluar = $input_tanggal_keluar;
        }

    if(empty($nik_err) && empty($tanggal_masuk_err) && empty($nama_err) && empty($alamat_err) && empty($kota_err) && empty($gelar_err) && empty($gender_err) && empty($tanggal_keluar_err)){

        $sql = "UPDATE karyawan SET nik=?, nama=?, alamat=?, tanggal_masuk=? , kota=? , gelar=? , gender=? , tanggal_keluar=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssssi", $param_nik, $param_nama, $param_alamat, $param_tanggal_masuk, $param_kota , $param_gelar, $param_gender, $param_tanggal_keluar, $param_id);
            
            // Set parameters
            $param_nik = $nik;
            $param_nama = $nama;
            $param_alamat = $alamat;
            $param_tanggal_masuk = $tanggal_masuk;
            $param_kota = $kota;
            $param_gelar = $gelar;
            $param_gender = $gender;
            $param_tanggal_keluar = $tanggal_keluar;
            $param_id = $id;


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

else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        $sql = "SELECT * FROM karyawan WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
					$nik = $row["nik"];
                    $tanggal_masuk = $row["tanggal_masuk"];
                    $nama = $row["nama"];
                    $alamat = $row["alamat"];
                    $kota = $row["kota"];
                    $gelar = $row["gelar"];
                    $gender = $row["gender"];
                    $tanggal_keluar = $row["tanggal_keluar"];
                } else{
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "tolong refresh kembali.";
            }
        }
        mysqli_stmt_close($stmt);

    }  else{
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Employee Management System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.wrapper{
            width: 600px;
            margin: 0 auto;
        }
	</style>
<body>
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Tolong isi data karyawan.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="post">
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
                            <label>Tanggal masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control <?php echo (!empty($tanggal_masuk_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tanggal_masuk; ?>">
                            <span class="invalid-feedback"><?php echo $tanggal_masuk_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" name="kota" class="form-control <?php echo (!empty($kota_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $kota; ?>">
                            <span class="invalid-feedback"><?php echo $kota_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>gelar {Tolong masukkan gelar S1, S2, S3 , D3, D4, SMA, SMK saja}</label>
                            <input type="text" name="gelar" class="form-control <?php echo (!empty($gelar_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gelar; ?>">
                            <span class="invalid-feedback"><?php echo $gelar_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" required>
                                <!-- <option value=""></option> -->
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $gender_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Tanggal keluar</label>
                            <input type="date" name="tanggal_keluar" class="form-control <?php echo (!empty($tanggal_keluar_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tanggal_keluar; ?>">
                            <span class="invalid-feedback"><?php echo $tanggal_keluar_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>  
                </div>
            </div>        
        </div>
    </div>
    </body>
    </head>
    </html>