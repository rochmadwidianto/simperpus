<?php
  	include "koneksi.php";
	$id = $_GET['id'];
    mysql_query("DELETE FROM `buku_ref` WHERE bukuId='$id'");

    header("location: buku_view.php?tipe=list&msg=delete");
?>