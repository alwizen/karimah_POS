<?php
 $url  = 'http://localhost/karimah'; 
 $host = 'localhost';  
 $user = 'root';  
 $pass = 'BAba55ko';
 $name = 'karimah'; 

 $koneksi = new mysqli($host,$user,$pass,$name);  //koneksi Database

 //Check koneksi, berhasil atau tidak
 if( $koneksi->connect_error )
 {
  die( 'Oops!! Koneksi Gagal : '. $koneksi->connect_error );
 }

 $url = rtrim($url,'/');
 ?>
