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

mysql_select_db($database_koneksi, $koneksi);
$query_tampilreservasi = "SELECT * FROM reservasi";
$tampilreservasi = mysql_query($query_tampilreservasi, $koneksi) or die(mysql_error());
$row_tampilreservasi = mysql_fetch_assoc($tampilreservasi);
$totalRows_tampilreservasi = mysql_num_rows($tampilreservasi);
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
<table width="1224" height="355" border="0" align="center">
  <tr>
    <td width="219" height="39" align="center" bgcolor="#CCCCCC"><h1>GOVAGO</h1></td>
    <td width="613" bgcolor="#CCCCCC"><ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="homeresepsionis.php">Home</a></li>
      <li><a href="tampilresepsionis.php" class="MenuBarItemSubmenu">Reservasi</a>
        <ul>
          <li><a href="pencarianresep.php">Pencarian Nama</a></li>
          <li><a href="pencarianresep2.php">Pencarian Check In</a></li>
        </ul>
      </li>
</ul> </td>
    <td width="182" align="center" bgcolor="#D6D6D6"><a href="<?php echo $logoutAction ?>">LOG OUT</a></td>
  </tr>
  <tr>
    <td height="225" colspan="3" align="center" valign="top" bgcolor="#999999"><h2>DATA RESERVASI
      </h2>
      <form id="search" name="form1" method="post" action="pencarianresep3.php">
Cari Berdasarkan Tanggal Check In:
        <label for="search"></label>
        <input name="search" type="text" id="search" size="40" />
      </form>
      <p>&nbsp;</p>
      <?php if ($totalRows_tampilreservasi > 0) { // Show if recordset not empty ?>
  <table width="100%" border="1">
    <tr>
      <td>nomor_pesanan</td>
      <td>id_tamu</td>
      <td>nama_tamu</td>
      <td>tgl_check_in</td>
      <td>tgl_check_out</td>
      <td>nomor_kamar</td>
      <td>jenis_kamar</td>
      <td>fasilitas</td>
      <td>harga</td>
      <td>id_resepsionis</td>
    </tr>
    <?php do { ?>
      <tr>
        <td height="27"><?php echo $row_tampilreservasi['nomor_pesanan']; ?></td>
        <td><?php echo $row_tampilreservasi['id_tamu']; ?></td>
        <td><?php echo $row_tampilreservasi['nama_tamu']; ?></td>
        <td><?php echo $row_tampilreservasi['tgl_check_in']; ?></td>
        <td><?php echo $row_tampilreservasi['tgl_check_out']; ?></td>
        <td><?php echo $row_tampilreservasi['nomor_kamar']; ?></td>
        <td><?php echo $row_tampilreservasi['jenis_kamar']; ?></td>
        <td><?php echo $row_tampilreservasi['fasilitas']; ?></td>
        <td><?php echo $row_tampilreservasi['harga']; ?></td>
        <td><?php echo $row_tampilreservasi['id_resepsionis']; ?></td>
      </tr>
      <?php } while ($row_tampilreservasi = mysql_fetch_assoc($tampilreservasi)); ?>
  </table>
  <?php } // Show if recordset not empty ?>    </td>
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
mysql_free_result($tampilreservasi);
?>
