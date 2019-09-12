<?php
require_once 'phpmailer/PHPMailerAutoload.php';



function special_code($length) 
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
function random_password($length) 
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
function encrypt_password($password)
{
    $hash_cost_factor = 10;
    $e_pwd = password_hash($password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
    return $e_pwd;
}

function verify_password($current,$system)
{
    return password_verify($current, $system);
}



/*
 *  Mail Sending Code	
 */
function send_phpmail( $toname, $to ,$fromname, $from , $subject, $body )
{
    global $mailsetting;
    if(empty($from))
    {
        $from = $mailsetting['defaultfromemail'];
    }
    if(empty($fromname))
    {

        $fromname = $mailsetting['defaultfromname'];
    }
    if(empty($to))
    {
        $toname = $mailsetting['defaulttoname'];
        $to = $mailsetting['defaulttoemail'];
    }
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Host = $mailsetting['Host'];
    $mail->Port = $mailsetting['Port'];
    $mail->SMTPSecure = $mailsetting['SMTPSecure'];
    $mail->SMTPAuth = $mailsetting['SMTPAuth'];
    $mail->Username = $mailsetting['gmail_username'];
    $mail->Password = $mailsetting['gmail_password'];
    $mail->setFrom($from, $fromname);
    $mail->addReplyTo($from, $fromname);
    $mail->addAddress($to, $toname);
    if(!empty($mailsetting['defaultccemail'])){
        $mail->AddCC($mailsetting['defaultccemail'], $mailsetting['defaultccname']);
    }

    $mail->AddEmbeddedImage('../assets/images/logo.png', "logo_2u");
    $mail->Subject = $subject;
    $mail->IsHTML(true);
    $mail->Body    = $body;
    if (!$mail->send()) {
        echo $mail->ErrorInfo;die;
    } else {
		return true;
    }
	
}
//send_phpmail( '', '' ,'', '' , 'test rhis', 'yes' );


function DisplayDate($date){
    return date('d-m-Y',strtotime($date));
}



function check_permission(){
    if(isset($_SESSION['adminloggedin'])){
        return true;
    }
    else{
        return false;
    }
}





//Permission Pages 

$PerPages = array("dashboard_per"=>"Dashboard",
    "user_dashboard_per"=>"User Dashboard",
    "camp_management_per"=>"Camp Management",
    "student_application_per"=>"Student Application Management",
    "student_profile_per"=>"Student Profile",
    "student_attendance_per"=>"Student Attendance",
    "testing_result_per"=>"Testing Result",
    "class_assignment_per"=>"Class Assignment",
    "incident_report_per"=>"Incident Report",
    "communication_history_per"=>"Communication History",
    "student_idcard_per"=>"Student ID Card",
    "student_image_gallery_per"=>"Image Gallery",
    "camp_fee_per"=>"Camp Fee",
    "enrollment_status_per"=>"Enrollment Status",
    "student_report_per"=>"Student Report",
    "student_assesment_per"=>"Student Assesment",
    "student_online_testing_per"=>"Student Online Testing",
    "student_test_file_per"=> "Student Test File",
    "test_name" => "Test Name",
    "add_questions"=>"Add Question",
    "student_question"=>"Student Question",
    "academic_per"=>"Academic",
    "cca_per"=>"CCA(Sporting)",
    "creative_classes_per"=>"Creative Classes",
    "boarding_activity_per"=>"Boarding Activities",
    "teacher_resource_management_per"=>"Teacher/Resource Management",
    "equipment_materials_per"=>"Equipment Materials",
    "curriculum_per"=>"Curriculum",
    "class_schedules_per"=>"Class Schedules",
    "transport_route_per"=>"Transport Route",
    "transport_schedule_per"=>"Transport Schedule",
    "driver_assignment_per"=>"Driver Assignment",
    "transport_incident_report_per"=>"Incident Report",
    "audit_transport_per"=>"Audit of Transport",
    "notification_per"=>"Notification",
    "export_feature_per"=>"Export Feature",
    "camp_teacher_per"=>"Camp Teacher",
    "boarding_staff_per"=>"Boarding Staff",
    "class_room_per"=>"Class Room",
    "boarding_room_per"=>"Boarding Room",
    "school_staff_per"=>"School Staff",
    "equipment_materials_per"=>"Equipment/Materials Assignment",
    "transport_driver_per"=>"Transport Driver",
    "transport_vehicles_per"=>"Transport Vehicles",
    "agent_profile_data_per"=>"Profile Data",
    "linked_student_per"=>"Linked Student",
    "agent_commission_per"=>"Commission",
    "agent_camp_fee_per"=>"Camp Fee",
    "agent_communication_per"=>"Communication",
    "messaging_feature_per"=>"Messaging Feature",
    "image_gallery_per"=>"Image Gallery",
    "video_gallery_per"=>"Video Gallery",
    "camp_revenue_per"=>"Camp Revenue",
    "student_application_report_per"=>"Student Application",
    "class_assignments_report_per"=>"Class Assignmnets",
    "agent_revenue_per"=>"Agent Revenue",
    "camp_student_conversion_per"=>"Camp Student Conversion",
    "boarding_assignment_report_per"=>"Boarding Assignmnets",
    "transport_assignments_report_per"=>"Transport Assignments",
    "class_attendance_report_per"=>"Class Attendance",
    "academic_schedule_per"=>"Academic Schedule",
    "cca_schedule_per"=>"CCA Schedule",
    "creative_classes_schedule_per"=>"Creative Classes Schedule",
    "boarding_activities_per"=>"Boarding Activities Schedule",
    "teacher_report_per"=>"Teachers",
    "camp_admin_report_per"=>"Camp Admin",
    "boarding_staff_report_per"=>"Boarding Staff",
    "user_per"=>"User",
    "user_role"=>"User Role",
    "userlist_per"=>"UserList"
);


$dashboard_per = array("dashboard_view");
$user_dashboard_per = array("user_dashboard_view");
$camp_management_per = array("camp_management_view","camp_management_add","camp_management_edit","camp_management_delete");
$student_application_per = array("student_application_view","student_application_add","student_application_edit","student_application_delete");
$student_profile_per = array("student_profile_view","student_profile_add","student_profile_edit","student_profile_delete");
$student_attendance_per = array("student_attendance_view","student_attendance_add","student_attendance_edit","student_attendance_delete");
$testing_result_per = array("testing_result_view","testing_result_add","testing_result_edit","testing_result_delete");
$class_assignment_per = array("class_assignment_view","class_assignment_add","class_assignment_edit","class_assignment_delete");
$incident_report_per = array("incident_report_view","incident_report_add","incident_report_edit","incident_report_delete");
$communication_history_per = array("communication_history_view","communication_history_add","communication_history_edit","communication_history_delete");
$student_idcard_per = array("student_idcard_view","student_idcard_add","student_idcard_edit","student_idcard_delete");
$student_image_gallery_per = array("student_image_gallery_view","student_image_gallery_add","student_image_gallery_edit","student_image_gallery_delete");
$camp_fee_per = array("camp_fee_view","camp_fee_add","camp_fee_edit","camp_fee_delete");
$enrollment_status_per = array("enrollment_status_view","enrollment_status_add","enrollment_status_edit","enrollment_status_delete");
$student_report_per = array("student_report_view","student_report_add","student_report_edit","student_report_delete");
$student_assesment_per = array("student_assesment_view","student_assesment_add","student_assesment_edit","student_assesment_delete");
$student_online_testing_per = array("student_online_testing_view","student_online_testing_add","student_online_testing_edit","student_online_testing_delete");
$student_test_file_per = array("student_test_file_view","student_test_file_add","student_test_file_edit","student_test_file_delete");
$test_name = array("test_name_view","test_name_add","test_name_edit","test_name_delete");
$add_questions = array("add_questions_view","add_questions_add","add_questions_edit","add_questions_delete");
$student_question = array("student_question_view","student_question_add","student_question_edit","student_question_delete");
$academic_per = array("academic_view","academic_add","academic_edit","academic_delete");
$cca_per = array("cca_view","cca_add","cca_edit","cca_delete");
$creative_classes_per = array("creative_classes_view","creative_classes_add","creative_classes_edit","creative_classes_delete");
$boarding_activity_per = array("boarding_activity_view","boarding_activity_add","boarding_activity_edit","boarding_activity_delete");
$teacher_resource_management_per = array("teacher_resource_management_view","teacher_resource_management_add","teacher_resource_management_edit","teacher_resource_management_delete");
$equipment_materials_per = array("equipment_materials_view","equipment_materials_add","equipment_materials_edit","equipment_materials_delete");
$curriculum_per = array("curriculum_view","curriculum_add","curriculum_edit","curriculum_delete");
$class_schedules_per = array("class_schedules_view","class_schedules_add","class_schedules_edit","class_schedules_delete");
$transport_route_per = array("transport_route_view","transport_route_add","transport_route_edit","transport_route_delete");
$transport_schedule_per = array("transport_schedule_view","transport_schedule_add","transport_schedule_edit","transport_schedule_delete");
$driver_assignment_per = array("driver_assignment_view","driver_assignment_add","driver_assignment_edit","driver_assignment_delete");
$transport_incident_report_per = array("transport_incident_report_view","transport_incident_report_add","transport_incident_report_edit","transport_incident_report_delete");
$audit_transport_per = array("audit_transport_view","audit_transport_add","audit_transport_edit","audit_transport_delete");
$notification_per = array("notification_view","notification_add","notification_edit","notification_delete");
$export_feature_per = array("export_feature_view","export_feature_add","export_feature_edit","export_feature_delete");
$camp_teacher_per = array("camp_teacher_view","camp_teacher_add","camp_teacher_edit","camp_teacher_delete");
$boarding_staff_per = array("boarding_staff_view","boarding_staff_add","boarding_staff_edit","boarding_staff_delete");
$class_room_per = array("class_room_view","class_room_add","class_room_edit","class_room_delete");
$boarding_room_per = array("boarding_room_view","boarding_room_add","boarding_room_edit","boarding_room_delete");
$school_staff_per = array("school_staff_view","school_staff_add","school_staff_edit","school_staff_delete");
$equipment_materials_per = array("equipment_materials_view","equipment_materials_add","equipment_materials_edit","equipment_materials_delete");
$transport_driver_per = array("transport_driver_view","transport_driver_add","transport_driver_edit","transport_driver_delete");
$transport_vehicles_per = array("transport_vehicles_view","transport_vehicles_add","transport_vehicles_edit","transport_vehicles_delete");
$agent_profile_data_per = array("agent_profile_data_view","agent_profile_data_add","agent_profile_data_edit","agent_profile_data_delete");
$linked_student_per = array("linked_student_view","linked_student_add","linked_student_edit","linked_student_delete");
$agent_commission_per = array("agent_commission_view","agent_commission_add","agent_commission_edit","agent_commission_delete");
$agent_camp_fee_per = array("agent_camp_fee_view","agent_camp_fee_add","agent_camp_fee_edit","agent_camp_fee_delete");
$agent_communication_per = array("agent_communication_view","agent_communication_add","agent_communication_edit","agent_communication_delete");
$messaging_feature_per = array("messaging_feature_view","messaging_feature_add","messaging_feature_edit","messaging_feature_delete");
$image_gallery_per = array("image_gallery_view","image_gallery_add","image_gallery_edit","image_gallery_delete");
$video_gallery_per = array("video_gallery_view","video_gallery_add","video_gallery_edit","video_gallery_delete");
$camp_revenue_per = array("camp_revenue_view","camp_revenue_add","camp_revenue_edit","camp_revenue_delete");
$student_application_report_per = array("student_application_report_view","student_application_report_add","student_application_report_edit","student_application_report_delete");
$class_assignments_report_per = array("class_assignments_report_view","class_assignments_report_add","class_assignments_report_edit","class_assignments_report_delete");
$agent_revenue_per = array("agent_revenue_view","agent_revenue_add","agent_revenue_edit","agent_revenue_delete");
$camp_student_conversion_per = array("camp_student_conversion_view","camp_student_conversion_add","camp_student_conversion_edit","camp_student_conversion_delete");
$boarding_assignment_report_per = array("boarding_assignment_report_view","boarding_assignment_report_add","boarding_assignment_report_edit","boarding_assignment_report_delete");
$transport_assignments_report_per = array("transport_assignments_report_view","transport_assignments_report_add","transport_assignments_report_edit","transport_assignments_report_delete");
$class_attendance_report_per = array("class_attendance_report_view","class_attendance_report_add","class_attendance_report_edit","class_attendance_report_delete");
$academic_schedule_per = array("academic_schedule_view","academic_schedule_add","academic_schedule_edit","academic_schedule_delete");
$cca_schedule_per = array("cca_schedule_view","cca_schedule_add","cca_schedule_edit","cca_schedule_delete");
$creative_classes_schedule_per = array("creative_classes_schedule_view","creative_classes_schedule_add","creative_classes_schedule_edit","creative_classes_schedule_delete");
$boarding_activities_per = array("boarding_activities_view","boarding_activities_add","boarding_activities_edit","boarding_activities_delete");
$teacher_report_per = array("teacher_report_view","teacher_report_add","teacher_report_edit","teacher_report_delete");
$camp_admin_report_per = array("camp_admin_report_view","camp_admin_report_add","camp_admin_report_edit","camp_admin_report_delete");
$boarding_staff_report_per = array("boarding_staff_report_view","boarding_staff_report_add","boarding_staff_report_edit","boarding_staff_report_delete");

$user_per = array("user_view","user_add","user_edit","user_delete");
$user_role = array("user_role_view","user_role_add","user_role_edit","user_role_delete");

$userlist_per = array("userlist_view","userlist_add","userlist_edit","userlist_delete");



function permission_access($db,$admin_id,$access)
{
    $q4 = mysqli_query($db, "select * from permission_access where permission_id = '$admin_id'");
    if(mysqli_num_rows($q4)>0)
    {
        $r4 = mysqli_fetch_assoc($q4);
        $permit = json_decode($r4['permission']);
        if(isset($permit->$access))
        {
            return $permit->$access;
        }
        else
        {
            return 0;
        }
    }
    else
    {
        return 0;
    }
}









?>