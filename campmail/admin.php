<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//ADMIN.PHP - Administrator page

session_start();

//Password protection
require_once (dirname(__FILE__) . "/protect.php");

//Including configuration and function
require_once (dirname(__FILE__) . "/config.php");
require_once ($functions_dir . "/shared.php");
if (!class_exists('crypto')) {require_once ($functions_dir . "/crypt.php"); $crypt = new Crypto;}
require_once ($functions_dir . "/users.php");
require_once ($functions_dir . "/groups.php");
require_once ($functions_dir . "/mail.php");
require_once ($functions_dir . "/settings.php");

//First time only operations
if (file_exists($functions_dir . "/lock")) {
@chmod($functions_dir . "/lock", 0755);
if (!@unlink ($functions_dir . "/lock")) {print "delete '/functions/lock' file by hand"; exit();}
@header("Location: admin.php?option=settings");}

//Retrieving GET variable
$option = "";
if (isset($_GET['option'])) $option = $_GET['option'];

//Set recipients array
if (!isset($_SESSION['array'])) $_SESSION['array'] = array();
//Set attachments array
if (!isset($_SESSION['attach'])) $_SESSION['attach'] = array();
//Set title, contents and display (TEXT or HTML) variables
if (!isset($_SESSION['title'])) $_SESSION['title'] = false;
if (!isset($_SESSION['contents'])) $_SESSION['contents'] = false;
if (!isset($_SESSION['display'])) $_SESSION['display'] = false;

//Erase attachments directory if no mail is present and no scheduled mail is present
if ($_SESSION['title'] == "") {
	$sscheduled_emails = get_settings($schedule_dir, true);
	if(count($sscheduled_emails)==0) erase_dir($data_dir . "/uploads");
}

//Retrieving users and groups with performance optimization
//(users are retrieved once and saved in a session var, that is refreshed ONLY when they are modified)
if(isset($users)) unset($users);
if (!isset($_SESSION['active_users'])) $_SESSION['active_users'] = array();
if (!isset($_SESSION['last_users_modified'])) $_SESSION['last_users_modified'] = 0;
if(filemtime($addresses_dir) > $_SESSION['last_users_modified']) {
	$_SESSION['last_users_modified'] = filemtime($addresses_dir);
	$_SESSION['active_users'] = array();
	$_SESSION['active_users'] = getusers(true, false);
}
$users = &$_SESSION['active_users'];
if (isset($users[0])) {print_r($users); $_SESSION['active_users'] = array(); $_SESSION['active_users'] = getusers(true, false); $users = &$_SESSION['active_users'];} //Bug fix
$groups = getgroups();
$send_mail = false;

//Pre-applied options
switch ($option)
{
	case "compose":
		//Add attachments
		if (isset($HTTP_POST_FILES['userfile']['name']) && is_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'])) {
		$userfile_name = $HTTP_POST_FILES['userfile']['name'];
		copy($HTTP_POST_FILES['userfile']['tmp_name'], $data_dir . "/uploads/" . $userfile_name);
		if (file_exists($data_dir . "/uploads/" . $userfile_name)) array_push($_SESSION['attach'], $userfile_name);
		}

		//Remove attachments
		if (isset($_GET['remove_attach'])) 
			$_SESSION['attach'] = array_diff ($_SESSION['attach'], array($_GET['remove_attach']));

		$_SESSION['attach'] = array_unique($_SESSION['attach']);

		//Erase old mail and write a new one
		if (isset($_GET['delete']) && $_GET['delete'] == "mail"){
		$_SESSION['title'] = false;
		$_SESSION['contents'] = false;
		$_SESSION['attach'] = array(); }
	break;

	case "logout":
		session_unset();
		session_destroy();
		//password protection: clear the cookie (is it necessary?) and return to login. 
		setcookie ("ccalias", "", time() - 3600);
		setcookie ("ccuname", "", time() - 3600);
		setcookie ("ccpass", "", time() - 3600);
		header("Location: $login_page"); 
		exit();
	break;

	case "send_saved_mail":
		//Set mail subject and body, encoding, recipients and send mail
		if (isset($_POST["subject"]) && isset($_POST["contents"]) && $_POST["subject"] != "" && $_POST["contents"] != ""){
		$_SESSION['title'] = stripslashes($_POST["subject"]);
		$_SESSION['contents'] = stripslashes($_POST["contents"]);
		}
		if (isset($_POST['encoding']) && $_POST['encoding'] != "")  $_SESSION['display'] = $_POST['encoding'];
		
		if (isset($_POST['recipients']) && $_POST['recipients'] != ""){
			$rec_array = explode (" ", $_POST['recipients']);
			$trim_array = array();
			foreach ($rec_array as $item) if(strlen($item)>4) $trim_array[] = $crypt->decrypt($pass, trim($item));
			$_SESSION['array'] = $trim_array;
			header("Location: admin.php?option=mail");
		}
	break;

	case "outbox":
		if (isset($_POST['filename']) && $_POST['filename'] != "") {
		if (file_exists($mails_dir . "/" . $_POST['filename'])) {@chmod($mails_dir . "/" . $_POST['filename'], 0755); unlink($mails_dir . "/" . $_POST['filename']); }
		}
	break;

	case "drafts":
		if (isset($_POST['filename']) && $_POST['filename'] != "") {
		if (file_exists($drafts_dir . "/" . $_POST['filename'])) {@chmod($drafts_dir . "/" . $_POST['filename'], 0755); unlink($drafts_dir . "/" . $_POST['filename']); }
		}
	break;

	case "unsent":
		if (isset($_POST['filename']) && $_POST['filename'] != "") {
		if (file_exists($unsent_dir . "/" . $_POST['filename'])) {@chmod($unsent_dir . "/" . $_POST['filename'], 0755); unlink($unsent_dir . "/" . $_POST['filename']); }
		}
	break;

	case "type_address":
		if (isset($_POST['typed_address']) && $_POST['typed_address'] != "") 
		{
		$typed_address_array = explode (",", $_POST['typed_address']);
		foreach ($typed_address_array as $item) if(validate_email(trim($item))) array_push ($_SESSION['array'], trim($item));
		}
	break;

	case "mail_user":
		if ($_GET['item'] != "" && !in_array($_GET['item'], $_SESSION['array'])) array_push ($_SESSION['array'], $_GET['item']);
	break;
	
	case "remove_recipient":
		if (isset($_GET['item']) && $_GET['item'] != "" && in_array($_GET['item'], $_SESSION['array']))
			$_SESSION['array'] = array_diff ($_SESSION['array'], array($_GET['item']));
	break;

	case "mail_group":
		if (isset($_GET['item']) && $_GET['item'] != "")
			$_SESSION['array'] = merge($_SESSION['array'], get_group_users(stripslashes($_GET['item'])));
	break;

	case "remove_recipient_group":
		if (isset($_GET['item']) && $_GET['item'] != "") 
		{
			$users_to_remove = get_group_users(stripslashes($_GET['item']), true); //only the users explicitely subscribed to that group
			$_SESSION['array'] = array_diff ($_SESSION['array'], $users_to_remove);
		}
	break;
	
	case "mail_all":
		$aaaaa = array_keys($users);
		$_SESSION['array'] = decrypt_array($aaaaa, $pass);
	break;

	case "erase_list":
		$_SESSION['array']= array();
	break;
}

//Ordering array and removing duplicates (when the array varies its lenght only, to optimize performance)
if (!isset($_SESSION['array_lenght'])) $_SESSION['array_lenght'] = 0;
$number_of_recipients_in_array = count($_SESSION['array']);
if($number_of_recipients_in_array != $_SESSION['array_lenght']) {
	$_SESSION['array_lenght'] = $number_of_recipients_in_array;
	sort ($_SESSION['array']);
	$_SESSION['array'] = array_unique($_SESSION['array']);
}
//Required by htmlpreview (and print_mail when HTML)
$_SESSION['savedmail'] = "";

//*********************BEGIN HTML CODE******************
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	
	<title>CcMail 1.0 - Administrator Page</title><link rel="stylesheet" type="text/css" href="style.css">
	
	<script type="text/javascript"><!--
	function toggle_all(formobj)
	{
		for (var i =0; i < formobj.elements.length; i++)
		{
			var elm = formobj.elements[i];
			elm.checked = formobj.allbox.checked;
		}
	}
	-->
	</script>
	</head>

<body>


<br>
<table width="99%" border="0" cellpadding="0" cellspacing="0"><tr>
	<td align="left"><a href="http://www.cicoandcico.com/ccmail-10/" title="Visit CcMail 1.0 Homepage"><img border="0" width="208" height="69" src="images/ccmail.gif" alt="CcMail Homepage"></a></td>
	<?php
	if ($_SESSION['title'] && $_SESSION['contents'] && $number_of_recipients_in_array > 0)
	print "
	</td><td align=\"right\" valign=\"bottom\">
	<a href=\"$PHP_SELF?option=compose\" title=\"Ready to send Mail!\"><img src=\"images/mail_blink.gif\" border=\"0\" alt=\"Ready to send Mail!\"></td>
	<td width=\"20\"></td>"; ?>
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
	<td valign="middle" width="10"><?php print "<a href=\"admin.php\" class=\"main\" title=\"Main page\">";?>&nbsp;Main&nbsp;</a></td>
	<td class="tab"></td>
	<td valign="middle" width="10"><?php print "<a href=\"$PHP_SELF?option=update\" class=\"main\" title=\"Search for updates\">";?>&nbsp;Updates&nbsp;</a></td>
	<td class="tab"></td>
	<td valign="middle" width="10"><?php print "<a href=\"$PHP_SELF?option=import\" class=\"main\" title=\"Import addresses from your old Mailing List Manager\">";?>&nbsp;Import&nbsp;</a></td>
	<td class="tab"></td>
	<td valign="middle" width="10"><?php print "<a href=\"$PHP_SELF?option=export\" class=\"main\" title=\"Export addresses list\">";?>&nbsp;Export&nbsp;</a></td>
	<td class="tab"></td>
	<td valign="middle" width="10">
	<?php print "<a href=\"$PHP_SELF?option=statistics\" class=\"main\" title=\"Statistics\">&nbsp;Statistics&nbsp;"; ?>
	<td class="tab"></td>
	<td valign="middle" width="10">
	<?php print "<a href=\"$PHP_SELF?option=access_log\" class=\"main\" title=\"Access Log\">&nbsp;Access&nbsp;Log&nbsp;"; ?>
	</a></td>
	<td class="tab"></td>
	<td valign="middle" width="10">
	<?php print "<a href=\"$PHP_SELF?option=schedule\" class=\"main\" title=\"Schedule\">&nbsp;Schedule&nbsp;"; ?>
	</a></td>
	<td class="tab"></td>
	<td valign="middle" width="10"><?php print "<a href=\"$PHP_SELF?option=settings\" class=\"main\" title=\"Edit your preferences\">";?>&nbsp;Settings&nbsp;</a></td>
	<td class="tab"></td>
<!--FLAGS AND FOOTER-flags differs from italian to english version-->
	<td> </td>
	<td align="right"><?php print "<a href=\"$PHP_SELF?option=help\" class=\"main\" title=\"CcMail Handbook\">&nbsp;Help&nbsp;</a>";?></td>
	<td class="tab"></td>
	<td align="right" width="10"><?php print "<a href=\"$PHP_SELF?option=about\" class=\"main\" title=\"Show informations about CcMail\">&nbsp;About&nbsp;</a>";?></td>
	<td class="tab"></td>
	<td align="right" width="10"><?php print "<a href=\"$PHP_SELF?option=logout\" class=\"main\" title=\"Logout\">&nbsp;Logout</a>";?></td>
	<td align="right" class="footer"></td>
</tr>
</table>
<!--MAIN TABLE-->
	<table class="main_table" cellpadding="0" cellspacing="0">
	<tr>
	<td align="center" width="19%" valign="top">
	<table class="max_table" cellpadding="0" cellspacing="0">
	<tr>
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
		<?php 
		print "
		<center>
		<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>
		<td valign=\"top\"><img src=\"images/users16.gif\" height=\"20\" width=\"16\" border=\"0\" alt=\"Users\"></td>
		<td><div class=\"menu\"><b><a class=\"link\" href=\"$PHP_SELF?option=list_users\" title=\"View subscribed users\">Manage Users</a></b><br>
		&nbsp; &bull; <a class=\"link\"href=\"$PHP_SELF?option=delete_user\" title=\"Delete a subscribed User\">Delete User</a><br>
		&nbsp; &bull; <a class=\"link\" href=\"$PHP_SELF?option=restore_user\" title=\"Restore a deleted User\">Restore User</a>";
		if ($validation_email == "on") print "<br>&nbsp; &bull; <a class=\"link\"href=\"$PHP_SELF?option=waiting_users\" title=\"Show still not activated Users\">Unactivated</a>";
		print "<br></td></tr>
		<tr>
		<td valign=\"top\"><img src=\"images/groups16.gif\" height=\"20\" width=\"16\" border=\"0\" alt=\"Groups\"></td>
		<td><div class=\"menu\"><b><a class=\"link\"href=\"$PHP_SELF?option=list_groups\" title=\"View active groups\">Manage Groups</a></b><br>
		&nbsp; &bull; <a class=\"link\"href=\"$PHP_SELF?option=add_group\" title=\"Create a new Group\">Create Group</a><br>
		&nbsp; &bull; <a class=\"link\" href=\"$PHP_SELF?option=delete_group\" title=\"Delete an existing Group\">Delete Group</a><br>
		&nbsp; &bull; <a class=\"link\" href=\"$PHP_SELF?option=restore_group\" title=\"Restore a deleted Group\">Restore Group</a>
		<br></td></tr>
		<tr>
		<td valign=\"top\"><img src=\"images/email16.gif\" height=\"20\" width=\"16\" border=\"0\" alt=\"Compose\"></td>
		<td><div class=\"menu\"><b><a class=\"link\" href=\"$PHP_SELF?option=compose\" title=\"Compose a new Mail\">";
		if ($_SESSION['title'] && $_SESSION['contents']) print "<font color=\"red\">Composed Mail</font>";
		else print "Write Mail";
		print "</a></b><br></td></tr>
		<tr>
		<td valign=\"top\"><img src=\"images/outbox16.gif\" height=\"20\" width=\"16\" border=\"0\" alt=\"Outbox\"></td>
		<td><div class=\"menu\"><b><a class=\"link\" href=\"$PHP_SELF?option=outbox\" title=\"Show sent Mail(s)\">OutBox</a></b><br></td></tr>
		<tr>
		<td valign=\"top\"><img src=\"images/unsent16.gif\" height=\"20\" width=\"16\" border=\"0\" alt=\"Unsent\"></td>
		<td><div class=\"menu\"><b><a class=\"link\" href=\"$PHP_SELF?option=unsent\" title=\"Show Unsent Mail(s)\">Unsent</a></b><br></td></tr>
		<tr>
		<td valign=\"top\"><img src=\"images/drafts16.gif\" height=\"20\" width=\"16\" border=\"0\" alt=\"Drafts\"></td>
		<td><div class=\"menu\"><b><a class=\"link\" href=\"$PHP_SELF?option=drafts\" title=\"Show Drafts\">Drafts</a></b><br>";
		print "</td></tr></table></center>" ?>
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
		<!--Menu body-->CcMail comes with ABSOLUTELY NO WARRANTY. The script is under <a href="http://www.gnu.org/licenses/gpl.txt" class="link">GPL</a> license. Sources can be freely distributed, and usage is totally free.
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
		<b>CcMail <?php print $ccmail_version ?></b><br><br>
		<b>Lead Programmer</b><br>
		&nbsp; &nbsp; &bull; Emanuele Guadagnoli<br><br>
		<b>Support CcMail</b><br>
		&nbsp; &nbsp; &bull; <a class="link" href="http://www.cicoandcico.com/help-this-site/">Donate</a><br>
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
<div class="standard"><br>
<?php
//*********************END OF HTML CODE******************
//Displaying Icon...
if (stristr($option, "user")) print '<center><a href="?option=list_users"><img border="0" width="40" height="40" src="images/users.gif" alt="Manage Users"></a><br><b>Manage Users</b></center><br><br>';
elseif (stristr($option, "group")) print '<center><a href="?option=list_groups"><img border="0" width="40" height="40" src="images/groups.gif" alt="Manage Groups"></a><br><b>Manage Groups</b></center><br><br>';

switch ($option)
{
default:
	if (isset($_COOKIE["ccalias"])) print "<center><font size=\"5\" style=\"color: rgb(0, 153, 255);\">Welcome, " . $_COOKIE["ccalias"];
	print '.</font><br><br><br>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td colspan="6" width="60%"></td></tr><tr>
	<td width="16%" align="center"><a href="?option=list_users" class="link">
	<img border="0" width="40" height="40" src="images/users.gif" alt="Manage Users"><br><b>Users</b></a></td>
	<td width="16%" align="center"><a href="?option=list_groups" class="link">
	<img border="0" width="40" height="40" src="images/groups.gif" alt="Manage Groups"><br><b>Groups</b></a></td>
	<td width="16%" align="center"><a href="?option=compose" class="link">
	<img border="0" width="40" height="40" src="images/email.gif" alt="Write a new Mail"><br><b>Write</b></a></td>
	<td width="16%" align="center"><a href="?option=outbox" class="link">
	<img border="0" width="40" height="40" src="images/outbox.gif" alt="Show Outbox"><br><b>Outbox</b></a></td>
	<td width="16%" align="center"><a href="?option=settings" class="link">
	<img border="0" width="40" height="40" src="images/settings.gif" alt="Settings"><br><b>Settings</b></a></td>
	<td width="16%" align="center"><a href="?option=help" class="link">
	<img border="0" width="40" height="40" src="images/help.gif" alt="Help"><br><b>Handbook</b></a></td>
	</tr></table><br><br>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td><div class="standard">
	<b><font style="color: rgb(0, 153, 255);">CcMail '; print $ccmail_version; print '</font><br></b>
	CcMail 1.0 is a powerful open-source mailing list manager, supporting Groups and other useful features.<br><br>
	<b><font style="color: rgb(0, 153, 255);">Quick Links</font><br></b>
	<center><table border="0" cellpadding="0" cellspacing="0"><tr><td width="40%"><div class="standard"><b>
	&bull; <a href="mailto:cicoandcico [a t] cicoandcico [d o t] com" class="link">Contact Developer</a>
	<br>&bull; <a href="http://www.cicoandcico.com/ccmail_roadmap.php" class="link">CcMail Roadmap</a>
	<br>&bull; <a href="http://www.cicoandcico.com/join_ccmail.php" class="link">Join CcMail Team</a></b></div></td>
	<td width="20%"></td><td width="40%"><div class="standard"><b>
	&bull; <a href="?option=help" class="link">CcMail Handbook</a><br>
	&bull; <a href="?option=about" class="link">About CcMail</a>
	<br>&bull; <a href="http://www.hotscripts.com/Detailed/43672.html" class="link">Rate at Hotscripts.com</a></b></div>
	</td></tr></table></center><br>
	<b><font style="color: rgb(0, 153, 255);">User Interface preview</font></b><br><br><center>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td width="360" height="10">
	<table class="menu_content_table" cellspacing="0" cellpadding="1"><tr><td width="100%" valign="top">
	<table class="menu_content_table_bg" cellspacing="0" cellpadding\"0"><tr><td valign="top"><center>';
	//How you can include User Interface in your pages:
	include "include.php";
	print '</center></td></tr></table></td></tr></table></td></tr></table></center></div></td></tr></table></center>';
	break;

case "help":
	@include ($functions_dir . "/helpcontents.html");
	break;

case "about":
	@include ($functions_dir . "/about.html");
	break;

case "update":
	//Watch for updates
	print '<center><a href="?option=update"><img border="0" width="40" height="40" src="images/settings.gif" alt="Help"></a><br><b>Checking for updates...<br><br><br>';
	flush();
	$lastversion_f = @fopen ("http://www.cicoandcico.com/ccmail_version", "r");
	if (!$lastversion_f) echo "Connection failed.";
	else {
	$lastversion = @fgets ($lastversion_f, 1024);
	if ($lastversion != "" && $lastversion != $ccmail_version) print "A newer version of CcMail ($lastversion) is available!<br><br>
	<a href=\"http://www.cicoandcico.com/ccmail-10/\" class=\"link\">[DOWNLOAD]</a></b></center><br><br>
	A new version contains several new features and fixes, so you are highly recommended to make the update.<br>
	To install the new version, enter your <code>ccmail/</code> directory and DELETE EVERYTHING BUT <b><code>data/</code></b> FOLDER. <br>Then, COPY ALL THE NEW FILES AND FOLDERS BUT <b><code>DATA/</code></b> FOLDER. If you changed config.php, edit the new one reporting your username/password.<br>
	Then, open admin.php to make him complete the update.<br>Detailed informations in the included README.";
	else print 'Congratulations, this version is up to date.</b></center><br>';
	}
	break;

case "import":
	print '<center><a href="?option=import"><img border="0" width="40" height="40" src="images/users.gif" alt="Import"></a><br><b>Import Users<br><br><br>';
	include ($functions_dir . "/import.php");
	print "</b></center>";
	break;

case "export":
	$generate_cvs = false;
	if (isset($_GET['cvs']) && $_GET['cvs'] == "yes") $generate_cvs = true;
	print '<center><a href="?option=export"><img border="0" width="40" height="40" src="images/users.gif" alt="Export"></a><br><b>Export<br><br><br></center>';
	$backup = "<--FIELD:-->\n" . $pass . "\n<--FIELD:-->\n";
	$settings = get_settings($settings_dir);
	$setting_names = array_keys($settings);
	$outbox_names = get_settings($mails_dir, true);
	$unsent_names = get_settings($unsent_dir, true);
	$drafts_names = get_settings($drafts_dir, true);
	$all_users = get_settings($addresses_dir, true); //return array with filenames
	//Generating Backup...
	foreach ($all_users as $address) //USERS
	{
		$subscribed_groups = array();
		$subscribed_groups = file($addresses_dir . "/" . $address);
		$backup .= $address . "<--SUB_GROUPS:--> ";
		foreach ($subscribed_groups as $grp) $backup .= trim($grp) . " <--AND:--> ";
		$backup .= " <--RETURN:-->\n";
	}
	$backup .= "<--FIELD:-->\n";
	$groups_timestamps = array_keys($groups);
	foreach ($groups_timestamps as $time) $backup .= $time . " <--AND:--> " . $groups[$time] . " <--RETURN:-->\n"; //GROUPS
	$backup .= "<--FIELD:-->\n";
	foreach ($setting_names as $setting) $backup .= $setting . " <--VALUE:--> " . $settings[$setting] . " <--RETURN:-->\n"; //SETTINGS
	$backup .= "<--FIELD:-->\n";
	foreach ($outbox_names as $address) //OUTBOX
	{
		$m_handle = fopen($mails_dir . "/" . $address, "r");
		$contents = fread($m_handle, filesize($mails_dir . "/" . $address));
		$backup .= $address . "<--CONTENTS:--> $contents <--RETURN:-->\n";
	}
	$backup .= "<--FIELD:-->\n";
	foreach ($unsent_names as $address) //UNSENT
	{
		$m_handle = fopen($unsent_dir . "/" . $address, "r");
		$contents = fread($m_handle, filesize($unsent_dir . "/" . $address));
		$backup .= $address . "<--CONTENTS:--> $contents <--RETURN:-->\n";
	}
	$backup .= "<--FIELD:-->\n";
	foreach ($drafts_names as $address) //DRAFTS
	{
		$m_handle = fopen($drafts_dir . "/" . $address, "r");
		$contents = fread($m_handle, filesize($drafts_dir . "/" . $address));
		$backup .= $address . "<--CONTENTS:--> $contents <--RETURN:-->\n";
	}
	
	//Generating CVS...
	if ($generate_cvs){
		$backup = "";
		$all_addresses = array_keys($users);
		foreach ($all_addresses as $address){
			$displayed = $crypt->decrypt ($pass, $address);
			$subscribed_groups = file($addresses_dir . "/" . $address . "_~_" . $users[$address]); $groupstring = "";
			foreach ($subscribed_groups as $grp) $groupstring .= ", \"" . trim($grp) . "\"";
			$backup .= "\"$displayed\", \"$users[$address]\"$groupstring\n";
		}
	}
	
	print 'There are two ways of exporting Users: CcMail Backup or CSV file.</b><ul><li>CcMail backup is a complete backup of Users, Groups, Settings and Mails. You can use it *only* to restore a CcMail configuration (see "Import"). It as a good idea to make backups frequently, to avoid data losses. To save a backup, select all the field below, copy it and paste in a empty text file.</li><li>CSV is a plain text file used by many Mailing List Managers and other applications. Its structure here is:<br> "Address", "UNIX timestamp", "Group1", "Group2", etc...<br><br></li></ul><center>';
	if (!$generate_cvs) print '<b>CcMail Backup &nbsp; | &nbsp; <a href="?option=export&cvs=yes" class="link">CSV File</a></b><br><br>';
	else print '<b><a href="?option=export" class="link">CcMail Backup</a> &nbsp; | &nbsp; CSV File</b><br><br>';
	print "<textarea class=\"tbox\" rows=\"30\" cols=\"80\" readonly>$backup</textarea></b></center>";
	break;

case "access_log":
	print '<center><a href="?option=access_log"><img border="0" width="40" height="40" src="images/settings.gif" alt="Access Log"></a><br><b>Access Log<br><br><br></b>
	<table border="0" cellpadding="4" cellspacing="0"><tr><td><div class="standard">';
	$log = array();
	if (file_exists($data_dir . "/access_log")) $log = array_reverse(file($data_dir . "/access_log"));
	else print "No log retrieved";
	foreach($log as $log_line) print "<tr><td><div class=\"standard\">$log_line</div></td></tr>";
	print "</div></td></tr></table></center>";
	break;

case "statistics":
	$display_period = "week";
	if (isset($_GET['display_period'])) $display_period = $_GET['display_period'];
	print '<center><a href="?option=statistics"><img border="0" width="40" height="40" src="images/users.gif" alt="Statistics"></a><br><b>Statistics<br><br><br>
	Display Subscription statistics  during last week, month or year.<br><br></b>';
	require_once ($functions_dir . "/statistics.php");
	if ($display_period == "week") print '<b>Last Week &nbsp; | &nbsp; 
	<a href="?option=statistics&display_period=month" class="link">Last Month</a> &nbsp; | &nbsp; 
	<a href="?option=statistics&display_period=year" class="link">Last Year</a></b><br><br>';
	else if ($display_period == "month") print '<b><a href="?option=statistics&display_period=week" class="link">Last Week</a> &nbsp; | &nbsp; Last Month &nbsp; | &nbsp; 
	<a href="?option=statistics&display_period=year" class="link">Last Year</a></b><br><br>';
	else if ($display_period == "year") print '<b><a href="?option=statistics&display_period=week" class="link">Last Week</a> &nbsp; | &nbsp; <a href="?option=statistics&display_period=month" class="link">Last Month</a> &nbsp; | &nbsp; 
	Last Year</b><br><br>';
	show_statistics($display_period);
	break;
	
case "settings":
	print '<center><a href="?option=settings"><img border="0" width="40" height="40" src="images/settings.gif" alt="Settings"></a><br><b>&nbsp;&nbsp;&nbsp;Settings</b><br><br>
	<b>Settings &nbsp; | &nbsp; 
	<a href="?option=test" class="link" title="Test Mailer Configuration">Test</a> &nbsp; | &nbsp; 
	<a href="?option=reset" class="link" title="Erase informations and return to factory defaults">Reset</a></b><br><br></center>';
	//Retrieving settings array...
	$settings = get_settings($settings_dir);

	if (isset($_POST['company_name']))
	{
	$applied_settings = array();
	$setting_names = array_keys($settings);
	foreach($setting_names as $item) $applied_settings[$item] = trim(stripslashes(@$_POST[$item]));

	//Controlling numeric values syntax and applying changes...
	if (eregi("^[0-9]+$", $applied_settings['max_displayed_recipients']) && eregi("^[0-9]+$", $applied_settings['pause_for']) && eregi("^[0-9]+$", $applied_settings['pause_every']))
	{
		print "<center><font color=\"red\"><b>Changes successfully applied!</b></font><br><br></center>";
		apply_settings($applied_settings);
	}
	else print "<b><center><font color=\"red\">Syntax error!</font><br>\"Max diplayed recipients\" and \"Pause for\" must be integers!</center></b><br><br></center>";
	
	//General settings
	$settings = get_settings($settings_dir);
	}
	print "<center>
	<form method=\"post\" action=\"$PHP_SELF?option=settings\">
	<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" width=\"100\">
	<tr><td colspan=\"2\"><div class=\"standard\"><b><font color=\"red\">General settings:</font><b></b></div></td></tr>";
	print_setting("company_name", $settings);
	print_setting("company_site", $settings);
	print_setting("subscription_form_url", $settings, "The URL of the page you placed CcMail subscription form in.");
	//language file
	include ($settings_dir . "/lang.ccmail");
	$lang_files = get_settings($lang_dir, true);
	print "<tr><td align=\"right\" valign=\"top\"><div class=\"standard\"><b>Form Language: &nbsp; </b></div></td><td><div class=\"standard\"><select class=\"tbox\" name=\"lang\">";
	foreach ($lang_files as $lang_file) {
		$disp_lang_file = str_replace(".php", "", $lang_file);
		$lang_selected = ""; if($disp_lang_file == $lang) $lang_selected = "selected";
		print "<option value=\"$disp_lang_file\" $lang_selected>$disp_lang_file</option>";}
	print "</select> The language of the subscription form</div></td></tr>";
	print_setting("company_email", $settings, "This will appear as the Reply-to address.");
	print_setting("signature", $settings, "The following line(s) will be added to any plain-text mail. <br><b>If you like this script please leave a reference to CcMail like the displayed one.</b>", true);
	print_setting("send_copy_to", $settings, "Send a copy of any sent Mail to the following address. Leave empty if you don't want to send a copy.");
	print_setting("notify_admin", $settings, "Notify administrator on User subscription/unsubscription. A mail will be sent to the address above. Values: <b>YES</b>/<b>NO</b>");
	print_setting("banned_addresses", $settings, "The following addresses will not be able to subscribe or receive mails. Syntax: <i>addr1, addr2, addr3</i>");
	print_setting("banned_domains", $settings, "Addresses belonging to the following domains will not be able to subscribe or receive mails. Syntax: <i>dom1.com, dom2.net, etc</i>");
	print_setting("max_displayed_recipients", $settings, "Max <b>displayed</b> recipients before wrapping. Must be a number!");
	
	//Validation
	print "<tr><td valign=\"top\" colspan=\"2\"><div class=\"standard\"><br><b><font color=\"red\">Validation settings:</font></div></td></tr>";
	$validation_email = $settings['validation_email']; $validate_check = ""; if($validation_email == "on") $validate_check="checked";
	print "<tr> <td></td><td><div class=\"standard\"><br>Read the <b><a href=\"?option=help#h14\" class=\"link\">manual pages about fake subscriptions</a></b></div></td></tr>
	<tr><td align=\"right\" valign=\"top\"><div class=\"standard\"><b>Validation Email: &nbsp; </b></div></td><td><div class=\"standard\"><input type=\"checkbox\" name=\"validation_email\" $validate_check> &nbsp;Select to enable Validation Emails</div></td></tr>";
	print_setting("validation_text", $settings, "", true);
	
	//PHPMailer
	$check_mail = "";
	$check_sendmail = "";
	$check_smtp = "";
	if ($settings['send_method'] == "mail") $check_mail = "checked";
	elseif ($settings['send_method'] == "sendmail") $check_sendmail = "checked";
	elseif ($settings['send_method'] == "smtp") $check_smtp = "checked";
	
	$auth_check = "";
	if ($settings['smtp_auth'] == "on") $auth_check = "checked";
	
	$select_priority_1 = ""; $select_priority_3 = ""; $select_priority_5 = "";
	if ($settings['mail_priority'] == "1") $select_priority_1 = "selected";
	elseif ($settings['mail_priority'] == "3") $select_priority_3 = "selected";
	elseif ($settings['mail_priority'] == "5") $select_priority_5 = "selected";
	
	$smtp_host = $settings['smtp_host'];
	$smtp_port = $settings['smtp_port'];
	$smtp_helo = $settings['smtp_helo'];
	$smtp_uname = $settings['smtp_uname'];
	$smtp_passw = $settings['smtp_passw'];
	$pause_for = $settings['pause_for'];
	$pause_every = $settings['pause_every'];
	
	print "<tr><td valign=\"top\" colspan=\"2\"><div class=\"standard\"><br><b><font color=\"red\">PHPMailer settings:</font></div></td></tr>
	<tr> <td></td><td><div class=\"standard\">These settings are necessary to send Mails. I suggest you to read the <b><a href=\"?option=help#h13\" class=\"link\">manual pages for this section</a>.<br></b>
	Click <b><a href=\"?option=test\" class=\"link\" title=\"Test Mailer Configuration\">here</a></b> to test your configuration.<br><br></div></td></tr>
	<tr><td align=\"right\" valign=\"top\"><div class=\"standard\"><b>Mail Priority: &nbsp; </b></div></td><td><select name=\"mail_priority\" class=\"tbox\">
	<option value=\"1\" $select_priority_1>High</option>
	<option value=\"3\" $select_priority_3>Normal</option>
	<option value=\"5\" $select_priority_5>Low</option></select></td></tr>
	<tr> <td></td><td><div class=\"standard\"><br>Send Mails out with intervals to prevent server overload.</div></td></tr>
	<tr><td align=\"right\" valign=\"top\"><div class=\"standard\"><b>Pause for: &nbsp; </b></div></td><td>
	<div class=\"standard\"><input name=\"pause_for\" class=\"tbox\" size=\"3\" value=\"$pause_for\"> seconds after sending <input name=\"pause_every\" class=\"tbox\" size=\"3\" value=\"$pause_every\"> mails.<br><br></div></td></tr>
	<tr><td align=\"right\" valign=\"top\"><div class=\"standard\"><b>Send Method: &nbsp; </b></div></td><td><div class=\"standard\">
	<input type=\"radio\" name=\"send_method\" value=\"mail\" $check_mail>Mail() function (<b>not recommended</b>)<br>
	<input type=\"radio\" name=\"send_method\" value=\"sendmail\" $check_sendmail>SendMail<br>
	<input type=\"radio\" name=\"send_method\" value=\"smtp\" $check_smtp>SMTP (requires the followings:)<br>
	<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\"><tr><td width=\"30\"> </td><td>
	<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\">
	<tr><td><div class=\"standard\">Hostname</div></td><td><input class=\"tbox\" type=\"text\" name=\"smtp_host\" value=\"$smtp_host\"></td></tr>
	<tr><td><div class=\"standard\">PORT</div></td><td><input class=\"tbox\" type=\"text\" name=\"smtp_port\"  value=\"$smtp_port\"></td></tr>
	<tr><td><div class=\"standard\">HELO</div></td><td><input class=\"tbox\" type=\"text\" name=\"smtp_helo\"  value=\"$smtp_helo\"></td></tr>
	<tr><td><div class=\"standard\">Authentication</div></td><td><div class=\"standard\"><input type=\"checkbox\" name=\"smtp_auth\" $auth_check> (requires the followings:)</div></td></tr>
	<tr><td><div class=\"standard\">Username</div></td><td><input class=\"tbox\" type=\"text\" name=\"smtp_uname\" value=\"$smtp_uname\"></td></tr>
	<tr><td><div class=\"standard\">Password</div></td><td><input class=\"tbox\" type=\"password\" name=\"smtp_passw\" value=\"$smtp_passw\"></td></tr></table></td></tr></table>
	</div></td></tr>";
	
	//Notifications
	print "<tr><td valign=\"top\" colspan=\"2\"><div class=\"standard\"><br><br><br><b><font color=\"red\">Notify settings:</font></div></td></tr>";
	print "<td></td><td valign=\"top\"><div class=\"standard\">In the following fields you can use these environment variables:<br>
	<i>\$company_name</i> = Your Company Name.<br>
	<i>\$company_email</i> = Your Company Email<br>
	<i>\$company_site</i> = Your Site<br>
	<i>\$subscription_form_url</i> = Your subscription page URL<br>
	<i>\$gr_name</i> = The name of the relative Group<br>
	<i>[--ADDRESS--]</i> = The recipient's address</div></td></tr>";
	print_setting("notify_message", $settings, "The Subject of any Notification mail");
	print_setting("notify_user", $settings, "Notify Users on subscription/unsubscription. The following mails will be sent. Values: <b>YES</b>/<b>NO</b>");
	print_setting("on_subscription", $settings, "The mail that will be authomatically sent to any subscribed user, if <b>Notify User</b> is set to \"YES\"", true);
	print_setting("on_unsubscription", $settings, "The mail that will be authomatically sent when a user will unsubscribe, if <b>Notify User</b> is set to \"YES\"", true);
	print_setting("on_user_delete", $settings, "The mail that will be sent to a deleted user (a confirm will be asked).", true);
	print_setting("on_user_restore", $settings, "The mail that will be sent to a restored user (a confirm will be asked).", true);
	print_setting("on_group_created", $settings, "The mail that will be sent to every users when a new group is created (a confirm will be asked).", true);
	print_setting("on_group_delete", $settings, "The mail that will be sent to the users of a group, when it will be deleted (a confirm will be asked).", true);
	print_setting("on_group_restore", $settings, "The mail that will be sent to the users of a group, when it will be restored (a confirm will be asked).", true);
	print "<tr><td></td><td align=\"right\"><input class=\"button\" type=\"submit\" value=\"Submit\"></td></tr></table></form></center>";
	break;

case "test":
	print '<center><a href="?option=test"><img border="0" width="40" height="40" src="images/settings.gif" alt="Settings"></a><br><b>&nbsp;&nbsp;&nbsp;Test</b><br><br>
	<b><a href="?option=settings" class="link" title="Edit Settings">Settings</a> &nbsp; | &nbsp; Test &nbsp; | &nbsp; 
	<a href="?option=reset" class="link" title="Erase informations and return to factory defaults">Reset</a></b><br><br><br></center><b>';
	include ($settings_dir . "/send_method.ccmail");
	$display = ""; if(isset($_GET['display'])) $display = $_GET['display'];
	$test_title = "CcMail 1.0 Mailer test";
	$test_contents = "This mail has been sent to test CcMail Mailer configuration (\"Send method\" is set to: $send_method)\n
	<br><br>Some HTML code:<br><b>Hello! Below there should be an horizontal row.</b><hr>Bye.";
	if(isset($_POST['mail_number']))
	{
		print_mail($test_title, $test_contents, $_POST['encoding'], false);
		print_mail_header();
		mail_array($pass, $_SESSION['array'], $test_title, $test_contents,  $_POST['encoding'], true, false,  $_POST['mail_number']);
	}
	else {
		if ($send_copy_to != "") {
			print "Here you can test your Mailer configuration. <br>The selected number of test emails will be sent to the \"Send copy to\" address, that is $send_copy_to.<br><br></b>";
			print_mail($test_title, $test_contents, $display);
			print "<form method=\"post\" action=\"$PHP_SELF?option=test\">
			I want to send 
			<select class=\"tbox\" name=\"mail_number\"><option value=\"1\" selected>1</option><option value=\"2\">2</option>
			<option value=\"5\">5</option><option value=\"10\">10</option><option value=\"50\">50</option>
			<option value=\"100\">100</option><option value=\"200\">200</option></select> Mails as 
			<select class=\"tbox\" name=\"encoding\"><option value=\"text\" selected>Plain Text</option><option value=\"html\">HTML</option></select>
			<input class=\"button\" type=\"submit\" value=\"Send\">
			</form>";
		}
		else print "<center>\"Send copy to\" field is not filled. That is the default email address for testing puposes, so fill it to proceed.</b></center>";
	}
	break;
	
case "reset":
	print '<center><a href="?option=reset"><img border="0" width="40" height="40" src="images/settings.gif" alt="Settings"></a><br><b>&nbsp;&nbsp;&nbsp;Reset</b><br><br>
	<b><a href="?option=settings" class="link" title="Edit Settings">Settings</a> &nbsp; | &nbsp; <a href="?option=test" class="link" title="Test Mailer Configuration">Test</a> &nbsp; | &nbsp; Reset</a></b><br><br><br></center><b>';
	
	if(isset($_POST['to_reset']))
	{
		if ($_POST['to_reset'] == "users" || $_POST['to_reset'] == "groups" || $_POST['to_reset'] == "outbox" || $_POST['to_reset'] == "unsent" || $_POST['to_reset'] == "drafts" || $_POST['to_reset'] == "everything")
		{
			print "<center>";
			switch($_POST['to_reset'])
			{
				case "everything": 
					if(erase_dir($addresses_dir) && erase_dir($groups_dir) && erase_dir($unsent_dir) && erase_dir($drafts_dir) && erase_dir($mails_dir) && erase_dir($schedule_dir) && erase_dir($waiting_dir) && unlink($data_dir . "/access_log")) print "Everything was deleted";
				break;
				case "users": if(erase_dir($addresses_dir)) print "Users deleted"; break;
				case "groups": if(erase_dir($groups_dir)) print "Groups deleted"; break;
				case "outbox": if(erase_dir($mails_dir)) print "Outbox cleaned"; break;
				case "unsent": if(erase_dir($unsent_dir)) print "Unsent mails deleted"; break;
				case "drafts": if(erase_dir($drafts_dir)) print "Drafts deleted"; break;
			}
		}
		else print "<center><b>Unvalid value!</b></center>";
	}
	else {
		print 'Here you can erase saved informations.<br>To protect you from accidental mistakes, you have to write a key word to select what you want to erase. <br>BE CAREFUL!!!<br><br><center><table border="0"><tr><td><div class="standard">
		Allowed values: <br>&nbsp;&nbsp;&bull;&nbsp;<i>"everything"</i> -> ERASE USERS, GROUPS and EVERY MAIL
		<br>&nbsp;&nbsp;&bull;&nbsp;<i>"users"</i> -> ERASE USERS
		<br>&nbsp;&nbsp;&bull;&nbsp;<i>"groups"</i> -> ERASE GROUPS
		<br>&nbsp;&nbsp;&bull;&nbsp;<i>"outbox"</i> -> ERASE OUTBOX
		<br>&nbsp;&nbsp;&bull;&nbsp;<i>"unsent"</i> -> ERASE UNSENT MAILS
		<br>&nbsp;&nbsp;&bull;&nbsp;<i>"drafts"</i> -> ERASE DRAFTS
		<br><br>
		<center><form method="post" action="?option=reset">
		<input class="tbox_max" name="to_reset" size="20" maxlength="100">
		<input class="button" type="submit" value="ERASE">
		</form></center></td></tr></table></center>';
		}
	break;
	
//**************SCHEDULING****************
case "schedule":
	print '<center><a href="?option=schedule"><img border="0" width="40" height="40" src="images/schedule.gif" alt="Schedule"></a><br><b>Schedule<br><br>
	Make sure to read <a href="?option=help#h16" class="link">manual page sbout Scheduling</a> before using this feature.</b><br><br>';
	if (!function_exists('get_schedule')) require_once($functions_dir . "/schedule.php");
	//Retrieving informations about selected schedules
	$selected_schedules = array();
	$number_schedules = count($scheduled_emails = get_settings($schedule_dir, true));
	for ($i=0; $i<$number_schedules; $i++)
	{
		if (isset($_POST["schedule_del_" . ($i+1)])) 
			array_push($selected_schedules, trim($_POST["schedule_del_" . ($i+1)])); //add selected schedules
	}
	if(count($selected_schedules) > 0) {
		foreach($selected_schedules as $sched_name) del_schedule($sched_name);
		print "<b><font color=\"red\">Schedule(s) deleted successfully</font></b><br><br>";
	}
	
	if (isset($_GET['new_schedule']) && $_GET['new_schedule'] == "true") {
	
		if (isset($_POST['ready']) && $_POST['ready'] == "true")  {
			$plain_text_version_ = "";
			if(isset($_SESSION['plain_text_version'])) $plain_text_version_ = $_SESSION['plain_text_version'];
			
			if(new_schedule($_SESSION['title'], $_SESSION['contents'], $_POST['encoding'], $_SESSION['array'], (int)$_POST['interval'], (int)$_POST['number_per_interval'], $_SESSION['attach'], $plain_text_version_))  print "<b><font color=\"red\">Schedule saved!</font></b><br><br>";
			else print "<b><font color=\"red\">Could not save Scheduled Mail!</font></b><br><br>";
			print_scheduled();
		}
		else print "<b>Select Scheduling frequency (make sure to insert numeric values):</b><br><br>
		<form method=\"post\" action=\"$PHP_SELF?option=schedule&new_schedule=true\">
		Email <input name=\"number_per_interval\" class=\"tbox\" size=\"3\"> Recipients every <input name=\"interval\" class=\"tbox\" size=\"3\"> seconds.<br><br>
		<input type=\"hidden\" name=\"encoding\" value=\"".$_POST['encoding']."\">
		<input type=\"hidden\" name=\"ready\" value=\"true\">
		<input type=\"submit\" value=\"Schedule\" class=\"button\"></form>"; 
	}
	elseif (isset($_GET['item'])) print_schedule_details($_GET['item']);
	else print_scheduled();
break;

//**********USER MANAGEMENT*************
case "list_users":
	$to_search = "";
	if (isset($_GET['to_search'])) $to_search = $_GET['to_search'];
	$select_equals = ""; if (isset($_GET['search_option']) &&$_GET['search_option'] == "equals") $select_equals = "selected";
	print "<center><form method=\"get\" action=\"$PHP_SELF\">
	<input name=\"option\" value=\"list_users\" type=\"hidden\">
	<select name=\"search_option\" class=\"tbox\">
	<option value=\"contains\">Contains</option>
	<option value=\"equals\" $select_equals>Equals</option>
	</select>
	<input name=\"to_search\" size=\"20\" value=\"$to_search\" class=\"tbox_max\">
	<input type=\"submit\" value=\"Search\" class=\"button\"></form></center>";
	if ($to_search){
		$matching = array();
		$decripted_users = decrypt_array(array_keys($users), $pass);
		if ($_GET['search_option'] == "equals" && in_array($to_search, $decripted_users)) {
			$crypted = $crypt->encrypt($pass, $to_search);
			$matching[$crypted] = $users[$crypted];
		}
		elseif ($_GET['search_option'] == "contains") {
			foreach($decripted_users as $addr) 
				if (stristr($addr, $to_search)) {
					$crypted = $crypt->encrypt($pass, $addr);
					$matching[$crypted] = $users[$crypted];
				}
		}
		if (count($matching) != 0) {
			print "<center><b>". count($matching). " results found:</b></center><br>"; list_users($pass, $_SESSION['array'], $matching);}
		else print '<center><b><font color="red">No Match!</font></b></center>';
	}
	else list_users($pass, $_SESSION['array']);
	break;

case "get_user_details":
	if (isset($_GET['item'])){
	$selected_user= $_GET['item'];
	if (validate_email($selected_user)) {
		$selected_user = $crypt->encrypt ($pass, $selected_user);
		$selected_user .= "_~_" . $users[$selected_user];}
	if (isset($selected_user)) get_user_details($pass, stripslashes(trim($selected_user)));
	}
	list_users($pass, $_SESSION['array']);
	break;

case "delete_user":
	$to_search = "";
	if (isset($_GET['to_search'])) $to_search = $_GET['to_search'];
	$select_equals = ""; if (isset($_GET['search_option']) &&$_GET['search_option'] == "equals") $select_equals = "selected";
	print "<center><form method=\"get\" action=\"$PHP_SELF\">
	<input name=\"option\" value=\"delete_user\" type=\"hidden\">
	<select name=\"search_option\" class=\"tbox\">
	<option value=\"contains\">Contains</option>
	<option value=\"equals\" $select_equals>Equals</option>
	</select>
	<input name=\"to_search\" size=\"20\" value=\"$to_search\" class=\"tbox_max\">
	<input type=\"submit\" value=\"Search\" class=\"button\"></form></center>";
	if ($to_search){
		$matching = array();
		$decripted_users = decrypt_array(array_keys($users), $pass);
		if ($_GET['search_option'] == "equals" && in_array($to_search, $decripted_users)) {
			$crypted = $crypt->encrypt($pass, $to_search);
			$matching[$crypted] = $users[$crypted];
		}
		elseif ($_GET['search_option'] == "contains") {
			foreach($decripted_users as $addr) 
				if (stristr($addr, $to_search)) {
					$crypted = $crypt->encrypt($pass, $addr);
					$matching[$crypted] = $users[$crypted];
				}
		}
		if (count($matching) != 0) {
			print "<center><b>". count($matching). " results found:</b></center><br>"; restore_delete_list($matching, $pass, "delete_user");}
		else print '<center><b><font color="red">No Match!</font></b></center>';
	}
	else {
	if (!isset($_POST['confirm'])) restore_delete_list($users, $pass, "delete_user");
	else
	{
		//Retrieving informations about selected users
		$selected_users = array();
		$number_iterations = count($users);
		for ($i=0; $i<$number_iterations; $i++)
		{
			if (isset($_POST["user_" . $i])) 
				array_push($selected_users, trim($_POST["user_" . $i])); //add selected groups
		}
		if (count($selected_users) != 0){
		$success = true; $_SESSION['deleted_users'] = array();
		foreach($selected_users as $user){
			$user_data = explode("_~_", $user);
			if (!delete_user($user)) $success = false;
			else array_push($_SESSION['deleted_users'], $crypt->decrypt ($pass, $user_data[0]));
		}
		if($success)
		{
			print "<b>" . count($_SESSION['deleted_users']) . " of " . count($selected_users) . " selected Users successfully deleted.<br>";
			require_once ($settings_dir . "/on_user_delete.ccmail");
			if (strlen($on_user_delete) != 0){
			print "Do you want to notify those Users?</b><br><br>";
			print_mail($notify_message, $on_user_delete, "text", false);
			print "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\"></td><td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=notify&case=user_del\">
			<input class=\"button\" type=\"submit\" value=\"Notify\">
			</form></td><td width=\"10\">&nbsp;</td></tr></table>";
		}}
		else print "<center><b>Error: Some User has not been deleted!</b></center>";
		}
		else print "<center><b>No User selected.</b></center>";
	}}
	break;

case "restore_user":
	$to_search = "";
	unset($users); $users = &getusers(false);
	if (isset($_GET['to_search'])) $to_search = $_GET['to_search'];
	$select_equals = ""; if (isset($_GET['search_option']) &&$_GET['search_option'] == "equals") $select_equals = "selected";
	print "<center><form method=\"get\" action=\"$PHP_SELF\">
	<input name=\"option\" value=\"restore_user\" type=\"hidden\">
	<select name=\"search_option\" class=\"tbox\">
	<option value=\"contains\">Contains</option>
	<option value=\"equals\" $select_equals>Equals</option>
	</select>
	<input name=\"to_search\" size=\"20\" value=\"$to_search\" class=\"tbox_max\">
	<input type=\"submit\" value=\"Search\" class=\"button\"></form></center>";
	if ($to_search){
		$matching = array();
		$decripted_users = decrypt_array(array_keys($users), $pass);
		if ($_GET['search_option'] == "equals" && in_array($to_search, $decripted_users)) {
			$crypted = $crypt->encrypt($pass, $to_search);
			$matching[$crypted] = $users[$crypted];
		}
		elseif ($_GET['search_option'] == "contains") {
			foreach($decripted_users as $addr) 
				if (stristr($addr, $to_search)) {
					$crypted = $crypt->encrypt($pass, $addr);
					$matching[$crypted] = $users[$crypted];
				}
		}
		if (count($matching) != 0) {
			print "<center><b>". count($matching). " results found:</b></center><br>"; restore_delete_list($matching, $pass, "restore_user");}
		else print '<center><b><font color="red">No Match!</font></b></center>';
	}
	else {
	if (!isset($_POST['confirm'])) restore_delete_list($users, $pass, "restore_user");
	else
	{
		//Retrieving informations about selected users
		$selected_users = array();
		$number_iterations = count($users);
		for ($i=0; $i<$number_iterations; $i++)
		{
			if (isset($_POST["user_" . $i])) 
				array_push($selected_users, trim($_POST["user_" . $i])); //add selected groups
		}
		if (count($selected_users) != 0){
		$success = true; $_SESSION['restored_users'] = array();
		foreach($selected_users as $user){
			$user_data = explode("_~_", $user);
			if (!restore_user($user)) $success = false;
			else array_push($_SESSION['restored_users'], $crypt->decrypt ($pass, $user_data[0]));
		}
		if($success)
		{
			print "<b>" . count($_SESSION['restored_users']) . " of " . count($selected_users) . " selected Users successfully restored.<br>";
			require_once ($settings_dir . "/on_user_restore.ccmail");
			if (strlen($on_user_restore) != 0){
			print "Do you want to notify those Users?</b><br><br>";
			print_mail($notify_message, $on_user_restore, "text", false);
			print "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\"></td><td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=notify&case=user_res\">
			<input class=\"button\" type=\"submit\" value=\"Notify\">
			</form></td><td width=\"10\">&nbsp;</td></tr></table>";
		}}
		else print "<center><b>Error: Some User has not been restored!</b></center>";
		}
		else print "<center><b>No User selected.</b></center>";
	}}
	break;

case "waiting_users":
	print "<center><b>These Users received an activation code, but you're still waiting for their validation.<br>
	Usually, this means that they sumbitted a fake address.</b><br><br>";
	$waiting_users_filenames = get_settings($waiting_dir, true);
	$waiting_users = array();
	foreach($waiting_users_filenames as $w_usr) {
		$w_arr = explode("_~_", $w_usr); $waiting_users[trim($w_arr[0])] = trim($w_arr[1]);}
	
	$to_search = "";
	if (isset($_GET['to_search'])) $to_search = $_GET['to_search'];
	$select_equals = ""; if (isset($_GET['search_option']) && $_GET['search_option'] == "equals") $select_equals = "selected";
	print "<center><form method=\"get\" action=\"$PHP_SELF\">
	<input name=\"option\" value=\"waiting_users\" type=\"hidden\">
	<select name=\"search_option\" class=\"tbox\">
	<option value=\"contains\">Contains</option>
	<option value=\"equals\" $select_equals>Equals</option>
	</select>
	<input name=\"to_search\" size=\"20\" value=\"$to_search\" class=\"tbox_max\">
	<input type=\"submit\" value=\"Search\" class=\"button\"></form></center>";
	if ($to_search){
		$matching = array();
		$decripted_users = decrypt_array(array_keys($waiting_users), $pass);
		if ($_GET['search_option'] == "equals" && in_array($to_search, $decripted_users)) {
			$crypted = $crypt->encrypt($pass, $to_search);
			$matching[$crypted] = $waiting_users[$crypted];
		}
		elseif ($_GET['search_option'] == "contains") {
			foreach($decripted_users as $addr) 
				if (stristr($addr, $to_search)) {
					$crypted = $crypt->encrypt($pass, $addr);
					$matching[$crypted] = $waiting_users[$crypted];
				}
		}
		if (count($matching) != 0) {
			print "<center><b>". count($matching). " results found:</b></center><br>"; list_users($pass, $_SESSION['array'], $matching);}
		else print '<center><b><font color="red">No Match!</font></b></center>';
	}
	else list_users($pass, $_SESSION['array'], $waiting_users);
	break;
	
//**********GROUPS MANAGEMENT*************
case "list_groups":
	if (isset($_GET['hide']) && $_GET['hide'] != "") hide_group($_GET['hide']);
	elseif (isset($_GET['unhide']) && $_GET['unhide'] != "") unhide_group($_GET['unhide']);
	$groups = getgroups();
	list_groups();
	break;

case "add_group":
	if (!isset($_POST['groupname']) || $_POST['groupname'] == "") 
	{
	print "<b>Type the name of the new group you want to create.</b><br>A good name should be short, simple and intuitive.<br><br><br>
	<center>
	<table cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\"><div class=\"standard\">
	<form method=\"post\" action=\"$PHP_SELF?option=add_group\">
	<b>Group Name:</b>
	<input class=\"tbox_max\" name=\"groupname\" size=\"20\" maxlength=\"100\">
	<input class=\"button\" type=\"submit\" value=\"Create Group\">
	</form></div></td></tr></table></center><br><br>";
	list_groups();
	}
	else 
	{
		$gr_name = str_replace("\"", "'", stripslashes(trim($_POST['groupname'])));
		if(add_group($gr_name)) 
		{
			require_once ($settings_dir . "/on_group_created.ccmail");
			if (strlen($on_group_created) != 0){
			print "<b>Do you want to notify your users a new group was created?<br><br>";
			print_mail($notify_message, $on_group_created, "text", false);
			print "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\"></td><td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=notify&case=group_created&gr_name=$gr_name\">
			<input class=\"button\" type=\"submit\" value=\"Notify\">
			</form></td><td width=\"10\">&nbsp;</td></tr></table>";
			}
		}
		else list_groups();
	}
	break;

case "delete_group":
	if (!isset($_GET['item'])) list_to_del_group();
	else
	{
		$gr_name = stripslashes(trim($_GET['item'])); //gr_name = timestamp
		if(delete_group ($gr_name))
		{
			$groups = getgroups(false);
			$gr_name = $groups[$gr_name . ".OLD"]; //get group name
			require_once ($settings_dir . "/on_group_delete.ccmail");
			if (strlen($on_group_delete) != 0){
			print "<b>Do you want to notify the users subscribed to the group?<br><br>";
			print_mail($notify_message, $on_group_delete, "text", false);
			print "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\"></td><td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=notify&case=group_del&to=$gr_name\">
			<input class=\"button\" type=\"submit\" value=\"Notify\">
			</form></td><td width=\"10\">&nbsp;</td></tr></table>";
			}
		}
		else list_groups();
	}
	break;

case "restore_group":
	if (!isset($_GET['item'])) list_to_restore_group();
	else
	{
		$gr_name = stripslashes(trim($_GET['item'])); // see delete_group
		if(restore_group ($gr_name))
		{
			$groups = getgroups();
			$gr_name = $groups[$gr_name];
			require_once ($settings_dir . "/on_group_restore.ccmail");
			if (strlen($on_group_restore) != 0){
			print "<b>Do you want to notify the users subscribed to the group?<br><br>";
			print_mail($notify_message, $on_group_restore, "text", false);
			print "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\"></td><td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=notify&case=group_res&to=$gr_name\">
			<input class=\"button\" type=\"submit\" value=\"Notify\">
			</form></td><td width=\"10\">&nbsp;</td></tr></table>";
			}
		}
		else list_groups();
	}
	break;

case "get_group_details";
	if (isset($_GET['item'])) get_group_details($pass, stripslashes(trim($_GET['item'])));
	list_groups();
	break;

//**********MAIL MANAGEMENT*************
case "compose":
	print '<center><a href="?option=compose"><img border="0" width="40" height="40" src="images/email.gif" alt="Write Mail"></a><br><b>Write Mail</b></center><br><br>';
	//Retrieving encoding informations
	if (isset($_GET['display'])) $_SESSION['display'] = $_GET['display'];
	
	//Set session variables from post data (if present)
	if (isset($_POST["subject"]) && isset($_POST["contents"]) && $_POST["subject"] != "" && $_POST["contents"] != ""){
		$_SESSION['title'] = stripslashes($_POST["subject"]);
		$_SESSION['contents'] = stripslashes($_POST["contents"]);
		//unset plain text version on eventual modifications
		if(isset($_SESSION['plain_text_version'])) unset($_SESSION['plain_text_version']);
	}
	
	//Display mail, if present
	if ($_SESSION['title'] != "" && $_SESSION['contents'] != "")
	{
		print_mail($_SESSION['title'], $_SESSION['contents'], $_SESSION['display'], true, $_SESSION['attach']);
		print "
		<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>
		<td width=\"80%\">
		<form method=\"post\" action=\"$PHP_SELF?option=mail\">
		<input class=\"button_red\" type=\"submit\" value=\"Send Mail as\">
		<select class=\"tbox\" name=\"encoding\">
		<option value=\"text\" selected>Plain Text</option>
		<option value=\"html\">HTML</option>
		</select>
		</form></td>
		<td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=attach\">
		<input class=\"button\" type=\"submit\" value=\"Attach\"></form></td>
		<td width=\"10\">&nbsp;</td>
		<td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=edit\">
		<input class=\"button\" type=\"submit\" value=\"Edit\"></form></td>
		<td width=\"10\">&nbsp;</td>
		<td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=drafts\">
		<input type=\"hidden\" name=\"savemail\" value=\"true\">
		<input class=\"button\" type=\"submit\" value=\"Save\"></form></td>
		<td width=\"10\">&nbsp;</td>
		<td align=\"right\"><form method=\"post\" action=\"$PHP_SELF?option=compose&delete=mail\">
		<input class=\"button\" type=\"submit\" value=\"New Mail\"></form></td>
		<td width=\"10\">&nbsp;</td>
		</td></tr></table>";
	}
	//Compose mail
	else {
	$editor_type= "text";
	if (isset($_GET['editor_type'])) $editor_type = $_GET['editor_type'];
	if ($editor_type == "text") print '<center><b>Plain Text &nbsp; | &nbsp; 
	<a href="?option=compose&editor_type=wysiwyg" class="link" title="HTML WYSIWYG editor">HTML editor</a></b><br><br>';
	else print '<center><b><a href="?option=compose&editor_type=text" class="link" title="Plain text editor">Plain Text</a> &nbsp; | &nbsp; HTML editor &nbsp; </b><br><br>';
	
	require_once("fckeditor/fckeditor.php");
	$oFCKeditor = new FCKeditor('contents') ;
	$oFCKeditor->BasePath = "fckeditor/";
	$oFCKeditor->Config['AutoDetectLanguage'] = false ;
	$oFCKeditor->Config['DefaultLanguage'] = "en" ;
	$oFCKeditor->ToolbarSet = "CcMail" ;
	print "
	<form method=\"post\" action=\"$PHP_SELF?option=compose\">
	<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>
	<td><b><div class=\"standard\"><font color=\"red\">&nbsp;&nbsp;Subject:&nbsp;&nbsp; </font></div></b></td>
	<td align=\"left\" width=\"90%\"><input name=\"subject\" style=\"width: 100%;background-color: #FCFCFC;border: #A7A7A7 1px solid;color: #000000; font: 11px Verdana, Geneva, Arial, Helvetica, \"Nimbus Sans L\", sans-serif;\"></td></tr>
	<tr><td colspan=\"2\" height=\"5\"></td></tr>
	<tr><td colspan=\"2\" align=\"right\">";
	if($editor_type =="wysiwyg") $oFCKeditor->Create();
	else print "<textarea name=\"contents\" style=\"width: 100%;height: 400;background-color: #FCFCFC;border: #A7A7A7 1px solid;color: #000000; font: 11px Verdana, Geneva, Arial, Helvetica, \"Nimbus Sans L\", sans-serif;\"></textarea>";
	print "</td></tr>
	<tr><td colspan=\"2\" align=\"right\"><br><input class=\"button\" type=\"submit\" value=\"Proceed\"></td></tr></table>
	</form></center>";
	}
	break;

case "attach":
	print '<center><a href="?option=attach"><img border="0" width="40" height="40" src="images/email.gif" alt="attach Files"></a><br><b>Attach Files</b></center><br><br>';
	print "<b>Select a file on your Hard Disk. If it is not added, that's because it's too big. Tiny files should be uploaded successfully.</b><br><br><br><center>
	<form enctype=\"multipart/form-data\" action=\"$PHP_SELF?option=compose\" method=\"post\">";
	echo '
	<table border="0" cellpadding="0" cellspacing="0"><tr>
	<td><b><div class="standard">Select attachment: &nbsp; </div></b></td>
	<td><input class="tbox_max" name="userfile" type="file" size=\"30\"></td></tr>
	<tr><td colspan="2" align="right"><br><br><input class="button" type="submit" value="Attach"></td></tr></table>
	</form></center>';
	break;

case "edit":
	print '<center><a href="?option=edit"><img border="0" width="40" height="40" src="images/email.gif" alt="Edit Mail"></a><br><b>Edit Mail</b></center><br><br>';
	$editor_type= "text";
	if (isset($_GET['editor_type'])) $editor_type = $_GET['editor_type'];
	if ($editor_type == "text") print '<center><b>Plain Text &nbsp; | &nbsp; 
	<a href="?option=edit&editor_type=wysiwyg" class="link" title="HTML WYSIWYG editor">HTML editor</a></b><br><br>';
	else print '<center><b><a href="?option=edit&editor_type=text" class="link" title="Plain text editor">Plain Text</a> &nbsp; | &nbsp; HTML editor &nbsp; </b><br><br>';
	if ($_SESSION['title'] != "" && $_SESSION['contents'] != "")
	{
		$title = $_SESSION['title'];
		$contents = $_SESSION['contents'];
		require_once("fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor('contents') ;
		$oFCKeditor->BasePath = "fckeditor/";
		$oFCKeditor->Config['AutoDetectLanguage'] = false ;
		$oFCKeditor->Config['DefaultLanguage'] = "en" ;
		$oFCKeditor->ToolbarSet = "CcMail" ;
		$oFCKeditor->Value = $contents ;
		print "
		<center><form method=\"post\" action=\"$PHP_SELF?option=compose\">
		<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>
		<td><b><div class=\"standard\"><font color=\"red\">&nbsp;&nbsp;Subject:&nbsp;&nbsp; </font></div></b></td>
		<td align=\"left\" width=\"90%\"><input name=\"subject\" value=\"$title\" style=\"width: 100%;background-color: #FCFCFC;border: #A7A7A7 1px solid;color: #000000; font: 11px Verdana, Geneva, Arial, Helvetica, \"Nimbus Sans L\", sans-serif;\"></td></tr>
		<tr><td colspan=\"2\" height=\"5\"></td></tr>
		<tr><td colspan=\"2\" align=\"right\">";
		if($editor_type =="wysiwyg") $oFCKeditor->Create();
		else print "<textarea name=\"contents\" style=\"width: 100%;height: 400;background-color: #FCFCFC;border: #A7A7A7 1px solid;color: #000000; font: 11px Verdana, Geneva, Arial, Helvetica, \"Nimbus Sans L\", sans-serif;\">$contents</textarea>";
		print "</td></tr>
		<tr><td colspan=\"2\" align=\"right\"><br><input class=\"button\" type=\"submit\" value=\"Proceed\"></td></tr></table>
		</form></center>";
	}
	break;

case "notify":
	print '<center><img border="0" width="40" height="40" src="images/email.gif" alt="Notify users"><br><b>Sending Notification</b></center><br><br>';
	switch($_GET['case'])
	{
	case "user_del":
	include ($settings_dir . "/on_user_delete.ccmail");
	$recipient = $_SESSION['deleted_users'];
	print "<b>Sending the following mail:</b><br><br>";
	print_mail($notify_message, $on_user_delete, "text", false);
	print_mail_header(); mail_array($pass, $recipient, $notify_message, $on_user_delete, "text");
	break;

	case "user_res":
	$recipient = $_SESSION['restored_users'];
	include ($settings_dir . "/on_user_restore.ccmail");
	print "<b>Sending the following mail:</b><br><br>";
	print_mail($notify_message, $on_user_restore, "text", false);
	print_mail_header(); mail_array($pass, $recipient, $notify_message, $on_user_restore, "text");
	break;

	case "group_created":
	$gr_name = stripslashes(trim($_GET['gr_name']));
	include ($settings_dir . "/on_group_created.ccmail");
	$decripted_users = decrypt_array(array_keys($users), $pass); //include all users
	if (count($decripted_users)>0){
	print "<b>Sending the following mail to all subscribed users:</b><br><br>";
	print_mail($notify_message, $on_group_created, "text", false);
	print_mail_header(); mail_array($pass, $decripted_users, $notify_message, $on_group_created, "text");
	}
	else print "<b>No user subscribed yet.</b><br><br>";
	break;

	case "group_del":
	$gr_name = stripslashes(trim($_GET['to']));
	include ($settings_dir . "/on_group_delete.ccmail");
	$gr_users = get_group_users($gr_name, true); //only the users explicitely subscribed to the group
	if (count($gr_users)>0){
	print "<b>Sending the following mail to the users of group $gr_name:</b><br><br>";
	print_mail($notify_message, $on_group_delete, "text", false);
	print_mail_header(); mail_array($pass, $gr_users, $notify_message, $on_group_delete, "text");
	}
	else print "<b>No user subscribed to the group yet.</b><br><br>";
	break;

	case "group_res":
	$gr_name = stripslashes(trim($_GET['to']));
	include ($settings_dir . "/on_group_restore.ccmail");
	$gr_users = get_group_users($gr_name, true); //only the users explicitely subscribed to the group
	if (count($gr_users)>0){
	print "<b>Sending the following mail to the users of group $gr_name:</b><br><br>";
	print_mail($notify_message, $on_group_restore, "text", false);
	print_mail_header(); mail_array($pass, $gr_users, $notify_message, $on_group_restore, "text");
	}
	else print "<b>No user subscribed to the group yet.</b><br><br>";
	break;
	
	}
	break;

case "outbox":
	print '<center><a href="?option=outbox"><img border="0" width="40" height="40" src="images/outbox.gif" alt="Outbox"></a><br><b>Outbox</b></center><br><br>';
	if (!isset($_GET['item'])) show_outbox($mails_dir);
	else print_sent_mail($mails_dir, $pass, $_GET['item']);
	break;
	
case "drafts":
	//save mail, if selected, and display folder
	if (isset($_POST['savemail']) && $_POST['savemail'] == true) save_mail($drafts_dir, $pass, $rec_array=array(), stripslashes($_SESSION['title']), stripslashes($_SESSION['contents']), $_SESSION['display'], $_SESSION['attach']);
	print '<center><a href="?option=drafts"><img border="0" width="40" height="40" src="images/drafts.gif" alt="Drafts"></a><br><b>Drafts</b></center><br><br>';
	if (!isset($_GET['item'])) show_outbox($drafts_dir);
	else print_sent_mail($drafts_dir, $pass, $_GET['item']);
	break;

case "unsent":
	print '<center><a href="?option=unsent"><img border="0" width="40" height="40" src="images/unsent.gif" alt="Outbox"></a><br><b>Unsent</b></center><br><br>';
	if (!isset($_GET['item'])) show_outbox($unsent_dir);
	else print_sent_mail($unsent_dir, $pass, $_GET['item']);
	break;

case "mail_user":
	list_users($pass, $_SESSION['array']);
	break;

case "type_address":
	print '<center><a href="?option=type_address"><img border="0" width="40" height="40" src="images/email.gif" alt="Type address"></a><br><b>Add Recipient</b></center><br><br>';
	print "<b>Type the address you want to add to Recipients.<br></b>To add more addresses, separe them trough commas (ex: example@example.com, none@user.net).<br><br><br>
	<center><form method=\"post\" action=\"$PHP_SELF?option=type_address\">
	<b>Type Mail address(es):</b>
	<input class=\"tbox\" name=\"typed_address\" size=\"20\" maxlength=\"100\">
	<input class=\"button\" type=\"submit\" value=\"Add to Recipients\">
	</form></center>";
	if (isset($_POST['typed_address']) && $_POST['typed_address'] != "") print "
	<br><br><b>Valid address(es) was/were successfully added.</b>";
	break;

case "remove_recipient":
	print '<center><a href="?option=list_users"><img border="0" width="40" height="40" src="images/users.gif" alt="Manage Users"></a><br><b>Manage Users</b></center><br><br>';
	list_users($pass, $_SESSION['array']);
break;

case "mail_group":
	list_groups();
	print "<br><br><br>
	<b>The users of the group (even those who were not explicitely subscribed to that group, but were subscribed to every group)have been added to the Recipients list.</b>";
	break;

case "remove_recipient_group":
	list_groups();
	print "<br><br><br>
	<b>The users of the group have been removed from the Recipients list.</b>";
break;

case "mail_all":
	print '<center><a href="?option=list_users"><img border="0" width="40" height="40" src="images/users.gif" alt="Manage Users"></a><br><b>Manage Users</b></center><br><br>';
	list_users($pass, $_SESSION['array']);
	break;

case "mail":
	print '<center><a href="?option=mail"><img border="0" width="40" height="40" src="images/email.gif" alt="Send Mail"></a><br><b>Send Mail</b></center><br><br>';
	if (isset($_POST['plain_text_version'])) $_SESSION['plain_text_version'] = stripslashes($_POST['plain_text_version']);
	
	//Reading session variables
	if ($_SESSION['title'] != "" && $_SESSION['contents'] != "")
	{
		if($number_of_recipients_in_array == 0) 
			print "<center><b>Select recipients first! This mail will be preserved.</b></center>";
		else
		{
			$encoding = "";
			if (isset($_POST['encoding']) && $_POST['encoding'] != "" || $_SESSION['display'] != "") {
			if (isset($_POST['encoding']) && $_POST['encoding'] != "") $encoding = $_POST['encoding'];
			else $encoding = $_SESSION['display'] ;
			
			//If encoding is set to html, ask for a plain text version
			if($encoding == "html" && !isset($_SESSION['plain_text_version']))
			{
				$plaintext = trim(strip_tags(str_replace("<br/>", "\n", str_replace("<br>", "\n", $_SESSION['contents']))));
				print "
				<center><form method=\"post\" action=\"$PHP_SELF?option=mail\">
				<input type=\"hidden\" name=\"encoding\" value=\"$encoding\">
				<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>
				<td><b><div class=\"standard\">Even if you want to send this Mail as HTML, it is generally a good choice to include a plain text version for those clients that don't support HTML.<br><br>
				<textarea name=\"plain_text_version\" style=\"width: 100%;height: 400;background-color: #FCFCFC;border: #A7A7A7 1px solid;color: #000000; font: 11px Verdana, Geneva, Arial, Helvetica, \"Nimbus Sans L\", sans-serif;\">$plaintext</textarea></td></tr>
				</td></tr>
				<tr><td colspan=\"2\" align=\"right\"><br><input class=\"button\" type=\"submit\" value=\"Proceed\"></td></tr></table>
				</form></center>";
			}
			//If a confirm was received send mail
			if (isset($_POST['confirm']) && $_POST['confirm'] == "true") 
			{
				$send_mail = true;
				print_mail_header();
			}
			else if($encoding == "text" || ($encoding == "html" && isset($_SESSION['plain_text_version']))) { //ask for a confirm
			print_mail($_SESSION['title'], $_SESSION['contents'], $encoding, false, $_SESSION['attach']); //doesn't print choice between text or html
			print "
			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\"></td>
			</tr><tr><td colspan=\"5\" align=\"right\"><div class=\"menu_title\">Are you sure you want to send this Mail?&nbsp;<br><br></div></td></tr><tr>
			<td valign=\"top\" align=\"right\" width=\"10%\">
			<form method=\"post\" action=\"$PHP_SELF?option=mail\">
			<input type=\"hidden\" name=\"encoding\" value=\"$encoding\">
			<input type=\"hidden\" name=\"confirm\" value=\"true\">
			<input class=\"button_red\" type=\"submit\" value=\"Yes\">
			</form></td>
			<td width=\"10\">&nbsp;</td><td valign=\"top\" align=\"right\" width=\"10%\"><form method=\"post\" action=\"$PHP_SELF?option=compose\">
			<input class=\"button\" type=\"submit\" value=\"No\">&nbsp;
			</form></td>
			<td width=\"10\">&nbsp;</td><td valign=\"top\" align=\"right\" width=\"10%\"><form method=\"post\" action=\"$PHP_SELF?option=schedule&new_schedule=true\">
			<input type=\"hidden\" name=\"encoding\" value=\"$encoding\">
			<input class=\"button_red\" type=\"submit\" value=\"Schedule\">&nbsp;
			</form></td><td width=\"10\">&nbsp;</td></tr></table>";
			}
			}
			else print "Invalid encoding type";
		}
	}
	else print "<center><b>Compose a Mail first!</b></center>";
	break;
}

//if ($back) print "<br><br><br><br><br><br><center><b><a class=\"article\" href=\"$PHP_SELF?$back\">Back</a></b><br></center>";

//*********************BEGIN HTML CODE******************
?>
</div><br>
</td></tr></table>
<!--******************/BODY******************-->
<td align="center" width="19%" valign="top">
	<table class="max_table" cellpadding="0" cellspacing="0">
	<tr>
	<td height="100%" align="center" width="100%" valign="top">
	<!--*********MENU*********-->
	<table class="menu_button" cellpadding="0" cellspacing="0"><tr>
	<td align="left" height="31" width="32"><img src="images/head.png" border="0" alt=""></td>
	<td height="31" width="100%" align="center" valign="middle">
	<a class="menu_title">Recipients</a></td>
	<td height="31" align="right" width="29"><img src="images/foot.png" border="0" alt=""></td>
	<td height="31" width="5"><img src="images/shadow1.gif" border="0" alt=""></td>
	</tr>
	<tr><td colspan="3">
			<table class="menu_content_table" cellspacing="0" cellpadding="1"><tr><td width="100%" valign="top">
			<table class="menu_content_table_bg" cellspacing="0" cellpadding="0"><tr><td valign="top">
			<div class="menu"><center>
			<!--Menu body-->
			<?php
			print "
			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>
			<td align=\"center\" width=\"100%\">
			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td><div class=\"menu\">
			<b>&bull; <a class=\"link\" href=\"$PHP_SELF?option=list_users\" title=\"Add some subscriber\">Add Users</a><br>
			&bull; <a class=\"link\" href=\"$PHP_SELF?option=list_groups\" title=\"Add some Group (i.e. its subscribers)\">Add Groups</a><br>
			&bull;&nbsp;<a class=\"link\" href=\"$PHP_SELF?option=type_address\" title=\"Add some not subscribed address\">Type&nbsp;Address</a><br>
			&bull;&nbsp;<a class=\"link\" href=\"$PHP_SELF?option=mail_all\" title=\"Add every User\">Add&nbsp;Everyone</a><br></b><br></td></tr></table></td></tr><tr><td><div class=\"menu\">";
			$number_displayed = ""; if (isset($_GET['display_all'])) $number_displayed = $_GET['display_all'];
			$recipients_displayed = $max_displayed_recipients;
			if($number_displayed == "all" || $number_of_recipients_in_array <= $recipients_displayed) $recipients_displayed = $number_of_recipients_in_array; 
			if ($number_of_recipients_in_array != 0) 
			{
				print "<b>$number_of_recipients_in_array&nbsp;selected:</b><br>";
				for($k=0; $k<$recipients_displayed; $k++)
				{
					$item = $_SESSION['array'][$k]; $short=$item;
					if (stristr($_SERVER['HTTP_USER_AGENT'], "MSIE")) //IE visualization bug
						$short = str_replace("@", "[at]", $short);

					if (strlen($short) > 24) $short = substr($short, 0, 21) . "...";
					print "<a class=\"link\" href=\"$PHP_SELF?option=get_user_details&item=$item\" title=\"Details about $item\">$short</a><br>\n";
				}
				if ($number_of_recipients_in_array > $recipients_displayed)
					print "<a class=\"link\" href=\"$PHP_SELF?option=$option&display_all=all\" title=\"View All\">[...]</a><br>\n
					<center><b><a class=\"link\" href=\"$PHP_SELF?option=$option&display_all=all\" >View all</a></b></center>";
				else if ($number_displayed == "all") print "<br><center><b><a class=\"link\" href=\"$PHP_SELF?option=$option\">Reduce list</a></b></center>";
				print "<br><center><b><a class=\"link\" href=\"$PHP_SELF?option=erase_list\" title=\"Empty list\">Erase Recipients List</a></b></center>"; 
			}
			else print "<center><b>None&nbsp;selected</b>";
			print "</div></td></tr></table>";
			?><!--/Menu body-->
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
	</td>
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
<?
//SEND MAIL IF $send_mail==true
if($send_mail)
{
if($encoding == "html") 
	mail_array($pass, $_SESSION['array'], $_SESSION['title'], text_to_html($_SESSION['contents'], "html"), "html", true, $_SESSION['attach'], false, $_SESSION['plain_text_version']);
else if($encoding == "text") 
	mail_array($pass, $_SESSION['array'], $_SESSION['title'], $_SESSION['contents'], "text", true, $_SESSION['attach']);

unset($_SESSION['plain_text_version']);
}
?>
</body>
</html>
</body></html>
