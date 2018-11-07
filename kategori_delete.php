<?php
  	include "koneksi.php";
	$id = $_GET['id'];
    mysql_query("DELETE FROM `kategori_buku_ref` WHERE kategoriBukuId='$id'");

    header("location: kategori_view.php?tipe=list&msg=delete");
?>