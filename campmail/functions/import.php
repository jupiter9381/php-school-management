<?php
/*********************************************************************/
/*                               CcMail 1.0                          */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//IMPORT.PHP - Import addresses from old Mailing Lists

if(!isset($data_dir)) exit();

//Restore CcMail backup file
if (isset($HTTP_POST_FILES['ccmail_backup']['name']) && is_uploaded_file($HTTP_POST_FILES['ccmail_backup']['tmp_name'])) 
{	
	$ccmail_fp = fopen($HTTP_POST_FILES['ccmail_backup']['tmp_name'], "r");
	$ccmail_backup = fread($ccmail_fp, filesize($HTTP_POST_FILES['ccmail_backup']['tmp_name']));
	if (strlen($ccmail_backup) > 0 && strstr($ccmail_backup, "<--FIELD:-->") && strstr($ccmail_backup, "<--RETURN:-->"))
	{
		$success = true;
		$fields = explode("<--FIELD:-->", $ccmail_backup);
		
		//Removing informations (except for settings) ...
		erase_dir($addresses_dir);erase_dir($groups_dir);
		if(count($fields)>5) {erase_dir($unsent_dir);erase_dir($drafts_dir);erase_dir($mails_dir);}
		else print "This backup belongs to a version < 1.0.0. A new backup is recommended.<br>"; 
		
		//Restoring key...
		$key = trim($fields[1]);
		if (!write_to_file($data_dir . "/key.php", "<?php //DONT EDIT!!!\n\$pass = \"$key\";\n?>")){
			$success = false;
			print "Could not write key! Chmod data/ directory to 775 or 777, and retry.<br>";}
		//Restoring users...
		$users_lines = explode("<--RETURN:-->", trim($fields[2]));
		foreach($users_lines as $line)
		{
			$groups_string = "";
			$user_file_names = explode("<--SUB_GROUPS:-->", trim($line));
			if($user_file_names[0] != "") $group_names = explode("<--AND:-->", trim($user_file_names[1]));
			foreach($group_names as $item) if(strlen(trim($item))>0) $groups_string .= trim($item) ."\n";
			
			$user_filename = trim($user_file_names[0]);
			if(strlen($user_filename)>0)
				if (!write_to_file($addresses_dir . "/" . $user_filename, $groups_string)){
				$success = false;
				print "Could not write user file! Chmod data/addr directory to 775 or 777, and retry.<br>";}
		}
		//Restoring groups...
		$groups_lines = explode("<--RETURN:-->", trim($fields[3]));
		foreach($groups_lines as $line)
		{
			$groups_data = explode("<--AND:-->", trim($line));
			if(strlen(trim($groups_data[0]))>0 && strlen(trim($groups_data[1]))>0)
				if (!write_to_file($groups_dir . "/" . trim($groups_data[0]) . ".ccmail", "\\\"" . trim($groups_data[1]))){
				$success = false;
				print "Could not write group file! Chmod data/groups directory to 775 or 777, and retry.<br>";}
		}
		//Restoring settings...

		//Restoring outbox(FROM 1.0.0)...
		$outbox_lines = array(); if(count($fields)>5) $outbox_lines = explode("<--RETURN:-->", trim($fields[5]));
		foreach($outbox_lines as $line)
		{
			$outbox_data = explode("<--CONTENTS:-->", trim($line));
			if(strlen(trim($outbox_data[0]))>0 && strlen(trim($outbox_data[1]))>0)
				if (!write_to_file($mails_dir . "/" . trim($outbox_data[0]), trim($outbox_data[1]))){
				$success = false;
				print "Could not write sent mail file! Chmod data/groups directory to 775 or 777, and retry.<br>";}
		}
		//Restoring unsent...
		$outbox_lines = array(); if(count($fields)>5) $outbox_lines = explode("<--RETURN:-->", trim($fields[6]));
		foreach($outbox_lines as $line)
		{
			$outbox_data = explode("<--CONTENTS:-->", trim($line));
			if(strlen(trim($outbox_data[0]))>0 && strlen(trim($outbox_data[1]))>0)
				if (!write_to_file($unsent_dir . "/" . trim($outbox_data[0]), trim($outbox_data[1]))){
				$success = false;
				print "Could not write unsent mail file! Chmod data/groups directory to 775 or 777, and retry.<br>";}
		}
		//Restoring drafts...
		$outbox_lines = array(); if(count($fields)>5) $outbox_lines = explode("<--RETURN:-->", trim($fields[7]));
		foreach($outbox_lines as $line)
		{
			$outbox_data = explode("<--CONTENTS:-->", trim($line));
			if(strlen(trim($outbox_data[0]))>0 && strlen(trim($outbox_data[1]))>0)
				if (!write_to_file($drafts_dir . "/" . trim($outbox_data[0]), trim($outbox_data[1]))){
				$success = false;
				print "Could not write drafts file! Chmod data/groups directory to 775 or 777, and retry.<br>";}
		}
		
		if ($success) print "Backup successfully restored!";
		else print "Errors while restoring backup!"; 
	}
	else print "This doesn't appear to be a valid CcMail backup file! Aborting...";
}
elseif (isset($_POST['selected_groups']) && $_POST['selected_groups'] == "selected_groups"){
	//Retrieving informations about selected groups
	$active_groups = $groups;
	$selected_groups = array();
	$gr_count = 0;
	$timestamp = time();
	if (isset($_POST['everything']) && $_POST['everything'] == "everything") $selected_groups = $active_groups; //select everything
	else foreach ($active_groups as $item)
	{
		$gr_count ++;
		if (isset($_POST["group_" . $gr_count]) && stripslashes(trim($_POST["group_" . $gr_count])) == stripslashes(trim($item))) array_push($selected_groups, $item); //add selected groups
	}
	$string = "";
	foreach ($selected_groups as $item) $string .= $item . "\n"; //create group string
	$success = true;
	foreach ($_SESSION['imported_addresses_array_new'] as $address) 
		if(!write_to_file($addresses_dir . "/" . $address . "_~_" . $timestamp, $string)) $success=false;
	if ($success) print "Users successfully imported!<br><br>";
	else print "Could not import users! Try to chmod data/addr directory to 775, or 777, then repeat the operation.<br><br>";
	$_SESSION['imported_addresses_array'] = false;
}
//Importing retrieved Users...
elseif (isset($_SESSION['imported_addresses_array']) && is_array($_SESSION['imported_addresses_array'])){
	$active_groups = $groups;
	if (count($active_groups) > 1){
	print "Select the Group(s) where you want to add the imported Users:
	<form action=\"$PHP_SELF?option=import\" method=\"post\">
	<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td><div class=\"standard\"><br>
	<input type=\"hidden\" name=\"selected_groups\" value=\"selected_groups\">
	<input type=\"checkbox\" name=\"everything\" value=\"everything\" checked>Everything<br>\n";
	$gr_count = 0;
	foreach($active_groups as $item){$gr_count ++; print "<input type=\"checkbox\" name=\"group_$gr_count\" value=\"$item\">$item<br>\n";}
	print "<br><input class=\"button\" type=\"submit\" value=\"Import Users\"></td></tr></table></form>\n";
	}
	else{
		$success = true;
		$timestamp = time();
		foreach ($_SESSION['imported_addresses_array'] as $address) //> *Warning: Invalid argument supplied for foreach()
			if(!write_to_file($addresses_dir . "/" . $address . "_~_" . $timestamp, "")) $success=false;
		if ($success) print "Users successfully imported!<br><br>";
		else print "Could not import users! Try to chmod data/addr directory to 775, or 777, then repeat the operation.<br><br>";
	}
	$_SESSION['imported_addresses_array_new'] = $_SESSION['imported_addresses_array'];
	unset($_SESSION['imported_addresses_array']);
}
//Retrieving users list...
elseif (isset($HTTP_POST_FILES['imported_file']['name']) && is_uploaded_file($HTTP_POST_FILES['imported_file']['tmp_name'])) 
{
	$trimmed_address_array = array();
	$file_address_array = fopen($HTTP_POST_FILES['imported_file']['tmp_name'], "r");
	$list = fread($file_address_array, filesize($HTTP_POST_FILES['imported_file']['tmp_name']));

	//Processing retrieved list
	$list = str_replace(";", ",", str_replace("'", "", str_replace("\"", "", $list))); //removes " and ' and replaces ";" with ","
	$typed_address_array = explode("\n", $list);
	foreach ($typed_address_array as $item){ //foreach line
		$split_line = explode(",", $item); //split line by commas
		foreach ($split_line as $to_validate) if(validate_email(trim($to_validate))) array_push ($trimmed_address_array, trim($to_validate)); //add validated addresses
	}
	$trimmed_address_array = array_unique($trimmed_address_array);
	if (count($trimmed_address_array) > 0) {
		print "CcMail retrieved the following valid addresses:<br><br></b>";
		foreach ($trimmed_address_array as $item) print "$item<br>";
		print "<form action=\"$PHP_SELF?option=import\" method=\"post\"><br><br><input class=\"button\" type=\"submit\" value=\"Proceed\">";
		$cripted_address_array = array();
		foreach ($trimmed_address_array as $item) array_push($cripted_address_array, $crypt->encrypt ($pass, $item));
		$_SESSION['imported_addresses_array'] = $cripted_address_array;
	}
	else print 'No valid address retrieved.<br></b>Please edit your file in order to match a simple list, and retry.<b><br><a href="?option=import" class="link">Retry</a>';
}
else {
print"You can Import a list of Users or a CcMail backup file.</b><br>
You should be able to retrieve informations from virtually any plain text file, from a normal list to a CSV.<br>If your Users are not retrieved successfully, please edit your file in order to match a simple list, and retry.<br><br><br>
<form enctype=\"multipart/form-data\" action=\"$PHP_SELF?option=import\" method=\"post\">";
print'<table border="0" cellpadding="0" cellspacing="0" width="100"><tr>
<td></td><td><div class="standard">Import addresses from a generic plain text file (a simple list, a CSV...)</td></tr>
<tr><td><div class="standard">
<b>1)&nbsp;Generic&nbsp;text&nbsp;file&nbsp;</b><br><br></div></td>
<td valign="top" align="right"><input class="tbox_max" name="imported_file" type="file" size="30"><br><br></td></tr>
<tr><td></td><td><div class="standard">Restore a CcMail Backup file</td></tr>
<tr><td><div class="standard">
<b>2)&nbsp;CcMail&nbsp;Backup&nbsp;file&nbsp;</b><br><br></div></td>
<td valign="top" align="right"><input class="tbox_max" name="ccmail_backup" type="file" size="30"></td></tr>
<tr><td colspan="2" align="right"><br><br><input class="button" type="submit" value="Proceed"></td></tr></table>
</form>';
}
?>