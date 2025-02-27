<?php 
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
    crossorigin="anonymous">
</head>
<body>
    
    <section class="row">
        <div class="col-md-6 offset-md-3 align-self-center">
            <h1 class="text-center mt-4">Form Tambah Tugas</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="tugas" class="form-label">Tugas</label>
                    <input type="text" class="form-control" id="tugas" name="tugas" placeholder="Nama Tugas" required>
                </div>
                <div class="mb-3">
                    <label for="jangka_waktu" class="form-label">Jangka Waktu</label>
                    <input type="date" class="form-control" id="jangka_waktu" name="jangka_waktu" required>
                </div>
                <div class="mb-3">
                    <label for="prioritas" class="form-label">Prioritas</label>
                    <select class="form-control" id="prioritas" name="prioritas" required>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <input name="tambah" type="submit" class="btn btn-primary" value="Tambah">
                <a href="index.php" type="button" class="btn btn-info text-white">Kembali</a>
            </form>
        </div>
    </section>

    <?php
    if(isset($_POST['tambah'])){
        $tugas = mysqli_real_escape_string($koneksi, $_POST['tugas']);
        $jangka_waktu = mysqli_real_escape_string($koneksi, $_POST['jangka_waktu']);
        $prioritas = mysqli_real_escape_string($koneksi, $_POST['prioritas']);

        // Query SQL untuk insert data
        $query = "INSERT INTO ukk (tugas, jangka_waktu, prioritas) 
                  VALUES ('$tugas', '$jangka_waktu', '$prioritas')";

        $result = mysqli_query($koneksi, $query);

        if($result){
            header("location: index.php");
            exit(); // Tambahkan exit() agar header tidak error
        } else {
            echo "<script>alert('Data Gagal ditambahkan!');</script>";
        }
    }
    ?>
</body>
</html>

