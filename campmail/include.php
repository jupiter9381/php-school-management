<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//INCLUDE.PHP - User interface to Subscribe/Unsubscribe/Modify

require_once (dirname(__FILE__) . "/config.php");
require_once ($functions_dir . "/shared.php");
if (!class_exists('crypto')) {require_once ($functions_dir . "/crypt.php"); $crypt = new Crypto;}
$error_message = "";
$address = ""; if (isset($_GET['address'])) $address = strtolower(stripslashes(trim($_GET['address'])));

//Retrieving language pack
require ($settings_dir . "/lang.ccmail"); $pack_filename = $lang_dir . "/" . $lang . ".php";
if(file_exists($pack_filename)) require ($pack_filename); else require($lang_dir . "/en.php");

//Retrieving POST address
if ($address != "" && !validate_email($address)) {$address = ""; $error_message = $CCMAIL_LANG['invalid_syntax'];}

//Removing banned addresses
if ($address != ""){
	$banned_array = explode(",", $banned_addresses);
	$banned_array_trim = array();
	foreach ($banned_array as $ban) array_push($banned_array_trim, trim($ban));
	foreach ($banned_array_trim as $ban) if (strlen($ban) > 0 && $address == $ban) {$address = ""; $error_message = $CCMAIL_LANG['not_allowed']; }
}

//Removing banned domains
if ($address != ""){
	$banned_domains_array = explode(",", $banned_domains);
	$banned_domains_array_trim = array();
	foreach ($banned_domains_array as $ban) array_push($banned_domains_array_trim, trim($ban));
	foreach ($banned_domains_array_trim as $ban) if (strlen($ban) > 0 && strstr($address, "@$ban")) {$address = ""; $error_message = $CCMAIL_LANG['not_allowed']; }
}

//Retrieving Groups, users and so on
$groups = getgroups(true, false);
$cripted_address = ""; $user_filename = "";
if($address != ""){
$cripted_address = $crypt->encrypt ($pass, $address);
$user_filename = file_search($addresses_dir, $cripted_address);
}

//Controlling if user has not been deleted
if (strstr($user_filename, "~--OLD--~")) {$address = ""; $error_message = $CCMAIL_LANG['not_allowed']; }

/*Visualization: if you want to edit CSS styles,
'standard' = standard text
'link' = link
'button' = button
'tbox_max' = input field
*/
print '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="100%"><div class="standard">';

//Activate email address by code
if($address != "" && isset($_GET['validation_code']) && $_GET['validation_code'] != "" && $validation_email == "on")
{
	$user_to_activate = file_search($waiting_dir, $cripted_address);
	if (strlen(trim($_GET['validation_code']))==20 && strstr($user_to_activate, "_~_" . trim($_GET['validation_code'])))
	{
		if (copy($waiting_dir."/".$user_to_activate, $addresses_dir."/".str_replace("_~_" . trim($_GET['validation_code']), "", $user_to_activate)) && unlink($waiting_dir."/".$user_to_activate)){
		//Sending notification...
		include ($settings_dir . "/on_subscription.ccmail");
		include ($settings_dir . "/notify_message.ccmail");
		$admin_email = array($send_copy_to);
		$user_email = array($address);
		if ($notify_user == "YES") mail_array($pass, $user_email, $notify_message, $on_subscription, "text", false);
		if ($notify_admin == "YES" && $send_copy_to != "") mail_array($pass, $admin_email, $notify_message, "User $address subscribed to your mailing list.", "text", false);
		$address = ""; $error_message = $CCMAIL_LANG['val_suc'];
		}
		else $error_message = $CCMAIL_LANG['val_code_err'];
	}
	else if($user_to_activate){
		$w_arr = explode("_~_", $user_to_activate); $old_val_code = trim($w_arr[2]);
		//Sending notification...
		$user_email = array($address);
		include ($settings_dir . "/validation_text.ccmail");
		$val_link = $subscription_form_url . "?address=$address&validation_code=$old_val_code";
		$validation_text = str_replace("VALIDATION_LINK", "<a href=\"$val_link\" title=\"Click to activate your account\">$val_link</a>", $validation_text);
		mail_array($pass, $user_email, $notify_message, $validation_text, "html", false);
		$error_message = $CCMAIL_LANG['wrong_val_code'];
	}
}

//Default Form
if (!isset($_GET['action']) || $address == "")
{
	print "<form method=\"get\" action=\"$PHP_SELF\"><b>" . $CCMAIL_LANG['insert_addr'] ."</b>
	<font color=\"red\"><b>$error_message</b></font><br><br>
	<input name=\"address\" size=\"20\" value=\"$address\" class=\"tbox_max\"><select name=\"action\" class=\"tbox\">
	<option value=\"subscribe\" selected>".$CCMAIL_LANG['subscribe']."</option>
	<option value=\"unsubscribe\">".$CCMAIL_LANG['unsubscribe']."</option>";
	if (count($groups) > 1) print "<option value=\"modify\">".$CCMAIL_LANG['modify']."</option>";
	print "</select><input type=\"submit\" value=\"".$CCMAIL_LANG['go']."\" class=\"button\"><br><br>";

	if (count($groups) > 1) 
	{
		print $CCMAIL_LANG['idlike']."<br>
		<input type=\"checkbox\" name=\"everything\" value=\"everything\" checked>".$CCMAIL_LANG['everything']."<br>\n";
		$gr_count = 0;
		foreach($groups as $item)
		{
			$gr_count ++;
			print "<input type=\"checkbox\" name=\"group_$gr_count\" value=\"$item\">$item<br>\n";
		}
	}
	print "</form>\n";
}

//Modify existing User
elseif (isset($_GET['action']) && $_GET['action'] == "modify")
{	
	if ($user_filename != "") {
	//apply selected changes
	if (isset($_GET['modify']) && $_GET['modify'] == "yes")
	{
		//retrieves informations about subscribed groups
		$selected_groups = array();
		$gr_count = 0;
		if (isset($_GET['everything']) && $_GET['everything'] == "everything") $selected_groups = $groups; //select everything
		else foreach ($groups as $item)
		{
			$gr_count ++;
			if (isset($_GET["group_" . $gr_count]) && stripslashes(trim($_GET["group_" . $gr_count])) == stripslashes(trim($item))) array_push($selected_groups, $item); //add selected groups
		}
		if (count($selected_groups) == 0) //if none was selected, display unsubscribe choice
		{
			$selected_groups = $groups;
			print $CCMAIL_LANG['wanna_unsub'];
		}
		
		//writes groups into file
		$string = ""; foreach ($selected_groups as $item) $string .= $item . "\n"; //create group string
		unlink ($addresses_dir . "/" . $user_filename);
		if (write_to_file($addresses_dir . "/" . $user_filename, $string))
			print "<b>".$CCMAIL_LANG['mod_suc']." <a class=\"link\" href=\"$PHP_SELF?action=\"><b>".$CCMAIL_LANG['go_back']."</b></a><br><br></b>";
		else print "<b>".$CCMAIL_LANG['mod_err']."<br></b>";
	}
	print "<form method=\"get\" action=\"$PHP_SELF\">
	<input readonly name=\"address\" size=\"20\" value=\"$address\" class=\"tbox_max\">
	<input type=\"hidden\" name=\"action\" value=\"modify\">
	<input type=\"hidden\" name=\"modify\" value=\"yes\">
	<input type=\"submit\" value=\"".$CCMAIL_LANG['go']."\" class=\"button\"><br><br>";

	$subscribed_groups = get_user_details($pass, $user_filename, false);
	if (count($groups) > 1) 
	{
		print $CCMAIL_LANG['edit_group'] ."<br>
		<input type=\"checkbox\" name=\"everything\" value=\"everything\"";
		if (count($subscribed_groups) == 0)  print "checked";
		print ">".$CCMAIL_LANG['everything']."<br>\n";
		$gr_count = 0;
		foreach($groups as $item)
		{
			$gr_count ++;
			print "<input type=\"checkbox\" name=\"group_$gr_count\" value=\"$item\"";
			if (in_array($item, $subscribed_groups)) print "checked";
			print ">$item<br>\n";
		}
	}
	print "</form>\n";
	}
	else print "<b>".$CCMAIL_LANG['usr_not_sub']." <a class=\"link\" href=\"$PHP_SELF?action=\"><b>".$CCMAIL_LANG['go_back']."</b></a></b><br><br>";
}

//Unsubscribe User
elseif (isset($_GET['action']) && $_GET['action'] == "unsubscribe")
{
	if (is_file($addresses_dir . "/" . $user_filename))
	{
		if (unlink($addresses_dir . "/" . $user_filename)){
		print "<b>".$CCMAIL_LANG['unsub_suc']." <a class=\"link\" href=\"$PHP_SELF?action=\"><b>".$CCMAIL_LANG['go_back']."</b></a></b><br><br>";
		//Sending notification...
		include ($settings_dir . "/on_unsubscription.ccmail");
		include ($settings_dir . "/notify_message.ccmail");
		$admin_email = array($send_copy_to);
		$user_email = array($address);
		if ($notify_user == "YES") mail_array($pass, $user_email, $notify_message, $on_unsubscription, "text", false);
		if ($notify_admin == "YES" && $send_copy_to != "") mail_array($pass, $admin_email, $notify_message, "User $address unsubscribed from your mailing list.", "text", false);
		}
		else {
		print "<b>".$CCMAIL_LANG['unsub_err']."</b>";
		$admin_email = array($send_copy_to);
		mail_array($pass, $admin_email, $notify_message, "Unable to unsubscribe user $address from your mailing list!", "text", false);
		}
	}
	else print "<b>".$CCMAIL_LANG['usr_not_sub']." <a class=\"link\" href=\"$PHP_SELF?action=\"><b>".$CCMAIL_LANG['go_back']."</b></a></b><br><br>";
}

//Subscribe User
elseif (isset($_GET['action']) && $_GET['action'] == "subscribe")
{
	//Retrieving informations about subscribed groups
	$selected_groups = array();
	$gr_count = 0;
	if (isset($_GET['everything']) && $_GET['everything'] == "everything") $selected_groups = $groups; //select everything
	else foreach ($groups as $item)
	{
		$gr_count ++;
		if (isset($_GET["group_" . $gr_count]) && stripslashes(trim($_GET["group_" . $gr_count])) == stripslashes(trim($item))) array_push($selected_groups, $item); //add selected groups
	}

	if ($user_filename == "")
	{
		//Save address and subscribed groups
		$string = "";
		foreach ($selected_groups as $item) $string .= $item . "\n"; //create group string
		
		if ($validation_email == "on") //if validation is required
		{
			if (file_search($waiting_dir, $cripted_address) != false) {
				print "<b>".$CCMAIL_LANG['waiting_val']."</b><br><br>";
				//Sending notification...
				$user_email = array($address);
				$temp_code_array = explode("_~_", file_search($waiting_dir, $cripted_address));
				$existing_validation_code = trim($temp_code_array[2]);
				include ($settings_dir . "/validation_text.ccmail");
				$val_link = $subscription_form_url . "?address=$address&validation_code=$existing_validation_code";
				$validation_text = str_replace("VALIDATION_LINK", "<a href=\"$val_link\" title=\"Click to activate your account\">$val_link</a>", $validation_text);
				mail_array($pass, $user_email, $notify_message, $validation_text, "html", false);
			}
			else{
			@include ($functions_dir . "/keygen.php");
			$validation_code = key_gen(true);
			if(write_to_file($waiting_dir . "/" . $cripted_address . "_~_" . time() . "_~_" . $validation_code, $string)){
				echo "<b>$address</b> ".$CCMAIL_LANG['val_sent'];
				print "<br><br><center><a class=\"link\" href=\"$PHP_SELF?action=\"><b>".$CCMAIL_LANG['go_back']."</b></a></center>";
				//Sending notification...
				$user_email = array($address);
				include ($settings_dir . "/validation_text.ccmail");
				$val_link = $subscription_form_url . "?address=$address&validation_code=$validation_code";
				$validation_text = str_replace("VALIDATION_LINK", "<a href=\"$val_link\" title=\"Click to activate your account\">$val_link</a>", $validation_text);
				mail_array($pass, $user_email, $notify_message, $validation_text, "html", false);
			}
			else print $CCMAIL_LANG['val_err'];
			}
		}
		else 
		{
			//Write groups into file
			if(write_to_file($addresses_dir . "/" . $cripted_address . "_~_" . time(), $string)){
				echo "<b>$address</b> ".$CCMAIL_LANG['sub_suc'];
				if ($notify_user == "YES") print "<br>".$CCMAIL_LANG['sub_confirm'];
				print "<br><br><center><a class=\"link\" href=\"$PHP_SELF?action=\"><b>".$CCMAIL_LANG['go_back']."</b></a></center>";
				//Sending notification...
				include ($settings_dir . "/on_subscription.ccmail");
				include ($settings_dir . "/notify_message.ccmail");
				$admin_email = array($send_copy_to);
				$user_email = array($address);
				if ($notify_user == "YES") mail_array($pass, $user_email, $notify_message, $on_subscription, "text", false);
				if ($notify_admin == "YES" && $send_copy_to != "") mail_array($pass, $admin_email, $notify_message, "User $address subscribed to your mailing list.", "text", false);
			}
			else print $CCMAIL_LANG['sub_err'];
		}
	}
	else { print "<b>".$CCMAIL_LANG['usr_alr_sub']."</b><br><br><center>";
	if (count($groups) > 1) print "<a href=\"$PHP_SELF?address=$address&action=modify\" class=\"link\">".$CCMAIL_LANG['modify']."</a> | ";
	print "<a href=\"$PHP_SELF?address=$address&action=unsubscribe\" class=\"link\">".$CCMAIL_LANG['unsubscribe']."</a></center>"; }
}
print '</div></td></tr></table>';
?>
