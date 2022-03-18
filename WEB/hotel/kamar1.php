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
<title>Kamar</title>
<style type="text/css">
body {
	background-image: url(img/background.jpg);
	background-repeat: no-repeat;
	background-attachment:fixed;
	background-position:center;
	background-size:cover;
}
#FOOTER {
	color: #FFF;
}
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
</head>

<body>
<table width="100%" height="355" border="1" align="center">
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
    <td width="182" bgcolor="#CCCCCC">Search</td>
    <td width="182" align="center" bgcolor="#D6D6D6"><a href="<?php echo $logoutAction ?>">LOG OUT</a></td>
  </tr>
  <tr>
    <td height="225" colspan="4" align="center" bgcolor="#CCCC99">
    <div> <a href="kamarsimple1.php"><img src="img/simple bedroom.jpg" width="90%" /></a></div>
    <div> <a href="kamardeluxe1.php"><img src="img/deluxe bedroom.jpg" width="90%" /></a></div>
    <div> <a href="kamarluxury1.php"><img src="img/luxury bedroom.jpg" width="90%" /></a></div>
    </td>
  </tr>
  <tr>
    <td height="81" colspan="4" align="center" bgcolor="#000000" id="FOOTER"><strong>©</strong>Copyright 2022</td>
  </tr>
</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>