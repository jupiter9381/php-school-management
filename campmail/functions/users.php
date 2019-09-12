<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

/*USERS.PHP - Users management functions:

1- decrypt_array($array, $pass) //required for notify
2- list_users($pass, $array)
3- restore_delete_list($pass, $delete)
4- delete_user($item)
5- restore_user($item)

*/

function decrypt_array($array, $pass) //required for notify
{
	global $crypt;
	$array_size = count($array);
	$decrypted_array = array();
	for($i = 0; $i < $array_size; $i++) array_push($decrypted_array, $crypt->decrypt ($pass, $array[$i]));
	return $decrypted_array;
}

function list_users($pass, &$array, $users_to_display = false)
{
	global $addresses_dir;
	global $users;
	global $crypt;
	global $PHP_SELF;
	global $_GET;
	global $option;
	$sort_by_time = true;
	$getitem = ""; if (isset($_GET['item'])) $getitem = $_GET['item'];
	if(isset($_GET['to_search'])) $getitem .= "&to_search=".$_GET['to_search'];
	if(isset($_GET['search_option'])) $getitem .= "&search_option=".$_GET['search_option'];
	if (isset($_GET['sortusersbytime']) && $_GET['sortusersbytime'] == "false") $sort_by_time = false;
	$print_sort_by_time = ""; if (!$sort_by_time) $print_sort_by_time = "false";

	$recipients = array();
	if (count($array) != 0) $recipients = $array;
	
	//Third argument: print only $users_to_display array elements
	if (is_array($users_to_display)) $users = &$users_to_display;
	
	$addresses = array_keys($users); //users sorted by time
	if (!$sort_by_time) {
	$decrypted_array = array();
	foreach($addresses as $item) array_push($decrypted_array, $crypt->decrypt ($pass, $item));
	sort($decrypted_array);
	$addresses = $decrypted_array;
	}
	
	$sizeofarray=count($addresses);
	if ($sizeofarray == 0) print "<center><b>No subscribed User.</b></center>";
	else
	{
	//Split
	$splitnumber = 1;
	if (isset($_GET['splitnumber'])) $splitnumber = $_GET['splitnumber'];
	$numberofsplits = floor(8*(1 - exp(-$sizeofarray/400))) + 1;
	if ($sizeofarray/800 > 1) $numberofsplits = round($numberofsplits*$sizeofarray/800);
	$splitby = ceil($sizeofarray/$numberofsplits);
	$group_number = ceil($splitnumber/7); $nextgroup = $group_number*7+1; $prevgroup = $nextgroup-8; 
	$lastgroup = ceil($sizeofarray/$splitby);
	
	print "<center><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td rowspan=\"2\">";
	if ($group_number > 1) print "<a href=\"$PHP_SELF?option=$option&item=$getitem&splitnumber=1&sortusersbytime=$print_sort_by_time\" title=\"First Users\"><image border=\"0\" src=\"images/first.gif\" alt=\"Prev\"></a>&nbsp;<a href=\"$PHP_SELF?option=$option&item=$getitem&splitnumber=$prevgroup&sortusersbytime=$print_sort_by_time\" title=\"Previous Users\"><image border=\"0\" src=\"images/prev.gif\" alt=\"Prev\"></a>&nbsp;";
	print "</td><td><div class=\"standard\"><b><center>";
	$lowersplit = 0;
	$uppersplit = $sizeofarray;
	if ($numberofsplits > 1) {
	for($j=1;$j<=$numberofsplits;$j++) {
	$lower = ($j-1)*$splitby + 1;
	$upper = $j*$splitby;
	if($upper>=$sizeofarray) $upper = $sizeofarray;
	if ($j <= $group_number*7 && $j > ($group_number-1)*7)
	{
		if ($splitnumber == $j) {
			print "[$lower-$upper] ";
			$lowersplit = $lower-1;
			$uppersplit = $upper;
		}
		else print "<a class=\"link\" href=\"$PHP_SELF?option=$option&item=$getitem&splitnumber=$j&sortusersbytime=$print_sort_by_time\">[$lower-$upper]</a> ";
		}
	}
	}
	print "</center></b></div></td>";
	if ($nextgroup < $numberofsplits) print "<td rowspan=\"2\">&nbsp;<a href=\"$PHP_SELF?option=$option&item=$getitem&splitnumber=$nextgroup&sortusersbytime=$print_sort_by_time\" title=\"Next Users\"><image border=\"0\" src=\"images/next.gif\" alt=\"Next\"></a>&nbsp;<a href=\"$PHP_SELF?option=$option&item=$getitem&splitnumber=$lastgroup&sortusersbytime=$print_sort_by_time\" title=\"Last Users\"><image border=\"0\" src=\"images/last.gif\" alt=\"Last\"></a></td>";
	print "</tr><tr><td colspan=\"3\" height=\"2\"> </td></tr></table>";
	
	//Print
	$rows = $sizeofarray + 2;
	if (!$sort_by_time) print "
	<table border=\"0\" cellpadding=\"1\" cellspacing=\"2\"><tr>
	<td></td><td align=\"center\"><div class=\"standard\"><b>User address</b></div></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><a class=\"menulink\" href=\"$PHP_SELF?option=$option&item=$getitem&splitnumber=$splitnumber\" title=\"Sort by Time\"><b>Date Subscribed</b></a></td>";
	else print "<table border=\"0\" cellpadding=\"1\" cellspacing=\"2\"><tr>
	<td></td><td align=\"center\"><a class=\"menulink\" href=\"$PHP_SELF?option=$option&item=$getitem&sortusersbytime=false&splitnumber=$splitnumber\" title=\"Sort by Name\"><b>User address</b></a></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"standard\"><b>Date Subscribed</b></div></td>";
	print "<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"menu\"><b>Recipients Options</b></div></td>
	</tr><tr><td height=\"5\" colspan=\"6\" background=\"images/dot.gif\"></td></tr>";
	
	$counter = $lowersplit;
	for($j=$lowersplit;$j<$uppersplit;$j++)
	{
		if($sort_by_time) {
		$item = $addresses[$j];
		$print = $crypt->decrypt ($pass, $item);
		}
		else {
		$print = $addresses[$j];
		$item = $crypt->encrypt ($pass, $print);
		}
		$filename = $item . "_~_" . $users[$item]; $date = str_replace(" ", "&nbsp;", date("j/m/Y, G:i", $users[$item]));
		if($users[$item] == "") $date = "Unknown";
		$counter ++;
		print "\n<tr><td align = \"center\"><div class=\"standard\"><b>$counter &nbsp</b></div></td>
		<td align=\"center\"><a class=\"link\" href=\"$PHP_SELF?option=get_user_details&item=$filename&splitnumber=$splitnumber\" title=\"See user details\"><b>$print</b></a></td>
		<td align=\"right\"><div class=\"standard\">$date</div></td>
		<td align=\"center\"><div class=\"standard\">";
		if (!in_array($print, $recipients))
		print "<a class=\"link\" href=\"$PHP_SELF?option=mail_user&item=$print&sortusersbytime=$print_sort_by_time&splitnumber=$splitnumber\" title=\"Add to Recipients\">Add</a> / Remove";
		else print "Add / <a class=\"link\" href=\"$PHP_SELF?option=remove_recipient&item=$print&sortusersbytime=$print_sort_by_time&splitnumber=$splitnumber\" title=\"Remove from Recipients\">Remove</a>";
		print "</div></td></tr>";
		flush(); @ob_flush();
	}
	print "</table></center>";
	}
}

function restore_delete_list($users, $pass, $delete) // $delete = delete_user or restore_user
{
	global $PHP_SELF;
	global $_GET;
	global $crypt;

	$sort_by_time = true;
	if (isset($_GET['sortusersbytime']) && $_GET['sortusersbytime'] == "false") $sort_by_time = false;
	$print_sort_by_time = ""; if (!$sort_by_time) $print_sort_by_time = "false";
	$search_option = ""; if (isset($_GET['search_option'])) $search_option = $_GET['search_option'];
	$to_search = ""; if (isset($_GET['to_search'])) $to_search = $_GET['to_search'];
	
	$addresses = array_keys($users); //users sorted by time
	if (!$sort_by_time) {
		$decrypted_array = array();
		foreach($addresses as $item) array_push($decrypted_array, $crypt->decrypt ($pass, $item));
		sort($decrypted_array);
		$addresses = $decrypted_array;
	}
	
	$sizeofarray=count($addresses);
	if ($sizeofarray == 0) print "<center><b>No User.</b></center>";
	else
	{
	//Split
	$splitnumber = 1;
	if (isset($_GET['splitnumber'])) $splitnumber = $_GET['splitnumber'];
	$numberofsplits = floor(8*(1 - exp(-$sizeofarray/400))) + 1;
	if ($sizeofarray/800 > 1) $numberofsplits = round($numberofsplits*$sizeofarray/800);
	$splitby = ceil($sizeofarray/$numberofsplits);
	$group_number = ceil($splitnumber/7); $nextgroup = $group_number*7+1; $prevgroup = $nextgroup-8; 
	$lastgroup = ceil($sizeofarray/$splitby);
	
	print "<center><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td rowspan=\"2\">";
	if ($group_number > 1) print "<a href=\"$PHP_SELF?option=$delete&search_option=$search_option&to_search=$to_search&splitnumber=1&sortusersbytime=$print_sort_by_time\" title=\"First Users\"><image border=\"0\" src=\"images/first.gif\" alt=\"Prev\"></a>&nbsp;<a href=\"$PHP_SELF?option=?option=$delete&search_option=$search_option&to_search=$to_search&splitnumber=$prevgroup&sortusersbytime=$print_sort_by_time\" title=\"Previous Users\"><image border=\"0\" src=\"images/prev.gif\" alt=\"Prev\"></a>&nbsp;";
	print "</td><td><div class=\"standard\"><b><center>";
	$lowersplit = 0;
	$uppersplit = $sizeofarray;
	if ($numberofsplits > 1) {
	for($j=1;$j<=$numberofsplits;$j++) {
	$lower = ($j-1)*$splitby + 1;
	$upper = $j*$splitby;
	if($upper>=$sizeofarray) $upper = $sizeofarray;
	if ($j <= $group_number*7 && $j > ($group_number-1)*7)
	{
		if ($splitnumber == $j) {
			print "[$lower-$upper] ";
			$lowersplit = $lower-1;
			$uppersplit = $upper;
		}
		else print "<a class=\"link\" href=\"$PHP_SELF?option=$delete&search_option=$search_option&to_search=$to_search&splitnumber=$j&sortusersbytime=$print_sort_by_time\">[$lower-$upper]</a> ";
		}
	}
	}
	print "</center></b></div></td>";
	if ($nextgroup < $numberofsplits) print "<td rowspan=\"2\">&nbsp;<a href=\"$PHP_SELF?option=$delete&search_option=$search_option&to_search=$to_search&splitnumber=$nextgroup&sortusersbytime=$print_sort_by_time\" title=\"Next Users\"><image border=\"0\" src=\"images/next.gif\" alt=\"Next\"></a>&nbsp;<a href=\"$PHP_SELF?option=$delete&search_option=$search_option&to_search=$to_search&splitnumber=$lastgroup&sortusersbytime=$print_sort_by_time\" title=\"Last Users\"><image border=\"0\" src=\"images/last.gif\" alt=\"Last\"></a></td>";
	print "</tr><tr><td colspan=\"3\" height=\"2\"> </td></tr></table>";
	
	//Print
	$rows = $sizeofarray + 2;
	print "<center>
	<form method=\"post\" action=\"$PHP_SELF?option=$delete\"><input type=\"hidden\" name=\"confirm\" value=\"yes\">";
	if (!$sort_by_time) print "
	<table border=\"0\" cellpadding=\"1\" cellspacing=\"2\"><tr>
	<td></td><td align=\"center\"><div class=\"standard\"><b>User address</b></div></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><a class=\"menulink\" href=\"$PHP_SELF?option=$delete&search_option=$search_option&to_search=$to_search\" title=\"Sort by Time\"><b>Date Subscribed</b></a></td>";
	else print "<table border=\"0\" cellpadding=\"1\" cellspacing=\"2\"><tr>
	<td></td><td align=\"center\"><a class=\"menulink\" href=\"$PHP_SELF?option=$delete&sortusersbytime=false&search_option=$search_option&to_search=$to_search\" title=\"Sort by Name\"><b>User address</b></a></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"standard\"><b>Date Subscribed</b></div></td>";
	print "<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"menu\">
	<input name=\"allbox\" type=\"checkbox\" value=\"check_all\" onClick=\"toggle_all(this.form);\" >
	</div></td>
	</tr><tr><td height=\"5\" colspan=\"6\" background=\"images/dot.gif\"></td></tr>";
	$counter = $lowersplit;
	for($j=$lowersplit;$j<$uppersplit;$j++)
	{
		if($sort_by_time) {
		$item = $addresses[$j];
		$print = $crypt->decrypt ($pass, $item);
		}
		else {
		$print = $addresses[$j];
		$item = $crypt->encrypt ($pass, $print);
		}
		
		$counter ++;
		$filename = $item . "_~_" . $users[$item];
		$date = str_replace(" ", "&nbsp;", date("j/m/Y, G:i", str_replace("~--OLD--~", "", $users[$item])));
		print "\n<tr><td align = \"center\"><div class=\"standard\"><b>$counter &nbsp</b></div></td>
		<td align=\"center\"><a class=\"link\" href=\"$PHP_SELF?option=get_user_details&item=$filename\" title=\"See user details\"><b>$print</b></a></td>
		<td align=\"right\"><div class=\"standard\">$date</div></td>
		<td align=\"center\"><div class=\"standard\">
		<input type=\"checkbox\" name=\"user_$j\" value=\"$filename\"><br>";
		flush(); @ob_flush();
	}
	if($delete == "restore_user") print "</table><br><input type=\"submit\" value=\"Restore selected\" class=\"button\"></form></center>";
	else print "</table><br><input type=\"submit\" value=\"Delete selected\" class=\"button\"></form></center>";
	}
}

function delete_user($item)
{
	global $PHP_SELF;
	global $addresses_dir;
	if (file_exists($addresses_dir . "/" . $item))
	{
		rename($addresses_dir . "/" . $item, $addresses_dir . "/" . $item . "~--OLD--~");
		return true;
	}
	else {print "<b>User is not registered!</b><br><br>";
	return false;}
}

function restore_user($item)
{
	global $addresses_dir;
	if (file_exists($addresses_dir . "/" . $item . "~--OLD--~"))
	{
		if (!file_exists($addresses_dir . "/" . $item)) 
			rename($addresses_dir . "/" . $item . "~--OLD--~", $addresses_dir . "/" . $item);
		else unlink($addresses_dir . "/" . $item . "~--OLD--~");
		
		return true;
	}
	else {print "<b>User has not been deleted.</b><br><br>";
	return false;}
}

?>