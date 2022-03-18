<?php require_once('Connections/koneksi.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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
  $insertSQL = sprintf("INSERT INTO reservasi (nomor_pesanan, id_tamu, nama_tamu, tgl_check_in, tgl_check_out, nomor_kamar, jenis_kamar, fasilitas, harga, id_resepsionis) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nomor_pesanan'], "int"),
                       GetSQLValueString($_POST['id_tamu'], "int"),
                       GetSQLValueString($_POST['nama_tamu'], "text"),
                       GetSQLValueString($_POST['tgl_check_in'], "date"),
                       GetSQLValueString($_POST['tgl_check_out'], "date"),
                       GetSQLValueString($_POST['nomor_kamar'], "int"),
                       GetSQLValueString($_POST['jenis_kamar'], "text"),
                       GetSQLValueString($_POST['fasilitas'], "text"),
                       GetSQLValueString($_POST['harga'], "double"),
                       GetSQLValueString($_POST['id_resepsionis'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "printreservasi.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksi, $koneksi);
$query_reservasi = "SELECT * FROM reservasi";
$reservasi = mysql_query($query_reservasi, $koneksi) or die(mysql_error());
$row_reservasi = mysql_fetch_assoc($reservasi);
$totalRows_reservasi = mysql_num_rows($reservasi);
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
      <li><a href="hometamu.php">Home</a>        </li>
      <li><a href="kamar1.php" class="MenuBarItemSubmenu">Kamar</a>
        <ul>
          <li><a href="kamarsimple1.php">Simple Bedroom</a></li>
          <li><a href="kamardeluxe1.php">Deluxe Bedroom</a></li>
          <li><a href="kamarluxury1.php">Luxury Bedroom</a></li>
          </ul>
        </li>
      <li><a href="fasilitas1.php">Fasilitas</a>        </li>
      <li><a href="reservasi1.php">Reservasi</a></li></ul> </td>
    <td width="182" align="center" bgcolor="#D6D6D6"><a href="<?php echo $logoutAction ?>">LOG OUT</a></td>
  </tr>
  <tr>
    <td height="225" colspan="3" align="center" bgcolor="#CCCCCC">&nbsp;
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <h2>RESERVASI</h2>
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nomor Pesanan:</td>
            <td><input name="nomor_pesanan" type="text" value="" size="32" readonly="readonly" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID Tamu:</td>
            <td><input name="id_tamu" type="text" size="32" required=/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nama Tamu:</td>
            <td><input type="text" name="nama_tamu" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tgl Check In:</td>
            <td><input type="date" name="tgl_check_in" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tgl Check Out:</td>
            <td><input type="date" name="tgl_check_out" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nomor Kamar:</td>
            <td><input name="nomor_kamar" type="text" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Jenis Kamar:</td>
            <td><input type="text" name="jenis_kamar" value="" size="32" placeholder="Simple/Deluxe/Luxury Bedroom" required/></td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="middle" nowrap="nowrap">Fasilitas:</td>
            <td valign="baseline"><p>
              <input name="fasilitas" type="checkbox" id="fasilitas" value="AC" checked="checked" />
              <label for="fasilitas">AC</label>
            </p>
              <p>
                <input type="checkbox" name="fasilitas2" id="fasilitas2" value="TV"/>
                <label for="fasilitas">TV</label>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Harga:</td>
            <td><label for="harga"></label>
              <select name="harga" id="harga">
                <option value="400000">400000 - Simple Bedroom</option>
                <option value="600000">600000 - Deluxe Bedroom</option>
                <option value="900000">900000 - Luxury Bedroom</option>
            </select></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">ID Resepsionis:</td>
            <td><input name="id_resepsionis" type="text" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="center">&nbsp;</td>
            <td align="center"><input type="submit" value="BOOK" />
            <input type="reset" name="Reset" id="button" value="CANCEL" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td height="81" colspan="3">&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($reservasi);
?>