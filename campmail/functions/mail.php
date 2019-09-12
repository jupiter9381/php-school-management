<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

/*MAIL.PHP - Mail management functions:

1- text_to_html($string, $type)
2- print_mail($title, $contents, $encoding, $choice = true)
3- save_mail($pass, $array, $subject, $object, $encoding)
4- get_mail_content($mail_name)
5- show_outbox()
6- print_sent_mail($pass, $filename)
7- iscompatible() //required by print_mail
8- print_mail_header() //required to display mail_array function correctly

*/

function text_to_html($string, $type) //text converte tutto, html converte da text solo <>&"'
{
	$trans = get_html_translation_table(HTML_ENTITIES); //"&gt;" => ">" racchiude tutti i caratteri traslabili
	$html_esc = get_html_translation_table(); //racchiude solo i caratteri <>"'&
	//DELETEprint_r ($html_esc);
	
	if ($type == "text") $string = strtr($string, $trans); //translate all applicable characters
	
	if ($type == "html") 
	{
		$difference = array_diff ($trans, $html_esc); //only È‡Ú etc
		//$difference = array_flip($difference); //flip array if conversion to html
		//$html_esc = array_flip($html_esc);
		$string = strtr($string, $difference);
	}
	
	return $string;
}

function print_mail($title, $contents, $encoding, $choice = true, $att_arr = false) //DEFAULT=text
{
	global $PHP_SELF;
	global $option;

	$compatible = false; if(iscompatible()) $compatible=true;
	//if the browser does not support iframes, print the following. else, render the iframe.
	if (!$compatible && $encoding == "html" && (stristr($contents, "<body") || stristr($contents, "<style") || stristr($contents, "text/css")))
	print "<b>Notice:</b> If you composed a HTML mail using CSS styles or &lt;body&gt; options like \"background\" or \"link\", it won't probably be *displayed* well, but will be correctly sent.<br><br>
	<center><a target=\"blank\" href=\"functions/htmlpreview.php\" class=\"link\"><b>Click here to open Mail in a new window</b></a></center><br>";
	else if ($compatible && $encoding == "html") print "<center><a target=\"blank\" href=\"functions/htmlpreview.php\" class=\"link\"><b>Display Mail Contents in a new window</b></a></center><br>";

	//preparing subject and contents...
	if ($encoding == "") $encoding = "text";
	$title = text_to_html($title, "text"); //subject will not be converted to html
	
	if ($encoding == "text") {
	$contents = text_to_html($contents, "text");
	$contents = str_replace("\n", "<br>", $contents);
	}
	elseif ($encoding == "html") {
		$contents = text_to_html($contents, "html");
		//Removes everything before body tag, to avoid visualization errors.
		$bodied = array();
		if (stristr($contents, "<body")) {
			$bodied = explode("<body", $contents);
			$tags = explode(">", $bodied[1]);
			$contents = substr($bodied[1], strlen($tags[0])+1, strlen($bodied[1]));
		}
		if (stristr($contents, "</html>")) $contents = str_replace("</html>", "", $contents);
		if (stristr($contents, "</body>")) $contents = str_replace("</body>", "", $contents);
	}
	
	//Verifying attachments...
	global $data_dir;
	$att_string = "";
	if (is_array($att_arr) && count($att_arr) > 0)
	{
		foreach($att_arr as $att){
			if($choice) $att_string .= "<a class=\"link\" href=\"$PHP_SELF?option=compose&remove_attach=$att\" title=\"Click to remove\">" . $att . " (" . filesize($data_dir . "/uploads/" . $att) . " bytes)</a>, ";
			else $att_string .= $att . ", ";
		}
		$att_string = substr($att_string, 0, strlen($att_string)-2);
	}

	print "
	<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\" height=\"10\">
	<table class=\"menu_content_table\" cellspacing=\"0\" cellpadding=\"1\"><tr><td width=\"100%\" valign=\"top\">
	<table class=\"menu_content_table_bg\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\">
	<div class=\"menu\">
	<!--Menu body-->
		<table width=\"99%\" cellpadding=\"0\" cellspacing=\"0\"><tr><td colspan=\"2\">
		<div class=\"standard\"><b><center>Showing mail...</center></b></td></tr>
		<tr><td><div class=\"menu\"><b><font color=\"red\">Subject: </font>$title</b></td>
		<td align=\"right\"><b><div class=\"menu\">";
		if ($choice) //default = display choice betweeb html or text
		{
		if ($encoding == "html") print "<a class=\"link\" href=\"$PHP_SELF?option=$option&display=text\" title=\"Display Plain Text version\"><font color=\"red\">[HTML]</font></a>";
		elseif ($encoding == "text") print "<a class=\"link\" href=\"$PHP_SELF?option=$option&display=html\" title=\"Display HTML version\"><font color=\"red\">[TEXT]</font></a>";
		}
		else 
		{
		if ($encoding == "html") print "<font color=\"red\">[HTML]</font>";
		elseif ($encoding == "text") print "<font color=\"red\">[TEXT]</font>";
		}
		print "</div></b></td></tr>";
	if (strlen ($att_string) != 0) print "<tr><td colspan=\"2\"><div class=\"menu\"><b><font color=\"red\">Attachments: </font></b>$att_string</div></td></tr>";
		print "<tr><td colspan=\"2\"><div class=\"menu\"><hr>";

	if ($compatible && $encoding == "html") print "
	<iframe id=\"html_preview\" src=\"functions/htmlpreview.php\" width=\"100%\" height=\"300\" frameborder=\"no\" scrolling=\"yes\"></iframe>";
	else print $contents;

		print "</div></td></tr></table><!--/Menu body-->
	</div>
	</td></tr></table>
	</td></tr></table>
	</td><td class=\"menu_lshadow\" valign=\"top\"><img src=\"images/shadow1.gif\" border=\"0\" alt=\"\">
	</td></tr>
	<tr><td colspan=\"4\" height=\"5\">
	<table class=\"menu_shadow\" cellpadding=\"0\" cellspacing=\"0\"><tr>
	<td align=\"left\" width=\"14\"><img border=\"0\" src=\"images/shadow2.gif\" alt=\"\"></td>
	<td width=\"100%\"></td>
	<td align=\"right\" width=\"15\"><img border=\"0\" src=\"images/shadow4.gif\" alt=\"\"></td>
	</tr></table></td></tr></table><br><br>";
}

function save_mail($dir, $pass, $array, $subject, $object, $encoding, $attachments)
{
	/*the saved mail has a timestamp as file name, and this structure:
	
	subject
	_~~~~~~_
	object
	_~~~~~~_
	encoding
	_~~~~~~_
	recipients (crypted)
	_~~~~~~_
	attachments (if available)
	*/
	
	global $crypt;
	$mail_filename = $dir . "/" . time(); //file name is actual timestamp (unique)
	$string = $subject . "\n_~~~~~~_\n" . $object . "\n_~~~~~~_\n" . $encoding . "\n_~~~~~~_\n";
	//enqueue encrypted recipients list
	foreach ($array as $item) $string .= $crypt->encrypt($pass, $item) . " ";
	$string = $string . "\n_~~~~~~_\n";
	if (is_array($attachments)) foreach ($attachments as $item) $string .= $item . " ";
	if (!write_to_file($mail_filename . ".ccmail", $string)) print "Mail cannot be saved! Chmod data/mail and data/drafts directories to 775, or 777, and repeat the operation.";
}

function get_mail_content($dir, $mail_name)
{
	$temp = array();
	$file = fopen($dir . "/" . $mail_name, "r");
	if (flock($file, LOCK_SH))
	{
		$temp = explode("_~~~~~~_", fread($file, filesize($dir . "/" . $mail_name))); //see save_mail()
		flock($file, LOCK_UN);
	}
	fclose($file);
	return $temp;
}

function show_outbox($dir)
{
	global $PHP_SELF;
	global $_GET;
	//choosing between outbox and drafts
	global $mails_dir; global $unsent_dir; global $drafts_dir; $redirect = "";
	if ($dir == $mails_dir) $redirect = "outbox";
	elseif ($dir == $unsent_dir) $redirect = "unsent";
	elseif ($dir == $drafts_dir) $redirect = "drafts";
	$outbox = get_settings($dir, true); //return array with filenames;
	rsort($outbox); //Sort by time
	$to_search = ""; if (isset($_GET['to_search'])) $to_search = $_GET['to_search'];
	$search_option = ""; if (isset($_GET['search_option'])) $search_option = $_GET['search_option'];
	$search_string = ""; 
		if($to_search) $search_string .= "&to_search=$to_search"; 
		if($search_option) $search_string .= "&search_option=$search_option";
	
	if (count($outbox) == 0) print "<center><b>Folder is empty!</b><br><br><br></center>";
	else {
	//Print search
	$select_contents = ""; if ($search_option == "contents") $select_contents = "selected";
	print "<center><form method=\"get\" action=\"$PHP_SELF\">
	<input name=\"option\" value=\"$redirect\" type=\"hidden\">
	<select name=\"search_option\" class=\"tbox\">
	<option value=\"title\">Title</option>
	<option value=\"contents\" $select_contents>Contents</option>
	</select>
	<input name=\"to_search\" size=\"20\" value=\"$to_search\" class=\"tbox_max\">
	<input type=\"submit\" value=\"Search\" class=\"button\"></form></center>";
	if ($to_search){
		$matching = array();
		foreach($outbox as $item) {
			$content = get_mail_content($dir, $item);
			$subject = trim($content[0]);
			$body = trim($content[1]);
			if ($_GET['search_option'] == "title") if(stristr($subject, $to_search)) array_push($matching, $item);
			if ($_GET['search_option'] == "contents") if(stristr($body, $to_search)) array_push($matching, $item);
		}
		if (count($matching) != 0) {$outbox = $matching; print "<center><b>" . count($matching) . " results found:";}
		else print '<center><b><font color="red">No Match!</font></b></center>';
	}
	
	//Split
	$sizeofarray=count($outbox);
	$splitnumber = 1;
	if (isset($_GET['splitnumber'])) $splitnumber = $_GET['splitnumber'];
	$numberofsplits = floor(8*(1 - exp(-$sizeofarray/400))) + 1;
	if ($sizeofarray/800 > 1) $numberofsplits = round($numberofsplits*$sizeofarray/800);
	$splitby = ceil($sizeofarray/$numberofsplits);
	$group_number = ceil($splitnumber/7); $nextgroup = $group_number*7+1; $prevgroup = $nextgroup-8; 
	$lastgroup = ceil($sizeofarray/$splitby);
	
	print "<center><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td rowspan=\"2\">";
	if ($group_number > 1) print "<a href=\"$PHP_SELF?option=$redirect&splitnumber=1$search_string\" title=\"First Users\"><image border=\"0\" src=\"images/first.gif\" alt=\"Prev\"></a>&nbsp;<a href=\"$PHP_SELF?option=$redirect&splitnumber=$prevgroup$search_string\" title=\"Previous Users\"><image border=\"0\" src=\"images/prev.gif\" alt=\"Prev\"></a>&nbsp;";
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
		else print "<a class=\"link\" href=\"$PHP_SELF?option=$redirect&splitnumber=$j$search_string\">[$lower-$upper]</a> ";
		}
	}
	}
	print "</center></b></div></td>";
	if ($nextgroup < $numberofsplits) print "<td rowspan=\"2\">&nbsp;<a href=\"$PHP_SELF?option=$redirect&splitnumber=$nextgroup$search_string\" title=\"Next Users\"><image border=\"0\" src=\"images/next.gif\" alt=\"Next\"></a>&nbsp;<a href=\"$PHP_SELF?option=$redirect&splitnumber=$lastgroup$search_string\" title=\"Last Users\"><image border=\"0\" src=\"images/last.gif\" alt=\"Last\"></a></td>";
	print "</tr><tr><td colspan=\"3\" height=\"2\"> </td></tr></table>";
	
	//Show outbox...
	$rows = $sizeofarray + 2;
	print "<center><table border=\"0\" cellpadding=\"1\" cellspacing=\"2\"><tr>
	<td></td><td align=\"center\"><div class=\"standard\"><b>Mail Subject</b></div></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"menu\"><b>Date and Time</b></div></td>
	<td rowspan=\"$rows\" valign=\"top\"  width=\"5\" background=\"images/dot.gif\"></td>
	<td align = \"center\"><div class=\"menu\"><b>Preview</b></div></td>
	</tr><tr><td height=\"5\" colspan = \"6\" background=\"images/dot.gif\"></td></tr>";
	$counter = $lowersplit;
	for($j=$lowersplit;$j<$uppersplit;$j++)
	{
		$item = $outbox[$j];
		$date = str_replace(" ", "&nbsp;", date("j/m/Y, G:i", str_replace(".ccmail", "", $item)));
		$counter ++;
		//retrieving informations...
		$content = get_mail_content($dir, $item);
		$subject = text_to_html(trim($content[0]), "text");
		$preview = text_to_html(trim($content[1]), "text");
		//cutting long names...
		$entire_subject = $subject;
		if (strlen($subject) > 20) $subject = substr($subject, 0, 17) . "...";
		if (strlen($preview) > 40) $preview = substr($preview, 0, 37) . "...";
		print "\n<tr><td align = \"center\"><div class=\"standard\"><b>$counter &nbsp</b></div></td>
		<td align=\"center\"><a class=\"link\" href=\"$PHP_SELF?option=$redirect&item=$item\" title=\"Show details about '$entire_subject'\"><b>$subject</b></a></td>
		<td align=\"right\"><div class=\"standard\">$date</div></td>
		<td align=\"left\"><div class=\"standard\">$preview</div></td></tr>";
	}
	print "</table></center><br><br>";
	}
}

function print_sent_mail($dir, $pass, $filename) //get mail filename as input
{
	global $PHP_SELF;
	global $mails_dir;
	global $drafts_dir;
	global $unsent_dir;
	global $crypt;
	global $users;

	if (!file_exists($dir . "/" . $filename)){
		print "<b><center>Could not find selected mail</center></b>"; return false;}
	$date = date("j/m/Y, G:i", str_replace(".ccmail", "", $filename));
	$content = get_mail_content($dir, $filename);
	$subject = text_to_html(trim($content[0]), "text");
	$body = text_to_html(trim($content[1]), "text");
	$texthtml = trim($content[2]);
	$att_arr = explode(" ", trim($content[4]));
	print "<center><b>Displaying Mail \"$subject\", sent on $date...</b><br><br>";
	$_SESSION['savedmail'] = $content[1];
	
	print_mail(trim($content[0]), trim($content[1]), $texthtml, false, $att_arr);
	$recipients_line = $content[3];
	$deletewho = "";
	if ($dir == $mails_dir) $deletewho = "outbox";
	elseif($dir == $drafts_dir) $deletewho = "drafts";
	elseif($dir == $unsent_dir) $deletewho = "unsent";
	print "
	<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"100%\"></td>";
	if ($dir != $drafts_dir) print "<td valign=\"top\" align=\"right\" width=\"10%\"><form method=\"post\" action=\"$PHP_SELF?option=send_saved_mail\">
	<input type=\"hidden\" name=\"subject\" value=\"$subject\">
	<input type=\"hidden\" name=\"contents\" value=\"$body\">
	<input type=\"hidden\" name=\"encoding\" value=\"$texthtml\">
	<input type=\"hidden\" name=\"recipients\" value=\"$recipients_line\">
	<input class=\"button\" type=\"submit\" value=\"Send\">
	</form></td><td width=\"10\">&nbsp;</td>";
	print "<td valign=\"top\" align=\"right\" width=\"10%\"><form method=\"post\" action=\"$PHP_SELF?option=compose&display=$texthtml\">
	<input type=\"hidden\" name=\"subject\" value=\"$subject\">
	<input type=\"hidden\" name=\"contents\" value=\"$body\">
	<input class=\"button\" type=\"submit\" value=\"Paste\">
	</form></td><td width=\"10\">&nbsp;</td><td align=\"right\" width=\"10%\">
	<form method=\"post\" action=\"$PHP_SELF?option=$deletewho\">
	<input type=\"hidden\" name=\"filename\" value=\"$filename\">
	<input class=\"button\" type=\"submit\" value=\"Delete\"></form></td><td width=\"10\">&nbsp;</td></tr></table><br><br></center>";
	
	$recipients = explode (" ", trim($content[3]));
	if (count($recipients) > 0 && $recipients[0] != ""){
		print "<center><b>Recipients:</b><br></center>";
		$sent_array = array();
		foreach ($recipients as $item) @$sent_array[$item] = $users[$item];
		list_users($pass, $_SESSION['array'], $sent_array);
	}
}

function iscompatible()
{
	global $HTTP_USER_AGENT ;

	if ( isset( $HTTP_USER_AGENT ) )
		$sAgent = $HTTP_USER_AGENT ;
	else
		$sAgent = $_SERVER['HTTP_USER_AGENT'] ;

	if ( strpos($sAgent, 'MSIE') !== false && strpos($sAgent, 'mac') === false && strpos($sAgent, 'Opera') === false )
	{
		$iVersion = (float)substr($sAgent, strpos($sAgent, 'MSIE') + 5, 3) ;
		return ($iVersion >= 5.5) ;
	}
	else if ( strpos($sAgent, 'Gecko/') !== false )
	{
		$iVersion = (int)substr($sAgent, strpos($sAgent, 'Gecko/') + 6, 8) ;
		return ($iVersion >= 20030210) ;
	}
	else
		return false ;
}

function print_mail_header()
{
	global $settings_dir;
	include ($settings_dir . "/send_method.ccmail");
	print "<center><table border=\"0\"><tr><td width=\"300\"><div class=\"standard\">
	<font color='red'><b>Log:</b></font><br>
	<a id=\"send_method\"></a><br>";
	if($send_method == "mail") print "<b>TIP:</b> <i>It is not recommended to use mail() function to send mails. Please read the appropriate <a href=\"?option=help#h13\" class=\"link\">manual pages for this section</a></i>.<br><br>";
	print "<a id=\"log_part1\"></a><br>
	<br><b>Delivering...
	<a id=\"percentage\"></a><br>
	<br><a id=\"log_part2\"></a><br><br></b>
	<font color=\"red\"><a id=\"error_message\"></a></font><br>
	<a id=\"error_log\"></a>
	</div></td></tr></table></center>";
}

?>