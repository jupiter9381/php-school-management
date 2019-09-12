<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*********************************************************************/

//Set Username and Password. Multiple accounts available.
//Only letters and numbers allowed (no spaces).
$uname[1] = "admin"; 
$upass[1] = "kareem";
$known_as[1] = "demo_user";
//Add another user (Optional)
//$uname[2] = "demo"; 
//$upass[2] = "demo";
//$known_as[2] = "demo_user";

//DON'T EDIT BELOW THIS LINE UNLESS YOU KNOW WHAT YOU'RE DOING!!!
error_reporting(E_ALL);

//Edit this line with the full path ONLY if you receive errors like
//"Warning: main(/path/to/ccmail/config.php): failed to open stream: No such file or directory in //home2/danabw/public_html/ccmail/include.php on line 12"
$ccmail_full_path = dirname(__FILE__); 

$login_page = "admin_form.php";
$data_dir = $ccmail_full_path . "/data";
$settings_dir = $data_dir . "/settings";
$functions_dir = $ccmail_full_path . "/functions";
$lang_dir = $ccmail_full_path . "/lang";
$addresses_dir = $data_dir . "/addr";
$waiting_dir = $data_dir . "/waiting";
$groups_dir = $data_dir . "/groups";
$mails_dir = $data_dir . "/mail";
$drafts_dir = $data_dir . "/drafts";
$unsent_dir = $data_dir . "/unsent";
$schedule_dir = $data_dir . "/schedule";

//Backward compatibility (versions < 4.1.0 won't have these vars as globals)
if(version_compare(phpversion(), '4.1.0') == -1) {
   $_POST = &$HTTP_POST_VARS;
   $_GET = &$HTTP_GET_VARS;
   $_COOKIE = &$HTTP_COOKIE_VARS;
   $_REQUEST = array_merge($HTTP_COOKIE_VARS, $HTTP_POST_VARS, $HTTP_GET_VARS);
}

//Retrieving $PHP_SELF;
if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];

//Creating folders SOLO LA PRIMA VOLTA????????????
if (!is_writable($data_dir)) @chmod ($data_dir, 0755);
if (!@is_dir($addresses_dir)) if (!@mkdir ($addresses_dir)) {
	print "Data directory is not writeable! Chmod it to 775 or 777 to proceed."; exit();};
if (!is_dir($groups_dir)) mkdir ($groups_dir);
if (!is_dir($mails_dir)) mkdir ($mails_dir);
if (!is_dir($drafts_dir)) mkdir ($drafts_dir);
if (!is_dir($unsent_dir)) mkdir ($unsent_dir);
if (!is_dir($waiting_dir)) mkdir ($waiting_dir);
if (!is_dir($schedule_dir)) mkdir ($schedule_dir);
if (!is_dir($data_dir . "/uploads")) mkdir ($data_dir . "/uploads");
if (!is_writable($addresses_dir)) @chmod ($addresses_dir, 0755);
if (!is_writable($groups_dir)) @chmod ($groups_dir, 0755);
if (!is_writable($mails_dir)) @chmod ($mails_dir, 0755);
if (!is_writable($drafts_dir)) @chmod ($drafts_dir, 0755);
if (!is_writable($unsent_dir)) @chmod ($unsent_dir, 0755);
if (!is_writable($waiting_dir)) @chmod ($waiting_dir, 0755);
if (!is_writable($schedule_dir)) @chmod ($schedule_dir, 0755);
if (!is_writable($data_dir . "/uploads")) @chmod ($data_dir . "/uploads", 0755);

//Updating from old versions
if (file_exists($functions_dir . "/update.php")) require_once($functions_dir . "/update.php");

//Generating crypt key
if (!file_exists($data_dir . "/key.php")) {require_once($functions_dir . "/shared.php"); require_once($functions_dir . "/keygen.php"); key_gen();}

//Retrieving settings...
include ($ccmail_full_path ."/ccmail_version");
@require ($data_dir . "/key.php"); //retrieves $pass
include ($settings_dir . "/company_name.ccmail");
include ($settings_dir . "/company_site.ccmail");
include ($settings_dir . "/subscription_form_url.ccmail");
include ($settings_dir . "/company_email.ccmail");
include ($settings_dir . "/send_copy_to.ccmail");
include ($settings_dir . "/signature.ccmail");
include ($settings_dir . "/banned_addresses.ccmail");
include ($settings_dir . "/banned_domains.ccmail");
include ($settings_dir . "/notify_user.ccmail");
include ($settings_dir . "/notify_admin.ccmail");
include ($settings_dir . "/max_displayed_recipients.ccmail");
include ($settings_dir . "/notify_message.ccmail");
include ($settings_dir . "/validation_email.ccmail");
?>
