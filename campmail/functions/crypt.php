<?php
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//CRYPT.PHP - Crypto class for addresses crypting

$ralphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890.@~_-";
$alphabet = $ralphabet . $ralphabet;

class Crypto {

function encrypt ($password,$strtoencrypt)
{
	global $ralphabet;
	global $alphabet;
	$encrypted_string = "";
	$pos_alpha_ary = array();
	
	for($i=0; $i<strlen($password); $i++)
	{
	$cur_pswd_ltr = substr($password,$i,1);
	$pos_alpha_ary[] = substr(strstr($alphabet,$cur_pswd_ltr),0,strlen($ralphabet));
	}
	
	$i=0;
	$n = 0;
	$nn = strlen($password);
	$c = strlen($strtoencrypt);
	
	while($i<$c)
	{
	$encrypted_string .= substr($pos_alpha_ary[$n],strpos($ralphabet,substr($strtoencrypt,$i,1)),1);
	
	$n++;
	if($n==$nn) $n = 0;
	$i++;
	}
	return $encrypted_string;
}

function decrypt ($password,$strtodecrypt) 
{
	global $ralphabet;
	global $alphabet;
	$decrypted_string = "";
	$pos_alpha_ary = array();
	
	for($i=0; $i<strlen($password); $i++)
	{
	$cur_pswd_ltr = substr($password,$i,1);
	$pos_alpha_ary[] = substr(strstr($alphabet,$cur_pswd_ltr),0,strlen($ralphabet));
	}
	
	$i=0;
	$n = 0;
	$nn = strlen($password);
	$c = strlen($strtodecrypt);
	
	while($i<$c) {
	$decrypted_string .= substr($ralphabet,strpos($pos_alpha_ary[$n],substr($strtodecrypt,$i,1)),1);
	
	$n++;
	if($n==$nn) $n = 0;
	$i++;
	}
	return $decrypted_string;
}

}
?>