<?php
include('../db_config.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT s.*,p.gender,p.age_year,p.first_name,p.middle_name,p.last_name,p.age_month,p.nationality,p.grade FROM `school_application` s LEFT JOIN student_profile p ON s.student_profile_id=p.student_profile_id  WHERE `student_app_id` = '$id'"));
    }
  ?>
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

            h1 {
               margin: 0 0 7px 0;
            }
            .formdiv{
			    border-style: single !important;
    			/*border: 6px solid gray;*/
			    margin-top: 0px;
				/*margin-bottom: 40px;*/
    			padding: 40px;
    			
			}
			.row {
    			margin-right: 0px;
				margin-left: 0px;

			}
			.raffle{
					color:orange !important;
					margin-bottom: 1px;
    				margin-top: 1px !important;
				}
				.raffles_school{
				    margin-bottom: -10px;
					margin-top: -30px;    
				}
			body {
    		color: #676a6c;
    		height: 100%;
    		direction: ltr;
    		overflow-x: hidden;
    		font-size: 16px;
    		line-height: 1.5;
    		}
    		hr {
	            border: single;
	            height: 4px;
	            width: 100%;
	    		/* Set the hr color */
	            color: gray; /* old IE */
	   			background-color: gray; /* Modern Browsers */
	   		}

   			p#span-text {
			    line-height: 1px !important;
			    margin-bottom: 0px !important;
			}
			p#span_text1 {
			    line-height: 1px !important;
			    margin-bottom: 0px !important;
			}

    		p{
    			margin-bottom: 9px !important;
    			margin-top: 9px !important;
			}
      .border {
          border-radius: 5px;
          border: 2px solid;
          padding: 8px; 
          width: 20px !important;
          height: 8px;  
      } 
       @media only screen and (max-width: 600px) {
  .printed_app {
    font-size: 11px !important;          
    position: absolute;
    margin-top: -2.9% !important;}

.ic_malasiya{
          font-size: 11px  !important; 
            margin-left: 79px  !important;
            position: absolute  !important;
           margin-top: -7.7% !important;
        }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
  .printed_app {
    font-size: 11px !important;          
    position: absolute;
    margin-top: -3.1% !important;}
    .ic_malasiya{
          font-size: 11px  !important; 
            margin-left: 79px  !important;
            position: absolute  !important;
           margin-top: -7.7% !important;
        }
      }


/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .printed_app {
    font-size: 11px !important;          
    position: absolute;
    margin-top: -1.9% !important;} 
    .ic_malasiya{
          font-size: 11px  !important; 
            margin-left: 79px  !important;
            position: absolute  !important;
           margin-top: -1.8% !important;
        }
      }

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  .printed_app {
    font-size: 11px !important;          
    position: absolute;
    margin-top: -1.5% !important;} 
    .ic_malasiya{
          font-size: 11px  !important; 
            margin-left: 79px  !important;
            position: absolute  !important;
           margin-top: -1.4% !important;
        }
      }

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  .printed_app {
    font-size: 11px !important;          
    position: absolute;
    margin-top: -1.4% !important;
  }
  .ic_malasiya{
          font-size: 11px  !important; 
            margin-left: 79px  !important;
            position: absolute  !important;
           margin-top: -1.4% !important;
        }

}     

			@media print{		
        @page {
            size: auto;
            
            margin: 18px;
            }
            .student_health{
              margin-bottom: 15%!important;
              margin-top: 60%!important;

            }
            .appendix{
              
              margin-top: -10% !important;

            }
             
        .printed_app {
            font-size: 9px !important;          
            position: absolute;
            margin-top: -1.5% !important;}

        .ic_malasiya{
          font-size: 11px  !important; 
          margin-left: 79px  !important;
          position: absolute  !important;
          margin-top: -1.7% !important;
        }
      		

				.raffle{
					color:orange !important;
					margin-bottom: 2px !important;
    			margin-top: 2px !important;
          font-size: 56px !important
				}
        .american{
          font-size: 46px !important

        }     
        

        .camper{
          font-size: 22px !important;
          margin-top: -20px !important;

        }
				
				.raffles_school{
				    margin-bottom: 0px;
					  margin-top: -20px;    
				}

				.think{
          color: orange!important;
        }			
            }

			body{
    		color: #676a6c;
    		height: 100%;
    		direction: ltr;
    		overflow-x: hidden;
    		font-size: 13px;
    		line-height: 1.2;
    		}

        
        .col-md-6{
          margin-left: 300px;
          margin-top: -30px;
        }
       
        
      }
     

		</style>
	</head>
    <body>
          <section>
          		<div class="cotainer">
          			<div class="row">
          				<div class="formdiv col-md-12">
          					<div class="col-md-12">
          						<center class="raffles_school">
          							<h1>
          								<b>
          									<font class="raffle" color="orange" size=""> Raffles</font>
          								</b>
          								<b>
          									<font class="american" color="gray" size=""> <i>American</i> School</font>
          								</b> 
          							</h1>
          						</center>
          						<center>
          							<u>
          								<h4 class="camper"><b>CAMPER APPLICATION FORM</b></h4>
          							</u>
          						</center>
          						<!-- <p text-align=justify; >*Please fill out this form using Adobe Fill and Sign, so that all answers are eligible. Hand written applications will not be accepted.</p> -->
                      <p text-align="justify" style="font-size: 11px" ; ><i>*Please fill out the form below and Print it out and sign it, Please upload you completed and signed application form into the RAS Camp System or email it to <b>camp@rafflesamericanschool.org</b>, Hand written applications will not be accepted.</i>
                        
                      </p>
          						
          						<div class="row">
          							<lable><b>STUDENT INFORMATION</b></lable><br>
          						
          						<p> 
          							Name(first/middle/last):&nbsp;<u><?php echo $data['first_name'].' '.$data['middle_name'].' '.$data['last_name'];?></u>&nbsp;&nbsp;&nbsp;Gender:&nbsp;<u><?php echo $data['gender'];?></u>
                        <!-- ____________Male______________Female -->
          						</p> 
          								
          							<span class="printed_app" style="font-size: 11px;position: absolute;"> *As printed in applicants passport
          							</span>

          						<p>
          							Date of Birth (DD/MM/YYYY):&nbsp;&nbsp;<u><?php echo $data['dob'];?></u>&nbsp;&nbsp;Age:&nbsp;<u><?php echo $data['age_year'];?></u>&nbsp;&nbsp;Yrs. <u><?php echo $data['age_month'];?></u>&nbsp;&nbsp;Months &nbsp;Current grade:&nbsp;&nbsp;<u><?php echo $data['grade'];?></u>&nbsp;&nbsp;
          						</p>	
          							
      							
      							<p> 
                        Passport No.:&nbsp;&nbsp;<u><?php echo $data['passport_no'];?></u>&nbsp;&nbsp;Nationality: &nbsp;&nbsp;<u><?php echo $data['nationality'];?></u>&nbsp;&nbsp;Country Issuing Passport:&nbsp;&nbsp;<u><?php echo $data['issue_date_passport'];?></u>&nbsp;&nbsp;
      							</p>
      							
      							<p>
      								<span class="ic_malasiya" style="font-size: 11px; margin-left: 100px;position: absolute;">(or IC# if Malaysia)
      								</span>
      							</p>
          						<p>	
          			       Camp Selection:&nbsp;&nbsp;<u><?php echo $data['camp_dates'];?></u>&nbsp;&nbsp;
                       Boarding Requested?&nbsp;&nbsp; Yes &nbsp;&nbsp; <input type="text" class="border" name="boarding" readonly><?php if((isset($data['boarding_req'])) && ($data['boarding_req'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px'  style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;  <input type="text" class="border" name="boarding" readonly><?php if((isset($data['boarding_req'])) && ($data['boarding_req'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>  
          						</p>
          						<p>
          							English Name : &nbsp;&nbsp;<u><?php echo $data['english_name'];?></u>&nbsp;&nbsp;
                      </p>
          					
          						<label><b>SIBLINGS</b></label>
          						<p>
          							Does the applicant have siblings / family members attending camp RAS?&nbsp;&nbsp; Yes &nbsp;&nbsp; <input type="text" class="border" name="boarding" readonly> <?php if((isset($data['siblings'])) && ($data['siblings'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -19px;'>"; }?>&nbsp;&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;<input type="text" class="border" name="boarding" readonly><?php if((isset($data['siblings'])) && ($data['siblings'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>
          						<p>	
          							If Yes, campers name (s):&nbsp;&nbsp;<u><?php echo $data['campers_name'];?></u>&nbsp;&nbsp;
                      </p>
          					
          					
          						<label><b>FAMILY INFORMATION</b></label>
          						
          						<p>
          						    Primary local address in Malaysia:&nbsp;&nbsp;<u><?php echo $data['address'];?></u>&nbsp;&nbsp;
          						
          						</p>
          						<p>
          							Mother Name (first/middle/last): &nbsp;&nbsp;<u><?php echo $data['mother_name'];?></u>&nbsp;&nbsp;

          						</p>
          						
          						<p>
          							Email (Mother): &nbsp;&nbsp;<u><?php echo $data['mother_email'];?></u>&nbsp;&nbsp; Mobile (Mother): &nbsp;&nbsp;<u><?php echo $data['mother_mobile'];?></u>&nbsp;&nbsp; Home Phone Number: &nbsp;&nbsp;<u><?php echo $data['home_phone'];?></u>&nbsp;&nbsp;
          						</p>          				
          						<p>
          							Father Name (first/middle/last):&nbsp;&nbsp;<u><?php echo $data['father_name'];?></u>&nbsp;&nbsp;
          						<p>
          							Email (Father): &nbsp;&nbsp;<u><?php echo $data['father_email'];?></u>&nbsp;&nbsp;Mobile (Father): &nbsp;&nbsp;<u><?php echo $data['father_mobile'];?></u>&nbsp;&nbsp;Home Phone Number: &nbsp;&nbsp;<u><?php echo $data['home_phone'];?></u>&nbsp;&nbsp;
          						</p>
          						<p>
          							WeChat # <font style="font-size: 11px;"> (if applicable)</font>: &nbsp;&nbsp;<u><?php echo $data['wechat'];?></u>&nbsp;&nbsp;KakaoTalk ID&nbsp;&nbsp;<u><?php echo $data['kakao_talk'];?></u>&nbsp;&nbsp;Line ID&nbsp;&nbsp;<u><?php echo $data['line_id'];?></u>&nbsp;&nbsp;Whatsapp &nbsp;&nbsp;<u><?php echo $data['whatsapp'];?></u>&nbsp;&nbsp;
          						</p>

          					
          						<label><b>EMERGENCY CONTACT</b></label>
          						<p>
          							In case parent / guardian cannot be reached, please provide local contact information (i.e. friend, colleague, relative)
          						</p>
          						<p>
          							Name:&nbsp;&nbsp;<u><?php echo $data['relative_name'];?></u>&nbsp;&nbsp;Relationship to Student: <u><?php echo $data['relation_student'];?></u>&nbsp;&nbsp;
          						</p>
                      <p>
                        Relative Phone Number:&nbsp;&nbsp;<u><?php echo $data['relative_name'];?></u>&nbsp;&nbsp;Relative Email Address: <u><?php echo $data['relation_student'];?></u>&nbsp;&nbsp;
                      </p>
          						
          						</div>
          						<div class="row">
          							<label><b>BOARDING ALLOCATION REQUEST</b></label>
                        <p> 
                       
                       Boarding Allocation Requested?&nbsp;&nbsp; Yes &nbsp;&nbsp; <input type="text" class="border" name="boarding" readonly><?php if((isset($data['boarding_all_req'])) && ($data['boarding_all_req'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px'  style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;  <input type="text" class="border" name="boarding" readonly><?php if((isset($data['boarding_all_req'])) && ($data['boarding_all_req'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>  
                      </p>
          						<p>
          							If the student applicant is boarding and would they like to be sharing a room with a friend or relative of a similar age and same gender, please add the students name&nbsp;&nbsp;<u><?php echo $data['boarding_student_name'];?></u>&nbsp;&nbsp;Gender&nbsp;&nbsp;<u><?php echo $data['boarding_gender'];?></u>&nbsp;&nbsp; Age&nbsp;&nbsp;<u><?php echo $data['boarding_student_age'];?></u>&nbsp;&nbsp;

          						</p>          						

          						</div>

          						<div class="row">
          							<label><b>LANGUAGE ASSESSMENT</b></label>
          						<p>
          							Applicant’s most proficient language: &nbsp;&nbsp;<u><?php echo $data['proficient_language'];?></u>&nbsp;&nbsp;Primary language at home: &nbsp;&nbsp;<u><?php echo $data['primary_language_at_home'];?></u>&nbsp;&nbsp;
          						</p>
          						<p>
          									
          							Parent’s assessment of applicant’s ability in English (please tick):
          						</p>
          						<p>
          							<font style="font-size: 14px; margin-left: 5%; " > <i>*Please be aware that this is a camp specifically directed toward students with little, beginner, and intermediate English ability*</i></font>
	          					</p>
          						<p>
          							<input type="text" class="border" name="boarding" readonly><?php if((isset($data['is_reading'])) && ($data['is_reading'] == 'Reading')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;
                        Reading
                        <font style=" margin-left: 20px;">
                        &nbsp;&nbsp;Sufficient
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['reading_value'])) && ($data['reading_value'] == 'Sufficient')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;</font> 
                        <font style=" margin-left: 19px;">
                        &nbsp;&nbsp;Intermediate
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['reading_value'])) && ($data['reading_value'] == 'Intermediate')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;
                      </font>  
                        <font style=" margin-left: 20px;">
                        &nbsp;&nbsp;Beginner 
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['reading_value'])) && ($data['reading_value'] == 'Beginner')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;
                      </font>
                        <font style=" margin-left: 21px;">
                          None
                          <input type="text" class="border" name="boarding" readonly><?php if((isset($data['reading_value'])) && ($data['reading_value'] == 'None')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;
                      </font>
          						</p>
          						<p>
          						   <input type="text" class="border" name="boarding" readonly><?php if((isset($data['is_speaking'])) && ($data['is_speaking'] == 'Speaking')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;
                          Speaking
                         <font style=" margin-left: 21px;">
                          Sufficient
                          <input type="text" class="border" name="boarding" readonly><?php if((isset($data['speaking_value'])) && ($data['speaking_value'] == 'Sufficient')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;
                        </font>

                          <font style=" margin-left: 18px;">
                            &nbsp;&nbsp;Intermediate
                            <input type="text" class="border" name="boarding" readonly><?php if((isset($data['speaking_value'])) && ($data['speaking_value'] == 'Intermediate')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;</font> 
                          <font style=" margin-left: 20px;">
                            &nbsp;&nbsp;Beginner
                          <input type="text" class="border" name="boarding" readonly><?php if((isset($data['speaking_value'])) && ($data['speaking_value'] == 'Beginner')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        </font>
                         <font style=" margin-left: 18px;">
                          &nbsp;&nbsp; None
                          <input type="text" class="border" name="boarding" readonly><?php if((isset($data['speaking_value'])) && ($data['speaking_value'] == 'None')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        </font>
          						</p>
          						<p>
          						   <input type="text" class="border" name="boarding" readonly><?php if((isset($data['is_writing'])) && ($data['is_writing'] == 'Writing')){ echo "<img src='../assets/images/check.png' width='13px' height='13px  style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;
                       Writing
                       <font style=" margin-left: 26px;">&nbsp;&nbsp;Sufficient
                         <input type="text" class="border" name="boarding" readonly><?php if((isset($data['writing_value'])) && ($data['writing_value'] == 'Sufficient')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;</font> 
                         <font style=" margin-left: 18px;">
                          &nbsp;&nbsp;Intermediate
                          <input type="text" class="border" name="boarding" readonly><?php if((isset($data['writing_value'])) && ($data['writing_value'] == 'Intermediate')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;</font> 
                           <font style=" margin-left: 20px;">
                            &nbsp;&nbsp;Beginner
                          <input type="text" class="border" name="boarding" readonly><?php if((isset($data['writing_value'])) && ($data['writing_value'] == 'Beginner')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        </font>
                         <font style=" margin-left: 20px;">
                          &nbsp;&nbsp; None
                          <input type="text" class="border" name="boarding" readonly><?php if((isset($data['writing_value'])) && ($data['writing_value'] == 'None')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;</font>
          						</p>
          						</div>
          						<br>
          							<label><b>SUPPORT SERVICES</b></label>
          						<p>
          							Are there any behavioral or learning support needs that we should be aware of? &nbsp;&nbsp;yes&nbsp;&nbsp;<input type="text" class="border" name="boarding" readonly><?php if((isset($data['support'])) && ($data['support'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;No&nbsp;&nbsp;<input type="text" class="border" name="boarding" readonly><?php if((isset($data['support'])) && ($data['support'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;
          						</p>
          						<p>
          							If Yes, please list the support needed.
          						</p>

          						<p>
                        &nbsp;&nbsp;<u><?php echo $data['support_address'];?></u>
          						</p>
          							
                        <label><b>TRANSPORTATION PLAN</b></label>

          						<p>
          							Will the applicant and their family require transport to and from Senai or Changi Airport, before and after the camp?<br>
                        Senai
                        <input type="text" class="border" name="boarding" readonly>
          							<?php if((isset($data['transportation'])) && ($data['transportation'] == 'Senai')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -20px;'>"; }?> <font style=" margin-left: 100px;">
                          Changi
                        <input type="text" class="border" name="boarding" readonly>
                        <?php if((isset($data['transportation'])) && ($data['transportation'] == 'Changi')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -20px;'>"; }?></font> <font style=" margin-left: 100px;">
                          No transport needed
                          <input type="text" class="border" name="boarding" readonly>
                          <?php if((isset($data['transportation'])) && ($data['transportation'] == 'No transport needed')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -20px;'>"; }?></font>
          						</p>
          						<p>
          							<font style="font-size: 12px;
    								"> *If yes, please provide the relevant transport details to your agent or representative 4 weeks prior to the camp 1 start date. Failure to submit these documents on time will not guarantee the possibility of an airport pickup/drop-off. Please note that transport times may vary depending on availability.</font>
          						</p>
          						<p>
          							<font style="font-size: 12px;
    								">*Airport transfers from Changi are charged at an additional fee.</font>
          						</p>
          						<p>
          							<b>TRANSPORTATION PLAN FOR DAY STUDENTS</b>
          						</p>
          						<p>
          							Would you like to request transportation for your day student applicant? 
                       &nbsp;&nbsp;yes&nbsp;&nbsp;<input type="text" class="border" name="boarding" readonly><?php if((isset($data['transport_student'])) && ($data['transport_student'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;No&nbsp;&nbsp;<input type="text" class="border" name="boarding" readonly><?php if((isset($data['transport_student'])) && ($data['transport_student'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;&nbsp;	
          						</p>
          						<p>
          							Day student applicants requiring a daily pick up service, please tick one of the following pickup locations.	
          						</p>
          						<p>
          						  Danga Bay (Starbucks)
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['student_pickup'])) && ($data['student_pickup'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?></font><font style=" margin-left: 40px;">
                        Teega A (lobby)
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['student_pickup'])) && ($data['student_pickup'] == '2')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?></font><font style=" margin-left: 40px;"> 
                        Teega B (lobby)
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['student_pickup'])) && ($data['student_pickup'] == '3')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?></font>
                      </p>
                      <p>
                        
                        Teega Suites (lobby)
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['student_pickup'])) && ($data['student_pickup'] == '4')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        <font style=" margin-left: 50px;">
                        Mall of medini(lobby)
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['student_pickup'])) && ($data['student_pickup'] == '5')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?></font>
          						</p> 		
          						
          						<p>
          							<font style="font-size: 11px;" > *Please contact your agent or representative for pickup times.</font>
          						</p>
                      <br>
          							<label><b>PARENTAL DISCLOSURE</b></label>

          						<p align="justify">
          							I attest that the information provided above is accurate and complete, and understand that failure to fully disclose any and all of the above information may result in delayed / nullified acceptance of my child.
          						</p>
                      <br>
          						<p>
          							<b>ACKNOWLEDGMENT</b>
          						</p>
          							
          						<p align="justify">
                       
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['acknowledgement1'])) && ($data['acknowledgement1'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?> I have read, understood and agreed to the Activity/Trip/Camp Consent Form as annexed together with this Application Form and the Brochure/Information of the Camp as annexed in Annexure A. This Application Form, the said Activity/Trip/Camp Consent Form and the said Brochure/Information of the Camp shall be taken together as constituting the entire contract between the parent(s) and the school.
          						</p>
          						<p>
                      
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['acknowledgement2'])) && ($data['acknowledgement2'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>&nbsp;
          							I undertake and agree to pay the fee (amount invoiced by the school) on or before the time-lines provided by the school. I understand that all payments are non-refundable.
          						</p>
          						<p>
          							Parent Signature: ______________________________________ Date:&nbsp;&nbsp;<u><?php echo $data['ack_date1'];?></u>&nbsp;&nbsp; 
          						</p>
          						<p>
          							Parent Signature: ______________________________________ Date:&nbsp;&nbsp;<u><?php echo $data['ack_date2'];?></u>&nbsp;&nbsp;
          						</p>
          						<p>
          							<b>*All information provided to Raffles American School is kept confidential as per the school policy.</b>
          						</p>

          					</div>
          					
          				</div>
          			</div>          						
          					<div class="row">
          				    <div class="formdiv col-md-12">
          					<div class="col-md-12 student_health">
          							<label><h4><b>STUDENT HEALTH RECORD– parent provided health questionnaire</b></h4></label>
          						<p>
          							<b>Please complete your child’s health record as accurately as possible.</b>
          						</p>
          						<p>
          							Does your child have any present illnesses?
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['illnesses'])) && ($data['illnesses'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['illnesses'])) && ($data['illnesses'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>
          						<p>
          							If yes, please provide details:
          						</p>
          						<p>
          							&nbsp;&nbsp;<u><?php echo $data['illnesses_details'];?></u>&nbsp;&nbsp;
          						</p>
          						
          							
          						<p>
          						  	Does your child suffer from any allergies?
                          &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['allergies'])) && ($data['allergies'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['allergies'])) && ($data['allergies'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>
          						<p>
          							If yes please provide details of cause, effect, and whether your child takes any medication for it.
          						</p>
          						<p>
          							&nbsp;&nbsp;<u><?php echo $data['allergies_details'];?></u>&nbsp;&nbsp;
          						</p>
          						
          						<p>
          							Does your child experience any learning difficulties or mental impairments that we need to be aware of in order to cater for the needs of your child?  
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['mental_impairments'])) && ($data['mental_impairments'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['mental_impairments'])) && ($data['mental_impairments'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>
          						<p>
          							(If yes) Please specify:
          						</p>
          						<p>
          							&nbsp;&nbsp;<u><?php echo $data['mental_impairments_details'];?></u>&nbsp;&nbsp;
          						</p>          						
          						
          						<p>
          									
          							Has your child slept away from home for more than a week before?
                         &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['slept_away'])) && ($data['slept_away'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['slept_away'])) && ($data['slept_away'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>
          						
          						<p>
          							If your child has not slept away from home before, we strongly suggest they do so before the beginning of camp, as, for some young students, being away from home for extended periods can be quite traumatic.
          						</p>

          						<p>
          							Does your child have a history of asthma? 
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['asthma'])) && ($data['asthma'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['asthma'])) && ($data['asthma'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>

          						<p>
          							Does he / she carry an asthma inhaler? 
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['inhaler'])) && ($data['inhaler'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['inhaler'])) && ($data['inhaler'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>
                      <p>
                        Does your child wear glasses or contact lenses?
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['lenses'])) && ($data['lenses'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['lenses'])) && ($data['lenses'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?> 
                      </p>
          						<p>
          							Does your child have trouble hearing or use a hearing aid?
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['hearing'])) && ($data['hearing'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['hearing'])) && ($data['hearing'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?> 
          						</p>

          						<p>
          							Is your child on daily medication?
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['daily_medication'])) && ($data['daily_medication'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['daily_medication'])) && ($data['daily_medication'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>

          						<p>	
          						Please list the name of the medications and the time / frequency required:&nbsp;&nbsp;<u><?php echo $data['medication_list'];?></u>&nbsp;&nbsp;
          						</p>
          						<p>
          						Is there any health condition or any limitations on your child’s physical activity that the school should be aware of?
          						</p>

          						<p>
          							&nbsp;&nbsp;<u><?php echo $data['health_condition_details'];?></u>&nbsp;&nbsp;
								</p>
          						
          						<p>
          							 
								</p>

          						<p>
          							Can your child swim? 
                        &nbsp;&nbsp;Yes&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['child_swim'])) && ($data['child_swim'] == '1')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
                        &nbsp;&nbsp;No&nbsp;&nbsp;
                        <input type="text" class="border" name="boarding" readonly><?php if((isset($data['child_swim'])) && ($data['child_swim'] == '0')){ echo "<img src='../assets/images/check.png' width='13px' height='13px' style = 'margin-left: -16px;'>"; }?>
          						</p>
          						
          						<p align="justify">
          							1. <input type="text" class="border" name="boarding" readonly><?php if((isset($data['attest_info'])) && ($data['attest_info'] == '1')){ echo "<img src='../assets/images/check.png' width='15px' height='13px' style = 'margin-left: -16px;'>"; }?> I attest that all the above information is accurate.
          						</p>
          						
          						<p align="justify">
          							2. <input type="text" class="border" name="boarding" readonly><?php if((isset($data['give_permission'])) && ($data['give_permission'] == '1')){ echo "<img src='../assets/images/check.png' width='15px' height='13px' style = 'margin-left: -16px;'>"; }?> I hereby give permission to the school to administer the following medications to my child if deemed necessary by the school nurse:		
          						</p>
          						
          						<p align="justify">
          							<b>Tylenol – Panadol – Ibuprofen – Aspirin – Antacid – Sudafed</b>
          						</p>

          						<p align="justify">
          							(Please cr oss out (x) any medication NOT to be given to your child)
          						</p>

          						<p align="justify">
          							3. <input type="text" class="border" name="boarding" readonly><?php if((isset($data['give_permission_emergency'])) && ($data['give_permission_emergency'] == '1')){ echo "<img src='../assets/images/check.png' width='15px' height='13px' style = 'margin-left: -16px;'>"; }?> I hereby give permission for emergency measures to be initiated in case of accident or sudden illness with the understanding that I will be notified.
          						</p>

          						<p align="justify">
          							4. <input type="text" class="border" name="boarding" readonly><?php if((isset($data['permission_medical_staff'])) && ($data['permission_medical_staff'] == '1')){ echo "<img src='../assets/images/check.png' width='15px' height='13px' style = 'margin-left: -16px;'>"; }?> I hereby give permission to the RAS Medical staff to administer medication that is prescribed to my child.
          						</p>

          						<!-- <p align="justify">
          							Parent Signature: ______________________________________ Date:&nbsp;&nbsp;<u><?php //echo $data['health_record_date'];?></u>&nbsp;&nbsp;

          						</p> -->
          							<h1 class="think1" style="text-align:center; margin-top: 13px;">
          								<font class="think" color="orange" size="100px;">
          								<i class="think">Think.</i> 
          								<b class="think">Create.</b> 
          								</font>
          								<font size="100px;"><i>Succeed.</i></font>
          							</h1>


          						</div>
          					</div>
          				</div>
          			    </div>
          						
          				<div class="row">
          				<div class="formdiv col-md-12">
          					<div class="col-md-12">                  
          						

          						<p>

          							To 
          							<font style="margin: 200px;"> : Raffles American School
          							</font>	
          						</p>
          						<br>
          						
          						<p>
          							Date 
          							<font style="margin: 185px;">
          							: &nbsp;&nbsp;<u><?php echo $data['date_head'];?></u>&nbsp;&nbsp;
          							</font>
          						</p>
          						<br>
          						

          						<p>
          							Camp Name <font style="margin: 140px;">:&nbsp;&nbsp;<u><?php echo $data['activity_camp'];?></u>&nbsp;&nbsp; </font>
          						</p>
          						<br>
          						
          						<p align="justify">
          							This letter is to give permission for my/our child to participate in the activity/trip/camp. I/We acknowledge that my/our child is expected to abide by RAS school rules and conform to RAS teachers/staff instructions at all times to ensure a safe activity/trip/camp both within and beyond the school vicinity.
          						</p>
          		
          						
          						<p align="justify">
          							1. I/We have read all of the information contained in this letter in relation to the activity/trip/camp (including any attached material). I/We hereby freely and voluntarily give consent for my/our child &nbsp;&nbsp;<u><?php echo $data['info_other_letter'];?></u>&nbsp;&nbsp;with passport number: &nbsp;&nbsp;<u><?php echo $data['info_other_date1'];?></u>&nbsp;&nbsp;, to participate in the Raffles American School Camp on &nbsp;&nbsp;<u><?php echo $data['info_other_date2'];?></u>&nbsp;&nbsp; (Date)

          						</p>
          					
          						
          						<p align="justify">
          							2. In the event of an accident or illness, I/we authorise RAS staff to obtain or administer any medical assistance or treatment that my/our child may reasonably require, including contacting my/our child’s doctor.
          						</p>
          				
          						
          						<p align="justify">
          							3. I/We accept liability for all reasonable costs incurred by RAS in obtaining such medical assistance or treatment (including any transportation costs) and undertake to reimburse RAS the full amount of those costs.
          						</p>
          						
          						
          						<p align="justify">
          							4. I/We have provided RAS all relevant details of my/our child’s medical or physical needs to RAS. I/We further declare and confirm that my/our child’s medical and physical condition is suitable to participate in the activity/trip/camp.
          						</p>
          					
          						
          						<p align="justify">
          							5. I/We further understand, acknowledge and agree that at any time RAS reserves the right to accept or decline participation to my/our child, if in the judgment of RAS my/our child is causing unreasonable disturbance or danger to himself/herself or any other  students, participants or RAS.

          						</p>
          						
          						
          						<p align="justify">
          							6. I/We give consent to RAS to store and process the Personal Data provided in this letter for the purpose as described in this letter and to disclose the Personal Data to the relevant governmental authorities or third parties where required by law or for legal purposes. For avoidance of doubt, Personal Data includes all data defined in the Personal Data Protection Act 2010 including all data I/We have disclosed to RAS in this letter.
          						</p>
          					
          						
          						<p align="justify">
          							7. I/We acknowledge and understand that while every reasonable and practical precaution and care will be taken by RAS, participation in the activity/trip/camp may carry with it certain risks which cannot be eliminated. These elements of risk also contribute to the sense of adventure and fun experienced by students which RAS considers as important to the social development of students.
          						</p>
          						
          						
          						<p align="justify">
          							8. I/We understand and acknowledge that RAS, its elected officials and officers, employees, agents, volunteers and representatives cannot accept responsibility for force majeure events over which it/they have no control, such as acts of God, strikes or government restrictions, and terrorist activities.
          						</p>

<!-- 
                      <p>
                        
                      </p>
                      <p class="ex1">
                      </p>
                      <p>
                      </p>
                      <style>
                        p.ex1 {
                          margin-bottom: 60px !important;
                        }
                      </style>
          						</div>
          						</div>
          						</div>
          						
          						<div class="row">
          				        <div class="formdiv col-md-12">
          					    <div class="col-md-12"> -->

          						<p align="justify">
          							9. I/We acknowledge and accept all of the inherent risks associated with my/our child’s participation in the activity/trip/camp and the possibility of personal injury, death, property damage or loss arising therefrom and agree to assume all the risks whether  foreseen or unforeseen and waive all and any of my/our rights, claims, demands or actions whatsoever that I/we may have now or in the future against RAS, its elected officials and officers, employees, agents, volunteers and/or representatives in connection with the activity/trip/camp.
          						</p>
          						
          						<p align="justify">
          							10. In consideration of my/our child being allowed to voluntarily participate in the activity/trip/camp with its inherent risks and hazards, I/we agree to hold harmless, release and indemnify against RAS, its directors, employees, agents, volunteers and/or representatives from and against any and all liabilities, claims, demands, causes of action, costs, expenses whatsoever in respect to injury, death, loss or damage to my/our child or any person or property directly or indirectly arising out of my/our child’s participation in the activity/trip/camp unless caused by proven negligence of RAS.
          						
          						</p>
          						
          						<p align="justify">
          							11. I/We shall also indemnify and keep indemnified at all times fully and effectively against RAS, its directors, employees, agents, volunteers and/or representatives any act, deed, matter or thing done or omitted by RAS pursuant to any directions or instructions given by me/us to RAS.
          						</p>
          							
          						<p align="justify">	
          							12. I/We acknowledge that due to safety and security reasons, my/our child is not permitted to change room allocations after final applications have been submitted (only applicable to boarding students).
          						</p>
          						
          						<p align="justify">
          							13. I/We understand and agree that RAS shall make the final decision for my/our child's placement in a class deemed suitable for both their age and English levels based on RAS testing procedures.
          						
          						</p>
          						
          						<p align="justify">
          							This letter including all clauses stated above shall be construed according to the laws of Malaysia. In the event of conflict between the English and Chinese language, the English version of this letter shall prevail.
          						</p>
          				<div class="row">	
				          	<div class="col-md-12">
				          		<div class="col-md-5"> 
				          			
					          	________________________________&nbsp;&nbsp;&nbsp;<u><?php echo $data['other_sign_student_date1'];?></u>&nbsp;&nbsp;
					          	<br>
          						Signature Of Student/ Participant &nbsp;&nbsp;&nbsp;&nbsp;Date
          						</div>
          						
				          		<div class="col-md-6">
				          		________________________________&nbsp;&nbsp;&nbsp;<u><?php echo $data['other_sign_student_date2'];?></u>&nbsp;&nbsp;
				          		<br>
          						Signature Of Parent or Guardian &nbsp;&nbsp;&nbsp;&nbsp;Date<br>
          						<font style=" margin-bottom: 0px; font-size: 11px;">
          							(needed if student/participant is a minor-under 18)
          						</font>

          						</div>
          					</div>
          				</div>
          				<br>
          						
          				<div class="row">	
				          	<div class="col-md-12">
				          		<div class="col-md-5"> 				          			
					          	
                      &nbsp;&nbsp;<u><?php echo $data['student_participant_name'];?></u>&nbsp;&nbsp;
          						<br>
                      Student/ Participant Name 
          						</div>
          						
				          		<div class="col-md-6">
				          		&nbsp;&nbsp;<u><?php echo $data['parent_guardian_name'];?></u>&nbsp;&nbsp;
				          		<br>
          						Parent/ Guardian Name 
          						</div>
          					</div>
          				</div>
          				<br>
          								
          				<div class="row">	
				          	<div class="col-md-12">
				          		<div class="col-md-5"> 
				          			
					          	_________________________________________
					          	<br>
          						Signature of witness Student/ Participant
          						</div>
          						
				          		<div class="col-md-6">
				          		__________________________________________
				          		<br>
          						Signature of witness for Parent/ Guardian
          						</div>
          					</div>
          				</div>
          					<br>
          				<div class="row">	
				          	<div class="col-md-12">
				          		 
				          			
					          	<!-- Emergency Contact Name:&nbsp;&nbsp;<u><?php //echo $data['emergency_contact_number'];?></u>&nbsp;&nbsp;Phone:&nbsp;&nbsp;<u><?php //echo $data['emergency_phone_number'];?></u>&nbsp;&nbsp;
					          	<br> -->
          						
          						
          						
				          		
          					</div>
          				</div>	
          						
          						<hr>
          						
          						<center>
          							<h3>
          								<u>
          									<b>
          										FOR OFFICE USE ONLY
          									</b>
          								</u>
          									
          							</h3>

          						</center>
          							<br>

          						
          						<p>

          							Please feel free to contact our Executive Coordinator, Ian Nenke at inenke@rafflesamericanschool.org if you have any questions or concerns.

          						</p>
          						
          						<p>
          							Acknowledged by,
          						</p>
          						
          						<p>
          							Name: &nbsp;&nbsp;<u><?php echo $data['office_name'];?></u>&nbsp;&nbsp;
          						
          						</p>
          						
          						<p>
          							Designation: &nbsp;&nbsp;<u><?php echo $data['office_designation'];?></u>&nbsp;&nbsp;
          						</p>
          						
          						<p>
          							Date: &nbsp;&nbsp;<u><?php echo $data['office_date'];?></u>&nbsp;&nbsp;
          						</p>
          							
          						
          					
          					
          					
          					
          					
          					


          					</div>
          					</div>
          					</div>
          								
          					<div class="row">
          						<div class="formdiv col-md-12">
          						<div class="col-md-12 appendix">
          							<center><h3><u><b>APPENDIX 1</b></u></h3></center>
                       
          							<label><b>RISKS:</b></label>                       
          						
          						<P>
          							Possible risks or injuries included in the activity/trip/camp may include but not limited to:
          						</P>
          						
          						<P>
          							(a) Risk of injury inherent in playing any type of sports or recreational activities;
          						</P>
          						
          						<P>
          							(b) Exposure to outdoors, nature, weather, Acts of God, sea life, insects/animal or plant life;

          						</P>
          						
          						<P>

          							(c) Inexperience or unfamiliarity with the activity or its requirements;

          						</P>

          							
          						<P>	
          							(d) Unfamiliarity with location or facility;
          						</P>
          						
          						<p>
          							(e) Faulty equipment/gear or inadequate instruction;
          						</p>
          						
          						<p>
          							(f) Complications or reaction from weather conditions or outside environment or nature;
          						</p>
          						
          						<p>
          							(g) Inadequate or unavailable healthcare facilities or assistance;
          						
          						</p>
          						
          						<p>
          							(h) Other accidents, loss of life, illnesses, allergic reactions (food, plants, insects etc), negligence and/or mistake.
          						</p>


          						

          							<label><b>PRECAUTIONS:</b></label>
          						<p>
          							Recommended precautions including but not limited to:
          						</p>
          						
          						<p> 
          							(a) Check local weather before departure and be familiar with the activities involved.

          						</p>
          						
          						<p>
          							(b) Bring appropriate clothing, footwear, supplies, protective gear (sports related, sunglasses, sunscreen, hat, etc) suitable for outdoor or recreational activities, standing/walking etc.
          						</p>
          						
          						<p>
          							(c) Avoid bringing valuables or keep them secure at all times. RAS shall not responsible for any lost or stolen items.
          						</p>
          						
          						<p>
          							(d) Advise RAS prior to any activity of any existing medical conditions or injury of the student.
          						</p>
          						
          						<p>
          							(e) Bring any necessary medications or emergency/medical kits (ie bee sting kits/epi-pen, inhalers, etc).
          						</p>

          						
          						
          					</div>
          				</div>
          		    </div>
          		</div>
          </section>
    </body>
    </html>
    <script>window.print();</script>