<?php 
include 'koneksi.php';
?>
<!DOCTYPE html>
    <html>
    <head>
        <title>Cara Membuat Validasi Menghindari Duplicate Entry Menggunakan PHP</title>
    </head>
    <body>
        <form action="" method="post">
           <table>
               <tr>
                    <td>nama</td>
                   <td><input type="text" name="nama" placeholder="nama"></td>
               </tr>
               <tr>
                   <td>Username</td>
                   <td><input type="username" name="username" placeholder="username"></td>
               </tr>
               <tr>
                   <td>password</td>
                   <td><input type="password" name="password" placeholder="password"></td>
               </tr>
               <tr>
                   <td>Level</td>
                   <td><input type="text" name="level" placeholder="level"></td>
               </tr>
               <tr>
                    <td><input type="submit" name="simpan" value="simpan"></td>
                </tr>
           </table>
        </form>
    </body>
    </html>

     <?php
//proses
    if(isset($_POST['simpan'])) {
    $nama=$_POST['nama'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $level = $_POST['level'];
   
//script validasi data

    $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM users WHERE nama='$nama' or username='$username'"));
    if ($cek > 0){
    echo "<script>window.alert('nama atau username yang anda masukan sudah ada')
    window.location='index.php'</script>";
    }else {
    mysqli_query($koneksi,"INSERT INTO users(id, nama, username, password, level)
    VALUES ('','$nama','$username','$password')");

    echo "<script>window.alert('DATA SUDAH DISIMPAN')
    window.location='index.php'</script>";
    }
    }
    ?>