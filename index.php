<?php 
session_start();
include('koneksi.php');
include('login_script.php');

if(strtoupper($_SESSION['status']) == 'LOGIN'){
	include('home.php');
}else{
	include('login.php');
}
 ?>
