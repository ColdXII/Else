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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE kamar SET jenis_kamar=%s, harga_kamar=%s, jenis_kasur=%s WHERE nomor_kamar=%s",
                       GetSQLValueString($_POST['jenis_kamar'], "text"),
                       GetSQLValueString($_POST['harga_kamar'], "text"),
                       GetSQLValueString($_POST['jenis_kasur'], "text"),
                       GetSQLValueString($_POST['nomor_kamar'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "tampilkamar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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
    <td height="225" colspan="4" align="center" valign="top" bgcolor="#999999"><h1>EDIT DATA KAMAR
    </h1>
      <form method="post" name="form1" id="form1">
        <input type="hidden" name="nomor_kamar" value="<?php echo $row_tampilkamar['nomor_kamar']; ?>" />
  </form>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <table align="center">
        <tr valign="baseline">
          <td width="93" align="right" nowrap="nowrap">Nomor_kamar:</td>
          <td width="343"><?php echo $row_tampilkamar['nomor_kamar']; ?></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Jenis_kamar:</td>
          <td valign="baseline"><table>
            <tr>
              <td width="295"><input type="radio" name="jenis_kamar" value="Single Bedroom" <?php if (!(strcmp(htmlentities($row_tampilkamar['jenis_kamar'], ENT_COMPAT, 'utf-8'),"Single Bedroom"))) {echo "checked=\"checked\"";} ?> />
                Single Bedroom</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kamar" value="Deluxe Bedroom" <?php if (!(strcmp(htmlentities($row_tampilkamar['jenis_kamar'], ENT_COMPAT, 'utf-8'),"Deluxe Bedroom"))) {echo "checked=\"checked\"";} ?> />
                Deluxe Bedroom</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kamar" value="Luxury Bedroom" <?php if (!(strcmp(htmlentities($row_tampilkamar['jenis_kamar'], ENT_COMPAT, 'utf-8'),"Luxury Bedroom"))) {echo "checked=\"checked\"";} ?> />
                Luxury Bedroom</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Harga_kamar:</td>
          <td valign="baseline"><table>
            <tr>
              <td width="306"><input type="radio" name="harga_kamar" value="400000" <?php if (!(strcmp(htmlentities($row_tampilkamar['harga_kamar'], ENT_COMPAT, 'utf-8'),400000))) {echo "checked=\"checked\"";} ?> />
                400.000 - Simple Bedroom</td>
            </tr>
            <tr>
              <td><input type="radio" name="harga_kamar" value="600000" <?php if (!(strcmp(htmlentities($row_tampilkamar['harga_kamar'], ENT_COMPAT, 'utf-8'),600000))) {echo "checked=\"checked\"";} ?> />
                600.000 - Deluxe Bedroom</td>
            </tr>
            <tr>
              <td><input type="radio" name="harga_kamar" value="900000" <?php if (!(strcmp(htmlentities($row_tampilkamar['harga_kamar'], ENT_COMPAT, 'utf-8'),900000))) {echo "checked=\"checked\"";} ?> />
                900.000 - Luxury Bedroom</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Jenis_kasur:</td>
          <td valign="baseline"><table>
            <tr>
              <td width="286"><input type="radio" name="jenis_kasur" value="Simple" <?php if (!(strcmp(htmlentities($row_tampilkamar['jenis_kasur'], ENT_COMPAT, 'utf-8'),"Simple"))) {echo "checked=\"checked\"";} ?> />
                Simple</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kasur" value="Double" <?php if (!(strcmp(htmlentities($row_tampilkamar['jenis_kasur'], ENT_COMPAT, 'utf-8'),"Double"))) {echo "checked=\"checked\"";} ?> />
                Double</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kasur" value="Queen" <?php if (!(strcmp(htmlentities($row_tampilkamar['jenis_kasur'], ENT_COMPAT, 'utf-8'),"Queen"))) {echo "checked=\"checked\"";} ?> />
                Queen</td>
            </tr>
            <tr>
              <td><input type="radio" name="jenis_kasur" value="King" <?php if (!(strcmp(htmlentities($row_tampilkamar['jenis_kasur'], ENT_COMPAT, 'utf-8'),"King"))) {echo "checked=\"checked\"";} ?> />
                King</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Update record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form2" />
      <input type="hidden" name="nomor_kamar" value="<?php echo $row_tampilkamar['nomor_kamar']; ?>" />
    </form>
    <p>&nbsp;</p>
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
