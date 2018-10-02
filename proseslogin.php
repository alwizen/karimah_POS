<?php
session_start(); //memulai session

//check apakah ada akses post dari halaman login?, jika tidak kembali kehalaman depan
if( !isset($_POST['username']) ) { header('location:index.php'); exit(); }
$error = ''; //set nilai default dari error,

require ( 'koneksi.php' );
$username = trim( $_POST['username'] );
$password = trim( $_POST['password'] );

if( strlen($username) < 2 )
{
 //validasi username tidak boleh kosong
 $error = '<script>alert(\'Login Gagal, Username tidak boleh kosong!! \')</script>';
}else if( strlen($password) < 2 )
{
 //validasi password tidak boleh kosong
 $error = '<script>alert(\'Login Gagal, Password tidak boleh kosong!! \')</script>';
}else{
 //mengubah semua karakter ke bentuk string
 $username = $koneksi->escape_string($username);
 $password = $koneksi->escape_string($password);

 //hash dengan md5
 $password = ($password);

 //SQL command untuk memilih data berdasarkan parameter $username dan $password yang diinputkan
 $sql = "SELECT nama, level FROM users WHERE username='$username' AND password='$password' LIMIT 1";

 //melakukan perintah
 $query = $koneksi->query($sql);

 //check query
 if( !$query )
 {
  die( 'Oops!! Sepertinya ada kesalahan database '. $koneksi->error );
 }

 //check hasil perintah
 if( $query->num_rows == 1 )
 {
  //jika data yang dimaksud ada maka akan ditampilkan
  $row =$query->fetch_assoc();

  //data nama disimpan di session browser
  $_SESSION['nama_u'] = $row['nama']; // hak akses kasir
  $_SESSION['akses']  = $row['level'];

  if( $row['level'] === 'admin')
  {
   //data hak Admin di set
   $_SESSION['saya_admin']= 'TRUE';
  }

  //menuju halaman sesuai hak akses
  header('location:'.$url.'/'.$_SESSION['akses'].'/');
  exit();

 }else{

  //jika data yang dimaksud tidak ada
   $error = '<script>alert(\'Login Gagal, Username dan Password tidak ditemukan !!! \')</script>';
 }

}

if( !empty($error) )
{
 //simpan error pada session
 $_SESSION['error'] = $error;
 header('location:'.$url.'/');
 exit();
}
?>