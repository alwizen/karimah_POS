<?php
 $url  = 'http://localhost/karimah'; 
 $host = 'localhost';  
 $user = 'root';  
 $pass = 'BAba55ko';
 $name = 'hijabStore';  

 $koneksi = mysqli_connect($host,$user,$pass,$name);  //koneksi Database

 //Check koneksi, berhasil atau tidak
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
 $url = rtrim($url,'/');
 ?>
