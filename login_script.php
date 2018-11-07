<?php
include('koneksi.php');

if((isset($_POST['userUsername']) & isset($_POST['userPassword'])) || ((isset($_SESSION['user_name']) & isset($_SESSION['user_password'])))) {
    $username=$_POST["userUsername"];
    $password=$_POST["userPassword"]; 

    if ($koneksi) {
       	$sql = "SELECT * FROM user_login WHERE userUsername='".$username."' and userPassword='".$password."'";
       	$retval = mysql_query($sql , $koneksi);
		$data = mysql_fetch_assoc($retval);
       	$num_rows = mysql_num_rows($retval); //jika password n username ditemukan jumlah baris yang ditemukan 
       //berarti 1

	    if($num_rows==1) {
	       session_start();
	       $_SESSION["status"] = "login";
	       $_SESSION["user_id"] = $data['userId'];
	       $_SESSION["real_name"] = $data['userNama'];
	       $_SESSION["user_name"] = $data['userUsername'];
	       $_SESSION["user_password"] = $data['userPassword'];
	       $_SESSION["user_level"] = $data['userLevelId'];

	       header("Location: home.php");
	       die();
	 	}
	    else{
	       header("Location: login.php");
	       die();
		}
	} 
  	else
   		echo "Tidak dapat terkoneksi dengan database";
} else {
	header("Location: login.php");
	die();
}
?>
