<?php 
	include('../db_config.php');

	if(isset($_GET['id']) && !empty($_GET['id'])){
	    $id = $_GET['id'];
	    $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT a.*,s.student_name FROM student_report_form a LEFT JOIN school_application s ON a.student_app_id=s.student_app_id LEFT JOIN teacher_resource_assignment t ON a.teacher_resource_assignment_id=t.teacher_resource_assignment_id WHERE `student_report_form_id` = '$id'"));
	}
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
			h1.raffles {
			    font-style: inherit;
			    font-family: fantasy;
			    line-height: 34px;
			    margin-bottom: 10px;
			    color: #808080;
			}

			.table>thead>tr>th {
                padding: 5px;
			    line-height: 1.428571;
			    vertical-align: bottom;
			    border-top: 1px solid #ddd;
			}

			@media print {
				.table>thead>tr>th {
	                padding: 5px !important;
				}
				.comment_box{
					height: 50px !important;
				}
				.logo_img{
					height: 100px !important;
					width: 156px !important;
					
				}
				.create_think{
					margin-top: 30px !important;
					margin-bottom: 0px !important;
				}
				.camp_director{
					margin-bottom: 8px !important;
				}
				.r_color{
					color:orange !important;
				}
				.raffles {
				    color: #808080 !important;
				}
				


			}

			
			
		</style>

	</head>
	<body>
		

		<section>
			<div class="container">
				<div class="row">

				<div class="FormDiv col-md-12">

					<div class="col-md-12" style="padding-bottom:30px;">
						<center><u class="raffles"><b><h1 class="raffles"><font class="r_color" style="color:orange">R</font>affles <i class="raffles">American</i> School</h1></b></u></center>
						<center><u class="raffles"><b><h1 class="raffles">Camp Report Card</h1></b></u></center>
						<center><u class="raffles"><h1 class="raffles">Year 2019</h1></u></center>
					</div>
                    <table class="table table-bordered">
						<tr>
							<td>Teacher Name:&nbsp;&nbsp;<b><?php echo ucwords($data['first_name']); ?></b></td>
						</tr>
						<tr>
							<td>Student Name:&nbsp;&nbsp;<b><?php echo ucwords($data['student_name']); ?></td>
						</tr>
						<tr>
							<td>Age:&nbsp;&nbsp;<b><?php echo $data['age_year']; ?></td>
						</tr>
						<tr>
							<td>Nationality:&nbsp;&nbsp;<b><?php echo ucwords($data['nationality']); ?></td>
						</tr>
						<tr>
							<td></td>
						    <td style="text-align: center;">Minimal</td>
							<td style="text-align: center;"></td>
							<td style="text-align: center;">Fair</td>
							<td style="text-align: center;"></td>
							<td style="text-align: center;">Excellent</td>
						</tr>
						<tr>
							<td>Level of improvement:</td>
							<td style="text-align: center;">1</td>
							<td style="text-align: center;">2</td>
							<td style="text-align: center;">3</td>
							<td style="text-align: center;">4</td>
							<td style="text-align: center;">5</td>
						</tr>
						<tr>
							<td>Problem Solving and Thinking Skills:</td>
							<td><?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '1')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '2')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '3')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '4')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '5')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
						</tr>
						<tr>
							<td>Organizational and Research Skills:</td>
							<td><?php if((isset($data['organizational'])) && ($data['organizational'] == '1')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['organizational'])) && ($data['organizational'] == '2')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['organizational'])) && ($data['organizational'] == '3')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['organizational'])) && ($data['organizational'] == '4')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['organizational'])) && ($data['organizational'] == '5')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
						</tr>
						<tr>
							<td>Communication Skills:</td>
							<td><?php if((isset($data['communication'])) && ($data['communication'] == '1')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['communication'])) && ($data['communication'] == '2')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['communication'])) && ($data['communication'] == '3')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['communication'])) && ($data['communication'] == '4')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['communication'])) && ($data['communication'] == '5')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
						</tr>
						<tr>
							<td>Character and Interpersonal Skills:</td>
							<td><?php if((isset($data['character_skills'])) && ($data['character_skills'] == '1')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['character_skills'])) && ($data['character_skills'] == '2')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['character_skills'])) && ($data['character_skills'] == '3')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['character_skills'])) && ($data['character_skills'] == '4')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['character_skills'])) && ($data['character_skills'] == '5')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
						</tr>
						<tr>
							<td>English Level at start of Camp:</td>
							<td><?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '1')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '2')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '3')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '4')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '5')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
						</tr>
						<tr>
							<td>English Level at end of Camp:</td>
							<td><?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '1')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '2')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '3')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '4')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
							<td><?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '5')){ echo "<center><img src='../assets/images/check.png' width='20px' height='20px'></center>"; }?></td>
						</tr>
						<tr>
							<td>Teacher Comment:</td>
							<td class="comment_box" colspan="5" style="height:70px;">
								<?php 
									$str = ucfirst(trim($data['teacher_comment']));
									print $str; ?></td>
						</tr>
					</table>
					<table class="table camp_director" style="text-align: center;margin-bottom: 10px;">
						<tr>
							<td>-------------------------------------</td>
							<td>-------------------------------------</td>
						</tr>
						<tr>
							<td>Camp Director (Ian Nenke)</td>
							<td>Teacher (<?php echo ucwords($data['first_name']); ?>)</td>
						</tr>
					</table>	
				<table class="table">
					<tr>		
						<td><h2 class="create_think" style="text-align:; margin-top: 64px; "><font style="color:orange;"><i class="r_color">Think.</i> <b class="r_color">Create.</b> </font><font size=""><i>Succeed.</i></font></h2></td>
						<td><img class="logo_img" src="../assets/images/ras-logo.png" style="    height: 170px;width: 176px;margin-top: 10px;margin-left: 150px;"></td>
					</tr>
				</table>
			</div>
			</div>
        </div>
		</section>

	</body>

	<footer>

	</footer>
</html>


<script type="text/javascript">
   window.print();
</script>