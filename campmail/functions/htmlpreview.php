<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//SAVEDMAIL.PHP - Show a HTML mail in a new window

session_start();
if (isset($_SESSION['savedmail']) && $_SESSION['savedmail'] != "") print $_SESSION['savedmail'];
elseif (isset($_SESSION['contents']) && $_SESSION['contents'] != "") print $_SESSION['contents'];
?>