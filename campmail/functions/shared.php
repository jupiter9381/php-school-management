<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

/*SHARED.PHP - Functions required both by include.php and admin.php:

1- write_to_file($filename, $string)
2- validate_email($email)
3- mail_array($pass, $array, $subject, $object, $encoding, $option = true)
4- get_settings($dir, $filenames_only = false)
5- getgroups($valid = true, $show_hidden = true)
6- getusers($valid, $report_filenames = false)
7- get_user_details($pass, $user, $print=true)
8- merge($array1, $array2)
9- erase_dir($dir)
10- file_search($dir, $incomplete_filename)

*/

function write_to_file($filename, $string)
{
	if (!is_writable($filename)) @chmod($filename, 0755);
	$file = @fopen($filename, "w");
	if ($file){
	if (@flock($file, LOCK_EX)) //acquires lock
	{
		@fwrite($file, $string);
		@flock($file, LOCK_UN); //releases lock
	}
	@fclose($file);
	return true;
	}
	else print "Could not write file $filename! ";
	return false;
}

function validate_email($email)
{
	$regexp = "^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$";
	if (eregi($regexp, $email)) return true;
	else return false;
}

function mail_array($pass, $array, $subject, $object, $encoding, $option = true, $att_arr=false, $test=false, $plain_text_version=false)
{
	//option=true => don't save sent mail, and don't add admin email
	//att_arr=array() => attachments array

	global $mail;
	global $functions_dir;
	global $settings_dir;
	global $company_name;
	global $company_email;
	global $signature;
	global $send_copy_to;
	global $data_dir;
	global $banned_addresses;
	global $mails_dir;
	global $unsent_dir;
	global $ccmail_version;
	
	//PHPMailer class
	if (!class_exists('phpmailer')){require ($functions_dir . "/class.phpmailer.php"); $mail = new PHPMailer();}

	//PHPMailer settings
	include ($settings_dir . "/mail_priority.ccmail");
	include ($settings_dir . "/send_method.ccmail");
	include ($settings_dir . "/smtp_host.ccmail");
	include ($settings_dir . "/smtp_port.ccmail");
	include ($settings_dir . "/smtp_helo.ccmail");
	include ($settings_dir . "/smtp_auth.ccmail");
	include ($settings_dir . "/smtp_uname.ccmail");
	include ($settings_dir . "/smtp_passw.ccmail");
	include ($settings_dir . "/pause_for.ccmail");
	include ($settings_dir . "/pause_every.ccmail");

	if (!is_array($array)) $array = array($array); //Creates array from a single variable
	if ($option && $send_copy_to != "") array_push($array, trim($send_copy_to)); //Add Admin email if selected

	if ($test == false) $array = array_unique($array); //Removing duplicates
	else {
		$array = array();
		for($i=0; $i<(int)$test; $i++) array_push($array, trim($send_copy_to));
	}

	//Removing banned addresses from recipients...
	$banned_array = explode(",", $banned_addresses);
	$banned_array_trim = array();
	foreach ($banned_array as $ban) array_push($banned_array_trim, trim($ban));
	if (count($banned_array) > 0) $array = array_diff ($array, $banned_array_trim);

	//Preparing body...
	$html_body = "";
	$plain_text_body = stripslashes($object);
	if($encoding == "html"){
		//Removing end tags (they will be added to the signature)
		if (!stristr($object, "</body>") && !stristr($object, "</html>")) $object .= "\n</body>\n";
		if (!stristr($object, "</html>")) $object .= "</html>\n";
		if (!stristr($object, "<html") && !stristr($object, "<body")) $object = "<html>\n<body>\n" . $object;
		elseif (!stristr($object, "<html")) $object = "<html>" . $object;
		$html_body = stripslashes($object);
		//Set plain text version of HTML email
		if ($plain_text_version) $plain_text_body = $plain_text_version;
		else $plain_text_body = trim(strip_tags(str_replace("<br/>", "\n", str_replace("<br>", "\n", $html_body))));
		}
	
	$log = "";
	$error_log = "";
	$successnum = 0;
	$delivered = array(); $undelivered = array();
	
	//Set PHPMailer class and Sending Method
	if ($send_method == "" || $send_method == "mail") $mail->IsMail();
	elseif($send_method == "sendmail") $mail->IsSendmail();
	elseif($send_method == "smtp") {
		$mail->IsSMTP();
		$mail->SMTPKeepAlive = true;
		$mail->SMTPDebug = false;
		$mail->Host = $smtp_host;
		$mail->Port = $smtp_port;
		$mail->Helo = $smtp_helo;
		if ($smtp_auth == "on") {
			$mail->SMTPAuth = true;
			$mail->Username = $smtp_uname;
			$mail->Password = $smtp_passw;
		}
	}
	else {print "PHPMailer is not configured! Abort..."; exit();}
	if ($option) print "<script language=\"javascript\">\n<!--\nsend_method.innerHTML = \"Send method: ". $mail->Mailer ."\"\n//-->\n</script>"; flush(); @ob_flush();
	
	//Set sender, recipients, subject and body
	$mail->From = $company_email;
	$mail->Sender = $company_email;
	$mail->FromName = $company_name;
	$mail->Priority = (int)$mail_priority;
	$mail->Subject = stripslashes($subject);
	if ($encoding == "html") 
	{
		$log .= "Encoding: HTML";
		$mail->IsHTML(true);
	}
	else $log .= "Encoding: Plain Text";
	
	//Sending Emails...
	if ($option) print "<script language=\"javascript\">\n<!--\nlog_part1.innerHTML = \"$log\"\n//-->\n</script>"; $log = ""; flush(); @ob_flush();
	$counter = 0; $total = count($array); $lastperceptual = 0;
	foreach($array as $item) 
	{
		if ($encoding == "html") 
		{
			$mail->Body = str_replace("[--ADDRESS--]", $item, $html_body);
			$mail->AltBody = str_replace("[--ADDRESS--]", $item, $plain_text_body . "\n\n" . $signature);
		}
		else $mail->Body = str_replace("[--ADDRESS--]", $item, $plain_text_body . "\n\n" . $signature);
		
		//pause for $pause_for seconds, after sending $pause_every messages
		if($counter%(int)$pause_every == 0) sleep ((int)$pause_for);
		
		//Add Attachments...
		if (is_array($att_arr) && count($att_arr) > 0)
		{
			$mimetypes = array_keys($att_arr);
			foreach($mimetypes as $mime) $mail->AddAttachment($data_dir . "/uploads/" . $att_arr[$mime]);
		}
	
		$mail->AddAddress($item);
		//if(!@$mail->Send()) 
		if(!@$mail->Send()) {array_push($undelivered, $item); $error_log .= $mail->ErrorInfo . "<br>"; }
		else {$successnum++; array_push($delivered, $item);}
		
		//Print percentage
		$counter ++; $perceptual = round($counter*100/$total);
		if($option && $perceptual > $lastperceptual) {
			print "<script language=\"javascript\">\n<!--\npercentage.innerHTML = \"$perceptual%\"\n//-->\n</script>";
			$lastperceptual = $perceptual;
		}
		flush();@ob_flush();

		$mail->ClearAddresses();
		$mail->ClearAttachments();
	}
	if($option) print "<script language=\"javascript\">\n<!--\nlog_part2.innerHTML = \"$successnum of $total recipients successfully emailed.\"\n//-->\n</script>";
	if ($successnum != $total && $option) {
	print "<script language=\"javascript\">\n<!--\nerror_message.innerHTML = \"<b>Mailer error!</b><br> The failed Mail(s) will be saved in the Unsent folder.\"\n//-->\n</script>";
	$log .= "<br><b>Error Log:</b><br>$error_log";
	}
	
	if($send_method == "smtp") $mail->SMTPClose();

	if ($option) //print log and register email
	{
		if(stristr($error_log, "The following recipients failed")) $log .= "<br><br><b>These errors usually occour because relaying is not allowed on the SMTP server from the IP address of the web server. Go to the configuration of your SMTP server and turn relaying on for your IP address and try again.</b>";
		
		print "<script language=\"javascript\">\n<!--\nerror_log.innerHTML = \"$log\"\n//-->\n</script>";
		
		if (count($delivered) > 0) save_mail($mails_dir, $pass, $delivered, stripslashes($subject), $mail->Body, $encoding, $att_arr); //save sent mail
		if (count($undelivered) > 0) save_mail($unsent_dir, $pass, $undelivered, stripslashes($subject), $mail->Body, $encoding, $att_arr); //save unsent mail
	}
}

function get_settings($dir, $filenames_only = false) //optionally returns only an array with file names
{
	$settings_dir = $dir; //directory to explore
	$files_array = array();
	$settings = array();
	if(is_dir($settings_dir)) {
	
	if ($handle = opendir($settings_dir)) 
	{
	while (false !== ($file = readdir($handle))) 
	{
		if(!$filenames_only && is_file($settings_dir . "/" . $file) && $file != "." && $file != ".." && preg_match("/\.ccmail$/", $file))
			array_push($files_array, $file);
		else if($filenames_only && is_file($settings_dir . "/" . $file) && $file != "." && $file != "..")
			array_push($files_array, $file);
	}
	}
	if ($filenames_only) return $files_array; //optionally returns only the array with file names
	foreach ($files_array as $item) //creates an array with "filename" => "contents"
	{
		$file = @fopen($settings_dir . "/" . $item, "r");
		if (@flock($file, LOCK_SH)) //acquires lock
		{
			$temp = explode("\"", @fread($file, @filesize($settings_dir . "/" . $item)));
			$settings[str_replace(".ccmail", "", $item)] = trim($temp[1]);
			@flock($file, LOCK_UN); //releases lock
		}
		@fclose($file);
	}

	}
	return $settings;
}

function getgroups($valid = true, $show_hidden = true)
{
	//valid=true -> return current groups | valid=false -> return deleted groups
	//show_hidden=false -> dont show hidden groups

	global $groups_dir;
	$filenames = get_settings($groups_dir); //return array with timestamps -> group names
	
	$groups = array();
	$timestamps = array_keys($filenames);
	foreach ($timestamps as $item) //select current or deleted groups
	{
		if ($valid && !strstr($item, ".OLD")) $groups[$item] = $filenames[$item];
		if (!$valid && strstr($item, ".OLD")) $groups[$item] = $filenames[$item];
	}
	//Search for hidden groups
	$hidden = array();
	foreach ($timestamps as $item) if (strstr($item, ".HIDE")) $hidden[$item] = $filenames[$item];
	if (!$show_hidden) $groups = array_diff($groups, $hidden);

	asort($groups);
	return $groups;
}

function getusers($valid, $report_filenames = false) //valid=true -> return current users | valid=false -> return deleted users
{
	global $addresses_dir;
	$users = array();
	if ($handle = opendir($addresses_dir))
	{
	while (false !== ($file = readdir($handle))) 
	{
		if ($valid && $file != "." && $file != ".." && !strstr($file, "~--OLD--~")) array_push ($users, $file);
		if (!$valid && $file != "." && $file != ".." && strstr($file, "~--OLD--~")) array_push ($users, $file);
	}}
	if ($report_filenames == true) return $users;
	$user_array = array();
	foreach($users as $item){
		$user_data = explode("_~_", $item);
		if ($valid) $user_array[$user_data[0]] = trim($user_data[1]); //filenames->timestamps
		else $user_array[$user_data[0]] = str_replace("~--OLD--~", "", trim($user_data[1]));
	}
	arsort($user_array);
	return $user_array;
}

function get_user_details($pass, $user, $print=true)  //user = complete user filename
{	//print = false => return *only* array of subscribed groups
	global $addresses_dir;
	global $crypt;
	$user_data = explode("_~_", $user);
	$displayed = $crypt->decrypt ($pass, $user_data[0]);
	$filename = $addresses_dir . "/" . $user;
	$groups = getgroups();
	$groups_subscribed = array();
	if (file_exists($filename))
	{
		$file_contents = "";
		$file = fopen($filename, "r");
		if (filesize($filename) != 0 && flock($file, LOCK_SH)) //acquires lock
		{
			flock($file, LOCK_UN); //releases lock
			$file_contents = fread($file, filesize($filename));
		}
		fclose($file);
		foreach ($groups as $group)
			if (strstr($file_contents, $group)) array_push($groups_subscribed, $group);
		
		if (!$print) return $groups_subscribed;
		//printing(default)...
		$date = date("F j, Y, g:i a", $user_data[1]);
		print "<center>User <b>$displayed</b> subscribed on <b>$date</b>";
		if (count($groups_subscribed) != 0) 
		{
			print " to the following active Groups:";
			list_groups($groups_subscribed);
		}
		else if(filesize($filename) == 0) print " to every active Group";
		else print ". <br>There is no subscribed Group (usually, it means that they are no longer active).";
		print "<br><br><br></center>";
	}
	else print "<center><b>Could not retrieve informations about user $displayed.</b><br>Usually, it means that User has been deleted. You have to restore it to display informations.<br><br></center>";
}

function merge($array1, $array2) //merge two arrays
{
	foreach ($array2 as $item) if (!in_array($item, $array1)) array_push($array1, $item);
	return $array1;
}

function erase_dir($dir)
{
	$success = true;
	if ($handle = opendir($dir)) 
	{
		while (false !== ($file = readdir($handle))) 
		{
			if(is_file($dir . "/" . $file) && $file != "." && $file != "..")
			{
				if (!is_writable($dir . "/" . $file)) @chmod($dir . "/" . $file, 0755);
				if(!@unlink ($dir . "/" . $file)) $success = false;
			}
		}
	}
	return $success;
}

function file_search($dir, $incomplete_filename) //optionally returns only an array with file names
{
	$filename = "";
	if (is_dir($dir) && $handle = opendir($dir)) 
	{
	while (!$filename && false !== ($file = readdir($handle))) 
	{
		if($file != "." && $file != ".." && strstr($file, $incomplete_filename."_~_")) $filename = $file;
	}}
	return $filename;
}
?>