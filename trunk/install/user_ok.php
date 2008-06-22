<?php 
include "../config.php";

$passid = $_POST['passid'];
$idsiswa = $_POST['idsiswa'];
$password1 = $_POST['password'];
$password2 = md5($password1);
$status = $_POST['status'];
   
mysql_connect($hostname, $username, $password)
                or die("Salah server, nama pengguna, atau passwordnya");
mysql_select_db($database) or die ("<b>Tidak dapat memilih database</b><br>" .mysql_error());

$input1 = "insert into password (passid, idsiswa, password, status) values ('".$passid."', '".$idsiswa."', '".$password2."', '".$status."')";
$hasil_1 = mysql_query($input1) or die (mysql_error());  
?>
<html>
<head>
<title>Input Berhasil</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="main.css" type="text/css" rel="stylesheet">
</head>

<body>
<h1 align="center">PASSWORD ANDA </h1>
<table width="209" height="47" border="0" align="center">
  <tr>
    <td><div align="right">Username :</div></td>
    <td><strong><?php echo $_POST['idsiswa']; ?></strong></td>
  </tr>
  <tr>
    <td><div align="right">Password : </div></td>
    <td><strong><?php echo $_POST['password']; ?></strong></td>
  </tr>
</table>
<div align="center">PERHATIAN ! Harap diingat baik-baik. Anda memerlukan password ini untuk LOGIN <br>
</div>
<p align="center"><a href="selesai.html">Lanjut Ke Langkah Selanjutnya </a></p>
<p>&nbsp; </p>
</body>
</html>
