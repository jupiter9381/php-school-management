<?php
session_start(); 
	error_reporting(E_ERROR | E_PARSE);
	//print_r($_SESSION);
if((!isset($_SESSION['adminloggedin'])) && (!isset($_SESSION['userLoggedin'])))
{
    header("location: index.php");  
}

else
{
    include('../db_config.php');
    $per_id = '';
    if(isset($_SESSION['admin_per_id'])){
    	$per_id = $_SESSION['admin_per_id'];
    }
    if(isset($_SESSION['userLoggedin'])){
    	$per_id = $_SESSION['user_per_id'];
    }
    // echo $per_id;die;
}
//echo $userloggedin;
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

	</head>
	<!--
		.boxed = boxed version
	-->
	<body>


		<!-- WRAPPER -->
		<div id="wrapper" class="clearfix">

			<aside id="aside">
				
				<nav id="sideNav"><!-- MAIN MENU -->
					<ul class="nav nav-list">
					<?php 

	                    if(permission_access($db,$per_id,'dashboard_view')==1)
	                   	{ 
	                ?>
						<li class="active"><!-- dashboard -->
							<a class="dashboard" href="dashboard.php">
								<i class="main-icon fa fa-dashboard"></i> <span>Dashboard</span>
							</a>
						</li>
<?php  } if(permission_access($db,$per_id,'user_dashboard_view')==1){ ?>
						<li>
	                        <a href="user_dashboard.php">
	                            <i class="main-icon fa fa-users"></i><span>Home</span>
	                        </a>
	                    </li>
					<?php  } if(permission_access($db,$per_id,'camp_management_view')==1){ ?>
						<li>
	                        <a href="camp_management.php">
	                            <i class="main-icon fa fa-users"></i><span>Camp Management</span>
	                        </a>
	                    </li>
						
	                <?php } //print_r($per_id);
	                if(permission_access($db,$per_id,'student_application_view')==1){ ?>

						<li>
							<a class="student_application" href="student_app.php">
								<i class="main-icon fa fa-graduation-cap"></i> 
								<span>Student Application Management</span>
							</a>
						</li>
						
					<?php } 


						$p1 = permission_access($db,$per_id,'student_profile_view');
						$p2 = permission_access($db,$per_id,'student_attendance_view');
						$p3 = permission_access($db,$per_id,'testing_result_view');
						$p4 = permission_access($db,$per_id,'class_assignment_view');
						$p5 = permission_access($db,$per_id,'incident_report_view');
						$p6 = permission_access($db,$per_id,'communication_history_view');
						$p7 = permission_access($db,$per_id,'student_idcard_view');
						$p8 = permission_access($db,$per_id,'student_image_gallery_view');
						$p9 = permission_access($db,$per_id,'camp_fee_view');
						$p10 = permission_access($db,$per_id,'enrollment_status_view');
						
						
						if($p1 == 1 || $p4 == 1 || $p5 == 1 || $p6 == 1 || $p7 == 1 || $p8 == 1 || $p9 == 1 || $p10 == 1 || $p11 == 1 || $p12 == 1){

					  ?>

						<li>
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-user"></i>
								<span>Student Management</span>
							</a>
							<ul>
								
								<?php if($p1==1){ ?>

								<li>
									<a href="student_profile.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Profile</span>
									</a>
								</li>

								<?php //}if($p2==1){ ?>
								
								<!--<li>
									<a href="student_attendance.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Attendance / Roll Call feature </span>
									</a>
								</li>-->

								<?php //}if($p3==1){ ?>
								
								<!--<li>
									<a href="testing_result.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Testing Results</span>
									</a>
								</li>-->

								<?php }if($p4==1){ ?>

								<li>
									<a href="class_assignment.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Class Assignment</span>
									</a>
								</li>

								<?php }if($p5==1){ ?>

								<li>
									<a href="incident_report.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Incident Reports</span>
									</a>
								</li>

								<?php }if($p6==1){ ?>

								<li>
									<a href="communication_history.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Communication History</span>
									</a>
								</li>

								<?php }if($p7==1){ ?>

								<li>
									<a href="add_student_idcard.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Student ID Card Generation</span>
									</a>
								</li>

								<?php }if($p8==1){ ?>
								
								<li>
									<a href="student_image_gallery.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Image Gallery</span>
									</a>
								</li>

								<?php }if($p9==1){ ?>

								<li>
									<a href="camp_fee.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Camp Fee/Cost Assignment</span>
									</a>
								</li>

								<?php }if($p10==1){ ?>

								<li>
									<a href="enrollment_status.php">
										<i class="main-icon fa fa-calendar"></i> 
										<span>Enrollment Status</span>
									</a>
								</li>

								<?php }

								$p11 = permission_access($db,$per_id,'student_report_view');
								$p12 = permission_access($db,$per_id,'student_assesment_view');

								if($p11 == 1 || $p12 == 1){

								 ?>

								<li>
			                        <a href="#">
			                        	<i class="fa fa-menu-arrow pull-right"></i>
			                            <i class="main-icon fa fa-file"></i>
			                            <span>Student Report</span>
			                        </a>
			                        <ul>
			                        	<?php if($p11==1){ ?>

			                           	<li>
					                        <a href="student_report_form.php">
					                            <i class="main-icon fa fa-file"></i>
					                            <span>Student Report form</span>
					                        </a>
				                    	</li>

				                    	<?php }if($p12==1){ ?>

					                    <li>
					                        <a href="student_assessment.php">
					                            <i class="main-icon fa fa-child"></i>
					                            <span>Student Assessments</span>
					                        </a>
					                    </li>

					                	<?php } ?>

				                	</ul>
				                </li>
				            	<?php }?>
				                
							</ul>
						</li>
						
						<?php }
						$p1 = permission_access($db,$per_id,'student_online_testing_view');
						$p2 = permission_access($db,$per_id,'student_test_file_view');
						$p3 = permission_access($db,$per_id,'test_name_view');
						$p4 = permission_access($db,$per_id,'add_questions_view');
						$p5 = permission_access($db,$per_id,'student_question_view');
						
						if($p1 == 1 || $p2 == 1 || $p3 == 1 || $p4 == 1 || $p5 == 1){
						?>

						<li>
							<a class="student_testing" href="#">
								<i class="main-icon fa fa-graduation-cap"></i> 
								<span>Student Testing Management</span>
							</a>
							<ul>
								<?php   if(permission_access($db,$per_id,'student_online_testing_view')==1){  ?>
								
								<li>
									<a href="add_student_online_test.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Online Test</span>
									</a>
								</li>
								<?php }  if(permission_access($db,$per_id,'student_test_file_view')==1){ ?>
								<li>
									<a href="add_student_test_file.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Test File</span>
									</a>
								</li>
								<?php } if(permission_access($db,$per_id,'test_name_view')==1){ ?>
								<li>
									<a href="student_test_name.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Test Name</span>
									</a>
								</li>
								<!-- <li>
									<a href="student_questions.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Question</span>
									</a>
								</li>
								<li>
									<a href="student_answers.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Answers </span>
									</a>
								</li> -->
								<?php } if(permission_access($db,$per_id,'add_questions_view')==1){ ?>
								<li>
									<a href="add_question.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Add Question </span>
									</a>
								</li>
								<?php } if(permission_access($db,$per_id,'student_question_view')==1){ ?>
								<li>
									<a href="student_question_answer.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Question and Answer </span>
									</a>
								</li>
							<?php } ?>
							</ul>
						</li>


						<?php }
						$p1 = permission_access($db,$per_id,'academic_view');
						$p2 = permission_access($db,$per_id,'cca_view');
						$p3 = permission_access($db,$per_id,'creative_classes_view');
						$p4 = permission_access($db,$per_id,'boarding_activity_view');
						$p5 = permission_access($db,$per_id,'teacher_resource_management_view');
						$p6 = permission_access($db,$per_id,'curriculum_view');
						$p7 = permission_access($db,$per_id,'class_schedules_view');
						if($p1 == 1 || $p2 == 1 || $p3 == 1 || $p4 == 1 || $p5 == 1 || $p6 == 1 || $p7 == 1){
						?>
						
						<li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-file"></i>
	                            <span>Class Management</span>
	                        </a>
	                        <ul>
	                        	<?php if(permission_access($db,$per_id,'academic_view')==1){ ?>
	                           	<li>
									<a href="class_academic.php">
										
										<i class="main-icon fa fa-graduation-cap"></i>
										<span>Academic</span>
									</a>
								</li>

								<?php } if(permission_access($db,$per_id,'cca_view')==1){ ?>
		                     
		                     	<li>
									<a href="cca_sporting.php">
										
										<i class="main-icon fa fa-futbol-o"></i>
										<span>CCA (Sporting)</span>
									</a>
								</li>

								<?php } if(permission_access($db,$per_id,'creative_classes_view')==1){ ?>
		                    
		                     	<li>
									<a href="creative_classes.php">
										
										<i class="main-icon fa fa-graduation-cap"></i>
										<span>Creative Classes</span>
									</a>
								</li>

								<?php } if(permission_access($db,$per_id,'boarding_activity_view')==1){ ?>

								<li>
									<a href="boarding_activities.php">
										
										<i class="main-icon fa fa-graduation-cap"></i>
										<span>Boarding Activities</span>
									</a>
								</li>

								<?php } if(permission_access($db,$per_id,'teacher_resource_management_view')==1){ ?>

			                    <li>
			                        <a href="teacher_resource.php">
			                        	
			                            <i class="main-icon fa fa-file"></i>
			                            <span>Teacher / Resource Assignment</span>
			                        </a>  
			                    </li>

			                    <?php } if(permission_access($db,$per_id,'curriculum_view')==1){ ?>

			                    <li>
			                        <a href="curriculum_overview.php">
			                        	
			                            <i class="main-icon fa fa-folder"></i>
			                            <span>Curriculum</span>
			                        </a>                     
			                    </li>

			                    <?php } if(permission_access($db,$per_id,'class_schedules_view')==1){ ?>

			                    <li>
			                        <a href="class_schedules.php">
			                        	
			                            <i class="main-icon fa fa-file"></i>
			                            <span>Class Schedules</span>
			                        </a>                     
			                    </li>

			                	<?php }  ?>

		                	</ul>
	                	</li>
					
	                	<?php }

	                	$p1 = permission_access($db,$per_id,'transport_route_view');
						$p2 = permission_access($db,$per_id,'transport_schedule_view');
						$p3 = permission_access($db,$per_id,'driver_assignment_view');
						$p4 = permission_access($db,$per_id,'transport_incident_report_view');
						$p5 = permission_access($db,$per_id,'audit_transport_view');
						$p6 = permission_access($db,$per_id,'notification_view');
						$p7 = permission_access($db,$per_id,'export_feature_view');

						if($p1 == 1 || $p2 == 1 || $p3 == 1 || $p4 == 1 || $p5 == 1 || $p6 == 1 || $p7 == 1){

	                	 ?>

	                	
						<li>
                            <a href="#">
                                <i class="fa fa-menu-arrow pull-right"></i>
                                <i class="main-icon fa fa-bus"></i>
                                <span>Transport Management</span>
                            </a>
							<ul>
								<?php   if(permission_access($db,$per_id,'transport_route_view')==1){ ?>
                                <li>
	                                <a href="transport_routes.php">    
	                                    <i class="main-icon fa fa-bus"></i>
	                                    <span>Transport Routes – Pickup / Drop Locations</span>
	                                </a>
                            	</li>

                            	<?php } if(permission_access($db,$per_id,'transport_schedule_view')==1){ ?>

	                             <li>
	                                <a href="transport_schedules.php">   
	                                    <i class="main-icon fa fa-bus"></i>
	                                    <span>Transport Schedules</span>
	                                </a>                        
	                            </li>

	                            <?php } if(permission_access($db,$per_id,'driver_assignment_view')==1){ ?>

                                <li>
									<a href="driver_assignments.php">
										
										<i class="main-icon fa fa-users"></i>
										<span>Driver Assignments</span>
									</a>                     
								</li>

								<?php } if(permission_access($db,$per_id,'transport_incident_report_view')==1){ ?>

								<li>
									<a href="incident_reports.php">
										
										<i class="main-icon fa fa-users"></i>
										<span>Incident Reports</span>
									</a>                     
								</li>

								<?php } if(permission_access($db,$per_id,'audit_transport_view')==1){ ?>

								<li>
									<a href="audit_of_transport.php">
										
										<i class="main-icon fa fa-bus"></i>
										<span>Audit of transport history</span>
									</a>                     
								</li>

								<?php } if(permission_access($db,$per_id,'notification_view')==1){ ?>

								<li>
									<a href="#">
										
										<i class="main-icon fa fa-bell"></i>
										<span>Notification</span>
									</a>                     
								</li>

								<?php } if(permission_access($db,$per_id,'export_feature_view')==1){ ?>

								<li>
									<a href="export_feature.php">
										
										<i class="main-icon fa fa-file"></i>
										<span>Export Feature</span>
									</a>                     
								</li>

							<?php }  ?>

                        	</ul>
                        </li>

                    	<?php }

                    	$p1 = permission_access($db,$per_id,'camp_teacher_view');
						$p2 = permission_access($db,$per_id,'boarding_staff_view');
						$p3 = permission_access($db,$per_id,'class_room_view');
						$p4 = permission_access($db,$per_id,'boarding_room_view');
						$p5 = permission_access($db,$per_id,'school_staff_view');
						$p6 = permission_access($db,$per_id,'equipment_materials_view');
						$p7 = permission_access($db,$per_id,'transport_driver_view');
						$p8 = permission_access($db,$per_id,'transport_vehicles_view');
						
						if($p1 == 1 || $p2 == 1 || $p3 == 1 || $p4 == 1 || $p5 == 1 || $p6 == 1 || $p7 == 1 || $p8 == 1){

                    	 ?>

						<li>
                            <a href="#">
                                <i class="fa fa-menu-arrow pull-right"></i>
                                <i class="main-icon fa fa-users"></i>
                                <span>Resource Management</span>
                            </a>
                           <ul>
                           	<?php   if(permission_access($db,$per_id,'camp_teacher_view')==1){ ?>
                                <li>
	                                <a href="camp_teachers.php">
	                                    <i class="main-icon fa fa-users"></i>
	                                    <span>Camp Teachers</span>
	                                </a>
                            	</li>

                            	<?php } if(permission_access($db,$per_id,'boarding_staff_view')==1){ ?>

	                            <li>
	                                <a href="boardingstaff.php">
	                                    <i class="main-icon fa fa-users"></i>
	                                    <span>Boarding Staff </span>
	                                </a>                        
	                            </li>

	                            <?php } if(permission_access($db,$per_id,'class_room_view')==1){ ?>

	                            <li>
			                        <a href="class_room.php">	                        	
			                            <i class="main-icon fa fa-users"></i><span>Class Room </span>
			                        </a>                     
			                    </li>

			                    <?php } if(permission_access($db,$per_id,'boarding_room_view')==1){ ?>

			                    <li>
			                        <a href="boarding_room.php">	                        	
			                            <i class="main-icon fa fa-users"></i><span>Boarding Room </span>
			                        </a>                     
			                    </li>

	                            <?php } if(permission_access($db,$per_id,'school_staff_view')==1){ ?>

	                            <li>
	                                <a href="school_staff.php">
	                                    <i class="main-icon fa fa-users"></i>
	                                    <span>School Staff</span>
	                                </a>                        
	                            </li>

	                            <?php } if(permission_access($db,$per_id,'equipment_materials_view')==1){ ?>

			                    <li>
			                        <a href="equipment_materials.php">
			                        	
			                            <i class="main-icon fa fa-file"></i>
			                            <span>Equipment / Materials Assignment</span>
			                        </a>                     
			                    </li>

	                            <?php } if(permission_access($db,$per_id,'transport_driver_view')==1){ ?>
                            
			                    <li>
			                        <a href="transport_drivers.php">
			                        	
			                            <i class="main-icon fa fa-users"></i>
			                            <span>Transport Drivers</span>
			                        </a>                     
			                    </li>

			                    <?php } if(permission_access($db,$per_id,'transport_vehicles_view')==1){ ?>

			                    <li>
			                        <a href="transport_vehicle.php">
			                        	
			                            <i class="main-icon fa fa-bus"></i>
			                            <span>Transport Vehicles</span>
			                        </a>                     
			                    </li>

			                	<?php } ?>

                        	</ul>
                        </li>

                    	<?php } 

                    	$p1 = permission_access($db,$per_id,'agent_profile_data_view');
						$p2 = permission_access($db,$per_id,'linked_student_view');
						$p3 = permission_access($db,$per_id,'agent_commission_view');
						$p4 = permission_access($db,$per_id,'agent_camp_fee_view');
						$p5 = permission_access($db,$per_id,'agent_communication_view');
						$p6 = permission_access($db,$per_id,'messaging_feature_view');
						
						if($p1 == 1 || $p2 == 1 || $p3 == 1 || $p4 == 1 || $p5 == 1 || $p6 == 1){

                    	?>
                        
						<li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-user-plus"></i>
	                            <span>	Sales Agent  </span>
	                        </a>
	                        <ul>

	                        	<?php   if(permission_access($db,$per_id,'agent_profile_data_view')==1){ ?>

	                           	<li>
			                        <a href="sales_agent_profile.php">
			                        	
			                            <i class="main-icon fa fa-file"></i>
			                            <span>Profile Data </span>
			                        </a>
		                    	</li>

		                    	<?php }  if(permission_access($db,$per_id,'linked_student_view')==1){ ?>

			                    <li>
			                        <a href="linked_student.php">
			                        	
			                            <i class="main-icon fa fa-child"></i>
			                            <span>	Linked Students </span>
			                        </a>  
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'agent_commission_view')==1){ ?>

			                    <li>
			                        <a href="student_commission_fee.php">
			                        	
			                            <i class="main-icon fa fa-usd"></i>
			                            <span>	Commission </span>
			                        </a>  
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'agent_camp_fee_view')==1){ ?>

			                    <li>
			                        <a href="agent_camp_fee.php">
			                        	
			                            <i class="main-icon fa fa-usd"></i>
			                            <span>	Camp Fee  </span>
			                        </a>  
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'agent_communication_view')==1){ ?>

			                    <li>
			                        <a href="agent_communication_history.php">
			                        	
			                            <i class="main-icon fa fa-comments"></i>
			                            <span>	Communication  </span>
			                        </a>  
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'messaging_feature_view')==1){ ?>

			                    <li>
			                        <a href="messaging_feature.php">
			                            <i class="main-icon fa fa-comments"></i>
			                            <span>	Messaging Feature </span>
			                        </a> 
			                    </li>

			                <?php }   ?>

		                	</ul>
		                </li>

		            	<?php } 

		            	$p1 = permission_access($db,$per_id,'image_gallery_view');
						$p2 = permission_access($db,$per_id,'video_gallery_view');
						
						if($p1 == 1 || $p2 == 1){

		            	?>
                        
		                <li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-user-plus"></i>
	                            <span>	Gallery  </span>
	                        </a>
	                        <ul>

	                        	<?php  if(permission_access($db,$per_id,'image_gallery_view')==1){ ?>
	                           	<li>
			                        <a href="image_gallery.php">
			                        	
			                         <i class="main-icon fa fa-file"></i>
			                         <span>
			                           Image Gallery  </span>
			                        </a>
		                    	</li>

		                    	<?php }  if(permission_access($db,$per_id,'video_gallery_view')==1){ ?>

			                    <li>
			                        <a href="video_gallery.php">
			                         <i class="main-icon fa fa-file"></i>
			                         <span>
			                            Video Gallery  </span>
			                        </a>
			                    </li>

			                    <?php }   ?>

		                    </ul>
		                </li>

		            	<?php }

		            	$p1 = permission_access($db,$per_id,'camp_revenue_view');
						$p2 = permission_access($db,$per_id,'student_application_report_view');
						$p3 = permission_access($db,$per_id,'class_assignments_report_view');
						$p4 = permission_access($db,$per_id,'agent_revenue_view');
						$p5 = permission_access($db,$per_id,'camp_student_conversion_view');
						$p6 = permission_access($db,$per_id,'boarding_assignment_report_view');
						$p7 = permission_access($db,$per_id,'transport_assignments_report_view');
						$p8 = permission_access($db,$per_id,'class_attendance_report_view');
						$p16 = permission_access($db,$per_id,'user_view');
						
						if($p1 == 1 || $p2 == 1 || $p3 == 1 || $p4 == 1 || $p5 == 1 || $p6 == 1 || $p7 == 1 || $p8 == 1){

		            	 ?>

		                <li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-user-plus"></i>
	                            <span>	Business Reporting  </span>
	                        </a>
	                        <ul>

	                        	<?php if(permission_access($db,$per_id,'camp_revenue_view')==1){ ?>

	                           	<li>
			                        <a href="camp_revenue.php">
			                            <i class="main-icon fa fa-file"></i>
			                            <span>
			                            Camp revenue  </span>
			                        </a>
		                    	</li>

		                    	<?php }  if(permission_access($db,$per_id,'student_application_report_view')==1){ ?>

			                    <li>
			                        <a href="student_applications.php">
			                            <i class="main-icon fa fa-child"></i>
			                            <span>	Student Applications </span>
			                        </a>  
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'class_assignments_report_view')==1){ ?>

			                    <li>
			                        <a href="business_class.php">
			                            <i class="main-icon fa fa-folder"></i>
			                            <span>	Class Assignments </span>
			                        </a>  
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'agent_revenue_view')==1){ ?>

			                    <li>
			                        <a href="agent_revenue.php">
			                            <i class="main-icon fa fa-usd"></i>
			                            <span>	Agent revenue </span>
			                        </a>  
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'camp_student_conversion_view')==1){ ?>

			                    <li>
			                        <a href="camp_student_conversion.php">
			                            <i class="main-icon fa fa-child"></i>
			                            <span>	Camp Student Conversion  </span>
			                        </a> 
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'boarding_assignment_report_view')==1){ ?>
		                      	
			                    <li>
			                        <a href="boarding_assignment.php">
			                            <i class="main-icon fa fa-file"></i>
			                            <span>	Boarding Assignment </span>
			                        </a>  
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'transport_assignments_report_view')==1){ ?>

			                    <li>
			                        <a href="transport_assignments.php">
			                            <i class="main-icon fa fa-bus"></i>
			                            <span>Transport Assignments   </span>
			                        </a> 
			                    </li>

			                    <?php }  if(permission_access($db,$per_id,'class_attendance_report_view')==1){ ?>

			                    <li>
			                        <a href="class_attendance.php">
			                            <i class="main-icon fa fa-check"></i>
			                            <span>Class Attendance </span>
			                        </a>
			                    </li>

			                    <?php } 


			                    $p9 = permission_access($db,$per_id,'academic_schedule_view');
								$p10 = permission_access($db,$per_id,'cca_schedule_view');
								$p11 = permission_access($db,$per_id,'creative_classes_schedule_view');
								$p12 = permission_access($db,$per_id,'boarding_activities_view');
						
								if($p9 == 1 || $p10 == 1 || $p11 == 1 || $p12 == 1){

			                     ?>

			                    <li>
			                        <a href="#">
			                            <i class="main-icon fa fa-clock-o"></i>
			                            <span>Schedules</span>
			                        </a>
			                        <ul>
			                    	
			                        	<?php  if(permission_access($db,$per_id,'academic_schedule_view')==1){ ?>

			 							<li>
					                        <a href="academic_schedules.php">
					                            <i class="main-icon fa fa-clock-o"></i>
					                            <span>Academic Schedules</span>
					                        </a> 
					                    </li>

					                    <?php }  if(permission_access($db,$per_id,'cca_schedule_view')==1){ ?>

					                    <li>
					                        <a href="cca_schedules.php">
					                            <i class="main-icon fa fa-clock-o"></i>
					                            <span>CCA (Sporting) Schedules</span>
					                        </a> 
					                    </li>

					                    <?php }  if(permission_access($db,$per_id,'creative_classes_schedule_view')==1){ ?>

					                    <li>
					                        <a href="creative_classes_schedules.php">
					                            <i class="main-icon fa fa-clock-o"></i>
					                            <span>Creative Classes Schedules</span>
					                        </a> 
					                    </li>

					                    <?php }  if(permission_access($db,$per_id,'boarding_activities_view')==1){ ?>

					                    <li>
					                     	<a href="boarding_activities_schedules.php">
					                            <i class="main-icon fa fa-clock-o"></i>
					                            <span>Boarding Activities Schedules</span>
					                        </a> 
					                    </li>

					                	<?php }  ?>

				                    </ul>
			                    </li>

			                	<?php } 


			                	$p13 = permission_access($db,$per_id,'academic_schedule_view');
								$p14 = permission_access($db,$per_id,'cca_schedule_view');
								$p15 = permission_access($db,$per_id,'creative_classes_schedule_view');
						
								if($p13 == 1 || $p14 == 1 || $p15 == 1){


			                	?>
			                    	                  
			                    <li>
			                        <a href="#">
			                        	
			                            <i class="main-icon fa fa-file"></i>
			                            <span>Camp Resource Allocation</span>
			                        </a> 
			                        <ul>

			                        	<?php  if(permission_access($db,$per_id,'teacher_report_view')==1){ ?>

			                        	<li>
					                      <a href="teachers_camp_resource.php">
					                            <i class="main-icon fa fa-users"></i>
					                            <span>Teachers</span>
					                        </a> 
					                    </li>

					                    <?php }  if(permission_access($db,$per_id,'video_gallery_view')==1){ ?>

					                    <li>
					                        <a href="camp_admin_report_view.php">
					                            <i class="main-icon fa fa-users"></i>
					                            <span>Camp Admins</span>
					                        </a> 
					                    </li>

					                    <?php }  if(permission_access($db,$per_id,'video_gallery_view')==1){ ?>

					                    <li>
					                        <a href="boarding_staff_report_view.php">
					                            <i class="main-icon fa fa-users"></i>
					                            <span>Boarding Staff</span>
					                        </a> 
					                    </li>

					               		<?php }  ?>

			                        </ul>            
			                    </li>

			                	<?php }  ?>

		                	</ul>
		                </li>

		           		<?php } 

		           		$p16 = permission_access($db,$per_id,'user_view');
						$p17 = permission_access($db,$per_id,'user_role_view');

						if($p16 == 1 || $p17 == 1){
						
		           		?>

		           		<li>
		           			<a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-user-plus"></i>
	                            <span>	User Management  </span>
	                        </a>
	                        <ul>
	                        	<?php if($p16==1){ ?>
	                        	<li>
	                        		<a href="users.php">
			                            <i class="main-icon fa fa-users"></i><span>Users</span>
			                        </a>
	                        	</li>
	                        	<?php }if($p17==1){ ?>
	                        	<li>
	                        		<a href="usertype.php">
			                            <i class="main-icon fa fa-users"></i><span>Users Role</span>
			                        </a>
	                        	</li>
	                        	<?php } ?>
	                        </ul>
		           		</li>

		           		<?php }?>
                     
		            </ul>

				</nav>

				<span id="asidebg"><!-- aside fixed background --></span>
			</aside>
			<!-- /ASIDE -->


			<!-- HEADER -->
			<header id="header">

				<!-- Mobile Button -->
				<button id="mobileMenuBtn"></button>
            <span class="logo pull-left">
                    <!--<h3 alt="logo" style = "height:35px;color:#fff;margin-top:4%;" />Admin Panel</h3>-->
 <img src="../assets/images/ras-logo.png" alt="logo" style="height: 70%;width: 45%;margin-top: 8px;">
            </span>

				<nav>

					<!-- OPTIONS LIST -->
					<ul class="nav pull-right">

						<!-- USER OPTIONS
						<li>
							<button onclick="location.href='index.php'" class="  btn btn-warning">Back to Protal</button>
						</li> -->
						<li class="dropdown pull-left">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<img class="user-avatar" alt="" src="../assets/images/noavatar.jpg" height="34" /> 
								<span class="user-name">
<?php
										 if(isset($_SESSION['adminloggedin'])){
										 	$name = $_SESSION['ausername'];
										 }
										 else if(isset($_SESSION['userLoggedin'])){
										 	$name = $_SESSION['userName'];
										 }
									 ?>
									<span class="hidden-xs">
										<?php echo $name; ?><i class="fa fa-angle-down"></i>
									</span>
								</span>
							</a>
							<ul class="dropdown-menu hold-on-click">
								

								
								<li>
									<a href="changepassword.php"><i class="fa fa-lock"></i>Change Password</a>
								</li>
								<li><!-- logout -->
									<a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a>
								</li>
					
							</ul>

						</li>
						<!-- /USER OPTIONS -->

					</ul>
					<!-- /OPTIONS LIST -->

				</nav>

			</header>
			<!-- /HEADER -->

