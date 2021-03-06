<!--<?php
 include('../db_config.php');
?>
-->

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
						<li class="active"><!-- dashboard -->
							<a class="dashboard" href="dashboard.php">
								<i class="main-icon fa fa-dashboard"></i> <span>Dashboard</span>
							</a>
						</li>

						<li>
                            <a href="#">
                                <i class="fa fa-menu-arrow pull-right"></i>
                                <i class="main-icon fa fa-users"></i><span>Resource Management</span>
                            </a>
                           <ul>
                                <li>
	                                <a href="camp_teachers.php">
	                                    <i class="main-icon fa fa-users"></i>
	                                    <span>Camp Teachers</span>
	                                </a>
                            	</li>
	                             <li>
	                                <a href="boardingstaff.php">
	                                    <i class="main-icon fa fa-users"></i><span>Boarding Staff </span>
	                                </a>                        
	                            </li>
                            
			                    <li>
			                        <a href="transport_drivers.php">
			                        	
			                            <i class="main-icon fa fa-users"></i><span>Transport Drivers </span>
			                        </a>                     
			                    </li>
			                    <li>
			                        <a href="transport_vehicle.php">
			                        	
			                            <i class="main-icon fa fa-bus"></i><span>Transport Vehicles </span>
			                        </a>                     
			                    </li>

                        	</ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-menu-arrow pull-right"></i>
                                <i class="main-icon fa fa-bus"></i>
                                <span>Transport Management</span>
                            </a>
                           <ul>
                                <li>
	                                <a href="transport_routes.php">    
	                                    <i class="main-icon fa fa-bus"></i>
	                                    <span>Transport Routes – Pickup / Drop Locations</span>
	                                </a>
                            	</li>
	                             <li>
	                                <a href="transport_schedules.php">   
	                                    <i class="main-icon fa fa-bus"></i>
	                                    <span>Transport Schedules</span>
	                                </a>                        
	                            </li>
                                      <li>
	                        <a href="driver_assignments.php">
	                        	
	                            <i class="main-icon fa fa-users"></i><span>	Driver Assignments</span>
	                        </a>                     
	                    </li>
	                    <li>
	                        <a href="incident_reports.php">
	                        	
	                            <i class="main-icon fa fa-users"></i><span>	 Incident Reports</span>
	                        </a>                     
	                    </li>
	                     <li>
	                        <a href="audit_of_transport.php">
	                        	
	                            <i class="main-icon fa fa-bus"></i><span>	Audit of transport history </span>
	                        </a>                     
	                    </li>
	                    <li>
	                        <a href="#">
	                        	
	                            <i class="main-icon fa fa-bell"></i><span>	Notification </span>
	                        </a>                     
	                    </li>
	                     <li>
	                        <a href="export_feature.php">
	                        	
	                            <i class="main-icon fa fa-file"></i><span>	Export Feature  </span>
	                        </a>                     
	                    </li>
                        	</ul>
                        </li>

                        <li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-file"></i><span>	Class Management</span>
	                        </a>
	                        <ul>
	                           	<li>
		                        <a href="academic.php">
		                        	
		                            <i class="main-icon fa fa-graduation-cap"></i><span>Academic</span>
		                        </a>
	                    	</li>
		                     
		                     	<li>
		                        <a href="cca_sporting.php">
		                        	
		                            <i class="main-icon fa fa-futbol-o"></i><span>CCA (Sporting)</span>
		                        </a>
	                    	</li>
		                    
		                     	<li>
		                        <a href="creative_classes.php">
		                        	
		                            <i class="main-icon fa fa-graduation-cap"></i><span>Creative Classes</span>
		                        </a>
	                    	</li>
	                    	<li>
		                        <a href="boarding_activities.php">
		                        	
		                            <i class="main-icon fa fa-graduation-cap"></i><span>Boarding Activities</span>
		                        </a>
	                    	</li>
			                     <li>
			                        <a href="teacher_resource.php">
			                        	
			                            <i class="main-icon fa fa-file"></i><span>	Teacher / Resource Assignment</span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="equipment_materials.php">
			                        	
			                            <i class="main-icon fa fa-file"></i><span>	Equipment / Materials Assignment</span>
			                        </a>                     
			                    </li>
			                    <li>
			                        <a href="curriculum_overview.php">
			                        	
			                            <i class="main-icon fa fa-folder"></i><span>Curriculum  </span>
			                        </a>                     
			                    </li>
			                    <li>
			                        <a href="class_schedules.php">
			                        	
			                            <i class="main-icon fa fa-file"></i><span>	Class Schedules </span>
			                        </a>                     
			                    </li>
		                   

		                	</ul>
	                	</li>
		                
		                <li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-user-plus"></i><span>	Gallery  </span>
	                        </a>
	                        <ul>
	                           	<li>
			                        <a href="image_gallery.php">
			                        	
			                         <i class="main-icon fa fa-file"></i><span>
			                           Image Gallery  </span>
			                        </a>
		                    	</li>
			                    <li>
			                        <a href="video_gallery.php">
			                         <i class="main-icon fa fa-file"></i><span>
			                            Video Gallery  </span>
			                        </a>
			                    </li>
		                    </ul>
		                </li>

		                <li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-user-plus"></i><span>	Sales Agent  </span>
	                        </a>
	                        <ul>
	                           	<li>
			                        <a href="sales_agent_profile.php">
			                        	
			                            <i class="main-icon fa fa-file"></i><span>Profile Data </span>
			                        </a>
		                    	</li>
			                    <li>
			                        <a href="linked_student.php">
			                        	
			                            <i class="main-icon fa fa-child"></i><span>	Linked Students </span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="student_commission_fee.php">
			                        	
			                            <i class="main-icon fa fa-usd"></i><span>	Commission </span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="agent_camp_fee.php">
			                        	
			                            <i class="main-icon fa fa-usd"></i><span>	Camp Fee  </span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="agent_communication_history.php">
			                        	
			                            <i class="main-icon fa fa-comments"></i><span>	Communication  </span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="messaging_feature.php">
			                            <i class="main-icon fa fa-comments"></i><span>	Messaging Feature </span>
			                        </a> 
			                    </li>
		                	</ul>
		                </li>

		                <li>
							<a class="student_testing" href="#">
								<i class="main-icon fa fa-graduation-cap"></i> 
								<span>Student Testing Management</span>
							</a>
							<ul>
								<li>
									<a href="student_online_test.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Online Test</span>
									</a>
								</li>
								<li>
									<a href="student_test_file.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Test File</span>
									</a>
								</li>
							</ul>
						</li>
		                
		                <li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-user-plus"></i><span>	Business Reporting  </span>
	                        </a>
	                        <ul>
	                           	<li>
			                        <a href="camp_revenue.php">
			                            <i class="main-icon fa fa-file"></i><span>
			                            Camp revenue  </span>
			                        </a>
		                    	</li>
			                    <li>
			                        <a href="student_applications.php">
			                            <i class="main-icon fa fa-child"></i><span>	Student Applications </span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="business_class.php">
			                            <i class="main-icon fa fa-folder"></i><span>	Class Assignments </span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="agent_revenue.php">
			                            <i class="main-icon fa fa-usd"></i><span>	Agent revenue </span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="camp_student_conversion.php">
			                            <i class="main-icon fa fa-child"></i><span>	Camp Student Conversion  </span>
			                        </a> 
			                    </li>
		                      	
			                    <li>
			                        <a href="boarding_assignment.php">
			                            <i class="main-icon fa fa-file"></i>
			                            <span>	Boarding Assignment </span>
			                        </a>  
			                    </li>
			                    <li>
			                        <a href="transport_assignments.php">
			                            <i class="main-icon fa fa-bus"></i>
			                            <span>Transport Assignments   </span>
			                        </a> 
			                    </li>
			                    <li>
			                        <a href="class_attendance.php">
			                            <i class="main-icon fa fa-check"></i>
			                            <span>Class Attendance </span>
			                        </a>
			                    </li>	                    
			                    <li>
			                        <a href="#">
			                            <i class="main-icon fa fa-clock-o"></i>
			                            <span>Schedules</span>
			                        </a>
			                        <ul>
			                    	
			 							<li>
					                        <a href="academic_schedules.php">
					                            <i class="main-icon fa fa-clock-o"></i>
					                            <span>Academic Schedules</span>
					                        </a> 
					                    </li>
					                    <li>
					                        <a href="cca_schedules.php">
					                            <i class="main-icon fa fa-clock-o"></i>
					                            <span>CCA (Sporting) Schedules</span>
					                        </a> 
					                    </li>
					                    <li>
					                        <a href="creative_classes_schedules.php">
					                            <i class="main-icon fa fa-clock-o"></i>
					                            <span>Creative Classes Schedules</span>
					                        </a> 
					                    </li>
					                    <li>
					                     	<a href="boarding_activities_schedules.php">
					                            <i class="main-icon fa fa-clock-o"></i>
					                            <span>Boarding Activities Schedules</span>
					                        </a> 
					                    </li>
				                    </ul>
			                    </li>
			                    	                  
			                    <li>
			                        <a href="#">
			                        	
			                            <i class="main-icon fa fa-file"></i>
			                            <span>Camp Resource Allocation</span>
			                        </a> 
			                        <ul>
			                        	<li>
					                      <a href="teachers_camp_resource.php">
					                            <i class="main-icon fa fa-users"></i>
					                            <span>Teachers</span>
					                        </a> 
					                    </li>
					                    <li>
					                        <a href="camp_admins_resource.php">
					                            <i class="main-icon fa fa-users"></i>
					                            <span>Camp Admins</span>
					                        </a> 
					                    </li>
					                    <li>
					                        <a href="boarding_staff_camp.php">
					                            <i class="main-icon fa fa-users"></i>
					                            <span>Boarding Staff</span>
					                        </a> 
					                    </li>
			                        </ul>            
			                    </li>

		                	</ul>
		                </li>
                            

						<li>
							<a class="student_application" href="student_app.php">
								<i class="main-icon fa fa-graduation-cap"></i> 
								<span>Student Application Management</span>
							</a>
						</li>

						<li>
							<a href=#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-user"></i>
								<span>Student Management</span>
							</a>
							<ul>
								<li>
									<a href="student_profile.php">
										<i class="main-icon fa fa-users"></i> 
										<span>Student Profile</span>
									</a>
								</li>
								<li>
									<a href="student_attendance.php">
										<i class="main-icon fa fa-calendar"></i> <span>Attendance / Roll Call feature </span>
									</a>
								</li>
								<li>
									<a href="testing_result.php">
										<i class="main-icon fa fa-calendar"></i> <span>Testing Results</span>
									</a>
								</li>
								<li>
									<a href="class_assignment.php">
										<i class="main-icon fa fa-calendar"></i> <span>Class Assignment</span>
									</a>
								</li>
								<li>
									<a href="incident_report.php">
										<i class="main-icon fa fa-calendar"></i> <span>Incident Reports</span>
									</a>
								</li>
								<li>
									<a href="communication_history.php">
										<i class="main-icon fa fa-calendar"></i> <span>Communication History</span>
									</a>
								</li>
								<li>
									<a href="student_idcard.php">
										<i class="main-icon fa fa-calendar"></i> <span>Student ID Card Generation</span>
									</a>
								</li>
								<li>
									<a href="student_image_gallery.php">
										<i class="main-icon fa fa-calendar"></i> <span>Image Gallery</span>
									</a>
								</li>
								<li>
									<a href="camp_fee.php">
										<i class="main-icon fa fa-calendar"></i> <span>Camp Fee/Cost Assignment</span>
									</a>
								</li>
								<li>
									<a href="enrollment_status.php">
										<i class="main-icon fa fa-calendar"></i> <span>Enrollment Status</span>
									</a>
								</li>
								<li>
			                        <a href="#">
			                        	<i class="fa fa-menu-arrow pull-right"></i>
			                            <i class="main-icon fa fa-file"></i><span>	Student Report </span>
			                        </a>
			                        <ul>
			                           	<li>
					                        <a href="student_report_form.php">
					                            <i class="main-icon fa fa-file"></i><span>Student Report form </span>
					                        </a>
				                    	</li>
					                    <li>
					                        <a href="student_assessment.php">
					                            <i class="main-icon fa fa-child"></i><span>	Student Assessments</span>
					                        </a>
					                    </li>	                    
				                	</ul>
				                </li>
							</ul>
						</li>

						<!-- <li>
							<a href=#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-th-list"></i> <span>Manager</span>
							</a>
							<ul>
								<li>
									<a href="../manager/deadline.php">
										<i class="fa fa-menu-arrow pull-right"></i>
										<i class="main-icon fa fa-calendar"></i> <span>Deadline</span>
									</a>
								</li>
								<li>
									<a href="../manager/extendeadline.php">
										<i class="fa fa-menu-arrow pull-right"></i>
										<i class="main-icon fa fa-calendar-times-o"></i> <span>Extend Deadline</span>
									</a>
									
								</li>
								<li>
									<a href="../manager/project.php">
										<i class="fa fa-menu-arrow pull-right"></i>
										<i class="main-icon fa fa-indent"></i> <span>Project</span>
									</a>
									
								</li>
								<li>
									<a href="../manager/teamtask.php">
										<i class="fa fa-menu-arrow pull-right"></i>
										<i class="main-icon fa fa-chain"></i> <span>Team Task</span>
									</a>
									
								</li>
						
								<li>
									<a href="../manager/projectissue.php">
										<i class="fa fa-menu-arrow pull-right"></i>
										<i class="main-icon fa fa-retweet"></i> <span>Project Issue</span>
									</a>
									
								</li>
								<li>
									<a href="../manager/milestone.php">
										<i class="fa fa-menu-arrow pull-right"></i>
										<i class="main-icon fa fa-line-chart"></i> <span>Milestone Report</span>
									</a>
									
								</li>
							</ul>
						</li>
						 <li>
	                        <a href="#">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-users"></i><span>Team Member</span>
	                        </a>
		                   <ul>
		                    
			                    <li>
			                        <a href="../pms/member.php">
			                            <i class="main-icon fa fa-user-plus"></i><span>Member</span>
			                        </a>
			                    </li>
			                    <li>
			                        <a href="../pms/project.php">
			                            <i class="main-icon fa fa-indent"></i><span>Project</span>
			                        </a>
			                    </li>
			                    <li>
			                        <a href="../pms/mycalendar.php">
			                            <i class="main-icon fa fa-calendar"></i><span>deadline</span>
			                        </a>
			                    </li>

			                    <li>
			                        <a href="../pms/extend.php">
			                            <i class="main-icon fa fa-calendar"></i><span>Extend Deadline </span>
			                        </a>
			                    </li>

			                    <li>
			                        <a href="../pms/task.php">
			                            <i class="main-icon fa fa-tasks"></i><span>Task</span>
			                        </a>
			                    </li>




			                    <li>
			                        <a href="../pms/projectissue.php">
			                            <i class="main-icon fa fa-retweet"></i><span>Project Issue</span>
			                        </a>
			                    </li>

			                    <li>
			                        <a href="../pms/milestone.php">
			                            <i class="main-icon fa fa-line-chart"></i><span>Milestone</span>
			                        </a>
			                    </li>

							</ul>
						</li>

				         <li>
			            	<a href="project.php">
									<i class="fa fa-menu-arrow pull-right"></i>
									<i class="main-icon  fa fa-indent"></i> <span>Project </span>
								</a>
			            </li>
	   

			            <li>
			            	<a href="assingtask.php">
									<i class="fa fa-menu-arrow pull-right"></i>
									<i class="main-icon fa fa-tasks"></i> <span>Team Assignment </span>
								</a>
			            </li>

			            

			             <li>
	                        <a href="gantt_chart.php">
	                        	<i class="fa fa-menu-arrow pull-right"></i>
	                            <i class="main-icon fa fa-line-chart"></i><span>Gantt Chart</span>
	                        </a>
	                    </li> -->
                     
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
									<span class="hidden-xs">
										 <i class="fa fa-angle-down"></i>
									</span>
								</span>
							</a>
							<ul class="dropdown-menu hold-on-click">
								

								
								<!--<li> logout
									<a href="changepassword.php"><i class="fa fa-lock"></i>Change Password</a>
								</li> -->
								<li><!-- logout -->
									<a href="index.php"><i class="fa fa-power-off"></i> Log Out</a>
								</li>
					
							</ul>

						</li>
						<!-- /USER OPTIONS -->

					</ul>
					<!-- /OPTIONS LIST -->

				</nav>

			</header>
			<!-- /HEADER -->

