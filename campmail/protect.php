<?
/*********************************************************************/
/*                             CcMail 1.0                            */
/*  Written by Emanuele Guadagnoli - cicoandcico[at]cicoandcico.com  */
/*      Reference page: http://www.cicoandcico.com/products.php      */
/*                            License: GPL                           */
/*             DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING         */
/*********************************************************************/

//PROTECT.PHP - Password protection
@session_start();

require_once (dirname(__FILE__) . "/config.php");
$time = date("j F Y G:i:s");
if (!isset($_SESSION['login_attempts'])) $_SESSION['login_attempts'] = 0;

$ip = $_SERVER["REMOTE_ADDR"];
$login_page = "admin_form.php";
$success_page = "admin.php";
$login_err = 'Wrong Username or password!';
$chr_err = 'Invalid syntax. Please retry';
$message = "";

function write_log($filename, $string)
{
	if (!is_file($filename)) @touch($filename);
	$file = @fopen($filename, "a");
	if ($file){
	if (flock($file, LOCK_EX)) //acquires lock
	{
		fwrite($file, $string);
		flock($file, LOCK_UN); //releases lock
	}
	fclose($file);
	return true;
	}
	else print "<br><center><b>Could not register access.</b></center>";
	return false;
}

@header("Pragma: ");
@header("Cache-Control: ");
@header("Expires: Mon, 26 Jul 1980 05:00:00 GMT");
@header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
@header("Cache-Control: no-store, no-cache, must-revalidate, proxy-revalidate");
@header("Cache-Control: post-check=0, pre-check=0", false);


//get POST vars
$username = ""; $password = "";
if (isset($_POST['username'])) $username = $_POST['username'];
if (isset($_POST['password'])) $password = $_POST['password'];

//if the cookies are set, control if they are right
if(isset($_COOKIE["ccalias"]) && isset($_COOKIE["ccuname"]) && isset($_COOKIE["ccpass"])){
	$user_exists = false;
	$user_count = count($uname);

	//check for user validity
	for ($i = 1; $i <= $user_count; $i++){
		if (crypt($uname[$i], $_COOKIE["ccuname"]) == $_COOKIE["ccuname"] && crypt($upass[$i], $_COOKIE["ccpass"]) == $_COOKIE["ccpass"]){
			$user_exists = true;
		}
	}

	if($user_exists); //do nothing (go to admin page)
	else{ //clear the cookies and display the login form
		$message='Cookies corrupted! Please close this page and restart the browser.';
		setcookie ("ccalias", "", time() - 3600);
		setcookie ("ccuname", "", time() - 3600);
		setcookie ("ccpass", "", time() - 3600);
		require($login_page);
		exit();
	}
}
else{ //cookies are not set: check POST variables

	//if the form is empty display login page
	if($username == "" && $password == ""){
		require($login_page);
		exit();
	}
	else{ //if POST vars are set, make sure that only letters and numbers are entered
		if (preg_match ("/[^a-zA-Z0-9]/", $username.$password)){	
			$message = $chr_err;
			require($login_page);
			exit();
		}
	}

	//now check POST vars through all the users to see if they exist
	$user_count = count($uname);
	$user_exists = false;

	for ($i = 1; $i <= $user_count; $i++) {
		$crypt_pass = crypt($upass[$i]);
		$crypt_username = crypt($uname[$i]);
		if (crypt($username, $crypt_username) == $crypt_username && crypt($password, $crypt_pass) == $crypt_pass){
		$user_id=$i;
		$user_exists = true;
		}
	}
	
	//if checking goes wrong
	if(!$user_exists){
		write_log($data_dir . "/access_log", "<b>$time:</b> access denied to $username ($ip)<br>\n");
		$message = $login_err;
		sleep(floor((exp($_SESSION['login_attempts'])))-1); $_SESSION['login_attempts']++;
		require($login_page);
		exit();
	}

	//if the login is correct then set the cookie so it dies when the browser is closed
	$alias = $known_as[$user_id];
	$cookie_crypt_pass = crypt($upass[$user_id]);
	$cookie_crypt_uname = crypt($uname[$user_id]);

	setcookie ("ccalias", $alias, 0);
	setcookie ("ccuname", $cookie_crypt_uname, 0);
	setcookie ("ccpass", $cookie_crypt_pass, 0);

	//Writing Log Access...
	write_log($data_dir . "/access_log", "<b>$time:</b> $alias logon successfully<br>\n");

	@header("Location: $success_page"); 
	exit();

}
