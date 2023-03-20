<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Show data karyawan</title>
    <style>
            .wrapper{
                width: 600px;
                margin: 0 auto;
            }
            table tr td:last-child{
                width: 120px;
            }
    </style>
    <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
    </script>
</head>
<body>
        <section>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Jumlah Data karyawan gender berdasarkan gelar</h2>
                            <?php

                            require_once "connect.php";
                            $sql = "SELECT gelar, 
                                  SUM(CASE WHEN gender = 'L' THEN 1 ELSE 0 END) AS jumlah_laki, 
                                   SUM(CASE WHEN gender = 'P' THEN 1 ELSE 0 END) AS jumlah_perempuan
                                  FROM karyawan
                                  GROUP BY gelar";
                            $result = mysqli_query($conn, $sql);


                            if (mysqli_num_rows($result) > 0) {
                                     echo '<table class="table table-bordered table-striped">';
                                     echo "<thead>";
                                     echo "<tr><th>Gelar</th><th>Laki-laki</th><th>Perempuan</th></tr>";
                            while($row = mysqli_fetch_assoc($result)) {
                                     echo "<tr><td>" . $row["gelar"] . "</td><td>" . $row["jumlah_laki"] . "</td><td>" . $row["jumlah_perempuan"] . "</td></tr>";
                                }
                                     echo "</table>";
                                } else {
                                     echo "Tidak ada data.";
                                }
                            ?>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
        </section>
        <section>
            <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Data Karyawan</h2>
                            <a href="input.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add data karyawan</a>
                        </div>
                        <?php
                        // memanggil koneksi
                        require_once "connect.php";                  
                        $sql = "SELECT * FROM karyawan";
                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>Id</th>"; 
                                            echo "<th>NIK</th>";
                                            echo "<th>Tanggal <br> Masuk</th>";
                                            echo "<th>Nama</th>";
                                            echo "<th>Alamat</th>";
                                            echo "<th>Kota</th>";
                                            echo "<th>Gelar</th>";
                                            echo "<th>gender</th>";
                                            echo "<th>Tanggal <br> Keluar</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        $tanggal_masuka = $row['tanggal_masuk'];
                                        $tanggal_keluara = $row['tanggal_keluar'];
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['nik'] . "</td>"; 
                                            echo "<td>" . date("d/m/Y", strtotime($tanggal_masuka)) . "</td>"; 
                                            echo "<td>" . $row['nama'] . "</td>";
                                            echo "<td>" . $row['alamat'] . "</td>";
                                            echo "<td>" . $row['kota'] . "</td>";
                                            echo "<td>" . $row['gelar'] . "</td>";
                                            echo "<td>" . $row['gender'] . "</td>";
                                            if($tanggal_keluara == NULL){
                                                echo "<td>" . " " . "</td>";
                                            }else{

                                                echo "<td>" . date("d/m/Y", strtotime($tanggal_keluara)) . "</td>";
                                            }
                                            echo "<td>";
                                                echo '<a href="baca.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="delete.php?id='. $row['id'] .'" class="mr-3" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";   
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>tidak ada data yang ditemukan.</em></div>';
                            }
                        } else{
                            echo "tolong refresh kembali.";
                        }
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>        
            </div>
        </div>
        </section>
</body>
</html>