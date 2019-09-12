<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//AUTO_SCHEDULE.PHP - Open this file to automatically process scheduled mails

//Including configuration and function
require_once (dirname(__FILE__) . "/config.php");
if (!class_exists('crypto')) {require_once ($functions_dir . "/crypt.php"); $crypt = new Crypto;}
require_once ($functions_dir . "/shared.php");
require_once ($functions_dir . "/schedule.php");
require_once ($functions_dir . "/mail.php");

schedule();

print '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>CcMail 1.0 - Scheduling page</title><link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript">
// CREDITS:
// Automatic Page Refresher by Peter Gehrig and Urs Dudli www.24fun.com
// Permission given to use the script provided that this notice remains as is.
// Additional scripts can be found at http://www.hypergfurl.com.


// Configure refresh interval (in seconds)
var refreshinterval=120

// Shall the coundown be displayed inside your status bar? Say "yes" or "no" below:
var displaycountdown="no"

// Do not edit the code below
var starttime
var nowtime
var reloadseconds=0
var secondssinceloaded=0

function starttime() {
	starttime=new Date()
	starttime=starttime.getTime()
    countdown()
}

function countdown() {
	nowtime= new Date()
	nowtime=nowtime.getTime()
	secondssinceloaded=(nowtime-starttime)/1000
	reloadseconds=Math.round(refreshinterval-secondssinceloaded)
	if (refreshinterval>=secondssinceloaded) {
        var timer=setTimeout("countdown()",1000)
		if (displaycountdown=="yes") {
			window.status="Page refreshing in "+reloadseconds+ " seconds"
		}
    }
    else {
        clearTimeout(timer)
		window.location.reload(true)
    } 
}
window.onload=starttime
</script>
</head>
<body><center><div class="standard"><br><br><br>
Please let this page open. I will automatically refresh every 2 minutes executing scheduled emails.<br>
If you want to include scheduling in a page please use schedule.php (without automatic refresh nor any output)<br><br>
If you want to use this page, it is a good idea to assign it a unique name so that no one can execute it.<br>
</div></center></body></html>';
?>