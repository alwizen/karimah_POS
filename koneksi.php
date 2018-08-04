<?php

 $url    = 'http://localhost/karimah'; 
 $dbhost = 'localhost';  
 $dbuser = 'root';  
 $dbpass = 'BAba55ko';
 $dbname = 'karimah'; 


 $koneksi = new mysqli($dbhost,$dbuser,$dbpass,$dbname);  //koneksi Database

 //Check koneksi, berhasil atau tidak
 if( $koneksi->connect_error )
 {
  die( 'Oops!! Koneksi Gagal : '. $koneksi->connect_error );
 }

 $url = rtrim($url,'/');
 ?>
