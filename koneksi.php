<?php
require "mysql_mysqli.inc.php";
/* 1. nama host */
$mysql_hostname = "localhost";
/* 2. nama user database */
$mysql_user = "root";
/* 3. password database */
$mysql_password = "localhost";
/* 4. nama database */
$mysql_database = "db_perpustakaan";
$prefix = "";

/* 5. koneksi */
$koneksi = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Tidak dapat terkoneksi dengan database");
mysql_select_db($mysql_database, $koneksi) or die("Tidak dapat memilih database");
?>
