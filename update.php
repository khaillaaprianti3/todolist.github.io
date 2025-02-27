<?php 
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Update Data Tugas</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
   rel="stylesheet" 
   integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
   crossorigin="anonymous">
</head>
<body>

    <?php 
    // Ambil data dari parameter URL browser
    $id = $_GET['id'];

    // Sanitasi input id untuk mencegah SQL Injection
    $id = mysqli_real_escape_string($koneksi, $id);

    // Query untuk mengambil data berdasarkan ID
    $query = "SELECT * FROM ukk WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    // Cek jika data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    ?>

    <section class="row">
        <div class="col-md-6 offset-md-3 align-self-center">
            <h1 class="text-center mt-4">Form Update Tugas</h1>
            <form method="POST">
                <!-- Inputan tersembunyi untuk menyimpan ID -->
                <input type="hidden" value="<?= $data['id'] ?>" name="id">
                
                <div class="mb-3">
                    <label for="tugas" class="form-label">Tugas</label>
                    <input type="text" class="form-control" id="tugas" value="<?= $data['tugas'] ?>" name="tugas" placeholder="Nama Tugas" required>
                </div>
                <div class="mb-3">
                    <label for="jangka_waktu" class="form-label">Jangka Waktu</label>
                    <input type="date" class="form-control" id="jangka_waktu" value="<?= $data['jangka_waktu'] ?>" name="jangka_waktu" required>
                </div>
                <div class="mb-3">
                    <label for="prioritas" class="form-label">Prioritas</label>
                    <select class="form-control" id="prioritas" name="prioritas" required>
                        <option value="Low" <?= $data['prioritas'] == 'Low' ? 'selected' : '' ?>>Low</option>
                        <option value="Medium" <?= $data['prioritas'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                        <option value="High" <?= $data['prioritas'] == 'High' ? 'selected' : '' ?>>High</option>
                    </select>
                </div>
                
                <input name="update" type="submit" class="btn btn-primary" value="Update">
                <a href="index.php" type="button" class="btn btn-info text-white">Kembali</a>
            </form>
        </div>
    </section>
    
    <?php 
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href = 'index.php';</script>";
    }
    ?>

    <?php 
    // Kondisi jika tombol Update diklik
    if(isset($_POST['update'])){
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $tugas = mysqli_real_escape_string($koneksi, $_POST['tugas']);
        $jangka_waktu = mysqli_real_escape_string($koneksi, $_POST['jangka_waktu']);
        $prioritas = mysqli_real_escape_string($koneksi, $_POST['prioritas']);

        // Query untuk update data
        $query = "UPDATE ukk 
                  SET tugas = '$tugas', jangka_waktu = '$jangka_waktu', prioritas = '$prioritas' 
                  WHERE id = '$id'";

        $result = mysqli_query($koneksi, $query);

        if($result){
            header("location: index.php");
            exit(); // Tambahkan exit() agar header tidak error
        } else {
            echo "<script>alert('Data Gagal diupdate!')</script>";
        }
    }
    ?>
</body>
</html>
