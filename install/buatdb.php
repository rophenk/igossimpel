<?php
	 // ambil variabel
	 include "../config.php";
     // buat database
     $conn = mysql_connect($hostname,$username,$password)
             or die("Koneksi database GAGAL !");

    // nama databse yang akan dibuat
    $sql = "CREATE DATABASE ".$database;
    $hasil = mysql_query($sql,$conn);
	
    if ($hasil)
       {
       echo "<center><h1>Database <b>".$database."</b> berhasil dibuat</h1><br></center>";
       $link = '<a href="buattabel.php">Lanjut ke tahap 2</a>';
       }
       else
       {
       echo "Tidak dapat membuat database ".$database." <br>".mysql_error();
       }
?>
<html>
<head>
<title>Database Dibuat</title>
<link href="main.css" type="text/css" rel="stylesheet">
</head>
<body><center><?php echo $link; ?></center>
</body>
</html>