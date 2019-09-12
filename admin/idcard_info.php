<?php 
	include('../db_config.php');
	//require_once __DIR__ . '/../mpdf/vendor/autoload.php';
	//date_default_timezone_set("Asia/Kolkata");
	//require_once __DIR__ . '/mpdf/vendor/autoload.php';
	//ini_set('memory_limit', '128M');
	//ob_start();

	// if(isset($_GET['id']) && !empty($_GET['id'])){
	//     $id = $_GET['id'];
	//     $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT i.*,a.student_name FROM student_idcard i LEFT JOIN school_application a ON i.student_app_id=a.student_app_id LEFT JOIN cca c ON i.student_app_id=c.student_app_id WHERE i.student_idcard_id='$id' "));
	//     print_r($data);
	// }
	ob_start();
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


			.boxx{
			    border-style: single !important;
    			border: 1px solid #da8404;
			    margin-top: -20px;
				margin-bottom: -20px;
				margin-left: 20px;
				margin-right: 20px;
    			padding: -1px;
			}


			body{
				font-size: 11px!important;

			}

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
			    height: 110px;
			    width: 106px;
			    margin-top: 38px;
			   /* margin-left: 276px;
			    width: 231px;*/
			    margin-left: -38px;
			    background-color: #ffa500;
			    border-radius: 16%;
			   /* margin-top: 80px;*/
			}
			.square1 {
				height: 16px;
				width: 180px;
				margin-left: -13px;
    			/*margin-left: 160px;
    			width: 440px;*/
    			background-color: #3dae48;
    			margin-top: -20px;
			}
			.square2{
				height: 16px;
				width: 180px;
				margin-left: -57px;
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
			 /*.............id card size.......................*/
			.col-md-12.boxx {
			    background: white;
			    margin-top: 40px;
			    width: 321px;
			    margin-left: 48px;
			   /* height: 208px;*/
			}
			.col-md-12.boxx1 {
			    background: white;
			    margin-bottom: 40px;
			    width: px;
			    /*height: 208px;*/
			}
			.col-md-5 {
			    border: 1px solid #000000;
			    height: 600px;
			}
			
			
			@media print {
				  @page { margin: 0; }
				  body { margin: 1.6cm; }
				}

			@media print {
				
				.col-md-12.boxx {
				    background: white;

				}
				.row {
				  /*display: inline-flex !important;*/
				  display: flex !important; 
				  flex-wrap: wrap !important;
				 
				}
				.col-md-12.boxx1 {
				    background: white;
				    margin-top: 30px !important;
				    margin-bottom: 0px !important;
				}
				.col-md-5 {
				    border: 1px solid #000000;
				    height: 600px;
				    width:auto !important;
				    

				}
				.square {
			    height: 110px !important;
			    width: 106px !important;
			    margin-top: 38px !important;
			   /* margin-left: 276px;
			    width: 231px;*/
			    margin-left: -38px !important;
			    background-color: #ffa500 !important;
			    border-radius: 16% !important;
			    margin-top: 80px;
				}
				h4.raffles {
				    color: #808080 !important;
				    font-size: 13px !important;
				    margin-left: 60px !important;
				    margin-top: -145px !important;
				    font-size: 13px !important;

				}
				i.raffles{
					color: #808080 !important;
					margin-right: -50px!important;
				}
				.color_raffles{
					color:orange !important;
					margin-left: -15px;
				}
				.Allergies{
					margin-left: 32px !important;
				}
				.camp{
					margin-left: 70px !important;
				}
				.cca{
					margin-left: 70px !important;
				}
				.Schedule{
					margin-left: 250px !important;
				}

				.agent{
					/*margin-left: -195px !important;
					margin-top: 5px!important;*/
				}

				.square1 {
					height: 16px !important;
	    			width: 180px !important;
	    			margin-left: 80px !important;
	    			background-color: #3dae48 !important;
	    			margin-top: -20px !important;
	    			display:block !important;
				}
				.square2{
					height: 16px !important;
					background-color: #2858a8 !important;
					width: 180px !important;
	    			margin-left: 80px !important;
	    			margin-top: -45px !important;
				}
				.camp_bold{
					color:white !important;
				}
				.summer_camp{
					margin-left: !important;
					margin-top: 0px !important;
				}
				.logo_school{
					<img src="../assets/images/ras-logo.png" width="80%" style="height: 50px;width: 70px;margin-left: 196px;margin-top:-40px;padding: 10px;">
					/*margin-left: 400px !important;
					margin-top: -10px !important;*/
				}
				.think_create{
					margin-top: 50px !important;
				}
				.think_create1{
					color: orange !important;
				}
				.raffles1 {
				    color: #808080 !important;
				    margin-left: 0px!important;
				   
				}

				.text-center {				    
				    
				    text-align: center !important;
				   
				}
				.centertext{				    
				    
				    
				    margin-right: -70px!important;
				   
				}

				body{
					background-color: #ffffff !important; 
					padding: 15px;
				}


			}

			
			
		</style>

	</head>
	<body>
		<div class="container" style="width:1170px">

		<section style="margin-left:40px;margin-right:40px">
			
				
				
				<div class="row">
					<?php 
				
				$student_app_id = $_POST['student_app_id'];
				foreach ($student_app_id as $key => $value) {
					/*echo "SELECT 
						p.student_id_number,
						a.student_name,
					 	a.student_app_id,
					 	a.allergies,
					 	a.allergies_details,
					 	a.student_pickup,
					 	a.relative_name,
					 	a.relative_phone,
					 	a.boarding_req,
					 	c.cca_name,
					 	m.camp_name 
					 	FROM school_application a 
					 	LEFT JOIN cca c ON a.student_app_id=c.student_app_id 
					 	LEFT JOIN camp_management m ON a.camp_management_id = m.camp_management_id
					 	LEFT JOIN student_profile p ON a.student_app_id=p.student_app_id
					 	WHERE a.student_app_id='$value'";*/

					$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT 
						p.student_id_number,
						a.student_name,
					 	a.student_app_id,
					 	a.allergies,
					 	a.allergies_details,
					 	a.student_pickup,
					 	a.relative_name,
					 	a.relative_phone,
					 	a.boarding_req,
					 	c.cca_name,
					 	m.camp_name 
					 	FROM school_application a 
					 	LEFT JOIN cca c ON a.student_app_id=c.student_app_id 
					 	LEFT JOIN camp_management m ON a.camp_management_id = m.camp_management_id
					 	LEFT JOIN student_profile p ON a.student_app_id=p.student_app_id
					 	WHERE a.student_app_id='$value'"));
					 	
					 	$q2 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `student_profile` "));


					if($data['allergies'] == '0' || $data['allergies'] == ''){
			            $data['allergies_details'] = 'No';
			        }
			        if($data['student_pickup'] == '1'){
			            $data['student_pickup'] = 'Danga Bay (Starbucks)';
			        }
			        if($data['student_pickup'] == '2'){
			            $data['student_pickup'] = 'Teega A (lobby)';
			        }
			        if($data['student_pickup'] == '3'){
			            $data['student_pickup'] = 'Teega B (lobby)';
			        }
			        if($data['student_pickup'] == '4'){
			            $data['student_pickup'] = 'Teega Suites (lobby)';
			        }
			        if($data['student_pickup'] == '5'){
			            $data['student_pickup'] = 'Mall of medini(lobby)';
			        }

			        if($data['boarding_req'] == '0'){
			            $data['boarding_req'] = 'Day Student';
			        }
			        if($data['boarding_req'] == '1'){
			            $data['boarding_req'] = 'Boarding Student';
			        }

				?>
					<div class="col-md-5">
					<div class="col-md-12 boxx border">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="square text-center">

									<img src="../uploads/1553678041.jpg" width="100%" style="margin-top:-30px;height:110px;width:80px; ">
									<h4><b class="camp_bold text-center " style="color:white; font-size: 13px; margin-top: 20px;">CAMP STUDENT</b></h4>
								</div>
							</div>

							<div class="col-md-8">	
								<h4 class="raffles text-center">
									<font class="color_raffles raffles" style="color:orange; margin-left: -20px; text-align: center;">Raffles</font><b class="raffles"><i >American</i>School</b> 
								</h4>	
								
								<div class="text-center centertext">
									<h4 style="margin-left:-1px; margin-top: -30px; " ><?php echo $data['student_name'];?></h4>
									<h4 style="margin-top: -35px; margin-left:-15px; "><?php echo $data['student_id_number'];?></h4>
									
								</div>
								<div class="row Allergies">
									<div class="col-md-12">
										<h5 class="cca" style="margin-top: -30px;margin-left:38px;"><b>CCA</b>:<?php echo $data['cca_name'];?></h5>
										<h5 class="camp" style="margin-top: -20px;margin-left:38px;"><b>Camp</b>:<?php echo $data['camp_name'];?></h5>
										<h5 class="Allergies" style="margin-top: -20px; margin-left:-15px; font-size: 13px; "><b>Allergies</b>:<?php echo $data['allergies_details'];?></h5>
										
									</div>
									
								</div>
								

								<div class="square1"></div>	
							</div>
						</div>
						<div class="col-md-12">

							<div class="col-md-6">
								<h5 class="summer_camp" style="text-align: left; margin-left: -35px; margin-top: -1px; ">Summer Camp 2019</h5>
								<h5 style="margin-top: -20px;margin-left:-20px;"><?php echo $data['boarding_req'];?></h5>
							</div>
							<div class="col-md-6">
								<div class="square2">
									
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-md-12 think_create">
								<h4 style="margin-left: -35px; margin-top: -23px; " ><font class="think_create1" style="color:orange">Think. <b class="think_create1">Create.</b></font> <i>Succeed.</i></h4>
							</div>
							<div class="col-md-6 logo_school">
								<img src="../assets/images/ras-logo.png" width="80%" style="height: 50px;width: 70px;margin-left: 196px;margin-top:-110px;padding: 10px;">
							</div>
							
						</div>
						<div class="col-md-12 boxx1">
							
							<h4 style="text-align: center;">Transport Information</h4>
							<!-- <div class="row text-center"> -->
								
									<h5 style="margin-top: -20px; text-align: center;" ><b>Pick Location</b> : <?php echo $data['student_pickup'];?></h5>
							<!-- </div> -->
							<!-- <div class="row text-center"> -->		
									<h5 class="agent" style="margin-top: -15px; text-align: center;"><b> Agent</b> : XYZ</h5>
								
							<!-- </div> -->
							<!-- <div class="row text-center"> -->
									<h5 style="margin-top: -15px; text-align: center;" ><b>Emergency Contact</b>  <?php echo $data['relative_name'];?> : <?php echo $data['relative_phone'];?></h5>
							<!-- </div> -->
							<h5 style="text-align: center; margin-top: -15px; ">If this card is found please return to the securty <br>Center at Raffles American School or call<br>
							<b>+6075098743</b></h5>
							
							<h3 style="margin-top: -10px;" class="raffles1 text-center">
								<font class="color_raffles" style="color:orange">Raffles</font><b><i class="raffles1">American</i></b>School
							</h3>

							
						</div>

					</div>
						
						
					</div>
					<?php } ?>

					<!-- <div class="col-md-5">
					<div class="col-md-12 boxx border">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="square text-center">
									<img src="../uploads/1553678041.jpg" width="100%" style="margin-top:-30px;height:110px;width:80px; ">
									<h4><b class="camp_bold" style="color:white; font-size: 13px; margin-top: 20px;">CAMP STUDENT</b></h4>
								</div>
							</div>

							<div class="col-md-8">	
								<h4 class="raffles text-center">
									<font class="color_raffles" style="color:orange; margin-left: -10px; ">Raffles</font><b><i class="raffles">American</i>School</b> 
								</h4>	
								
								<div class="text-center">
									<h4 style="margin-left:-1px; margin-top: -30px; " ><?php echo $data['student_name'];?></h4>
									<h4 style="margin-top: -35px; margin-left:-15px; ">111223</h4>
									
								</div>
								<div class="row Allergies">
									<div class="col-md-12">
										<h5 class="cca" style="margin-top: -30px;margin-left:38px;"><b>CCA</b>:<?php echo $data['cca_name'];?></h5>
										<h5 class="camp" style="margin-top: -20px;margin-left:38px;"><b>Camp</b>:<?php echo $data['camp_name'];?></h5>
										<h5 class="Allergies" style="margin-top: -20px; margin-left:-15px; font-size: 13px; "><b>Allergies</b>:<?php echo $data['allergies_details'];?></h5>
										
									</div>
									
								</div>
								

								<div class="square1"></div>	
							</div>
						</div>
						<div class="col-md-12">

							<div class="col-md-6">
								<h5 class="summer_camp" style="text-align: left; margin-left: -35px; margin-top: -1px; ">Summer Camp 2019</h5>
								<h5 style="margin-top: -20px;margin-left:-20px;"><?php echo $data['boarding_req'];?></h5>
							</div>
							<div class="col-md-6">
								<div class="square2">
									
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-md-12 think_create">
								<h4 style="margin-left: -35px; margin-top: -23px; " ><font class="think_create1" style="color:orange">Think. <b class="think_create1">Create.</b></font> <i>Succeed.</i></h4>
							</div>
							<div class="col-md-6 logo_school">
								<img src="../assets/images/ras-logo.png" width="80%" style="height: 50px;width: 70px;margin-left: 196px;margin-top:-110px;padding: 10px;">
							</div>
							
						</div>
						<div class="col-md-12">
							
							<h4 style="text-align: center;">Transport Information.</h4>
							<div class="row text-center">
								
									<h5 style="margin-top: -20px;" ><b>Pick Location</b> : <?php echo $data['student_pickup'];?></h5>
					
									<h5 style="margin-top: -15px;"><b>Agent</b> : XYZ</h5>
								
							</div>
							<div class="row text-center">
									<h5 style="margin-top: -15px;" ><b>Emergency Contact</b> -> <?php echo $data['relative_name'];?> : <?php echo $data['relative_phone'];?></h5>
							</div>
							<h5 style="text-align: center; margin-top: -15px; ">If this card is found please return to the securty <br>Center at Raffles American School or call<br>
							<b>+6075098743</b></h5>
							
							<h3 style="margin-top: -10px;" class="raffles1 text-center">
								<font class="color_raffles" style="color:orange">Raffles</font><b><i class="raffles1">American</i></b>School
							</h3>

							
						</div>

					</div>
						
						
					</div> -->
				</div>

				 
			

				<!-- <div class="row">
					<div class="col-md-8 col-md-offset-2 boxx">
						<div class="col-md-12">
							
							<h4 style="text-align: center;">Transport Information.</h4>
							<div class="row text-center">
								
									<h5 style="margin-top: -20px;" ><b>Pick Location</b> : <?php echo $data['student_pickup'];?></h5>
					
									<h5 style="margin-top: -15px;"><b>Agent</b> : XYZ</h5>
								
							</div>
							<div class="row text-center">
									<h5 style="margin-top: -15px;" ><b>Emergency Contact</b> -> <?php echo $data['relative_name'];?> : <?php echo $data['relative_phone'];?></h5>
							</div>
							<h5 style="text-align: center; margin-top: -15px; ">If this card is found please return to the securty <br>Center at Raffles American School or call<br>
							<b>+6075098743</b></h5>
							
							<h3 style="margin-top: -10px;" class="raffles1 text-center">
								<font class="color_raffles" style="color:orange">Raffles</font><b><i class="raffles1">American</i></b>School
							</h3>

							
						</div>
					</div>
				</div> -->	



				
        	
		</section>
	</div>

	</body>

	
</html>

<?php 
// $body = ob_get_clean();
// $mpdf = new \Mpdf\Mpdf();
// $mpdf->WriteHTML($body);
// $mpdf->Output();
?>
<script type="text/javascript">
   window.print();
</script>