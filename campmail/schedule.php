<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//SCHEDULE.PHP - File to call to process scheduled mails

//Including configuration and function
require_once (dirname(__FILE__) . "/config.php");
if (!class_exists('crypto')) {require_once ($functions_dir . "/crypt.php"); $crypt = new Crypto;}
require_once ($functions_dir . "/shared.php");
require_once ($functions_dir . "/schedule.php");
require_once ($functions_dir . "/mail.php");

schedule();
?>