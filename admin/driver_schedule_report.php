<?php include('../db_config.php');

	if(isset($_GET['id']) && !empty($_GET['id'])){
	    $id = $_GET['id'];
	    
	    //echo "SELECT t1.*,t2.first_name,t2.last_name,t3.student_app_id,t3.student_name,t3.nationality,t3.age_year FROM transport_students as t1 LEFT JOIN transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id LEFT JOIN school_application as t3 on t1.students_id=t3.student_app_id WHERE schedule_id='$id'";

	    $sql2 = mysqli_query($db, "SELECT t1.*,t2.first_name,t2.last_name,t3.student_app_id,t3.student_name,t3.nationality,t3.age_year FROM transport_students as t1 LEFT JOIN transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id LEFT JOIN school_application as t3 on t1.students_id=t3.student_app_id WHERE schedule_id='$id'");
	    //print_r($data);die;

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
			/*.FormDiv{
			    border-style: double !important;
    			border: 6px solid #da8404;
			    margin-top: 0px;
				margin-bottom: 0px;
    			padding: 28px;
			}*/
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
		
<!-- ***************_MORNING PICK UP_***********************-->
		<section>
			<div class="container">
				<div class="row">
					<div class="FormDiv col-md-12">
						<strong>_MORNING PICK UP_</strong>
	                    <table class="table table-bordered">
					        <tr>
                                <th>Sr.No</th>
                                <th>Drivers </th> 
                                <th>Student</th>
                                <th>Pick Up Time</th> 
                                <th>Drop Off Time</th> 
                                <th>Pick Up Address/Drop Off Address</th> 
                                <th>Remarks</th>
                                <?php 

                                    $date = date('d-m-Y');
                                    $ts = strtotime($date);
                                    $year = date('o', $ts);
                                    $week = date('W', $ts);
                                    for($i = 1; $i <= 7; $i++) {
                                        $ts = strtotime($year.'W'.$week.$i);
                                        //print date("m/d/Y l", $ts) . "\n";
                                        $final_date=date("d-m-Y", $ts);
                                ?>

                                <th><?=$final_date; ?></th>

                                <?php } ?>
                            </tr>

                            <?php while($data = mysqli_fetch_assoc($sql2)){ 
                            	
                            ?>


                            <tr>
                                <td><?php echo $data['schedule_id']; ?></td>
                                <td><?php echo $data['first_name'].' '.$data['last_name']; ?></td>
                                <td><?php echo $data['student_name']; ?></td>
                                <td><?php echo $data['pickup_start_time']; ?></td>
                                <td><?php echo $data['pickup_end_time']; ?></td> 
                                <td><?php echo $data['pick_location'].' - '.$data['drop_loc_id']; ?></td> 
                                 
                                <td><?php echo $data['remark']; ?></td>

                                <?php 
                                //print_r($one['attendance_date']);
                                $new_date = date('d-m-Y');
                                $new_ts = strtotime($date);
                                $new_year = date('o', $ts);
                                $new_week = date('W', $ts);
                                for($i = 1; $i <= 7; $i++) {
                                    $new_ts = strtotime($new_year.'W'.$new_week.$i);
                                    //print date("m/d/Y l", $ts) . "\n";
                                    $new_final_date=date("Y-m-d", $new_ts);
                                	$one = mysqli_query($db,"SELECT * FROM modal_schedule WHERE transport_schedules_id='$id' AND attendance_date='$new_final_date' AND student_app_id='$data[student_app_id]'") or die(mysqli_error($db));
                                	if(mysqli_num_rows($one)>0) { 
                                ?>
                                <td><img src='../assets/images/check.png' width='15px' height='15px'></td>

                            	<?php }else{
                            		echo '<td></td>';
                            	}  } ?>
                            </tr>
                        <?php } ?>
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