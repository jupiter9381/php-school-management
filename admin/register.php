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
	<!--
		.boxed = boxed version
	-->
	<body>


		<div class="padding-15">

			<div class="login-box">

				<!-- registration form -->
				<form action="" class="sky-form boxed" id = "registerform1" method="post" enctype="multipart/form-data">
					<header><i class="fa fa-users"></i> Create Account </header>
					
				
					
					<fieldset>
						<div class="row">
							<div class="col-md-6">
								<label class="input">
									<input type="text" id="first_name" name="first_name" placeholder="First Name"  required="required" >
								</label>
							</div>
							<div class="col col-md-6">
								<label class="input">
									<input type="text" id="last_name" name="last_name" placeholder="Last Name"  required="required" >
								</label>
							</div>
						</div>
					</fieldset>
                           

                    <fieldset>
						<label class="input">
							<i class="icon-append fa fa-users"></i>
							<input type="text" id="contact_number" name="contact_number" placeholder="Contact Number"  required="required" >
							<b class="tooltip tooltip-bottom-right">Only Number characters</b>
						</label>
					</fieldset>

					<fieldset>					
						<label class="input">
							<i class="icon-append fa fa-envelope"></i>
							<input type="text" id="email" name="email" placeholder="Email Address"  required="required">
							<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
						</label>
					</fieldset>
                    <fieldset>
						<div class="row">
							<div class="col-md-12">
								<label class="input">
									<input type="text" id="password" name="password" placeholder="Password"  required="required" >
								</label>
							</div>
							<div class="col col-md-12">
								<label class="input">
									<input type="text" id="confirm_password" name="confirm_password" placeholder="Confirm_password"  required="required" >
								</label>
							</div>
						</div>
					</fieldset>

					<footer>
                        <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($data['uid'])?$data['uid']:'';?>">
						<input type ="hidden" name = "type" value="AddUser">
							<center>				
						<input type="submit" title="submit" id="formvalidate" data-form="registerform1"  class="btn btn-info btn-md btn-submit"  value="Register">
						</center>
					</footer>

				</form>
				<!-- /registration form -->
				<div class="clearfix"></div>
           
			</div>

		</div>


	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '../assets/plugins/';</script>
		<script type="text/javascript" src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
		<script type="text/javascript" src="../assets/js/app.js"></script>
		<script type="text/javascript" src="../includes/adminscript.js"></script>
		
	</body>
</html>