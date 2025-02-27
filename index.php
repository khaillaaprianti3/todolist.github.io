<?php 
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body><style>
    body {
        background-color:rgb(132, 232, 250); /* Warna solid untuk latar belakang */
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    section {
        background-color: #ffffff; /* Warna putih untuk kotak */
        border-radius: 10px; /* Sudut melengkung */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Bayangan kotak */
        padding: 30px; /* Jarak dalam diperbesar */
        max-width: 1100px; /* Maksimal lebar section */
        width: 70%; /* Ambil hampir seluruh lebar layar */
        min-height: 400px; /* Tinggi minimum */
    }

    h1 {
        color: #333; /* Warna teks di dalam kotak */
        text-shadow: none;
        margin-bottom: 20px; /* Jarak bawah heading lebih kecil */
        text-align: center;
    }

    table {
        width: 95%; /* Lebar tabel diperbesar hingga hampir memenuhi section */
        margin: 0 auto; /* Pusatkan tabel */
        border-collapse: collapse; /* Hilangkan jarak antar sel */
    }

    table th, table td {
        text-align: center; /* Pusatkan teks dalam sel */
        padding: 20px; /* Jarak dalam sel lebih besar */
        border: 1px solid #ddd; /* Tambahkan garis batas antar sel */
        font-size: 16px; /* Ukuran font lebih besar */
    }

    table thead {
        background-color: #f4f4f4; /* Warna latar belakang header tabel */
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

td, th {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
 
</style>
<section class="row">
    <div class="col-md-8 offset-md-2 align-self-center">
        <h1 class="text-center mt-4 mb-4">Todo List Khailla</h1>
        <a href="tambah.php" class="btn btn-primary mb-3">Tambah</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tugas</th>
                    <th scope="col">Jangka Waktu</th>
                    <th scope="col">Prioritas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $query = "SELECT * FROM ukk";
                $result = mysqli_query($koneksi, $query);

                if (!$result) {
                    echo "<tr><td colspan='5' class='text-center'>Error: " . mysqli_error($koneksi) . "</td></tr>";
                } else {
                    foreach ($result as $data) {
                        echo "
                            <tr>
                                <th scope='row'>". htmlspecialchars($no++) ."</th>
                                <td><input type='checkbox' name='select_task' value='". htmlspecialchars($data["id"]) ."'></td>
                                <td>". htmlspecialchars($data["tugas"]) ."</td>
                                <td>". htmlspecialchars($data["jangka_waktu"]) ."</td>
                                <td>". htmlspecialchars($data["prioritas"]) ."</td>
                                <td>
                                    <a href='update.php?id=". htmlspecialchars($data["id"]) ."' class='btn btn-success'>Update</a>
                                    <a href='delete.php?id=". htmlspecialchars($data["id"]) ."' class='btn btn-danger' onclick=\"return confirm('Yakin Hapus?')\">Hapus</a>
                                 </td>
                            </tr>
                        ";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>


