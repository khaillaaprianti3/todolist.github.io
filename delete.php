<?php

  include "koneksi.php";

  $id = $_GET['id'];
  $query = "DELETE FROM ukk  WHERE id = $id";
  $result = mysqli_query($koneksi, $query);
  if($result){
    header("location: index.php");
  }

?>
