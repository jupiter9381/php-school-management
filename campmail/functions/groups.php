<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

/*GROUPS.PHP - Groups management functions:

1- list_groups()
2- list_to_del_group()
3- list_to_restore_group()
4- add_group($gr_name)
5- delete_group($gr_name)
6- restore_group($gr_name)
7- get_group_users($group, $strict=false)
8- get_group_details($pass, $group)
9 - hide_group($gr_name)
10- unhide_group($gr_name)
*/

function list_groups($group_to_display = false) //group_to_display is used when you want to display only some groups
{
	global $groups_dir;
	global $groups;
	global $option;
	global $PHP_SELF;
	$sort_by_time = false;
	$getitem = ""; if (isset($_GET['item'])) $getitem = $_GET['item'];
	if (isset($_GET['sortgroupsbytime']) && $_GET['sortgroupsbytime'] == "true") $sort_by_time = true; //MAKEUNIVERSAL!!!!
	
	if (count($groups) == 0) print "<center><b>No active Group found.</b><br><br><br></center>";
	else
	{
		if (is_array($group_to_display)) $groups = array_intersect($groups, $group_to_display);
		$timestamps = array_keys($groups); //returns alphabetically ordered groups
		//Get users sorted by name or time
		if ($sort_by_time) {asort($timestamps);
		$timestamps  = array_reverse($timestamps);}
		
		$rows = sizeof($groups) + 2;
		if (!$sort_by_time) print "<center><table border=\"0\" cellpadding=\"1\" cellspacing=\"2\"><tr>
		<td></td><td align=\"center\"><div class=\"standard\"><b>Group Name</b></div></td>
		<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
		<td align = \"center\"><a class=\"menulink\" href=\"?option=$option&sortgroupsbytime=true&item=$getitem\" title=\"Sort by Time\"><b>Date Created</b></a></td>";
		else print "<center><table border=\"0\" cellpadding=\"1\" cellspacing=\"2\"><tr>
		<td></td><td align=\"center\"><a class=\"menulink\" href=\"?option=$option&item=$getitem\" title=\"Sort by Name\"><b>Group name</b></a></td>
		<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
		<td align = \"center\"><div class=\"standard\"><b>Date Created</b></div></td>";
		print "<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
		<td align = \"center\"><div class=\"menu\"><b>Hide</b></div></td>
		<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
		<td align = \"center\"><div class=\"menu\"><b>Recipients Options</b></div></td>
		</tr><tr><td height=\"5\" colspan = \"8\" background=\"images/dot.gif\"></td></tr>";
		$counter = 0;
		foreach($timestamps as $item)
		{
			$date = date("j/m/Y, G:i", $item);
			$counter ++;
			$gr_name = $groups[$item];
			$displayed = text_to_html($gr_name, "html");
			print "\n<tr><td align = \"center\"><div class=\"standard\"><b>$counter &nbsp</b></div></td>
			<td align = \"center\"><a class=\"link\" href=\"$PHP_SELF?option=get_group_details&item=$item\" title=\"See group details\"><b>$displayed</b></a></td>
			<td align=\"right\"><div class=\"standard\">$date</div></td>";
			if (!strstr($item, ".HIDE")) print "<td align = \"center\"><div class=\"standard\"><a class=\"link\" href=\"$PHP_SELF?option=list_groups&hide=$item\" title=\"Hide Group to Users\">Hide</a></div></td>";
			else print "<td align=\"center\"><div class=\"standard\"><a class=\"link\" href=\"$PHP_SELF?option=list_groups&unhide=$item\" title=\"Unhide Group\">Unhide</a></div></td>";
			print "<td align=\"center\"><div class=\"standard\">
			<a class=\"link\" href=\"$PHP_SELF?option=mail_group&item=$gr_name\" title=\"Add to Recipients\">Add</a> / <a class=\"link\" href=\"$PHP_SELF?option=remove_recipient_group&item=$gr_name\" title=\"Remove from Recipients\">Remove</a>
			</div></td></tr>";
		}
		print "</table></center>";
	}
}

function list_to_del_group()
{
	global $PHP_SELF;
	global $groups;
	
	if (count($groups) == 0) print "<center><b>No Group to delete.</b></center>";
	else
	{
		print "<center><b>Active Groups: click to delete.<br><br>";
		$timestamps = array_keys($groups);
		foreach($timestamps as $item)
		{
			$gr_name = text_to_html($groups[$item], "html");
			print "\n<a class=\"link\" href=\"$PHP_SELF?option=delete_group&item=$item\" title=\"Delete group\">$gr_name</a><br>";
		}
		print "</b></center>";
	}
}

function list_to_restore_group()
{
	global $PHP_SELF;

	$groups = getgroups(false);
	if (count($groups) == 0) print "<center><b>No Group to restore.</b></center>";
	else
	{
		print "<center><b>Deleted Groups: click to restore.<br><br>";
		$timestamps = array_keys($groups);
		foreach($timestamps as $item)
		{
			$gr_name = text_to_html($groups[$item], "html");
			$item = str_replace(".OLD", "", $item); //removes OLD suffix
			print "\n<a class=\"link\" href=\"$PHP_SELF?option=restore_group&item=$item\" title=\"Restore group\">$gr_name</a><br>";
		}
		print "</b></center>";
	}
}

function add_group($gr_name)
{
	global $groups_dir;
	global $groups;
	
	if (!in_array($gr_name, $groups)) 
	{
		if (write_to_file ($groups_dir . "/" . time() . ".ccmail", "\\\"" . $gr_name)){ //\" is necessary to use get_settings
		print "<b>Group successfully added.</b><br><br>";
		return true;}
		else return false;
	}
	else
	{
		print "<b>Group already present.</b><br><br>";
		return false;
	}
}

function delete_group($gr_name)
{
	global $groups_dir;
	if (file_exists($groups_dir . "/" . $gr_name . ".ccmail"))
	{
		@chmod($groups_dir . "/" . $gr_name . ".ccmail", 0755);
		rename($groups_dir . "/" . $gr_name . ".ccmail", $groups_dir . "/" . str_replace(".ccmail", "", $gr_name) . ".OLD.ccmail");
		print "<b>Group deleted.</b><br><br>";
		return true;
	}
	else print "<b>Group is no longer active!</b><br><br>";
	return false;
}

function restore_group($gr_name)
{
	global $groups_dir;
	if (file_exists($groups_dir . "/" . $gr_name . ".OLD.ccmail"))
	{
		@chmod($groups_dir . "/" . $gr_name . ".OLD.ccmail", 0755);
		rename($groups_dir . "/" . $gr_name . ".OLD.ccmail", $groups_dir . "/" . $gr_name . ".ccmail");
		print "<b>Group restored.</b><br><br>";
		return true;
	}
	else print "<b>Group has not been deleted!</b><br><br>";
	return false;
}

function get_group_users($group, $strict=false) //if strict=true returns only the users explicitely subscribed to that group
{
	global $pass;
	global $addresses_dir;
	global $users;
	global $crypt;
	
	$group_users = array();
	$addresses = array_keys($users);
	foreach ($addresses as $user)
	{
		$filename = $addresses_dir . "/" . $user . "_~_" . $users[$user];
		$file = fopen($filename, "r");
		if (flock($file, LOCK_SH)) //acquires lock
		{
			$filesize = filesize($filename);
			if ((!$strict && $filesize == 0) || ($filesize != 0 && strstr(fread($file, $filesize), $group))) //file empty=every group
				array_push($group_users, $crypt->decrypt ($pass, $user));
			flock($file, LOCK_UN); //releases lock
		}
		fclose($file);
	}
	return $group_users;
}

function get_group_details($pass, $group)
{
	global $groups_dir;
	global $groups;
	global $users;
	global $crypt;
	
	$filename = $groups_dir . "/" . $group . ".ccmail";
	if (file_exists($filename))
	{
		$gr_name = $groups[$group];
		$users_subscribed = get_group_users($gr_name, true); //only explicitely subscribed users
		$users_no = count($users_subscribed);
		$date = date("F j, Y, g:i a", $group);
		print "<center>Group <b>$gr_name</b> was created on <b>$date</b>. There are <b>$users_no</b> users subscribed to this group:";
		$crypted_list = array();
		foreach($users_subscribed as $item) {
		$crypted = trim($crypt->encrypt ($pass, $item));
		$crypted_list[$crypted] = $users[$crypted];
		}
		arsort($crypted_list);
		if ($users_no > 0) list_users($pass, $_SESSION['array'], $crypted_list);
		print "<br><br></center>";
	}
	else print "<b>Could not retrieve informations about group.</b><br><br>";
}

function hide_group($gr_name)
{
	global $groups_dir;
	if (file_exists($groups_dir . "/" . $gr_name . ".ccmail"))
	{
		rename($groups_dir . "/" . $gr_name . ".ccmail", $groups_dir . "/" . str_replace(".ccmail", "", $gr_name) . ".HIDE.ccmail");
		print "<center><b>Group Hidden.</b><br><br></center>";
		return true;
	}
	else print "<center><b>Group is no longer active!</b><br><br></center>";
	return false;
}

function unhide_group($gr_name)
{
	global $groups_dir;
	if (file_exists($groups_dir . "/" . $gr_name . ".ccmail"))
	{
		rename($groups_dir . "/" . $gr_name . ".ccmail", $groups_dir . "/" . str_replace(".HIDE", "", $gr_name) . ".ccmail");
		print "<center><b>Group Unhidden.</b><br><br></center>";
		return true;
	}
	else print "<center><b>Group has not been hidden!</b><br><br></center>";
	return false;
}
?>