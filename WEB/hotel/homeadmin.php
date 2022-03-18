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
#footer {
	color: #FFF;
	background-color: #000;
}
#home {
	color: #FFF;
	background-color: #000;
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
    <td height="225" colspan="4" align="center" valign="top" bgcolor="#FFCC99"><h1 id="home">SELAMAT DATANG BEKERJA LAGI</h1>
    <p><img src="img/working.gif" width="97%"/></p></td>
  </tr>
  <tr>
    <td height="81" colspan="4" align="center" id="footer"><strong>©</strong>Copyright 2022</td>
  </tr>
</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>