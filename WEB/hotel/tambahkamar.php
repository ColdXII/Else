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
  $insertSQL = sprintf("INSERT INTO kamar (nomor_kamar, jenis_kamar, harga_kamar, jenis_kasur) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['nomor_kamar'], "int"),
                       GetSQLValueString($_POST['jenis_kamar'], "text"),
                       GetSQLValueString($_POST['harga_kamar'], "text"),
                       GetSQLValueString($_POST['jenis_kasur'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "tampilkamar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksi, $koneksi);
$query_tampilkamar = "SELECT * FROM kamar";
$tampilkamar = mysql_query($query_tampilkamar, $koneksi) or die(mysql_error());
$row_tampilkamar = mysql_fetch_assoc($tampilkamar);
$totalRows_tampilkamar = mysql_num_rows($tampilkamar);
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
<li><a href="homeadmin.php">Home</a></li>
      <li><a href="tampilkamar.php">Kamar</a></li>
      <li><a href="tampilfkamar.php">Fasilitas Kamar</a></li>
      <li><a href="tampilreservasi.php">Fasilitas Hotel</a></li>
    </ul> </td>
    <td width="182" bgcolor="#CCCCCC">Search</td>
    <td width="182" align="center" bgcolor="#D6D6D6"><a href="<?php echo $logoutAction ?>">LOG OUT</a></td>
  </tr>
  <tr>
    <td height="225" colspan="4" align="center" valign="top" bgcolor="#999999"><h1>TAMBAH DATA KAMAR
    </h1>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table align="center">
        <tr valign="baseline">
          <td width="93" align="right" valign="middle" nowrap="nowrap">Nomor Kamar:</td>
          <td width="421"><input name="nomor_kamar" type="text" value="" size="32" readonly="readonly" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap="nowrap">Jenis Kamar:</td>
          <td valign="baseline"><table>
            <tr>
              <td width="356"><input name="jenis_kamar" type="radio" value="Simple Bedroom" checked="checked" />
                Simple Bedroom</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kamar" value="Deluxe Bedroom" />
                Deluxe Bedroom</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kamar" value="Luxury Bedroom" />
                Luxury Bedroom</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap="nowrap">Harga Kamar:</td>
          <td valign="baseline"><table>
            <tr>
              <td width="420"><input name="harga_kamar" type="radio" value="400000" checked="checked" />
                400.000 - Simple Bedroom</td>
            </tr>
            <tr>
              <td><input type="radio" name="harga_kamar" value="600000" />
                600.000 - Deluxe Bedroom</td>
            </tr>
            <tr>
              <td><input type="radio" name="harga_kamar" value="900000" />
                900.000 - Luxury Bedroom</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap="nowrap">Jenis Kasur:</td>
          <td valign="baseline"><table>
            <tr>
              <td width="269"><input name="jenis_kasur" type="radio" value="Single" checked="checked" />
                Single</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kasur" value="Double" />
                Double</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kasur" value="Queen" />
                Queen</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kasur" value="King" />
                King</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td colspan="2" align="center" nowrap="nowrap"><input type="submit" value="ADD" /></td>
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
mysql_free_result($tampilkamar);
?>
