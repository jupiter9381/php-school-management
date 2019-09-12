<?php include('../db_config.php');

	if(isset($_GET['id']) && !empty($_GET['id'])){
	    $id = $_GET['id'];

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
			 /*table { border-collapse: collapse; }
 table tr { display: block; float: left; }
 table tr tr{ display: block; float: center; }
 table th, table td { display: block; border: center; }*/

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
		
<!-- ***************  Student Test Report     ***********************-->
		<section>
			<div class="container">
				<div class="row">
					<div class="FormDiv col-md-12">
						<strong><h1 style="text-align: center; color: orange; "><ul>STUDENT TEST REPORT</ul></strong></h1>
	                    <table class="table table-bordered " id="sample_5">
	                    	<thead>
					       		<?php 
					       		$sql = "SELECT 
					       				t1.test_id,
					       				t1.obtained_marks,
					       				t1.wrong_answer_count,
					       				t1.correct_answer_count,
					       				t1.total_marks,
					       				t1.created_date,
					       				t1.total_percentage,
					       				t2.student_name,
					       				t3.test_name

					       				FROM student_test_result t1
					       				INNER JOIN student_profile t2 ON t2.student_profile_id = t1.student_id
					       				INNER JOIN student_test t3 ON t3.test_name_id = t1.test_id 
					       				WHERE t1.test_result_id ='$id'";
					       		$query = mysqli_query($db,$sql) or die(mysqli_error($db));
					       		$data = mysqli_fetch_assoc($query); 
					       		?>
	                        <tr>    <!-- <th>ID</th> -->
	                                <th>Student Name </th> 
	                                <th>Date & Time</th>
	                                <th>Test Name</th>
	                                <th>Wrong Answer</th>
	                                <th>Correct Answer</th>
	                                <th>Obtained Marks</th>
	                                <th>Total Marks</th>
	                                <th>Obtained Pecentage</th>

                            </tr>

                            </thead>


                            <tbody>

                            <tr id="invoice<?php echo $data['test_result_id'];?>">
                           
                            	
                            	<!-- <td><?php //echo $data['student_profile_id']; ?></td> -->
                            	<td><?php echo $data['student_name']; ?></td>
                            	<td><?php echo $data['created_date']; ?></td>
                            	<td><?php echo $data['test_name']; ?></td>
                            	<td style="color:red"; ><?php echo $data['wrong_answer_count']; ?></td>
                            	<td style="color:green";><?php echo $data['correct_answer_count']; ?></td>
                            	<td><?php echo $data['obtained_marks']; ?></td>
                            	<td><?php echo $data['total_marks']; ?></td>
                            	<td><?php echo $data['total_percentage']; ?>%</td>



                          </tr>
                        
                        </tbody>
						</table>
					</div>
				</div>
	        </div>
		</section>	

		<!-- ***************  Student Test Question Answer And Right Answer  ************-->

		<section>
			<div class="container">
				<div class="row">
					<div class="FormDiv col-md-12">
						<strong><h3 style="text-align: center; color: orange; "><ul> STUDENT TEST QUESTION ANSWER AND RIGHT ANSWER </ul></strong></h3>
	                    <table class="table table-bordered " id="sample_5">
	                    	<thead>
					       		
	                        <tr>    <!-- <th>Question No.</th> -->
	                                <th>Questions </th> 
	                                <th>Answers</th>
	                                <th>Correct Answer</th>
	                                <th>Student Answer</th>
	                                

                            </tr>

                            </thead>


                            <tbody>
                            	<?php
                            $i=0;

                            $q1 = mysqli_query($db,"SELECT t1.*,t2.test_name,t3.answer,t3.correct_answer
                                                    FROM `student_questions` t1 
                                                    LEFT JOIN student_test t2 ON t1.test_name_id=t2.test_name_id
                                                    LEFT JOIN student_answer t3 ON t3.student_questions_id = t1.student_questions_id WHERE t1.test_name_id='$data[test_id]'") or die(mysqli_error($db));
                                while($data = mysqli_fetch_assoc($q1)) {
                                	$sql02 = mysqli_query($db,"SELECT * FROM student_test_question_answer WHERE question_id = '$data[student_questions_id]'") or die(mysqli_error($db));
                                	$row02 = mysqli_fetch_assoc($sql02);
                                	$correct_answer = ""; 
                                	$total_answer_array = explode(',',$data['answer']);
                                	$correct_answer_array = explode(',',$data['correct_answer']);
                                	foreach ($correct_answer_array as $key => $value) {
                                		if($value == 1){
                                			$correct_answer = $total_answer_array[$key];
                                			break;
                                		}
                                	}
                               		echo '<tr>
                               				
                               				
                               				<td>'.$data['questions'].'</td>
                               				<td>'.$data['answer'].'</td>
                               				<td>'.$correct_answer.'</td>
                               				<td>'.$row02['answer'].'</td>
                               			<tr>';
                               	}

                            	$i++;      
                
                                ?>


                        
                        </tbody>

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
   //window.print();
</script>