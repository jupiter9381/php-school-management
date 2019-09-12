<?php 
	include('../db_config.php');

//date_default_timezone_set("Asia/Kolkata");
//require_once __DIR__ . '/mpdf/vendor/autoload.php';
//ini_set('memory_limit', '128M');
//ob_start();

	// if(isset($_GET['id']) && !empty($_GET['id'])){
	//     $id = $_GET['id'];
	//     $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT i.*,a.student_name FROM student_idcard i LEFT JOIN school_application a ON i.student_app_id=a.student_app_id LEFT JOIN cca c ON i.student_app_id=c.student_app_id WHERE i.student_idcard_id='$id' "));
	//     print_r($data);
	// }
 ?>
<!doctype html>
<html lang="en-US">
	<head>
		
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title></title>
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
		<style>
			.table-bordered>tbody>tr>td {
				    padding: 8px;
    				padding-right: 30px;
    				border: 2px solid #707070;
    				font-family: bold


    				
			}
			.FormDiv{
			    border-style: double !important;
    			border: 6px solid #da8404;
			    margin-top: 0px;
				margin-bottom: 0px;
    			padding: 28px;
			}
			/*h1.raffles {
			    font-style: inherit;
			    font-family: fantasy;
			    line-height: 34px;
			    color: #808080;
			}*/
			h1.raffles {
			    color: #808080;
			    font-size: 48px;
			    margin-bottom: 0px;
			}
			h2 {
				    margin: 0 0 25px 0;
				}

			h3 {
			    letter-spacing: normal;
			    margin: 0 0 32px 0;
			    /*padding-top: 195px;*/
			    text-align: center;
			}
			h4 {
			    letter-spacing: normal;
			    margin: 0 0 32px 0;
			    font-size: 15px;
			    
			}

			.square {
			    height: 250px;
			    width: 250px;
			    margin-top: 30px;
			   /* margin-left: 276px;
			    width: 231px;*/
			    background-color: #ffa500;
			    border-radius: 16%;
			   /* margin-top: 80px;*/
			}
			.square1 {
				height: 32px;
    			/*margin-left: 160px;
    			width: 440px;*/
    			background-color: #3dae48;
    			margin-top: -28px;
			}
			.square2{
				height: 32px;
				background-color: #2858a8;
			}
			h4.Allergies{
				font-size: 20px;
			}
			.table>thead>tr>th {
                padding: 5px;
			    line-height: 1.428571;
			    vertical-align: bottom;
			    border-top: 1px solid #ddd;
			}

			.col-md-8.col-md-offset-2.boxx {
			    background: white;
			    margin-top: 40px;
			}
			.col-md-8.col-md-offset-2.boxx1 {
			    background: white;
			    margin-bottom: 40px;
			}

			@media print {
				
				.col-md-8.col-md-offset-2.boxx {
				    background: white;
				    margin-top: 100px !important;
				}
				.col-md-8.col-md-offset-2.boxx1 {
				    background: white;
				    margin-top: 150px !important;
				}
				.square {
				    height: 250px;
				    width: 250px;
				    margin-top: 30px;
				   /* margin-left: 276px;
				    width: 231px;*/
				    background-color: #ffa500 !important;
				    border-radius: 16%;
				   /* margin-top: 80px;*/
				}
				h1.raffles {
				    color: #808080 !important;
				    font-size: 48px !important;
				    margin-left: 20px !important;
				    margin-top: -290px !important;
				    font-size: 45px !important;

				}
				i.raffles{
					color: #808080 !important;
				}
				.color_raffles{
					color:orange !important;
				}
				.Allergies{
					margin-left: 250px !important;
				}
				.camp{
					margin-left: 250px !important;
				}
				.cca{
					margin-left: 250px !important;
				}
				.Schedule{
					margin-left: 250px !important;
				}
				.square1 {
					height: 32px !important;
	    			width: 520px !important;
	    			margin-left: 265px !important;
	    			background-color: #3dae48 !important;
	    			margin-top: -25px !important;
				}
				.square2{
					height: 32px !important;
					background-color: #2858a8 !important;
					width: 520px !important;
	    			margin-left: 265px !important;
	    			margin-top: -65px !important;
				}
				.camp_bold{
					color:white !important;
				}
				.summer_camp{
					margin-left: -740px !important;
					margin-top: 10px !important;
				}
				.logo_school{
					margin-left: 400px !important;
					margin-top: -65px !important;
				}
				.think_create{
					margin-top: 30px !important;
				}
				.think_create1{
					color: orange !important;
				}
				.raffles1 {
				    color: #808080 !important;
				   
				}


			}

			
			
		</style>

	</head>
	<body>
		

		<section>
			
				<?php 
				
				//$student_app_id = $_POST['student_app_id'];
				//foreach ($student_app_id as $key => $value) {
					/*echo "SELECT 
						a.student_name,
						a.student_app_id,
						c.cca_name 
						FROM school_application a 
						LEFT JOIN cca c ON a.student_app_id=c.student_app_id 
						WHERE a.student_app_id='$value'";*/

					// $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT 
					// 	a.student_name,
					// 	a.student_app_id,
					// 	c.cca_name 
					// 	FROM school_application a 
					// 	LEFT JOIN cca c ON a.student_app_id=c.student_app_id 
					// 	WHERE a.student_app_id='$value'"));

				?>
				
				<div class="row">


					<div class="col-md-8 col-md-offset-2 boxx">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="square text-center">
									<img src="../uploads/1553678063.jpg" width="80%" style="margin-top:-20px;height:230px;width:150px; ">
									<h3><b class="camp_bold" style="color:white;">CAMP STUDENT</b></h3>
								</div>
							</div>

							<div class="col-md-8">	
								<h1 class="raffles text-center">
									<font class="color_raffles" style="color:orange">Raffles</font><b><i class="raffles">American</i></b>School
								</h1>	
								
								<div class="text-center">
									<h2>Ashish<?php //echo $data['student_name'];?></h2>
									<h2 style="margin-top: -30px;">111223</h2>
								</div>
								<div class="row Allergies">
									<div class="col-md-6">
										
									</div>
									<div class="col-md-6">
										<h4 class="cca" style="margin-top: -25px"><b>CCA</b>:Fried Fish</h4>
										<h4 class="camp" style="margin-top: -25px"><b>Camp</b>:Fried Fish</h4>
										<h4 class="Allergies" style="margin-top: -30px"><b>Allergies</b>:Fried Fish</h4>
									</div>
								</div>
								

								<div class="square1"></div>	
							</div>
						</div>
						<div class="col-md-12">

							<div class="col-md-4">
								<h3 class="summer_camp" style="text-align: center;">Summer Camp 2019</h3>
							</div>
							<div class="col-md-8">
								<div class="square2">
									
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-md-6 think_create">
								<h2><font class="think_create1" style="color:orange">Think. <b class="think_create1">Create.</b></font> <i>Succeed.</i></h2>
							</div>
							<div class="col-md-6 logo_school">
								<img src="../assets/images/ras-logo.png" width="80%" style="height: 128px;width: 133px;margin-left: 253px;margin-top:-20px;padding: 10px;">
							</div>
							
						</div>


						
						
					</div>
				</div>

				<!-- <div class="row">
					<div class="col-md-8 col-md-offset-2">
						
					</div>
				</div> --><br><br>
			

				<div class="row">
					<div class="col-md-8 col-md-offset-2 boxx1">
						<div class="col-md-12">
							
							<h2 style="text-align: center;">Transport Information.</h2>
							<div class="row text-center">
								
									<h3><b>Pick Location</b> : Teega A</h3>
					
									<h3><b>Agent</b> : XYZ</h3>
								
							</div>
							<div class="row text-center">
									<h3><b>Emergency Contact</b> -> XYZ : 01236547889</h3>
							</div>
							<h3 style="text-align: center;">If this card is found please return to the securty <br>Center at Raffles American School or call<br>
							<b>+6075098743</b></h3>
							
							<h1 class="raffles1 text-center">
								<font class="color_raffles" style="color:orange">Raffles</font><b><i class="raffles1">American</i></b>School
							</h1>

							
						</div>
					</div>
				</div>	



				<?php //} ?>
        	
		</section>

	</body>

	
</html>


<script type="text/javascript">
   //window.print();
</script>