<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

/*SCHEDULE.PHP - Scheduling functions (from 1.0.1):

1- new_schedule($subject, $contents, $encoding, $user_array, $interval, $number_per_interval)
2- del_schedule($sched_name)
3- get_schedule($sched_name, $get_user_array = false)
4- print_scheduled() //print scheduled mails with details
5- print_schedule_details($sched_name)
6- get_expired() //returns scheduled mails to be executed
7- schedule_exec($sched_name)
8- schedule() //execute scheduling

Schedule structure:
filename: timestamp_~_interval(seconds).ccmail
contents:
subject
_~~~~~~_
content
_~~~~~~_
encoding
_~~~~~~_
userarray
_~~~~~~_
number_per_interval
_~~~~~~_
attachments (mimetype_~_filename)
_~~~~~~_
plain text version (if isset session var)
*/

function new_schedule($subject, $contents, $encoding, $user_array, $interval, $number_per_interval, $attachments, $plain_text_version)
{
	global $schedule_dir;
	global $crypt;
	global $pass;
	
	if(!eregi("^[0-9]+$", $interval) || !eregi("^[0-9]+$", $number_per_interval)) return false;
	$sched_filename = $schedule_dir . "/" . time() . "_~_" . $interval . ".ccmail";
	if(file_exists($sched_filename)) if(@!unlink($sched_filename)) return false;
	
	//Preparing content
	$string = $subject . "\n_~~~~~~_\n" . $contents . "\n_~~~~~~_\n" . $encoding . "\n_~~~~~~_\n";
	foreach ($user_array as $item) $string .= $crypt->encrypt($pass, $item) . " ";
	$string .= "\n_~~~~~~_\n" . $number_per_interval . "\n_~~~~~~_\n";
	//Adding attachments
	if (is_array($attachments) && count($attachments) > 0)
	{
		$mimetypes = array_flip($attachments);
		foreach($attachments as $att) if(strlen($att)>0) $string .= $mimetypes[$att] . "_~_" . $att . "\n";
	}
	//Add plain text version
	$string .= "_~~~~~~_\n" . $plain_text_version;
	
	if (!write_to_file($sched_filename, $string)) return false;
	else return true;
}

function del_schedule($sched_name)
{
	global $schedule_dir;
	if (file_exists($schedule_dir . "/" . $sched_name) && unlink($schedule_dir . "/" . $sched_name)) return true;
	else return false;
}

function get_schedule($sched_name, $get_user_array = false, $get_attachments_array = false)
{
	global $schedule_dir;
	
	$temp = array();
	if(!file_exists($schedule_dir . "/" . $sched_name)) return false;
	$file = fopen($schedule_dir . "/" . $sched_name, "r");
	if (flock($file, LOCK_SH))
	{
		$temp = explode("_~~~~~~_", fread($file, filesize($schedule_dir . "/" . $sched_name)));
		flock($file, LOCK_UN);
	}
	fclose($file);
	
	//Get recipients array
	$user_array = array();
	$temp_user_array = explode(" ", $temp[3]);
	foreach($temp_user_array as $sched_user) if(strlen($sched_user) > 3) array_push($user_array, trim($sched_user));
	
	//Get attachments array (mime => filename)
	$attachments = array();
	if($get_attachments_array && strlen(trim($temp[5]))>0){
		$temp_attachments_array = explode("\n", trim($temp[5]));
		foreach($temp_attachments_array as $att) 
		{
			$temp_mime_array = explode("_~_", trim($att));
			$attachments[trim($temp_mime_array[0])] = trim($temp_mime_array[1]);
		}
	}
	
	$informations_array = array(
		"subject" => trim($temp[0]),
		"content" => trim($temp[1]),
		"encoding" => trim($temp[2]),
		"users_number" => count($user_array),
		"number_per_interval" => (int)trim($temp[4]),
		"plain_text_version" => trim($temp[6]));
	if ($get_user_array) return $user_array;
	elseif ($get_attachments_array) return $attachments;
	else return $informations_array;
}

function print_scheduled() //print scheduled mails with details
{
	global $schedule_dir;
	global $PHP_SELF;
	$scheduled_emails = get_settings($schedule_dir, true);
	
	$rows = count($scheduled_emails) + 2;
	if ($rows == 2) {print "<center><b>No Scheduled Mail</b></center>"; return false;}
	print "
	<form method=\"post\" action=\"$PHP_SELF?option=schedule\">
	<center><table border=\"0\" cellpadding=\"1\" cellspacing=\"2\"><tr>
	<td></td><td align=\"center\"><div class=\"standard\"><b>Subject</b></div></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"menu\"><b>Preview</b></div></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"menu\"><b># Remaining</b></div></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"menu\"><b>Interval</b></div></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"menu\"><b>Delete?<input name=\"allbox\" type=\"checkbox\" value=\"check_all\" onClick=\"toggle_all(this.form);\" ></b></div></td>
	</tr><tr><td height=\"5\" colspan=\"10\" background=\"images/dot.gif\"></td></tr>";
	
	$counter = 0;
	foreach($scheduled_emails as $sched)
	{
		$sched_info = get_schedule($sched);
		$counter ++;
		$exploded = explode("_~_", $sched); $minutes = "~".ceil(str_replace(".ccmail", "", $exploded[1])/60) . " mins";
		if(str_replace(".ccmail", "", $exploded[1]) < 60) $minutes = str_replace(".ccmail", "", $exploded[1]) . " sec";
		
		//cutting long names...
		$subject = $sched_info['subject']; $preview = $sched_info['content'];
		if (strlen($sched_info['subject']) > 20) $subject = substr($sched_info['subject'], 0, 17) . "...";
		if (strlen($sched_info['content']) > 40) $preview = substr(strip_tags($sched_info['content']), 0, 37) . "...";
		
		print "\n<tr><td align = \"center\"><div class=\"standard\"><b>$counter &nbsp</b></div></td>
		<td align=\"center\"><a class=\"link\" href=\"$PHP_SELF?option=schedule&item=$sched\" title=\"See Mail details\"><b>$subject</b></a></td>
		<td align=\"right\"><div class=\"standard\">$preview</div></td>
		<td align=\"center\"><div class=\"standard\">".$sched_info['users_number']."</div></td>
		<td align=\"center\"><div class=\"standard\">".$sched_info['number_per_interval']." every $minutes</div></td>
		<td align=\"center\"><div class=\"standard\"><input type=\"checkbox\" name=\"schedule_del_$counter\" value=\"$sched\"></div></td></tr>";
		flush(); @ob_flush();
	}
	print "</table><br><br><input type=\"submit\" value=\"Delete selected\" class=\"button\">
	</center></form>";
}

function print_schedule_details($sched_name)
{
	global $users;
	global $pass;
	
	$sched_info = get_schedule($sched_name); 
	if(!is_array($sched_info)) {print "<b>Scheduled Mail was expired. Go Back and retry.</b>"; return false;}
	$user_array = get_schedule($sched_name, true, false);
	$exploded = explode("_~_", $sched_name); $minutes = ceil(str_replace(".ccmail", "", $exploded[1])/60) . " minutes";
	if(str_replace(".ccmail", "", $exploded[1]) < 60) $minutes = str_replace(".ccmail", "", $exploded[1]) . " seconds";
	$_SESSION['savedmail'] = $sched_info['content'];
	
	print "<b>Showing scheduled Mail \"".$sched_info['subject']."\". There are ". count($user_array) ." Recipients remaining. 
	Mailer frequency is set to ".$sched_info['number_per_interval']." Mails every $minutes.</b><br><br>";
	print_mail($sched_info['subject'], $sched_info['content'], $sched_info['encoding'], false);
	print "<center><b>Remaining recipients:</b><br></center>";
	$sent_array = array();
	foreach ($user_array as $item) @$sent_array[$item] = $users[$item];
	list_users($pass, $_SESSION['array'], $sent_array);
}

function get_expired() //returns scheduled mails to be executed
{
	global $schedule_dir;
	
	$scheduled_emails = get_settings($schedule_dir, true);
	$time = time();
	$expired = array();
	foreach($scheduled_emails as $sched)
	{
		$exploded = explode("_~_", $sched);
		$every_seconds = (int)str_replace(".ccmail", "", $exploded[1]);
		$old_timestamps = (int)$exploded[0];
		if(($time-$every_seconds) > $old_timestamps) array_push($expired, $sched);
	}
	return $expired;
}

function schedule_exec($sched_name)
{
	global $crypt;
	global $pass;
	global $mails_dir;
	$sched_info = get_schedule($sched_name);
	$user_array = get_schedule($sched_name, true,false);
	$attachments = get_schedule($sched_name, false,true);
	
	$exploded = explode("_~_", $sched_name); $interval = str_replace(".ccmail", "", $exploded[1]);

	//Decrypt users
	$addresses_array = array();
	foreach($user_array as $user) array_push($addresses_array, $crypt->decrypt ($pass, $user));
	
	//Get users to process and remove them from array
	$users_to_process = array();
	for ($i = 0; $i < $sched_info['number_per_interval']; $i++) 
		if(isset($addresses_array[$i])) array_push($users_to_process, $addresses_array[$i]);
	$users_remaining = array_diff($addresses_array, $users_to_process);

	//Send mail and update schedule
	mail_array ($pass, $users_to_process, $sched_info['subject'], $sched_info['content'], $sched_info['encoding'], false, $attachments, false, $sched_info['plain_text_version']);
	if(del_schedule($sched_name) && count($users_remaining)>0) new_schedule($sched_info['subject'], $sched_info['content'], $sched_info['encoding'], $users_remaining, (int)$interval, (int)$sched_info['number_per_interval'], $attachments, $sched_info['plain_text_version']);
	if(count($users_remaining) == 0) save_mail($mails_dir, $pass, $users_remaining, $sched_info['subject'], $sched_info['content'], $sched_info['encoding'], $attachments); //save sent mail, but without recipients.
}

function schedule() //execute scheduling
{
	$expired = get_expired();
	foreach($expired as $sched) schedule_exec($sched);
}
?>