<?php
  	include "koneksi.php";
	$id = $_GET['id'];
    mysql_query("DELETE FROM `anggota_ref` WHERE anggotaId='$id'");

    header("location: anggota_view.php?tipe=list&msg=delete");
?>