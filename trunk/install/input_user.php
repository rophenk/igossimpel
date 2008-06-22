<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Tambah User</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="main.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<div align="center">
  <h1>Input User dan Password </h1>
  
<fieldset> 
<legend><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Tambah User</font></legend>
  <form method="POST" name="form1" action="user_ok.php">
    <table width="286" align="center">
      <tr valign="baseline">
        <td width="77" align="right" nowrap bgcolor="#666666"><span class="style1">Username :</span></td>
        <td width="197" align="left" bgcolor="#FFFFFF"><input type="text" name="idsiswa" value="" size="15"  class="text"></td>
      </tr>
      <tr valign="baseline">
        <td align="right" nowrap bgcolor="#666666"><span class="style1">Password :</span></td>
        <td align="left" bgcolor="#FFFFFF"><input type="password" name="password" value="" size="15"  class="text"></td>
      </tr>
      <tr valign="baseline">
        <td align="right" nowrap bgcolor="#666666"><span class="style1">Status :</span></td>
        <td align="left" bgcolor="#FFFFFF">
          <select name="status"  class="text">
            <option value="null" >----------</option>
            <option value="admin" selected >admin</option>
            <option value="guru" >guru</option>
          </select>        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td align="left"><input type="submit" class="button" value="Tambah User"></td>
      </tr>
    </table>
    <input name="passid" type="hidden" value="null">
  </form>
  <p></fieldset></p>
</div>
</body>
</html>
