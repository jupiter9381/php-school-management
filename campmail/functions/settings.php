<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

/*SETTINGS.PHP - Settings management functions:

1- prepare_string($string)
2- print_setting($key, &$settings, $description = false, $textarea = false)
3- apply_settings($applied_settings)

*/ 

function prepare_string($string)
{
	$string = str_replace("_", "&nbsp;", $string);
	$string = ucwords(strtolower($string));
	return $string;
}

function print_setting($key, &$settings, $description = false, $textarea = false)
{
	$value = $settings[$key];
	$display = prepare_string($key);
	if ($description) print "<tr> <td></td><td><div class=\"standard\"><br>$description</div></td></tr>";
	print "<tr><td align=\"right\" valign=\"top\"><div class=\"standard\"><b>$display: &nbsp; </b></div></td><td>";
	if(!$textarea) print "<input class=\"tbox\" size=\"50\" value=\"$value\" type=\"text\" name=\"$key\"></td></tr>";
	else print "<textarea class=\"tbox\" name=\"$key\" cols=\"50\" rows=\"5\">$value</textarea></td></tr>";
}

function apply_settings($applied_settings)
{
	global $settings_dir;
	$settings_filenames = array_keys($applied_settings);
	for ($i = 0; $i < count($settings_filenames); $i++)
	{
		$setting_name = $settings_filenames[$i];
		$setting_value = str_replace("\\", "", str_replace("\"", "'", $applied_settings[$setting_name]));
		$filename = $settings_dir . "/" . $setting_name . ".ccmail";
		if (!is_writable($filename)) @chmod($filename, 0755);
		unlink($filename);
		if (!write_to_file($filename, "<?php //DONT EDIT!!!\n\$$setting_name = \"$setting_value\";\n?>"))
			print "Could not save settings! Try to chmod all files in data/settings directory to 775 or 777, and retry.";
	}
}

?>
