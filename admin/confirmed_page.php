<?php 
if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `admin` WHERE `id` = '$id'"));
   }
?>
<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Welcome to Admin</title>
		<meta name="description" content="" />
		<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="../assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
		<!--<style>
			{
			background-image: url('../assets/images/1.jpg');
			}
		</style>-->


		
	</head>

	<style>
		
		p {
		    margin-bottom: 15px;
		}

	</style>
	<!--
		.boxed = boxed version
	-->
	<body>


		<div class="padding-15">

			<div class="login-box">

				<!-- registration form -->
				<form action="" class="sky-form boxed" id = "" method="post" enctype="multipart/form-data">
					<header>
						<center>
							

							<h3>Thanks for Registration</h3>

							<h4>please check your email to confirm</h4>

							<a class="btn btn-xs btn-info" href="index.php" ><p class=""> Please Login</p></a>

						</center>						


					</header>
					
			           
					

					

				</form>
				<!-- /registration form -->
				<div class="clearfix"></div>
           
			</div>

		</div>


	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '../assets/plugins/';</script>
		<script type="text/javascript" src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="../assets/js/app.js"></script>
		<script type="text/javascript" src="../includes/adminscript.js"></script>
		
	</body>
</html>