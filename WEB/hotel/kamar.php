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
<table width="100%" height="355" border="0" align="center">
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
    <td width="182" align="center" bgcolor="#D6D6D6"><a href="loginawal.php">LOGIN</a></td>
  </tr>
  <tr>
    <td height="225" colspan="3" align="center" bgcolor="#CCCC99">
    <div> <a href="kamarsimple.php"><img src="img/simple bedroom.jpg" width="90%" /></a></div>
    <div> <a href="kamardeluxe.php"><img src="img/deluxe bedroom.jpg" width="90%" /></a></div>
    <div> <a href="kamarluxury.php"><img src="img/luxury bedroom.jpg" width="90%" /></a></div>
    </td>
  </tr>
  <tr>
    <td height="81" colspan="3" align="center" bgcolor="#000000" id="FOOTER"><strong>©</strong>Copyright 2022</td>
  </tr>
</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>