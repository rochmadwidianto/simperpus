<?php
    include "koneksi.php";
  $id = $_GET['id'];
    mysql_query("DELETE FROM `tarif_ref` WHERE tarifId='$id'");

    header("location: tarif_view.php?tipe=list&msg=delete");
?>