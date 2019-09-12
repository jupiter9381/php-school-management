<!--
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

INDEX.PHP - This is only an example of how you can integrate CcMail 
panel into a php page (see below)
-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	
	<title>CcMail 1.0 - User panel</title><link rel="stylesheet" type="text/css" href="style.css"></head>
<body>
<br>
<table width="99%" border="0" cellpadding="0" cellspacing="0"><tr>
	<td align="left"><a href="http://www.cicoandcico.com/products.php?option=ccmail"><img border="0" width="208" height="69" src="images/ccmail.gif" alt="CcMail homepage"></a></td>
	</tr></table>
<!--separator--> 
	<table class="separator"><tr><td></td></tr></table>
<center>
<!--UP-BAR-->
	<table class="index" cellpadding="0" cellspacing="0">
	<tr align="center">
	<!--INDEX-->
		<td align="left" class="header"></td>
		<td class="spacer"></td>
		<td class="tab"></td>
		<td valign="middle" width="10"><?php print "<a href=\"?action=\" class=\"main\" title=\"Subscribe/Unsubscribe panel\">&nbsp;Main&nbsp;</a>";?></td>
		<td class="tab"></td>
		<td valign="middle" width="10"><a href="http://www.cicoandcico.com/download/download.php?SortBy=1&fdir=./ccmail/" class="main">&nbsp;Download&nbsp;page&nbsp;</a></td>
		<td class="tab"></td>
		<td valign="middle" width="10"><a href="http://www.cicoandcico.com/guestbook/sign.php" class="main">&nbsp;Support&nbsp;</a></td>
		<td class="tab"></td>
<!--FLAGS AND FOOTER-flags differs from italian to english version-->
	<td>   </td>
	<td align="right"><a href="admin.php" class="main" title="Administrator Area">&nbsp;Admin&nbsp;</a></td>
		<td align="right" class="footer"></td>
</tr>
</table>
<!--MAIN TABLE-->
<table class="main_table" cellpadding="0" cellspacing="0"><tr valign="top"><td align="center" width="19%" valign="top">
<table class="max_table" cellpadding="0" cellspacing="0"><tr>
<td height="5%" align="center" width="100%" valign="top">
	<!--*********MENU*********-->
	<table class="menu_button" cellpadding="0" cellspacing="0"><tr>
	<td align="left" height="31" width="32"><img src="images/head.png" border="0" alt=""></td>
	<td height="31" width="100%" align="center" valign="middle">
	<a class="menu_title">Menu</a></td>
	<td height="31" align="right" width="29"><img src="images/foot.png" border="0" alt=""></td>
	<td height="31" width="5"><img src="images/shadow1.gif" border="0" alt=""></td>
	</tr>
		<tr><td colspan="3">
		<table class="menu_content_table" cellspacing="0" cellpadding="1"><tr><td width="100%" valign="top">
		<table class="menu_content_table_bg" cellspacing="0" cellpadding="0"><tr><td valign="top">
		<div class="menu">
		<!--Menu body-->
		<b>CcMail 1.0</b><br>
		<center>
		<table border="0" cellpadding="0" cellspacing="0"><tr>
		<td><div class="menu">
		<b>&bull; </b><a href="http://www.cicoandcico.com/products.php?option=ccmail" class="link">CcMail Homepage</a><br>
		<b>&bull; </b><a href="http://www.cicoandcico.com/download/download.php?SortBy=1&fdir=./ccmail/" class="link">Download CcMail</a><br>
		<b>&bull; </b><a href="http://www.google.com/" class="link">Search the web</a><br><br>
		</td></tr></table></center>
		<b>Support</b><br>
		<center>
		<table border="0" cellpadding="0" cellspacing="0"><tr>
		<td><div class="menu">
		<b>&bull; </b><a href="http://www.cicoandcico.com/guestbook/sign.php" class="link">CcMail guestbook</a><br><br></td></tr></table></center><!--/Menu body-->
		</div>
		</td></tr></table>
		</td></tr></table>
	</td><td class="menu_lshadow">
	</td></tr>
	<tr><td colspan="4" height="5">
		<table class="menu_shadow" cellpadding="0" cellspacing="0"><tr>
		<td align="left" width="14"><img border="0" src="images/shadow2.gif" alt=""></td>
		<td width="100%"></td>
		<td align="right" width="15"><img border="0" src="images/shadow4.gif" alt=""></td>
		</tr></table>
	</td></tr></table>
	<!--*********/MENU*********-->
	</td></tr>
	<tr>
	<td height="5%" align="center" width="100%" valign="top">
	<!--*********MENU*********-->
	<table class="menu_button" cellpadding="0" cellspacing="0"><tr>
	<td align="left" height="31" width="32"><img src="images/head.png" border="0" alt=""></td>
	<td height="31" width="100%" align="center" valign="middle">
	<a class="menu_title">License</a></td>
	<td align="right" width="29" height="31"><img border="0" src="images/foot.png" alt=""></td>
	<td height="31" width="5"><img src="images/shadow1.gif" border="0" alt=""></td>
	</tr>
	<tr><td colspan="3">
		<table class="menu_content_table" cellspacing="0" cellpadding="1"><tr><td width="100%" valign="top">
		<table class="menu_content_table_bg" cellspacing="0" cellpadding="0"><tr><td valign="top">
		<div class="menu">
		<!--Menu body-->CcMail is under <a href="http://www.gnu.org/licenses/gpl.txt" class="link">GPL</a> license. Sources can be freely distributed, and usage is totally free.
		<br><br><!--/Menu body-->
		</div>
		</td></tr></table>
		</td></tr></table>
	</td><td class="menu_lshadow">
	</td></tr>
	<tr><td colspan="4" height="5">
		<table class="menu_shadow" cellpadding="0" cellspacing="0"><tr>
		<td align="left" width="14"><img border="0" src="images/shadow2.gif" alt=""></td>
		<td width="100%"></td>
		<td align="right" width="15"><img border="0" src="images/shadow4.gif" alt=""></td>
		</tr></table>
	</td></tr></table>
	<!--*********/MENU*********-->
	</td></tr>
	<tr>
	<td height="85%" align="center" width="100%" valign="top">
	<!--*********MENU*********-->
	<table class="menu_button" cellpadding="0" cellspacing="0"><tr>
	<td align="left" height="31" width="32"><img src="images/head.png" border="0" alt=""></td>
	<td height="31" width="100%" align="center" valign="middle">
	<a class="menu_title">About</a></td>
	<td align="right" width="29" height="31"><img border="0" src="images/foot.png" alt=""></td>
	<td height="31" width="5"><img src="images/shadow1.gif" border="0" alt=""></td>
	</tr>
	<tr><td colspan="3">
		<table class="menu_content_table" cellspacing="0" cellpadding="1"><tr><td width="100%" valign="top">
		<table class="menu_content_table_bg" cellspacing="0" cellpadding="0"><tr><td valign="top">
		<div class="menu">
		<!--Menu body-->
		<b>CcMail <?php include ("ccmail_version"); print $ccmail_version ?></b><br><br>
		<b>Lead Programmer:</b><br>
		&nbsp; &nbsp; &bull; Emanuele Guadagnoli<br><br>
		<b>Report Bugs or Wishes</b><br>
		&nbsp; &nbsp; &bull; <a href="http://www.cicoandcico.com/guestbook/sign.php" class="link">Sign CcMail Guestbook</a><br><br>
		<b>Support CcMail</b><br>
		&nbsp; &nbsp; &bull; <a href="http://www.hotscripts.com/Detailed/43672.html" class="link">Rate at Hotscripts.com</a><br><br><!--/Menu body-->
		</div>
		</td></tr></table>
		</td></tr></table>
	</td><td class="menu_lshadow">
	</td></tr>
	<tr><td colspan="4" height="5">
		<table class="menu_shadow" cellpadding="0" cellspacing="0"><tr>
		<td align="left" width="14"><img border="0" src="images/shadow2.gif" alt=""></td>
		<td width="100%"></td>
		<td align="right" width="15"><img border="0" src="images/shadow4.gif" alt=""></td>
		</tr></table>
	</td></tr></table>
	<!--*********/MENU*********-->
	</td></tr></table>
	</td>
	<td valign="top">
<table border="0" cellpadding="6" cellspacing="1" class="max_table"><tr><td width="64%" valign="top">
<!--******************BODY******************-->
<div class="standard">
<b>Welcome to CcMail 1.0!</b> The displayed form allows you to Subscribe to this site's Mailing List.<br>
You have only to <i>type your address</i>, <i>check Groups you want to receive informations about(if displayed)</i> and <i>click on Go!</i><br>
The form allows you to Unsubscribe or Modify your account, too. Just enter your address (you have to be already subscribed) and select option.<br><br><br><center>



<!-- 
****************************************************
Example of how you can include CcMail user panel in a PHP page -->
<?php include dirname(__FILE__) . "/include.php"; ?>
<!-- 
****************************************************
-->



</center>
</div>
<!--*****************/BODY******************-->
	</td></tr></table>
	</td></tr><tr><td height="5"></td></tr></table>
	<table class="bottom_bar" cellpadding="0" cellspacing="0"><tr>
	<td align="left" width="13"><img border="0" src="images/head_002.png" alt=""></td>
	<td width="100%" valign="top"></td>
	<td align="right" width="8"><img border="0" src="images/foot_002.png" alt=""></td>
	<td width="10"></td>
	</tr></table>
	<table width="98%" border="0" cellpadding="0" cellspacing="0"><tr>
	<td align="left" valign="top"><div class="standard">
	</div></td>
	<td align="right" valign="top">
	<a href="http://jigsaw.w3.org/css-validator/validator?uri=http://www.cicoandcico.com"><img style="border:0;width:88px;height:31px" src="images/vcss.png" alt="Valid CSS!"></a></td>
	</tr></table>
</center>
</body>
</html>
</body></html>