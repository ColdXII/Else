<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tamu (id_tamu, nama_tamu, nik, JK, no_hp, alamat, username, password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_tamu'], "int"),
                       GetSQLValueString($_POST['nama_tamu'], "text"),
                       GetSQLValueString($_POST['nik'], "text"),
                       GetSQLValueString($_POST['JK'], "text"),
                       GetSQLValueString($_POST['no_hp'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "logintamu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksi, $koneksi);
$query_tamu = "SELECT * FROM tamu";
$tamu = mysql_query($query_tamu, $koneksi) or die(mysql_error());
$row_tamu = mysql_fetch_assoc($tamu);
$totalRows_tamu = mysql_num_rows($tamu);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	background-image: url(img/background.jpg);
	background-repeat: no-repeat;
	background-attachment:fixed;
	background-position:center;
	background-size:cover;
}
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
</head>

<body>
<table width="1224" height="355" border="1" align="center">
  <tr>
    <td width="219" height="39" align="center" bgcolor="#CCCCCC"><h1>GOVAGO</h1></td>
    <td width="613" bgcolor="#CCCCCC"><ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="index.php">Home</a>        </li>
      <li><a href="kamar.php" class="MenuBarItemSubmenu">Kamar</a>
        <ul>
          <li><a href="kamarsimple.php">Simple Bedroom</a></li>
          <li><a href="kamardeluxe.php">Deluxe Bedroom</a></li>
          <li><a href="kamarluxury.php">Luxury Bedroom</a></li>
        </ul>
      </li>
      <li><a href="fasilitas.php">Fasilitas</a>        </li>
      <li><a href="reservasi.php">Reservasi</a></li></ul> </td>
    <td width="182" bgcolor="#CCCCCC">Search</td>
    <td width="182" align="center" bgcolor="#D6D6D6"><a href="loginawal.php">LOGIN</a></td>
  </tr>
  <tr>
    <td height="225" colspan="4" align="center" bgcolor="#CCCCCC"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <h2>REGISTRASI TAMU</h2>
        <table align="center">
          <tr valign="baseline">
            <td align="center" valign="middle" nowrap="nowrap">ID Tamu:</td>
            <td><input name="id_tamu" type="text" size="32" readonly="readonly" /></td>
          </tr>
          <tr valign="baseline">
            <td align="center" valign="middle" nowrap="nowrap">Nama Tamu:</td>
            <td><input type="text" name="nama_tamu" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td align="center" valign="middle" nowrap="nowrap">NIK:</td>
            <td><input type="text" name="nik" value="" size="32"  required/></td>
          </tr>
          <tr valign="baseline">
            <td align="center" valign="middle" nowrap="nowrap">JK:</td>
            <td>
            <p>
              <input name="JK" type="text" id="JK" placeholder="L/P" value="" size="32" maxlength="1" required/>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td align="center" valign="middle" nowrap="nowrap">No HP:</td>
            <td>              <input type="text" name="no_hp" value="" size="32"  required/></td>
          </tr>
          <tr valign="baseline">
            <td align="center" valign="middle" nowrap="nowrap">Alamat:</td>
            <td><textarea name="alamat" cols="32"></textarea></td>
          </tr>
          <tr valign="baseline">
            <td align="center" valign="middle" nowrap="nowrap">Username:</td>
            <td><input type="text" name="username" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td align="center" valign="middle" nowrap="nowrap">Password:</td>
            <td><input type="text" name="password" value="" size="32" required/></td>
          </tr>
          <tr align="center" valign="baseline">
            <td nowrap="nowrap">&nbsp;</td>
            <td nowrap="nowrap"><input name="DAFTAR" type="submit" id="DAFTAR" value="DAFTAR" /> 
                            <input type="reset" name="Reset" id="button" value="CANCEL" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td height="81" colspan="4">&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($tamu);
?>
