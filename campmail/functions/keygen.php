<?php
/*********************************************************************/
/*                               CcMail 1.0                          */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//KEYGEN.PHP - Generates random key for addresses crypting

function key_gen($return = false) //use return to generate the authentication key
{
	global $data_dir;
	//creates a rendomized array
	$rnd0 = explode(" ","A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z 1 2 3 4 5 6 7 8 9 0");
	srand ((float)microtime()*1000000);
	shuffle ($rnd0);
	
	//created a random number
	srand((double)microtime()*1000000);
	$rnd1 = rand();
	
	//get unix timestamp of this file
	$rnd2 = filemtime(__FILE__);
	
	//get password
	$rnd3 = "ccmail10";
	
	$rnd4 = $rnd2.$rnd1.$rnd3.$rnd2.$rnd1.$rnd3;
	
	//creates a unique array
	for($i = 0; $i < strlen($rnd4); $i ++) array_push($rnd0, " " . $rnd4{$i});
	srand ((float)microtime()*1000000);
	shuffle ($rnd0);
	$pass = substr(str_replace(" ", "", implode(" ", $rnd0)), 0, 20);
	if (!$return && !write_to_file($data_dir . "/key.php", "<?php //DONT EDIT!!!\n\$pass = \"$pass\";\n?>"))
		print "Could not write key! Chmod data/ directory to 775 or 777, and retry.";
	else if($return) return $pass;
	
	//Destroying this file...
	//unlink(__FILE__);
}
?> 
