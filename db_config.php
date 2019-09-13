<?php

// if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=="127.0.0.1" || $_SERVER['HTTP_HOST']=="192.168.0.104" || $_SERVER['HTTP_HOST']=="192.168.1.1"){
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "school-management";
//     $baseurl = "http://local.school.com/";
// }
// else{    
//     $servername = "srv2";
//     $username = "rascamp_prueba";
//     $password = "12345678";
//     $dbname = "rascamp_school_management";
//     $baseurl = "http://rascamp.com/admin/";
// }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school-management";
$baseurl = "http://local.school.com/";
// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
mysqli_set_charset($db,"utf8");
$webname = "RAS Camp Admin";
$webtitle = "RAS Camp Admi";
$webmail="admin@rascamp.com";


  //mail setting
     $mailsetting = array(
        "Host"              =>  "mail.rascamp.com",
        "Port"              =>  587,
        "SMTPSecure"        =>  "tls",
        "SMTPAuth"          =>  true,
        "gmail_username"    =>  "admin@rascamp.com",
        "gmail_password"    =>  "dsv@ras360",
        "defaultfromemail"  =>  "admin@rascamp.com",
        "defaultfromname"   =>  "RAS Camp Admin",
        "defaulttoemail"    =>  "admin@rascamp.com",
        "defaulttoname"     =>  "RAS Camp Admin",
        "defaultccemail"    =>  "admin@rascamp.com",
        "defaultccname"     =>  "RAS Camp Admin"
    );
/*define('MAILSETTING',$mailsetting); */

//Authorize.net
define('LIVETEST', false);

//include function
include_once "function.php";




?>