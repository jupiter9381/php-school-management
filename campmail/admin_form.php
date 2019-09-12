<?
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//ADMIN_FORM.PHP - Authentication Form
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	
	<title>CcMail 1.0 - Administrator Page - Please Authenticate</title><link rel="stylesheet" type="text/css" href="style.css"></head>

<body>
<table border="0" cellpadding="6" cellspacing="1" class="max_table"><tr><td valign="middle" align="center">
<table cellpadding="0" cellspacing="0"><tr><td height="300" width="400">
<table class="menu_content_table" cellspacing="0" cellpadding="1"><tr><td width="100%" valign="top">
<table class="menu_content_table_bg" cellspacing="0" cellpadding="0"><tr><td valign="top" align="center">
<!--Menu body--><br><div class="standard">
<a href="http://www.cicoandcico.com/ccmail-10/"><img src="images/ccmail.gif" border="0" alt="CcMail 1.0"></a><br><br>
<b>Administrator Page - Please Authenticate</b>
<br>
<?php
if (isset($message) && $message != "") print "<font color=\"red\"><b>$message</b></font>";
?><br>

<table border="0" cellpadding="0" cellspacing="0"><tr>
<form action="protect.php" method="post">
<td align="right" height="40"><div class="standard"><b>Username:</b> &nbsp;</td><td><input class="tbox_max" type="text" name="username"></div></td></tr>
<tr><td align="right" height="40"><div class="standard"><b>Password:</b> &nbsp;</td><td><input class="tbox_max" type="password" name="password"></div></td></tr>
<tr><td colspan="2" align="right" height="60">
<input class="button" type="reset" value="Reset">
<input class="button_red" type="submit" value="Login"></form></td></tr></table>

<!--/Menu body-->
</div>
</td></tr></table>
</td></tr></table>
</td><td class="menu_lshadow" valign="top"><img src="images/shadow1.gif" border="0" alt="">
</td></tr>
<tr><td colspan="4" height="5">
<table class="menu_shadow" cellpadding="0" cellspacing="0"><tr>
<td align="left" width="14"><img border="0" src="images/shadow2.gif" alt=""></td>
<td width="100%"></td>
<td align="right" width="15"><img border="0" src="images/shadow4.gif" alt=""></td>
</tr></table></td></tr></table>
</td></tr></table>
</body>
</html>