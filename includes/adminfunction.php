<?php
session_start();
//Include database
include '../db_config.php';

//memeber login
if(isset($_POST["type"]) && $_POST["type"]== 'AddNewlogin1')
{
  // echo "hello";
  $success = false;
  $msg = "";
  $url="";
  extract($_POST);

   $q = mysqli_query($db,"select * from admin where email  = '$email' AND password='$password'");
   $count= mysqli_num_rows($q);
 
 
  if($count ==1)
  { $row= mysqli_fetch_assoc($q);
   $_SESSION['adminloggedin']  = $row['id'];
    //$_SESSION['adminname'] = $row['name'];
    $_SESSION['adminusername'] = $row['email'];
    $_SESSION['ausername'] = $row['user_name'];
    $_SESSION['admin_per_id'] = 1;
    echo json_encode(array(
        "valid"=>1,
        "msg" => "Logged in successfully"
    ));
  }
  
 
 else if($count ==0) {
     $q1 = mysqli_query($db,"select * from users where username = '$email'");
     
     $count1= mysqli_num_rows($q1);
     if($count1 ==1)
          {
            $row1 = mysqli_fetch_assoc($q1);
            if (verify_password($password, $row1['password']))
            {
                
                $_SESSION['userLoggedin'] = $row1['uid'];
                $_SESSION['userName'] = $row1['first_name'];
                $_SESSION['userEmail'] = $row1['email'];
                $_SESSION['userUsername'] = $row1['username'];
                $_SESSION['user_per_id'] = $row1['permission_id'];
                //echo $_SESSION['userLoggedin'];
                echo json_encode(array(
                    "valid"=>1,
                    "msg" => "Logged in successfully"
                ));
            }
            else
            {
                echo json_encode(array(
                    "valid"=>0,
                    "msg" => "Incorrect credentials"
                ));
            }
          }
       else{
            echo json_encode(array(
                "valid"=>0,
                "msg" => "Invalid email address or password !"
            ));
        }   
     
 }
 else
  {
    echo json_encode(array(
        "valid"=>0,
        "msg" => "No Such Record Found !"
    ));
  }
}


if(isset($_POST["type"]) && $_POST["type"]== 'AddUser')
{
    $success = false;
    $msg = "";
    $url="";
    //print_r($_POST);
    extract($_POST);    
    $id=$txtid; 
    $date=date('Y-m-d H:i:s');    
    if($id=='')
    {   
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if($password != $confirm_password) {
            $msg = "Password and Confirm password are not same.";
        } else  {
            $userc=mysqli_num_rows(mysqli_query($db,"select uid from users where username='$email'"));
            $emailc=mysqli_num_rows(mysqli_query($db,"select uid from users where email='$email'"));

            if($emailc>0){
                $msg = "Email-id is already register";
            }
             else if($userc>0)
            {
                $msg = "Username is already taken";
            } /* else if (preg_match('/[^a-z_\-0-9]/i', $username)) {
                $msg = "Username should contain only character,number or underscore";
            } */
            else
            {
                //$password = random_password(8);
                $permission_id = 3;
                $e_password = encrypt_password($password);
                $qry="INSERT INTO `users`(`permission_id`, `first_name`, `last_name`, `email`, `username`,`password`, `created`) VALUES ('$permission_id','$first_name','$last_name','$email','$email','$e_password','$date')";
                $q1=mysqli_query($db,$qry);
                if($q1) 
                {
                   $loginurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";           
                    $loginurl = str_replace("includes/adminfunction.php",'admin',$loginurl);
                    $to = $email;
                    $from = "";
                    $subject = "$webtitle - Account Has Been Created";
                    $body="
                        <b style='text-transform:capitalize;'>Dear $first_name $last_name, </b>
                        <br>
                        <p> Your Account Has Been Created .</p>
                        <p> Username : $email</p>
                        <p> Password : $password </p>
                        <p> Please <a href='$loginurl'> click here to login </a></p>
                        <br>
                        <p>Thank You</p>
                        <img alt=\"$webname\" border=\"0\" width=\"250\" style=\"display:block\"  src=\"cid:logo_2u\"><br>
                    ";
                    
                    send_phpmail( $first_name." ".$last_name, $to ,"", "" , $subject, $body  );
                    $success = true;                
                    $msg= "$email Register successfully";
                }
                else{
                    $msg= "Some Promlem Occur try after sometime";
                }   
            }
        }
        

        
                
    }
    else
    {   
        $qry="UPDATE `users` SET `permission_id`='$permission_id', `first_name`='$first_name', `last_name`='$last_name', `username`='$email' WHERE `uid`=$id";
        $q1=mysqli_query($db,$qry);
        //echo $qry;
        if($q1)
        {           
            $success = true;
            $msg = "User Detail updated Successfully";
        }
        else{
             $msg= "Some Promlem Occur try after sometime";
        }
        
    }
            
    echo json_encode(array(
        'valid'=>$success,
        'url'=>$url,
        'msg'=>$msg
    ));
}

/****************************************************
********** Delete User ****************
****************************************************/
if(isset($_POST["type"]) && $_POST["type"] == "DeleteUser")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM users WHERE uid = '$id'");
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "User Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


//permission UserType

if(isset($_POST['type']) && $_POST['type'] == 'AddUserType'){
    extract($_POST);
    $success = false;
    $message     = "";
    $id      = $hiddenid;
    $date    = date('Y-m-d H:i:s');

    if(isset($_POST['permission'])){
        $permission = mysqli_escape_string($db, json_encode($_POST['permission'],JSON_UNESCAPED_UNICODE));
    }else{
        $message = "Please select atleast one permission.";
    }
    if($id == '')
    {
        if (isset($permission)){
            $sql1 = "INSERT INTO `permission_access`(`user_type`, `permission`, `last_update`) VALUES ('$user_type','$permission',now())";
            $q1 = $db->query($sql1);
            if($q1)
            {
                $success = true;
                $message = "$user_type Register successfully";
            }
            else{
                $message= "Some Problem Occur try after sometime";
            }
        }
    }else{
        if(isset($permission))
        {
            //echo "UPDATE `permission_access` SET `user_type`='$user_type',`permission`= '$permission',`last_update`= now() WHERE `permission_id` ='$id'";
            $sql1= "UPDATE `permission_access` SET `user_type`='$user_type',`permission`= '$permission',`last_update`= now() WHERE `permission_id` ='$id'";
            $q1 = $db->query($sql1);
            if($q1)
            {
                $success = true;
                $message = "$user_type updated Successfully";
            }
            else{
                $message= "Some Problem Occur try after sometime";
            }
        }
    }
    echo json_encode(array(
        'success'=>$success,
        'message'=>$message
    ));
}


//regiter memeber

if(isset($_POST["type"]) && $_POST["type"]== 'AddNewform1')
{
  // echo "hello";
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);

    if($f_pwd == $password)
   {
  
   $q = mysqli_query($db,"select * from admin where user_name  = '$username' AND email='$email'");

    // echo "select * from user where user_name  = '$username' AND email='$email'";
     $count= mysqli_num_rows($q);
      if($count == 0)
    {
       
        $q1 = mysqli_query($db,"INSERT INTO `admin`(`first_name`, `last_name`, `user_name`, `email`, `password`,`gender`) VALUES ('$first_name','$last_name','$username','$email','$f_pwd','$gender')");
        
      //echo "INSERT INTO `user`(`first_name`, `last_name`, `user_name`, `email`, `password`,`gender`) VALUES ('$first_name','$last_name','$username','$email','$f_pwd','$gender')";
   
        if($q1)
        {
            $success = true;
            $msg= "Register successfully";
        }
        
    }

  
        else{
            $msg= "User Name And Email Id already exists";
        }

        }
   

   else
    {
       $msg= "Password doed not match"; 
    }



    
echo json_encode(array(
        'valid'=>$success,
        'url'=>$url,
        'msg'=>$msg
    ));
} 








/********************* Add Student Application *********************/



if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentApplication')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $applicaton_id = $_POST['applicationid'];
    //$camp_management_id = implode(',',$camp_management_id);

    if(!isset($_POST['allergies'])){
        $_POST['allergies'] = 'No';
    }
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
    $stm_update = "";

    if(!isset($_POST['boarding_req'])){
        $_POST['boarding_req'] = 0;
    }
    if(!isset($_POST['boarding_allocation_req'])){
        $_POST['boarding_allocation_req'] = 0;
    }
    if(!isset($_POST['siblings'])){
        $_POST['siblings'] = 0;
    }
    if(!isset($_POST['support'])){
        $_POST['support'] = 0;
    }
    if(!isset($_POST['transport_student'])){
        $_POST['transport_student'] = 0;
    }
    if(!isset($_POST['illnesses'])){
        $_POST['illnesses'] = 0;
    }
    if(!isset($_POST['allergies'])){
        $_POST['allergies'] = 0;
    }
    if(!isset($_POST['mental_impairments'])){
        $_POST['mental_impairments'] = 0;
    }
    if(!isset($_POST['slept_away'])){
        $_POST['slept_away'] = 0;
    }
    if(!isset($_POST['asthma'])){
        $_POST['asthma'] = 0;
    }
    if(!isset($_POST['inhaler'])){
        $_POST['inhaler'] = 0;
    }
    if(!isset($_POST['hearing'])){
        $_POST['hearing'] = 0;
    }
    if(!isset($_POST['daily_medication'])){
        $_POST['daily_medication'] = 0;
    }
    if(!isset($_POST['child_swim'])){
        $_POST['child_swim'] = 0;
    }
    if(!isset($_POST['lenses'])){
        $_POST['lenses'] = 0;
    }
   if(isset($_POST['dob']) && !empty($_POST['dob'])){
        $_POST['dob'] = date('Y-m-d',strtotime($_POST['dob']));
    }
    else{
        $_POST['dob'] = 'NULL';
    }
    if(isset($_POST['ack_date1']) && !empty($_POST['ack_date1'])){
        $_POST['ack_date1'] = date('Y-m-d',strtotime($_POST['ack_date1']));
    }
    else{
        $_POST['ack_date1'] = 'NULL';
    }
    if(isset($_POST['ack_date2']) && !empty($_POST['ack_date2'])){
        $_POST['ack_date2'] = date('Y-m-d',strtotime($_POST['ack_date2']));
        
    }
    else{
        $_POST['ack_date2'] = 'NULL';
    }
    if(isset($_POST['date_head']) && !empty($_POST['date_head'])){
        $_POST['date_head'] = date('Y-m-d',strtotime($_POST['date_head']));
        
    }
    else{
        $_POST['date_head'] = 'NULL';
    }
    if(isset($_POST['info_other_date1']) && !empty($_POST['info_other_date1'])){
        $_POST['info_other_date1'] = date('Y-m-d',strtotime($_POST['info_other_date1']));
        
    }
    else{
        $_POST['info_other_date1'] = 'NULL';
    }
    /*if(isset($_POST['info_other_date2'])){
        $_POST['info_other_date2'] = date('Y-m-d',strtotime($_POST['info_other_date2']));
        
    }
    else{
        $_POST['info_other_date2'] = 'NULL';
    }*/
    if(isset($_POST['other_sign_student_date1']) && !empty($_POST['other_sign_student_date1'])){
        $_POST['other_sign_student_date1'] = date('Y-m-d',strtotime($_POST['other_sign_student_date1']));
    }
    else{
        $_POST['other_sign_student_date1'] = 'NULL';
    }
    if(isset($_POST['other_sign_student_date2']) && !empty($_POST['other_sign_student_date2'])){
        $_POST['other_sign_student_date2'] = date('Y-m-d',strtotime($_POST['other_sign_student_date2']));
    }
    else{
        $_POST['other_sign_student_date2'] = 'NULL';
    }
    if(isset($_POST['office_date']) && !empty($_POST['office_date'])){
        $_POST['office_date'] = date('Y-m-d',strtotime($_POST['office_date']));
    }
    else{
        $_POST['office_date'] = 'NULL';
    }
    
    foreach ($_POST as $key=>$val){
        if($key != 'applicationid'){
            if(is_array($val)){
                $val = implode(',', $_POST[$key]);
                unset($_POST[$key]);
            }
            else{
                $val = mysqli_real_escape_string($db,$val); 
            }
            if($val == 'NULL'){
                $stm_update.="".$key."=NULL,";
            }else{
                $stm_update.="".$key."='$val',";
            }
        }
    }
    // echo $stm_update;die;
    $stm_update=substr($stm_update, 0, -1);

    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";
    $filename1="";
    $uploadOk1 = 1;
    $fileListimg1="";
    $filename2="";
    $uploadOk2 = 1;
    $fileListimg2="";
    $filename4="";
    $uploadOk4 = 1;
    $fileListimg4="";



    if (isset($_FILES["passport_copy"]))
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["passport_copy"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["passport_copy"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG","pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=uniqid().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["passport_copy"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",passport_copy='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",passport_copy='$filename'";
    }



    if (isset($_FILES["travel_insurance"]))
    {
        $target_dir1 = "../uploads/";
        // $path = "upload/product/";
        $target_file1 = $target_dir1 . basename($_FILES["travel_insurance"]["name"]);
        $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
        if ($_FILES["travel_insurance"]["size"] > 52428800) {
            $msg1=  "Sorry, your file is too large.";
            $uploadOk1 = 0;
        }
        $extallowed1 = array("jpg","jpeg","png","JPG","JPEG","PNG","pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType1),$extallowed1)){
            $msg1 = "Sorry,For jpg & png extension files are allowed";
            $status1 = false;
            $uploadOk1 = 0;
        }

        $filename1=uniqid().'.'.$imageFileType1;
        $filepath1=$target_dir1.$filename1;
        if ($uploadOk1 != 0) {

            if (move_uploaded_file($_FILES["travel_insurance"]["tmp_name"], $filepath1)) {
                $filename1=$filename1;
                $fileListimg1=",travel_insurance='$filename1'";
            } else {
                $uploadOk1 = 0;
                $msg1 = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename1='';
        $fileListimg1=",travel_insurance='$filename1'";
    }



    if (isset($_FILES["student_photo"]))
    {
        $target_dir2 = "../uploads/";
        // $path = "upload/product/";
        $target_file2 = $target_dir2 . basename($_FILES["student_photo"]["name"]);
        $imageFileType2 = pathinfo($target_file2,PATHINFO_EXTENSION);
        if ($_FILES["student_photo"]["size"] > 52428800) {
            $msg2=  "Sorry, your file is too large.";
            $uploadOk2 = 0;
        }
        $extallowed2 = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType2),$extallowed2)){
            $msg2 = "Sorry,For jpg & png extension files are allowed";
            $status2 = false;
            $uploadOk2 = 0;
        }

        $filename2=uniqid().'.'.$imageFileType2;
        $filepath2=$target_dir2.$filename2;
        if ($uploadOk2 != 0) {

            if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $filepath2)) {
                $filename2=$filename2;
                $fileListimg2=",student_photo='$filename2'";
            } else {
                $uploadOk2 = 0;
                $msg2 = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename2='';
        $fileListimg2=",student_photo='$filename2'";
    }
	
	if (isset($_FILES["final_application_form"]))
    {
        $target_dir4 = "../uploads/";
        // $path = "upload/product/";
        $target_file4 = $target_dir4 . basename($_FILES["final_application_form"]["name"]);
        $imageFileType4 = pathinfo($target_file4,PATHINFO_EXTENSION);
        if ($_FILES["final_application_form"]["size"] > 52428800) {
            $msg4=  "Sorry, your file is too large.";
            $uploadOk4 = 0;
        }
        $extallowed4 = array("jpg","jpeg","png","JPG","JPEG","PNG","pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType4),$extallowed4)){
            $msg4 = "Sorry,For jpg & png extension files are allowed";
            $status4 = false;
            $uploadOk4 = 0;
        }

        $filename4=uniqid().'.'.$imageFileType4;
        $filepath4=$target_dir4.$filename4;
        if ($uploadOk4 != 0) {

            if (move_uploaded_file($_FILES["final_application_form"]["tmp_name"], $filepath4)) {
                $filename4=$filename4;
                $fileListimg4=",final_application_form='$filename4'";
            } else {
                $uploadOk4 = 0;
                $msg4 = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename4='';
        $fileListimg4=",final_application_form='$filename4'";
    }
	
	

    $user_id = isset($_SESSION['userLoggedin'])?$_SESSION['userLoggedin']:'';
    //echo "SELECT * FROM users WHERE uid='$user_id'";
    

    if(isset($applicaton_id) && !empty($applicaton_id)){


        $q0 = "UPDATE `school_application` set `uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2 $fileListimg4 where `student_app_id`=$applicaton_id";
$last_id = $applicaton_id;
        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));

        $q001 = "UPDATE `student_profile` set `student_app_id`='$applicaton_id',`uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2  where `student_app_id`=$applicaton_id";

        $q002 = mysqli_query($db,$q001) or die(mysqli_error($db));
        
        if($q1)
        {
            $success = true;
            $msg= "Application  updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur While Updating try after sometime.";
        }

    }else {

         $q0 = "INSERT INTO `school_application` set `uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2 $fileListimg4 ";
        $q1 = mysqli_query($db,$q0);
        $last_id = mysqli_insert_id($db);
        $applicaton_id = mysqli_insert_id($db);

        //echo "INSERT INTO `student_profile` set `student_app_id`='$applicaton_id',`uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2";

        $q001 = "INSERT INTO `student_profile` set `student_app_id`='$applicaton_id',`uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2 ";

        $q002 = mysqli_query($db,$q001) or die(mysqli_error($db));
        if($q1 && $q002) 
        {
            $q0 = "SELECT * FROM users WHERE uid='$user_id'";
            $q1 = mysqli_fetch_assoc(mysqli_query($db,$q0));
            
            $query11 = "SELECT * FROM school_application WHERE student_app_id='$applicaton_id'";
            $query12 = mysqli_fetch_assoc(mysqli_query($db,$query11));

            $email = $q1['email'];
            $first_name = $q1['first_name']; 
            $last_name = $q1['last_name'];
            $loginurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $sid= $query12['student_app_id']; 
            $loginurl = str_replace("includes/adminfunction.php",'admin',$loginurl);
            $to = $email;
            $from = "";
            $subject = "Application Has Been Created";
            $body="
                <b style='text-transform:capitalize;'>Dear $first_name $last_name, </b>
                <br>
                <p> Thank you for your Application, please proceed to print and sign the application. Ensure to upload the signed application into the RAS camp system or email to  <a href='https://rascamp.com/admin/add_student_app.php?id=$sid'> Click to View</a></p>
                
                <br>
                <p>Thank You</p>
                <br>
            ";
            
            send_phpmail( "$first_name"." "."$last_name", $to ,"", "" , $subject, $body  ); 

            $success = true;
            $msg= "Application added successfully.";
        }
        else{
            $msg= "Some promblem occur while inserting try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg,
         'id'=>$last_id
    ));
}



// Delete Application Student 


if(isset($_POST["type"]) && $_POST["type"] == "DeleteApplicationStudent")
{
    $student_app_id = $_POST['student_app_id'];
    //echo "DELETE FROM school_application WHERE student_app_id = '$student_app_id'";
    $delrecord = mysqli_query($db,"DELETE FROM school_application WHERE student_app_id = '$student_app_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Profile Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

// Add Final Application with signature

if(isset($_POST["type"]) && $_POST["type"]== 'AddFinalApplicationForm')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $student_app_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("pdf");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry, For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
        else{
            echo json_encode(array(
                'valid'=>$success,
                'msg'=>"Upload only .pdf file"
            ));
            die;
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($final_application) && !empty($final_application)){   
        if(empty($filename)){
            $sql = "SELECT final_application_form FROM school_application WHERE student_app_id='$final_application'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['final_application_form'];
        }

       $q0 = "UPDATE `school_application` SET `final_application_form`='$filename' WHERE `student_app_id`='$final_application'";
            $upload_id = $final_application;
        $q1 = mysqli_query($db,$q0);
        $application_id = $q1['student_app_id'];
        
        /*for student profile*/
        
        $q0011 = "UPDATE `student_profile` SET `final_application_form`='$filename' WHERE `student_app_id`='$final_application'";
        $q0022 = mysqli_query($db,$q0011);
        
        if($q1)
        {
            
            if(isset($_SESSION['adminloggedin'])){
                
                $user_id = $_SESSION['adminloggedin'];
            }
            if(isset($_SESSION['userLoggedin'])){
                $user_id = $_SESSION['userLoggedin'];
            }
            //echo "SELECT * FROM users WHERE uid='$user_id'";
            $q0 = "SELECT t1.*,t2.student_app_id FROM users t1 LEFT JOIN school_application t2 ON t1.uid=t2.uid WHERE t1.uid='$user_id'";
            $q1 = mysqli_fetch_assoc(mysqli_query($db,$q0));

            $email = $q1['email'];
            $first_name = $q1['first_name'];
            $last_name = $q1['last_name'];
            $application_id =$q1['student_app_id'];

            $loginurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";           
            $loginurl = str_replace("includes/adminfunction.php",'admin',$loginurl);
            $to = $email;
            $from = "";
            $subject = "Uploaded Sign Application";
            $body="
                <b style='text-transform:capitalize;'>Dear $first_name $last_name, </b>
                <br>
                <p> Thank you for your uploaded signed Application. Your application will be processed within 3 business days and once approved by our Camp team you will receive an email to ($email) with acceptance and payment information. For any inquirues about your application please email us at camp@rafflesamericanschool.org with your application reference ($application_id) </p>
                
                <br>
                <p>Thank You</p>
                <br>
            ";
            
            send_phpmail( "$first_name"." "."$last_name", $to ,"", "" , $subject, $body  );
            
            $success = true;
            $msg= "School Application updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
        
       //echo "INSERT INTO `school_application`(`final_application_form`) VALUES ('$filename')";

       $q0 = "INSERT INTO `school_application` (`final_application_form`) VALUES ('$filename')";

$upload_id = mysqli_insert_id($db);

        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "School Staff  added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg,
        'id'=>$upload_id
    ));
}


//To Camplete status for student application


if(isset($_POST["type"]) && $_POST["type"] == "MarkAsCompleted")
{
    $student_app_id = $_POST['student_app_id'];
    
    $delrecord = mysqli_query($db,"UPDATE school_application SET `status`=1, `modified`=now() WHERE student_app_id = '$student_app_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        
        $q0 = "SELECT u.*,a.uid,a.student_app_id FROM users u LEFT JOIN school_application a ON u.uid=a.uid WHERE student_app_id='$student_app_id'";
        $q1 = mysqli_fetch_assoc(mysqli_query($db,$q0));

        $email = $q1['email'];
        $first_name = $q1['first_name'];
        $last_name = $q1['last_name'];

        $loginurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";           
        $loginurl = str_replace("includes/adminfunction.php",'admin',$loginurl);
        $to = $email;
        $from = "";
        $subject = "Welcome to Winter Camp  2019";
        $body="
                   <body style ='background:url(https://rascamp.com/assets/images/Screenshot_1.png) 
                                     no-repeat; 
                                     height: 100%;
                                     width:800px;
                                     background-size:cover; '>

                    <div class='container' style='position: relative; 
                                            text-align: center;
                                            color: #000;
                                            width:700px;'>

                     <div class='centered' style='position: absolute;
                                                  top: 50%;
                                                  left: 50%;
                                                  transform: translate(-50%, -50%);
                                                  margin-left: 50px;
                                                  margin-top: 15px;
                                                  margin-left: 160px;
                                                  margin-top: 15px;
                                                  margin-right: 50px;
                                                  text-align: justify;
                                                  padding-top: 150px;
                                                   '>

   
                       
                      
                         <img src='https://rascamp.com/assets/images/ras-logo.png' style='margin-left: -90px;
                              width : 150px;
                             height :80px; '> <br> 

                        <h2 style='text-align: left;'>The Raffles American School Experience Winter Camp 2019</h2>
                        <h2 style='text-align: left;'>Congratulations!</h2>
                        <br>
                         <div style ='font-family: Century Gothic;'>
                         <p> Your child has been accepted into our Winter Camp program. A receipt of your deposit will be emailed as soon as our finance department receives confirmation of your deposit. </p>
                        <p>Please send all travel details to your agent or point of contact as soon as they have been made so that RAS can reserve your transfers to and from the airport. For day students, please provide your agent with your hotel address in Johor so that daily transport can also be reserved.</p>
                        <p>Please remember that the deadline for travel documents, travel & medical insurance documents and final payment is on the 14th of December. The copy of these documents should be emailed to both myself and your agent or representative. And don't forget to have a current passport and any visa's that you may need for entry into Malaysia.</p>

                        <p>If you have any further queries please contact your representative agent or point of contact. We look forward to meeting you and wish you all a safe journey.</p>
                    
                            <p>Kind Regards</p>
                            <p style='color:#ff9900;'>Ian Nenke</p>
                            <p><b>Executive Coordinator & Camps Director</b></p>
                            
                            <p style=' margin-top: 35px; color:orange;'></p>
                           <p style ='font-size: 18px;'><b class='r_color' style ='color:orange !important;'>Raffles</i>
                          <i class='r_color' style ='color:#6f6e73 !important;'>American</b>
                          <b style= 'color:#6f6e73 !important;'>School</i></p>

                            <p style='color:orange;></p>
                           <p> <b class='r_color' style ='color:orange !important; font-size: 14px;'>Think.</b>
                           <b class='r_color' style ='color:orange !important; font-size: 14px;'>Create.</b>
                           <i style= 'color:#6f6e73 !important; font-size: 14px;'>Succeed.</i></p>
                        
                        </div>
                    
                  </div>
            </div>
            </body>
           
            ";
            
        send_phpmail( "$first_name"." "."$last_name", $to ,"", "" , $subject, $body  );
        
        
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Application Completed successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



//To Cancel status for student application


if(isset($_POST["type"]) && $_POST["type"] == "CancelApplication")
{
    $student_app_id = $_POST['student_app_id'];
    
    $delrecord = mysqli_query($db,"UPDATE school_application SET `status`=2, `modified`=now() WHERE student_app_id = '$student_app_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Application Cancelled successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/**********Fetch student details for selection************/

if(isset($_POST["type"]) && $_POST["type"] == "FetchStudentDetails")
{
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);


    $sql = mysqli_query($db,"SELECT gender,age_year,age_month,grade,nationality FROM student_profile WHERE student_profile_id= '$student_profile_id'");
    if(mysqli_affected_rows($db)>0){
        $success = true;
        $res = mysqli_fetch_assoc($sql);
    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "res"     => $res
    ));
}




//Delete Student Profile

/*if(isset($_POST["type"]) && $_POST["type"] == "DeleteStudentProfile")
{
    $student_profile_id = $_POST['student_profile_id'];
    //echo "DELETE FROM student_profile WHERE student_profile_id = '$student_profile_id'";
    $delrecord = mysqli_query($db,"DELETE FROM student_profile WHERE student_profile_id = '$student_profile_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Profile Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}*/



// Student Attendance

if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentAttendance')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $attendance_id = $_POST['attendanceid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
   
    $date = str_replace('/','-',$date);
    $date = date('Y-m-d',strtotime($date));
    $date = date('Y-m-d',strtotime($date));
    
    if(isset($attendance_id) && !empty($attendance_id)){


        $q0 = "UPDATE student_attendance SET `student_profile_id`='$student_profile_id', `roll_number`='$roll_number',  `atted_date`='$atted_date', `present_absent`='$present_absent', `class_list`='$class_list' where student_attendance_id='$attendance_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Student Attendance  updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `student_attendance`(`student_profile_id`, `roll_number`,`atted_date`,`present_absent`,`class_list`) VALUES ( '$student_profile_id', '$roll_number', '$atted_date','$present_absent','$class_list')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Student Attendance added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Student Attendance

if(isset($_POST["type"]) && $_POST["type"] == "DeleteStudentAttendance")
{
    $student_attendance_id = $_POST['student_attendance_id'];
    //echo "DELETE FROM student_attendance WHERE student_attendance_id = '$student_attendance_id'";
    $delrecord = mysqli_query($db,"DELETE FROM student_attendance WHERE student_attendance_id = '$student_attendance_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Attendance Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

/*******************fetch Student attendance details for selection*********************/

if(isset($_POST["type"]) && $_POST["type"] == "FetchStudentAttendanceDetails")
{
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);


    $sql = mysqli_query($db,"SELECT standard FROM student_profile WHERE student_profile_id= '$student_profile_id'");
    if(mysqli_affected_rows($db)>0){
        $success = true;
        $res = mysqli_fetch_assoc($sql);
    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "res"     => $res
    ));
}


// Testing Result

if(isset($_POST["type"]) && $_POST["type"]== 'AddTestingResult')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $test_result_id = $_POST['testresultid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    
    if(isset($test_result_id) && !empty($test_result_id)){


        $q0 = "UPDATE testing_result SET `test_number`='$test_number', `oral_test`='$oral_test', `interview_test`='$interview_test' where test_result_id='$test_result_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Test Result  updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `testing_result`(`test_number`, `oral_test`,`interview_test`) VALUES ( '$test_number', '$oral_test', '$interview_test')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Test Result added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Testing Result

if(isset($_POST["type"]) && $_POST["type"] == "DeleteTestingResult")
{
    $test_result_id = $_POST['test_result_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM testing_result WHERE test_result_id = '$test_result_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Test Result Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



// Class Assignmnet

if(isset($_POST["type"]) && $_POST["type"]== 'AddClassAssignment')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $class_id = $_POST['classid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    
    if(isset($class_id) && !empty($class_id)){


        $q0 = "UPDATE class_assignment SET `student_app_id`='$student_app_id',  `class_room`='$class_room', `class_academic_id`='$class_academic_id', `cca_id`='$cca_id', `creative_classes_id`='$creative_classes_id' where class_assignment_id='$class_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Class Assignmnet  updated successfully.";
        }
        else
        {
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `class_assignment`(`student_app_id`, `class_room`,`class_academic_id`, `cca_id`,`creative_classes_id`) VALUES ( '$student_app_id', '$class_room','$class_academic_id', '$cca_id', '$creative_classes_id')";


        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Class Assignment added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}





// Delete Class Assignment

if(isset($_POST["type"]) && $_POST["type"] == "DeleteClassAssignment")
{
    $class_assignment_id = $_POST['class_assignment_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM class_assignment WHERE class_assignment_id = '$class_assignment_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Class Assignment Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/*******************fetch Student Class Assignment details for selection*********************/

if(isset($_POST["type"]) && $_POST["type"] == "FetchStudentClassAssignment")
{
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);


    $sql = mysqli_query($db,"SELECT age_year FROM student_profile WHERE student_profile_id= '$student_profile_id'");
    if(mysqli_affected_rows($db)>0){
        $success = true;
        $res = mysqli_fetch_assoc($sql);
    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "res"     => $res
    ));
}


// Incident Report

if(isset($_POST["type"]) && $_POST["type"]== 'AddIncidentReport')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $incident_report_id = $_POST['reportid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";
    // print_r($_FILES);
    if (isset($_FILES["incident_file"]) && $_FILES['incident_file']['error'] == 0)
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["incident_file"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["incident_file"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["incident_file"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",incident_file='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    /*else{
        $filename='';
        $fileListimg=",student_picture='$filename'";
    }*/
    if ($uploadOk == 0) {
        $success=false;
    }
    else
    {
        
        
      

    if(isset($incident_report_id) && !empty($incident_report_id)){

        //echo "UPDATE incident_report SET `message_box`='$message_box' $fileListimg  where incident_report_id='$incident_report_id'";
        if($filename == ""){
            $q0 = "UPDATE incident_report SET `title`='$title',`student_profile_id`='$student_profile_id',`school_staff_id`='$school_staff_id',`date`='$date',`time`='$time',`message_box`='$message_box'  where incident_report_id='$incident_report_id'";
        }else{
            $q0 = "UPDATE incident_report SET `title`='$title',`student_profile_id`='$student_profile_id',`school_staff_id`='$school_staff_id',`date`='$date',`time`='$time',`incident_file`='$filename',`message_box`='$message_box'  where incident_report_id='$incident_report_id'";
        }

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Incident Report updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
 
        //echo  "INSERT INTO `incident_report`(`title`, `student_profile_id`, `school_staff_id`, `date`, `time`, `incident_file`, `message_box`) VALUES ('$title','$student_profile_id','$school_staff_id','$date','$time','$fileListimg','$message_box')";

        $q0 = "INSERT INTO `incident_report`(`title`, `student_profile_id`, `school_staff_id`, `date`, `time`, `incident_file`, `message_box`) VALUES ('$title','$student_profile_id','$school_staff_id','$date','$time','$filename','$message_box')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Incident Report added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }
}

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Incident Report

if(isset($_POST["type"]) && $_POST["type"] == "DeleteIncidentReport")
{
    $incident_report_id = $_POST['incident_report_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM incident_report WHERE incident_report_id = '$incident_report_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Indident Report Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}





// Communication History

if(isset($_POST["type"]) && $_POST["type"]== 'AddCommunicationHistory')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $communication_id = $_POST['communicationid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";
    // print_r($_FILES);
    if (isset($_FILES["upload_file"]) && $_FILES['upload_file']['error'] == 0)
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["upload_file"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["upload_file"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG","pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",upload_file='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    /*else{
        $filename='';
        $fileListimg=",student_picture='$filename'";
    }*/
    if ($uploadOk == 0) {
        $success=false;
    }
    else
    {

    $communication_date = str_replace('/','-',$communication_date);
    $communication_date = date('Y-m-d',strtotime($communication_date));
    $communication_date = date('Y-m-d',strtotime($communication_date));

    if(isset($communication_id) && !empty($communication_id)){        
    if(empty($filename)){
            $sql = "SELECT upload_file FROM communication_history WHERE communication_id='$communication_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['upload_file'];
    }
        $q0 = "UPDATE `communication_history` SET `student_app_id`='$student_app_id', `upload_file`='$filename', `communication_date`='$communication_date', `time`='$time' where communication_id='$communication_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Communication History updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        //echo "INSERT INTO `communication_history`(`student_app_id`, `communication_date`, `relative`, `communication_notes`) VALUES ('$student_app_id','$communication_date', '$relative', '$communication_notes')";
        $q0 = "INSERT INTO `communication_history`(`student_app_id`, `upload_file`,`communication_date`, `time`) VALUES ('$student_app_id', '$filename', '$communication_date', '$time')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Communication History added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }
}

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Communication History

if(isset($_POST["type"]) && $_POST["type"] == "DeleteCommunicationoHistory")
{
    $communication_id = $_POST['communication_id'];
    
    $delrecord = mysqli_query($db,"DELETE FROM communication_history WHERE communication_id = '$communication_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Communication History Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


// Student ID  Card

/*if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentIDCard')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $student_idcard_id = $_POST['idcardid'];
    

    if(isset($student_idcard_id) && !empty($student_idcard_id)){

        
        $q0 = "UPDATE student_idcard SET `student_app_id`='$student_app_id',`student_type`='$student_type' where student_idcard_id='$student_idcard_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Stundent ID Card updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `student_idcard`(`student_app_id`,`student_type`) VALUES ('$student_app_id','$student_type')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Stundent ID Card added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}*/


if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentIDCard')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    //$student_idcard_id = $_POST['idcardid'];
    $student_app_id = implode(',',$student_app_id);
    //print_r($student_idcard_id);

    if(isset($student_idcard_id) && !empty($student_idcard_id)){

        
        $q0 = "UPDATE student_idcard SET `student_app_id`='$student_app_id',`camp_management_id`='$camp_management_id' where student_idcard_id='$student_idcard_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Stundent ID Card updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `student_idcard`(`student_app_id`,`camp_management_id`) VALUES ('$student_app_id','$camp_management_id')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Stundent ID Card added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}



// Delete Student ID  Card

if(isset($_POST["type"]) && $_POST["type"] == "DeleteStudentIDCard")
{
    $student_idcard_id = $_POST['student_idcard_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM student_idcard WHERE student_idcard_id = '$student_idcard_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Stundent ID Card Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/**********Fetch student idcard details for selection************/

/*if(isset($_POST["type"]) && $_POST["type"] == "FetchStudentIDCardDetails")
{
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);
    // $student_profile_id = "'".implode("','", $student_profile_id)."'";

    

    $sql = mysqli_query($db,"SELECT a.student_app_id,
                                    a.allergies allergies,
                                    a.allergies_details details,
                                    a.student_pickup pickup,
                                    c.cca_name cca_name
                                    FROM school_application a 
                                    LEFT JOIN 
                                    cca c ON a.student_app_id=c.student_app_id 
                                    WHERE a.student_app_id= '$student_app_id'");

    if(mysqli_affected_rows($db)>0){
        $success = true;
        $res = mysqli_fetch_assoc($sql);
        // print_r($res);
        if($res['allergies'] == '0' || $res['allergies'] == ''){
            $res['details'] = 'No';
        }
        if($res['pickup'] == '1'){
            $res['pickup'] = 'Danga Bay (Starbucks)';
        }
        if($res['pickup'] == '2'){
            $res['pickup'] = 'Teega A (lobby)';
        }
        if($res['pickup'] == '3'){
            $res['pickup'] = 'Teega B (lobby)';
        }
        if($res['pickup'] == '4'){
            $res['pickup'] = 'Teega Suites (lobby)';
        }
        if($res['pickup'] == '5'){
            $res['pickup'] = 'Mall of medini(lobby)';
        }
    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "res"     => $res
    ));
}
*/


if(isset($_POST["type"]) && $_POST["type"] == "FetchStudentIDCardDetails")
{
    $success = false;
    $message = "";
    $html = "";
    $res = array();
    extract($_POST);
    // $student_profile_id = "'".implode("','", $student_profile_id)."'";

    //echo "SELECT t1.student_name FROM `school_application` t1 WHERE CONCAT(',',t1.camp_management_id,',') LIKE '%,$camp_management_id,%'";

    $sql = mysqli_query($db,"SELECT t1.student_name,t1.student_app_id FROM `school_application` t1 WHERE CONCAT(',',t1.camp_management_id,',') LIKE '%,$camp_management_id,%'");

    $i = 1;
    if(mysqli_affected_rows($db)){
        $success = true;
        ob_start();

        while($r11 = mysqli_fetch_assoc($sql)){

    ?>
            <tr>
                <td><?=$i;$i++;?></td>
                <td><?=$r11['student_name'];?></td>
                
                   
                <td><input type="checkbox" name="student_app_id[]" value="<?=$r11['student_app_id']?>"> <?//=$checked;?></td>
            </tr>
            
        <?php }    
        $html = ob_get_clean();
    }
    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "html"     => $html
    ));
}





// Student Image Gallery

if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentImageGallery')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $student_image_gallery_id = $_POST['imageid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["image_gallery"]))
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["image_gallery"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["image_gallery"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["image_gallery"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg="image_gallery='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    /*else{
        $filename='';
        $fileListimg=",student_picture='$filename'";
    }*/
    if ($uploadOk == 0) {
        $success=false;
    }
    else
    {

    if(isset($student_image_gallery_id) && !empty($student_image_gallery_id)){

        //echo "UPDATE incident_report SET `message_box`='$message_box' $fileListimg  where communication_id='$communication_id'";
        $q0 = "UPDATE student_image_gallery SET $fileListimg  where student_image_gallery_id='$student_image_gallery_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Student Image Gallery updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `student_image_gallery`(`image_gallery`) VALUES ('$filename')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Student Image Gallery added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }
}

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Student Image Gallery

if(isset($_POST["type"]) && $_POST["type"] == "DeleteStudentImageGallery")
{
    $student_image_gallery_id = $_POST['student_image_gallery_id'];
    
    $delrecord = mysqli_query($db,"DELETE FROM student_image_gallery WHERE student_image_gallery_id = '$student_image_gallery_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Image Gallery Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}




// Image Gallery

if(isset($_POST["type"]) && $_POST["type"]== 'AddImageGallery')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $image_gallery_id = $_POST['imagegalleryid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["gallery_image"]))
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["gallery_image"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["gallery_image"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["gallery_image"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg="gallery_image='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    /*else{
        $filename='';
        $fileListimg=",student_picture='$filename'";
    }*/
    if ($uploadOk == 0) {
        $success=false;
    }
    else
    {

    if(isset($image_gallery_id) && !empty($image_gallery_id)){

        //echo "UPDATE incident_report SET `message_box`='$message_box' $fileListimg  where communication_id='$communication_id'";
        $q0 = "UPDATE image_gallery SET $fileListimg  where image_gallery_id='$image_gallery_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Image Gallery updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `image_gallery`(`gallery_image`) VALUES ('$filename')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Image Gallery added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }
}

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Image Gallery

if(isset($_POST["type"]) && $_POST["type"] == "DeleteImageGallery")
{
    $image_gallery_id = $_POST['image_gallery_id'];
    
    $delrecord = mysqli_query($db,"DELETE FROM image_gallery WHERE image_gallery_id = '$image_gallery_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Image Gallery Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}




// Image Video

if(isset($_POST["type"]) && $_POST["type"]== 'AddVideoGellery')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $video_gellery_id = $_POST['videogelleryid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["video_gellery"]))
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["video_gellery"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["video_gellery"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["video_gellery"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg="video_gellery='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    /*else{
        $filename='';
        $fileListimg=",student_picture='$filename'";
    }*/
    if ($uploadOk == 0) {
        $success=false;
    }
    else
    {

    if(isset($video_gellery_id) && !empty($video_gellery_id)){

        //echo "UPDATE incident_report SET `message_box`='$message_box' $fileListimg  where communication_id='$communication_id'";
        $q0 = "UPDATE video_gellery SET $fileListimg  where video_gellery_id='$video_gellery_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Video Gallery updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `video_gellery`(`video_gellery`) VALUES ('$filename')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Video Gallery added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }
}

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Video Gallery

if(isset($_POST["type"]) && $_POST["type"] == "DeleteVideoGallery")
{
    $video_gellery_id = $_POST['video_gellery_id'];
    
    $delrecord = mysqli_query($db,"DELETE FROM video_gellery WHERE video_gellery_id = '$video_gellery_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Video Gallery Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}




// Camp Fee

if(isset($_POST["type"]) && $_POST["type"]== 'AddCampFee')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $camp_fee_id = $_POST['campid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    
    if(isset($camp_fee_id) && !empty($camp_fee_id)){


        $q0 = "UPDATE camp_fee SET  `camp_name`='$camp_name', `camp_fee`='$camp_fee', `transport_fee`='$transport_fee', `activity_fee`='$activity_fee', `camp_notes`='$camp_notes' where camp_fee_id='$camp_fee_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Camp Fee updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `camp_fee`(`camp_name`, `camp_fee`, `transport_fee`, `activity_fee`,`camp_notes`) VALUES ( '$camp_name', '$camp_fee', '$transport_fee','$activity_fee', '$camp_notes')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Camp Fee added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Camp Fee

if(isset($_POST["type"]) && $_POST["type"] == "DeleteCampFee")
{
    $camp_fee_id = $_POST['camp_fee_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM camp_fee WHERE camp_fee_id = '$camp_fee_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Camp Fee Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}





// Enrollment Status

if(isset($_POST["type"]) && $_POST["type"]== 'AddEnrollmentStatus')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $enrollment_id = $_POST['enrollmenttid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
   
    $enrollment_date = str_replace('/','-',$enrollment_date);
    $enrollment_date = date('Y-m-d',strtotime($enrollment_date));
    $enrollment_date = date('Y-m-d',strtotime($enrollment_date));
    
    if(isset($enrollment_id) && !empty($enrollment_id)){


        $q0 = "UPDATE enrollment_status SET `student_app_id`= '$student_app_id', `enrollment_date`='$enrollment_date', `enrollment_notes`='$enrollment_notes', `enrollment_value`='$enrollment_value' where enrollment_id='$enrollment_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Enrollment Status updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `enrollment_status`(`student_app_id`, `enrollment_date`, `enrollment_notes`, `enrollment_value`) VALUES ('$student_app_id', '$enrollment_date', '$enrollment_notes','$enrollment_value')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Enrollment Status added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Enrollment Status

if(isset($_POST["type"]) && $_POST["type"] == "DeleteEnrollmentStatus")
{
    $enrollment_id = $_POST['enrollment_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM enrollment_status WHERE enrollment_id = '$enrollment_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Enrollment Status Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}









// Student Assessment

if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentAssessment')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $assessment_id = $_POST['assessmentid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    
    if(isset($assessment_id) && !empty($assessment_id)){


        $q0 = "UPDATE student_assessment SET `student_name`='$student_name', `listing_exam`='$listing_exam', `oral_test`='$oral_test', `assesment_notes`='$assesment_notes' where assessment_id='$assessment_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Student Assessment updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `student_assessment`(`student_name`, `listing_exam`, `oral_test`,`assesment_notes`) VALUES ( '$student_name', '$listing_exam','$oral_test', '$assesment_notes')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Student Assessment added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Student Assessment

if(isset($_POST["type"]) && $_POST["type"] == "DeleteStudentAssessment")
{
    $assessment_id = $_POST['assessment_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM student_assessment WHERE assessment_id = '$assessment_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Assessment Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}





// Agent Profile

if(isset($_POST["type"]) && $_POST["type"]== 'AddAgentProfile')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $agent_profile_id = $_POST['agentid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    
    if(isset($agent_profile_id) && !empty($agent_profile_id)){


        $q0 = "UPDATE agent_profile SET `agent_name`='$agent_name', `contact_number`='$contact_number', `address`='$address' where agent_profile_id='$agent_profile_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Agent Profile updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `agent_profile`(`agent_name`, `contact_number`, `address`) VALUES ( '$agent_name', '$contact_number','$address')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Agent Profile added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Agent Profile

if(isset($_POST["type"]) && $_POST["type"] == "DeleteAgentProfile")
{
    $agent_profile_id = $_POST['agent_profile_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM agent_profile WHERE agent_profile_id = '$agent_profile_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Assessment Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}





// Linked Student

if(isset($_POST["type"]) && $_POST["type"]== 'AddLinkedStudent')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $linked_student_id = $_POST['linkedstudentid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    /*else{
        $filename='';
        $fileListimg=",student_picture='$filename'";
    }*/
    if ($uploadOk == 0) {
        $success=false;
    }
    else
    {

    if(isset($linked_student_id) && !empty($linked_student_id)){

       
        $q0 = "UPDATE linked_student SET `first_name`='$first_name', `last_name`='$last_name', `contact_number`='$contact_number', `roll_number`='$roll_number' $fileListimg, `gender`='$gender', `nationality`='$nationality', `age_year`='$age_year', `age_month`='$age_month', `grade`='$grade', `address`='$address', `agent_name`='$agent_name' where linked_student_id='$linked_student_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Linked Student updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `linked_student`(`first_name`, `last_name`, `contact_number`, `roll_number`, `picture`, `gender`, `nationality`, `age_year`, `age_month`, `grade`, `address`, `agent_name`) VALUES ( '$first_name', '$last_name', '$contact_number', '$roll_number', '$filename', '$gender', '$nationality', '$age_year', '$age_month', '$grade', '$address', '$agent_name')";


        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Linked Student added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }
}

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Linked Student

if(isset($_POST["type"]) && $_POST["type"] == "DeleteLinkedStudent")
{
    $linked_student_id = $_POST['linked_student_id'];
    
    $delrecord = mysqli_query($db,"DELETE FROM linked_student WHERE linked_student_id = '$linked_student_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Linked Student Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}




// Commission Fee

if(isset($_POST["type"]) && $_POST["type"]== 'AddCommissionFee')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $commission_fee_id = $_POST['commissionfeeid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    
    if(isset($commission_fee_id) && !empty($commission_fee_id)){


        $q0 = "UPDATE commission_fee SET `student_comission_fee`='$student_comission_fee', `commission_fee`='$commission_fee' where commission_fee_id='$commission_fee_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Commission Fee updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `commission_fee`(`student_comission_fee`, `commission_fee`) VALUES ( '$student_comission_fee', '$commission_fee')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Commission Fee added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Commission Fee

if(isset($_POST["type"]) && $_POST["type"] == "DeleteCommissionFee")
{
    $commission_fee_id = $_POST['commission_fee_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM commission_fee WHERE commission_fee_id = '$commission_fee_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Commission Fee Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


// Agent Camp Fee

if(isset($_POST["type"]) && $_POST["type"]== 'AddAgentCampFee')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $agent_camp_fee_id = $_POST['agentcampid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    
    if(isset($agent_camp_fee_id) && !empty($agent_camp_fee_id)){


        $q0 = "UPDATE agent_camp_fee SET `camp_fee`='$camp_fee', `transport_fee`='$transport_fee', `activity_fee`='$activity_fee', `camp_notes`='$camp_notes' where agent_camp_fee_id='$agent_camp_fee_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Agent Camp Fee updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `agent_camp_fee`(`camp_fee`, `transport_fee`, `activity_fee`, `camp_notes`) VALUES ( '$camp_fee', '$transport_fee', '$activity_fee', '$camp_notes')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Agent Camp Fee added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Agent Camp Fee

if(isset($_POST["type"]) && $_POST["type"] == "DeleteAgentCampFee")
{
    $agent_camp_fee_id = $_POST['agent_camp_fee_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM agent_camp_fee WHERE agent_camp_fee_id = '$agent_camp_fee_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Agent Camp Fee Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



// Agent Communication

if(isset($_POST["type"]) && $_POST["type"]== 'AddAgentCommunicationHistory')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $agent_communication_id = $_POST['agentcommunicationid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["upload_file"]))
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["upload_file"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["upload_file"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg="upload_file='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    /*else{
        $filename='';
        $fileListimg=",student_picture='$filename'";
    }*/
    if ($uploadOk == 0) {
        $success=false;
    }
    else
    {

    if(isset($agent_communication_id) && !empty($agent_communication_id)){

        //echo "UPDATE incident_report SET `message_box`='$message_box' $fileListimg  where communication_id='$communication_id'";
        $q0 = "UPDATE agent_communication_history SET $fileListimg  where agent_communication_id='$agent_communication_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Agent Communication updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `agent_communication_history`(`upload_file`) VALUES ('$filename')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Agent Communication added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }
}

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Agent Communication

if(isset($_POST["type"]) && $_POST["type"] == "DeleteAgentCommunication")
{
    $agent_communication_id = $_POST['agent_communication_id'];
    
    $delrecord = mysqli_query($db,"DELETE FROM agent_communication_history WHERE agent_communication_id = '$agent_communication_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Agent Communication Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



// Messaging Feature

if(isset($_POST["type"]) && $_POST["type"]== 'AddMessagingFeature')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $messaging_feature_id = $_POST['messagingfeatureid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
   
    
    if(isset($messaging_feature_id) && !empty($messaging_feature_id)){


        $q0 = "UPDATE messaging_feature SET `email`='$email' where messaging_feature_id='$messaging_feature_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Messaging Feature updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `messaging_feature`(`email`) VALUES ( '$email')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Messaging Feature added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Messaging Feature

if(isset($_POST["type"]) && $_POST["type"] == "DeleteMessagingFeature")
{
    $messaging_feature_id = $_POST['messaging_feature_id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM messaging_feature WHERE messaging_feature_id = '$messaging_feature_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Messaging Feature Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/****************************  Amit  *********************************/

/****************************** Add Camp Teacher **************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddCampTeacher')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $camp_teacher_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";
    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($camp_teacher_id) && !empty($camp_teacher_id)){   
        if(empty($filename)){
            $sql = "SELECT image FROM camp_teacher WHERE camp_teacher_id='$camp_teacher_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }    
        $q0 = "UPDATE `camp_teacher` SET `first_name`='$first_name',`last_name`='$last_name',`id_number`='$id_number',`mobile_number`='$mobile_number',`email_id`='$email_id',`address`='$address',`image`='$filename' WHERE `camp_teacher_id`='$camp_teacher_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Camp Teacher  updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
        $q0 = "INSERT INTO `camp_teacher`(`first_name`, `last_name`, `id_number`, `mobile_number`, `email_id`, `address`, `image`) VALUES ('$first_name','$last_name','$id_number','$mobile_number','$email_id','$address','$filename')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Camp Teacher added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}






/**********************************Delete Camp Teacher*************************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteCampTeacher")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM `camp_teacher` WHERE  camp_teacher_id = '$id'");
    //$delrecord4 = mysqli_query($db,"DELETE FROM add_reviews WHERE user_id='$id'");
    //$delrecord2 = mysqli_query($db,"DELETE FROM login WHERE login_id='$id'");
    if($delrecord )//&& $delrecord4 && $delrecord2)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Camp Teacher Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



/****************************** Add Boarding Staff **************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddBoardingStaff')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $boarding_staff_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0) 
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }

        if(isset($boarding_staff_id) && !empty($boarding_staff_id)){   
        if(empty($filename)){
            $sql = "SELECT image FROM boarding_staff WHERE boarding_staff_id='$boarding_staff_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }
        $q0 = "UPDATE `boarding_staff` SET `first_name`='$first_name',`last_name`='$last_name',`id_number`='$id_number',`mobile_number`='$mobile_number',`email_id`='$email_id',`address`='$address',`image`='$filename' WHERE `boarding_staff_id`='$boarding_staff_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Boarding Staff updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

       $q0 = "INSERT INTO `boarding_staff`(`first_name`, `last_name`, `id_number`, `mobile_number`, `email_id`, `address`, `image`) VALUES ('$first_name','$last_name','$id_number','$mobile_number','$email_id','$address','$filename')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Boarding Staff added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}



/****************************** Delete Boarding Staff*************************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteBoardingStaff")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM `boarding_staff` WHERE   boarding_staff_id = '$id'");
    //$delrecord4 = mysqli_query($db,"DELETE FROM add_reviews WHERE user_id='$id'");
    //$delrecord2 = mysqli_query($db,"DELETE FROM login WHERE login_id='$id'");
    if($delrecord )//&& $delrecord4 && $delrecord2)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Delete Boarding Staff Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



/****************************** Add School Staff **************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddSchoolStaff')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $school_staff_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($school_staff_id) && !empty($school_staff_id)){   
        if(empty($filename)){
            $sql = "SELECT image FROM school_staff WHERE school_staff_id='$school_staff_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }

        $q0 = "UPDATE `school_staff` SET `first_name`='$first_name',`last_name`='$last_name',`id_number`='$id_number',`mobile_number`='$mobile_number',`email_id`='$email_id',`address`='$address',`image`='$filename' WHERE `school_staff_id`='$school_staff_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "school_staff updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
        //echo "INSERT INTO `employee`( `first_name`, `last_name`,`mobile_number`, `emp_code`, `email`, `password`) VALUES ( '$first_name' , '$last_name', '$mobile_number', '$emp_code', '$email' , '$password')";
       /* $q0 = "INSERT INTO `product`( `product_name`,`product_price`,`picture`,`product_des`,`category_id`,`sub_id`) VALUES ( '$product_name','$product_price','$filename','$product_des','$category_id','$sub_id')";*/
       //echo "INSERT INTO `camp_teacher`(`first_name`, `last_name`, `id_number`, `mobile_number`, `email_id`, `address`, `image`) VALUES ('$first_name','$last_name','$id_number','$mobile_number','$email_id','$address' '$filename')";

       $q0 = "INSERT INTO `school_staff`(`first_name`, `last_name`, `id_number`, `mobile_number`, `email_id`, `address`, `image`) VALUES ('$first_name','$last_name','$id_number','$mobile_number','$email_id','$address','$filename')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "School Staff  added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/******************************* Delete School Staff ************************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteSchoolStaff")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM `school_staff` WHERE  school_staff_id = '$id'");
    //$delrecord4 = mysqli_query($db,"DELETE FROM add_reviews WHERE user_id='$id'");
    //$delrecord2 = mysqli_query($db,"DELETE FROM login WHERE login_id='$id'");
    if($delrecord )//&& $delrecord4 && $delrecord2)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "School Staff Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/******************************Add Transport Drivers **************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddTransportDrivers')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $transport_drivers_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }

    if(isset($transport_drivers_id) && !empty($transport_drivers_id)){   
        if(empty($filename)){
            $sql = "SELECT image FROM transport_drivers WHERE transport_drivers_id='$transport_drivers_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }        

        $q0 = "UPDATE `transport_drivers` SET `first_name`='$first_name',`last_name`='$last_name',`id_number`='$id_number',`mobile_number`='$mobile_number',`email_id`='$email_id',`address`='$address',`driving_licence`='$driving_licence',`image`='$filename' WHERE `transport_drivers_id`='$transport_drivers_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Drivers Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
      

       $q0 = "INSERT INTO `transport_drivers`(`first_name`, `last_name`, `id_number`, `mobile_number`, `email_id`, `address`,`driving_licence`,`image`) VALUES ('$first_name','$last_name','$id_number','$mobile_number','$email_id','$address','$driving_licence','$filename')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Drivers added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}

/*******************************Delete Transport Drivers ************************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteTransportDrivers")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM `transport_drivers` WHERE  transport_drivers_id = '$id'");
    //$delrecord4 = mysqli_query($db,"DELETE FROM add_reviews WHERE user_id='$id'");
    //$delrecord2 = mysqli_query($db,"DELETE FROM login WHERE login_id='$id'");
    if($delrecord )//&& $delrecord4 && $delrecord2)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Transport Drivers Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}




/******************************Add Transport Vehicles **************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddTransportVehicle')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $transport_vehicles_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }

    if(isset($transport_vehicles_id) && !empty($transport_vehicles_id)){   
    if(empty($filename)){
            $sql = "SELECT image FROM transport_vehicles WHERE transport_vehicles_id='$transport_vehicles_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }
        $q0 = "UPDATE `transport_vehicles` SET `vehicle_name`='$vehicle_name',`vehicle_type`='$vehicle_type',`registration_number`='$registration_number',`vehicle_number`='$vehicle_number',`image`='$filename' WHERE `transport_vehicles_id`='$transport_vehicles_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Vehicles Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
       //echo "INSERT INTO `transport_vehicles`(`vehicle_name`, `vehicle_type`, `registration_number`, `vehicle_number`, `image`) VALUES ('$vehicle_name','$vehicle_type','$registration_number','$vehicle_number','$filename')";

       $q0 = "INSERT INTO `transport_vehicles`(`vehicle_name`, `vehicle_type`, `registration_number`, `vehicle_number`, `image`) VALUES ('$vehicle_name','$vehicle_type','$registration_number','$vehicle_number','$filename')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Vehicles added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}



/*******************************Delete Transport Vechicles ************************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteTransportVechicles")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Transport Vechicle Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



/******************************Add Driver Assignments **************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddDriverAssignments')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $driver_assignments_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($driver_assignments_id) && !empty($driver_assignments_id)){   
        if(empty($filename)){
            $sql = "SELECT image FROM driver_assignments WHERE driver_assignments_id='$driver_assignments_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }

        $q0 = "UPDATE `driver_assignments` SET `first_name`='$first_name',`last_name`='$last_name',`id_number`='$id_number',`mobile_number`='$mobile_number',`email_id`='$email_id',`driving_license`='$driving_license',`address`='$address',`image`='$filename' WHERE `driver_assignments_id`='$driver_assignments_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Driver Assignments Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
       //echo "INSERT INTO `transport_vehicles`(`vehicle_name`, `vehicle_type`, `registration_number`, `vehicle_number`, `image`) VALUES ('$vehicle_name','$vehicle_type','$registration_number','$vehicle_number','$filename')";

       $q0 = "INSERT INTO `driver_assignments`(`first_name`, `last_name`, `id_number`, `mobile_number`, `email_id`, `driving_license`, `address`, `image`) VALUES ('$first_name','$last_name','$id_number','$mobile_number','$email_id','$driving_license','$address','$filename')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Driver Assignments added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}





/********************** Delete Driver Assignments **********************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteDriverAssignments")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `driver_assignments` WHERE  driver_assignments_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Driver Assignments Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

/***********************Add Transport Incident Reports*********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddTransportIncidentReports')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $transport_incident_reports_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }


    $date = str_replace('/','-',$date);
    $date = date('Y-m-d',strtotime($date));
    $date = date('Y-m-d',strtotime($date));
    
   
    if(isset($transport_incident_reports_id) && !empty($transport_incident_reports_id)){

        

        $q0 = "UPDATE `transport_incident_reports` SET `driver_name`='$driver_name',`transport_number`='$transport_number',`students`='$students',`date`='$date',`pickup_location`='$pickup_location',`drop_location`='$drop_location' WHERE `transport_incident_reports_id`='$transport_incident_reports_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Incident Reports Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `transport_incident_reports`(`driver_name`, `transport_number`, `students`, `date`, `pickup_location`, `drop_location`) VALUES ('$driver_name','$transport_number','$students','$date','$pickup_location','$drop_location')";

       $q0 = "INSERT INTO `transport_incident_reports`(`driver_name`, `transport_number`, `students`, `date`, `pickup_location`, `drop_location`) VALUES ('$driver_name','$transport_number','$students','$date','$pickup_location','$drop_location')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Incident Reports added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}



/********************** Delete Transport Drivers **********************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteTransportIncidentReports")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `transport_incident_reports` WHERE  transport_incident_reports_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Transport Incident Reports Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

/***********************Add Transport Audit*********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddTransportAudit')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $audit_of_transport_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }

    $date = str_replace('/','-',$date);
    $date = date('Y-m-d',strtotime($date));
    $date = date('Y-m-d',strtotime($date));

    if(isset($audit_of_transport_id) && !empty($audit_of_transport_id)){

        

        $q0 = "UPDATE `audit_of_transport` SET `vehicle_number`='$vehicle_number',`date`='$date' WHERE `audit_of_transport_id`='$audit_of_transport_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Audit of Transport Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `audit_of_transport`(`vehicle_number`, `date`) VALUES ('$vehicle_number','$date')";

       $q0 = "INSERT INTO `audit_of_transport`(`vehicle_number`, `date`) VALUES ('$vehicle_number','$date')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Audit of Transport added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/********************** Delete Transport Drivers **********************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteTransportAudit")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `audit_of_transport` WHERE  audit_of_transport_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Transport Audit Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/********************** Delete Transport Drivers **********************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteClassAcademic")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `class_academic` WHERE  class_academic_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Academic Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

/********************** Delete CCA (Sporting) **********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletecca")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `cca` WHERE cca_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "CCA Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



/********************** Delete Creative Classes **********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletecreativeclasses")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `creative_classes` WHERE creative_classes_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Creative Classes Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

/********************** Delete Boarding Activities **********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deleteboardingactivities")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `boarding_activities` WHERE boarding_activities_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Boarding Activities Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/************** Delete Teacher / Resource Assignment ******************/

if(isset($_POST["type"]) && $_POST["type"] == "Deleteteacherassignment")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `teacher_resource_assignment` WHERE teacher_resource_assignment_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Delete Teacher Assignment Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



/*********************** Add Equipment Assignment *********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddEquipmentMaterials')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $equipment_assignment_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($equipment_assignment_id) && !empty($equipment_assignment_id)){

        

        $q0 = "UPDATE `equipment_assignment` SET `equipment_assignment_name`='$equipment_assignment_name',`category_of_equipment`='$category_of_equipment' WHERE `equipment_assignment_id`='$equipment_assignment_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Equipment Assignment Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `creative_classes`(`classes_name`, `date`, `student_name`, `schedule`) VALUES ('$classes_name','$date','$student_name','$schedule')";

       $q0 = "INSERT INTO `equipment_assignment`(`equipment_assignment_name`, `category_of_equipment`) VALUES ('$equipment_assignment_name','$category_of_equipment')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Equipment Assignment added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/********************** Delete Creative Classes **********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deleteequipmentassignment")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `equipment_assignment` WHERE equipment_assignment_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Equipment Assignment Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}




/*********************** Add Camp Management *********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddCampManagement')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $camp_management_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }


    $start_date = str_replace('/','-',$start_date);
    $start_date = date('Y-m-d',strtotime($start_date));
    $start_date = date('Y-m-d',strtotime($start_date));
    
    $finish_date = str_replace('/','-',$finish_date);
    $finish_date = date('Y-m-d',strtotime($finish_date));
    $finish_date = date('Y-m-d',strtotime($finish_date));
    
    if(isset($camp_management_id) && !empty($camp_management_id)){
        
        $q0 = "UPDATE `camp_management` SET `camp_name`='$camp_name',`message`='$message',`start_date`='$start_date',`finish_date`='$finish_date',`student_number`='$student_number' WHERE `camp_management_id`='$camp_management_id'";
   
        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Camp Management Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `creative_classes`(`classes_name`, `date`, `student_name`, `schedule`) VALUES ('$classes_name','$date','$student_name','$schedule')";

       $q0 = "INSERT INTO `camp_management`(`camp_name`, `message`, `start_date`, `finish_date`, `student_number`) VALUES ('$camp_name','$message','$start_date','$finish_date','$student_number')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Camp Management added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/********************** Delete Creative Classes **********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletecampmanagement")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `camp_management` WHERE camp_management_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Camp Management Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/***********************Add Curriculum Overview*********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddCurriculumOverview')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $curriculum_overview_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry, For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($curriculum_overview_id) && !empty($curriculum_overview_id)){

        

        $q0 = "UPDATE `curriculum_overview` SET `curriculum_overview_name`='$curriculum_overview_name',`documents`='$filename' WHERE `curriculum_overview_id`='$curriculum_overview_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Curriculum Overview Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `curriculum_overview`(`curriculum_overview_name`, `documents`) VALUES ('$curriculum_overview_name','$filename')";

       $q0 = "INSERT INTO `curriculum_overview`(`curriculum_overview_name`, `documents`) VALUES ('$curriculum_overview_name','$filename')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Curriculum Overview added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/**********************Delete Curriculum Overview**********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletecurriculumoverview")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `curriculum_overview` WHERE curriculum_overview_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Curriculum Overview Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

/***********************Add Export Feature*********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'Addexportfeature')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $export_feature_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry, For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($export_feature_id) && !empty($export_feature_id)){

        

        $q0 = "UPDATE `export_feature` SET `export_feature_name`='$export_feature_name',`documents`='$filename' WHERE `export_feature_id`='$export_feature_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Export Feature Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `curriculum_overview`(`curriculum_overview_name`, `documents`) VALUES ('$curriculum_overview_name','$filename')";

       $q0 = "INSERT INTO `export_feature`(`export_feature_name`, `documents`) VALUES ('$export_feature_name','$filename')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Export Feature added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/**********************Delete Export Feature**********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deleteexportfeature")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `export_feature` WHERE export_feature_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Export Feature Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/**********************Delete Class Schedules**********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deleteclassschedules")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `class_schedules` WHERE class_schedules_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Class Schedules Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/*********************** Add Transport Routes *********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'Addtransportroutes')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $transport_routes_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($transport_routes_id) && !empty($transport_routes_id)){

        
        //echo "UPDATE `transport_routes` SET `student_app_id`='$student_app_id',`student_pickup`='$pickup_id',`drop_locations`='$drop_locations',`route_number`='$route_number' WHERE `transport_routes_id`='$transport_routes_id'";
        $q0 = "UPDATE `transport_routes` SET `student_app_id`='$student_app_id',`pickup_id`='$pickup_id',`drop_locations`='$drop_locations',`route_number`='$route_number' WHERE `transport_routes_id`='$transport_routes_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Routes Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `transport_routes`(`student_app_id`, `pickup_id`, `drop_locations`, `route_number`) VALUES ('$student_app_id','$pickup_id','$drop_locations','$route_number')";

       $q0 = "INSERT INTO `transport_routes`(`student_app_id`, `pickup_id`, `drop_locations`, `route_number`) VALUES ('$student_app_id','$pickup_id','$drop_locations','$route_number')";

      

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Routes added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}



/**********************Delete Transport Routes**********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletetransportroutes")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `transport_routes` WHERE transport_routes_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Transport Routes Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

/********************* Add Transports Schedules *********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'Addtransportschedules')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $transport_schedules_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($transport_schedules_id) && !empty($transport_schedules_id)){

        

        $q0 = "UPDATE `transport_schedules` SET `date`='$date',`students`='$students',`pickup_locations`='$pickup_locations',`drop_locations`='$drop_locations',`boarding_staff`='$boarding_staff',`drivers`='$drivers' WHERE `transport_schedules_id`='$transport_schedules_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Schedules Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `class_schedules`(`material_name`, `class_name`, `day`, `date`, `time`) VALUES ('$material_name','$class_name','$day','$date','$time')";

       $q0 = "INSERT INTO `transport_schedules`(`date`, `students`, `pickup_locations`, `drop_locations`, `boarding_staff`, `drivers`) VALUES ('$date','$students','$pickup_locations','$drop_locations','$boarding_staff','$drivers')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Transport Schedules added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}
/**********************Delete Transport Schedules**********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletetransportschedules")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `transport_schedules` WHERE transport_schedules_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Transport Schedules Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/********************* Fetch Student Details *********************/

if(isset($_POST["type"]) && $_POST["type"] == "FetchStudentDetailsReport")
{
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);

    //echo "SELECT age_year,age_month,nationality FROM student_profile WHERE student_profile_id= '$student_profile_id'";
    $sql = mysqli_query($db,"SELECT age_year,age_month,nationality FROM school_application WHERE student_app_id= '$student_app_id'");
    if(mysqli_affected_rows($db)>0){
        $success = true;
        $res = mysqli_fetch_assoc($sql);
    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "res"     => $res
    ));
}


/********************* Fetch Camp Teacher Details *********************/

if(isset($_POST["type"]) && $_POST["type"] == "FetchCampteacherDetails")
{
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);

    //echo "SELECT t1.first_name,t2.student_app_id FROM teacher_resource_assignment t1 INNER JOIN class_academic t2 ON t1.teacher_resource_assignment_id=t2.teacher_resource_assignment_id  WHERE t1.teacher_resource_assignment_id= '$teacher_resource_assignment_id'";
    $sql = mysqli_query($db,"SELECT t1.first_name,t2.student_app_id FROM teacher_resource_assignment t1 INNER JOIN class_academic t2 ON t1.teacher_resource_assignment_id=t2.teacher_resource_assignment_id  WHERE t1.teacher_resource_assignment_id= '$teacher_resource_assignment_id'");
    $student_ids = array();
    $student_list = array();
    if(mysqli_affected_rows($db)>0){
        $success = true;
        $res = mysqli_fetch_assoc($sql);
        if(strpos($res['student_app_id'], ','))
            $student_ids = explode(',', $res['student_app_id']);
        else
            $student_ids[] = $res['student_app_id'];

        $student_ids_str = implode(',', $student_ids);
        //echo "SELECT student_name FROM school_application WHERE student_app_id IN ($student_ids_str)";
        $sql2 = "SELECT student_name,student_app_id FROM school_application WHERE student_app_id IN ($student_ids_str)";
        $query2 = mysqli_query($db,$sql2) or die(mysqli_error($db));
        while($row2 = mysqli_fetch_assoc($query2)){
            $student_list[] = $row2;
        }

    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "res"     => $res,
        "student_list" => $student_list
    ));
}



/********************* Add Student Report Form*********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentReportForm')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $student_report_form_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]))
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($student_report_form_id) && !empty($student_report_form_id)){

        

        $q0 = "UPDATE `student_report_form` SET `teacher_resource_assignment_id`='$teacher_resource_assignment_id',`student_app_id`='$student_app_id',`age_year`='$age_year',`age_month`='$age_month',`nationality`='$nationality',`teacher_comment`='$teacher_comment',`first_name`='$first_name',`problem_solving`='$problem_solving',`organizational`='$organizational',`communication`='$communication',`character_skills`='$character_skills',`english_level_start`='$english_level_start',`english_level_end`='$english_level_end' WHERE `student_report_form_id`='$student_report_form_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Student report form updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       
        //echo "INSERT INTO `class_schedules`(`material_name`, `class_name`, `day`, `date`, `time`) VALUES ('$material_name','$class_name','$day','$date','$time')";

       $q0 = "INSERT INTO `student_report_form`(`teacher_resource_assignment_id`, `student_app_id`, `age_year`, `age_month`, `nationality`, `teacher_comment`, `first_name`, `problem_solving`, `organizational`, `communication`, `character_skills`, `english_level_start`, `english_level_end`) VALUES ('$teacher_resource_assignment_id','$student_app_id','$age_year','$age_month','$nationality','$teacher_comment', '$first_name','$problem_solving','$organizational','$communication','$character_skills','$english_level_start','$english_level_end')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Student report form added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/********************* Delete Student Report Form *********************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletestudentreportform")
{
    $id = $_POST['id'];

    //echo "DELETE FROM `transport_vehicles` WHERE  transport_vehicles_id = '$id'"

    $delrecord = mysqli_query($db,"DELETE FROM `student_report_form` WHERE student_report_form_id = '$id'");

    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Student Report Form Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/**********Fetch Attendance for student************/

if(isset($_POST["type"]) && $_POST["type"] == "AttendanceModel")
{
    $success = false;
    $message = "";
    $html = "";
    extract($_POST);

    $sql = mysqli_query($db,"SELECT student_app_id FROM class_academic WHERE class_academic_id='$class_academic_id'");
    if(mysqli_affected_rows($db)>0){
        $success = true;
        $row = mysqli_fetch_assoc($sql);
        $student_app_id = "'".str_replace(",", "','", $row['student_app_id'])."'";
        $sql2 = mysqli_query($db,"SELECT s.*,c.cca_name FROM school_application s LEFT JOIN cca c ON s.student_app_id=c.student_app_id WHERE s.student_app_id IN ($student_app_id)") or die(mysqli_error($db));
        ob_start();
        $i = 1;
        while($data = mysqli_fetch_assoc($sql2)){ 
            
            $one = mysqli_query($db,"SELECT * FROM modal_attendance WHERE student_app_id = '$data[student_app_id]' AND class_academic_id='$class_academic_id'") or die(mysqli_error($db));
            $new_array = array();
            while($two = mysqli_fetch_assoc($one)){
                $attendance_date = strtotime($two['attendance_date']);
                $new_array[] = $attendance_date;
            }
            ?>
            <tr>
                <td><?=$i;$i++;?></td>
                <td><?=$data['student_name'];?></td>
                <td><?=$data['gender'];?></td>
                <td><?=$data['nationality'];?></td>
                <td><?=$data['age_year'];?></td>
                <td><?=$data['cca_name'];?></td>
                <td></td>
                <!-- <td><?=$two['attendance_date'];?></td> -->
                
                    <?php 
                    $date = date('d-M-Y');
                    $ts = strtotime($date);
                    $year = date('o', $ts);
                    $week = date('W', $ts);
                    for($i = 1; $i <= 7; $i++) {
                        $ts = strtotime($year.'W'.$week.$i);
                        $date = date('Y-m-d',$ts);
                        $checked = (in_array($ts, $new_array))?'checked':'';
                    ?>
                        <td><input type="checkbox" name="student_app_id[<?=$ts?>][]" value="<?=$data['student_app_id']?>" <?=$checked;?>></td>
                    <?php  } ?>
                
            </tr>
        <?php } 
        $html = ob_get_clean();
    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "html"    => $html
    ));
}






//AddModalAttendance


if(isset($_POST["type"]) && $_POST["type"] == "AddModalAttendance")
{
    //print_r($_POST);
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);
    // print_r($student_profile_id);

    $student_app_id_array = array();
    foreach ($student_app_id as $key => $value) {
        foreach ($value as $key2 => $value2) {
            // $student_profile_id_array[] = $value2;
            $student_app_id_array[$key][] = $value2;
            $date = date('Y-m-d',$key);
            
            $s = mysqli_query($db,"SELECT * FROM modal_attendance WHERE student_app_id='$value2' AND class_academic_id='$academic_id' AND CAST(attendance_date as DATE) = '$date'");
            if(mysqli_affected_rows($db)>0){
            }
            else{
                $sql = mysqli_query($db,"INSERT INTO `modal_attendance`(`student_app_id`,`class_academic_id`,`attendance_date`,`status`) VALUES ('$value2','$academic_id','$date',1)");
                if(mysqli_affected_rows($db)>0){
                    $success = true;
                    $message = "Attendance marked successfully";
                }
            }
        }
    }
 
    $date = date('d-M-Y');
    $ts = strtotime($date);
    $year = date('o', $ts);
    $week = date('W', $ts);
    for($i = 1; $i <= 7; $i++) {
        $ts = strtotime($year.'W'.$week.$i);
        $timestamp = strtotime(date('Y-m-d',$ts));
        $date = date('Y-m-d',$ts);
        $date.PHP_EOL;
        if(isset($student_app_id_array[$timestamp])){
            $where_not_in = "'".implode("','", $student_app_id_array[$timestamp])."'";
            $sql = "DELETE FROM modal_attendance WHERE student_app_id NOT IN ($where_not_in) AND class_academic_id='$academic_id' AND attendance_date='$date'".PHP_EOL;
        }
        else{
            $sql = "DELETE FROM modal_attendance WHERE class_academic_id='$academic_id' AND attendance_date='$date'".PHP_EOL;
        }
        mysqli_query($db,$sql);
        if(mysqli_affected_rows($db)>0){
            $success = true;
            $message = "Attendance Removed successfully";
        }
    }
    echo json_encode(array(
        "success" => $success,
        "message" => $message,
    ));

}

/***************************************************Team Lucknow ***************************/
/******************************************************* ***************************/


/********************* Add Students in Transports Schedules *********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'ManageScheduleStudents')
{

    $success = false;
    $msg = "";	
    $status=1;	
    extract($_POST);
   
    $students_id=implode(",",$students);	
    if(!empty($id))
	{
       
        $q1 = mysqli_query($db,"UPDATE `transport_students` SET `schedule_id`='$schedule_id',`pick_location`='$pick_location',`drop_loc_id`='$drop_loc_id',`students_id`='$students_id',`driver_id`='$driver_id',`pickup_start_time`='$pick_time',`pickup_end_time`='$till_time',`remark`='$remark',`modify`=now() WHERE `id`='$id'");
        if($q1)
        {
            $success = true;
            $msg= "Record Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }		

    }else {
       
       $q1 = mysqli_query($db,"INSERT INTO `transport_students` SET `schedule_id`='$schedule_id',`pick_location`='$pick_location',`drop_loc_id`='$drop_loc_id',`students_id`='$students_id',`driver_id`='$driver_id',`pickup_start_time`='$pick_time',`pickup_end_time`='$till_time',`remark`='$remark',`status`='$status',`created`=now(),`modify`=now()");
        if($q1)
        {
            $success = true;
            $msg= "Record added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
		
    }
       $url='vtransportStudents.php?sid='.$schedule_id;  
       echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg,
		'url'=>$url
    ));  
}

/********************* Delete Student Report Form *********************/

if(isset($_POST["type"]) && $_POST["type"] == "DeleteStudentSchedule")
{
    $id = $_POST['id'];
    $delrecord = mysqli_query($db,"DELETE FROM `transport_students` WHERE id = '$id'");    
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Student Report Form Deleted Successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}

/********************* Add Transports Schedules *********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'ManageSchedule')
{

    $success = false;
    $msg = "";
    $status=1;	
    extract($_POST);   
    $staff_id1=implode(",",$staff_id);
    

    $sdate = str_replace('/','-',$sdate);
    $sdate = date('Y-m-d',strtotime($sdate));
    $sdate = date('Y-m-d',strtotime($sdate));

    if(isset($id) && !empty($id))
	{
		
        $q1 = mysqli_query($db,"select transport_schedules_id from transport_schedules where driver_id='$driver_id' and transport_schedules_id !='$id'");  
        if(mysqli_num_rows($q1)>0)
        {
            $msg = "Driver is already assigned a job";
        }       
        else
        {
            $q0 = "UPDATE `transport_schedules` SET `schedule_date`='$sdate',`driver_id`='$driver_id',`staff_id`='$staff_id1',`modify`=now(), `route_name`='$route_name', `phone`='$phone', `vehicle`='$vehicle' WHERE `transport_schedules_id`='$id'";


            $q1 = mysqli_query($db,$q0);
            if($q1)
            {
                $success = true;
                $msg= "Transport Schedules Updated successfully.";
            }
            else{
                $msg= "Some Promblem Occur try after sometime.";
            }
		}

    }
    else {
        $q1 = mysqli_query($db,"select transport_schedules_id from transport_schedules where driver_id='$driver_id' ");  
        if(mysqli_num_rows($q1)>0)
        {
            $msg = "Driver is already assigned a job";
        } 
        else { 
            // echo  "INSERT INTO `transport_schedules` SET `schedule_date`='$sdate',`driver_id`='$driver_id',`staff_id`='$staff_id1',`status`='$status',`created`=now(),`modify`=now(), `route_name`='$route_name', `phone`='$phone', `vehicle`='$vehicle'";

            $q1 = mysqli_query($db,"INSERT INTO `transport_schedules` SET `schedule_date`='$sdate',`driver_id`='$driver_id',`staff_id`='$staff_id1',`status`='$status',`created`=now(),`modify`=now(), `route_name`='$route_name', `phone`='$phone', `vehicle`='$vehicle'") or die(mysqli_error($db));
            if($q1)
            {
                $success = true;
                $msg= "Transport Schedules added successfully.";
            }
            else{
                $msg= "Some promblem occur try after sometime.";
            }
		}
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));  
}




/*********************************Fetch locations for scheduling*************************/



if(isset($_POST["type"]) && $_POST["type"]== 'PickupLocation')
{
    $success = true;
    $message = "";
    
    if($_POST["student_pickup"] == 'Danga Bay (Starbucks)'){
        $_POST["student_pickup"] = '1';
    }
    if($_POST['student_pickup'] == 'Teega A (lobby)'){
        $_POST['student_pickup'] = '2';
    }
    if($_POST['student_pickup'] == 'Teega B (lobby)'){
        $_POST['student_pickup'] = '3';
    }
    if($_POST['student_pickup'] == 'Teega Suites (lobby)'){
        $_POST['student_pickup'] = '4';
    }
    if($_POST['student_pickup'] == 'Mall of medini(lobby)'){
        $_POST['student_pickup'] = '5';
    } 
   

    $query = "SELECT t1.* , t2.* FROM school_application as t1 left join transport_routes as t2 on t1.student_app_id = t2.student_app_id where t1.student_pickup ='".$_POST["student_pickup"]."' ";
    $run_query = mysqli_query($db, $query);
    $count = mysqli_num_rows($run_query); 
    $drop_location_str = "";
    if($count > 0)
	{
        $success = true;
		$drop_location_str .= "<option value=''>Select</option>"; 
        while($r1 = mysqli_fetch_array($run_query))
		{      
            $route_id=$r1['student_app_id'];          
            $drop_location=$r1['drop_locations'];          
            $drop_location_str .= "<option value='".$drop_location."'>".$drop_location."</option>";       
        }	
    }
	else
	{
        $drop_location_str = '<option value="">Not available</option>';
    }

    /*$student_list = "";
    $query = "SELECT t1.* , t2.* FROM school_application as t1 left join transport_routes as t2 on t1.student_app_id = t2.student_app_id where t1.student_pickup ='".$_POST["student_pickup"]."' ";
    $run_query = mysqli_query($db, $query) or die(mysqli_error($db));
    $count = mysqli_num_rows($run_query); 
    if($count > 0)
    {
        while($r1 = mysqli_fetch_array($run_query))
        {      
            $std_id=$r1['student_app_id'];
            $std=$r1['student_name'];        
            $student_list .= "<option value='$std_id' selected>$std</option>";
       
        }
    }
    else
    {
        $student_list = '<option value=""> Student not available </option>';
    }*/
    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "drop_location" =>  $drop_location_str
    ));
}





/*if(isset($_POST["type"]) && $_POST["type"]== 'PickupLocation')
{
    
    $query = "SELECT *from transport_routes WHERE pickup_locations = '".$_POST["pickup_location"]."' order by drop_locations asc";   
    $run_query = mysqli_query($db, $query);
    $count = mysqli_num_rows($run_query); 
    if($count > 0)
	{
		 echo "<option value=''>Select</option>"; 
        while($r1 = mysqli_fetch_array($run_query))
		{      
        $route_id=$r1['transport_routes_id'];          
        $drop_location=$r1['drop_locations'];          
        echo "<option value='$route_id'>$drop_location</option>";       
        }	
    }
	else
	{
        echo '<option value="">Not available</option>';
    }
}*/


/*********************************Fetch studendens for scheduling*************************/
if(isset($_POST["type"]) && $_POST["type"]== 'StudentSchedule')
{

    $drop_location_id= $_POST['drop_location_id'];
    $pick_up_location= $_POST['pick_up_location'];
    $student_list = "";
    $message = "";
    $success = "";

    

    if($pick_up_location == 'Danga Bay (Starbucks)'){
        $pick_up_location = 1;       
    }    
    if($pick_up_location == 'Teega A (lobby)'){
        $pick_up_location = 2;       
    }
    if($pick_up_location == 'Teega B (lobby)'){
        $pick_up_location = 3;     
    }
    if($pick_up_location == 'Teega Suites (lobby)'){
        $pick_up_location = 4;      
    }
    if($pick_up_location == 'Mall of medini(lobby)'){
        $pick_up_location = 5;       
    }


    $query =  "SELECT t2.student_app_id,t2.student_name FROM transport_routes t1 INNER JOIN school_application t2 ON t2.student_app_id = t1.student_app_id WHERE pickup_id = '$pick_up_location' AND drop_locations = '$drop_location_id'";
    
    $run_query = mysqli_query($db, $query) or die(mysqli_error($db));
    $count = mysqli_num_rows($run_query); 
    if($count > 0)
	{
        $success = true;
        while($r1 = mysqli_fetch_array($run_query))
		{     
            $std_id=$r1['student_app_id'];
            // print_r($std_id);
            $std=$r1['student_name'];        
            $student_list .= "<option value='$std_id'>$std</option>";
       
        }
		
	
    }
	else
	{
        $student_list = '<option value="">Student not available</option>';
    }
    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "student_list" => $student_list
    ));
}

/*if(isset($_POST["type"]) && $_POST["type"]== 'StudentSchedule')
{
    $route_id= $_POST['route_id'];
    $query = "SELECT t1.*,t2.first_name,t2.middle_name,t2.last_name FROM school_application as t1
    join student_profile as t2
	on t1.student_profile_id=t2.student_profile_id
	WHERE t1.transport_student = '1' and t1.route_id='$route_id'";  
    $run_query = mysqli_query($db, $query);
    $count = mysqli_num_rows($run_query); 
    if($count > 0)
	{
       
        while($r1 = mysqli_fetch_array($run_query))
		{      
        $std_id=$r1['student_profile_id'];
        $std=$r1['first_name'].' '.$r1['middle_name'].' '.$r1['last_name'];        
        echo "<option value='$std_id'>$std</option>";
       
        }
		
	
    }
	else
	{
        echo '<option value="">Student not available</option>';
    }
}*/

/**************************Update schedule status*************************************/


if(isset($_POST["type"]) && $_POST["type"] == "IncedentstatusUpdate")
{
    $id = $_POST['id'];

    $updaterecord = mysqli_query($db,"UPDATE `transport_incident_reports` SET `status`='1' WHERE transport_incident_reports_id = '$id'");

    
    if($updaterecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Incident status updated successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Updating."
        ));
    }

}

/*
 * Fetch Schedule Details
 */
if(isset($_POST["type"]) && $_POST["type"] == "EditSchedule")
{
 $id = $_POST['id'];
  $query = "SELECT * FROM transport_schedules WHERE transport_schedules_id = '$id'";  
  $result = mysqli_query($db, $query);  
  $row = mysqli_fetch_array($result);  
  echo json_encode($row); 
    
}

// Student Profile -updated

// Student Profile -updated

/*if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentProfile')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    $student_id = $_POST['studentid'];
    $camp_management_id = implode(',',$camp_management_id);
    
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["student_picture"]))
    {
        $target_dir = "../uploads/";
        
        $target_file = $target_dir . basename($_FILES["student_picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["student_picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["student_picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",student_picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
   
    if ($uploadOk == 0) {
        $success=false;
    }
    else
    {
    if(isset($studentid) && !empty($studentid)){
        $q2=mysqli_query($db,"select std_email from student_profile where std_email='$email' and student_profile_id!='$student_id'");
        if(mysqli_num_rows($q2)>0)
        {
        $msg= "Email already available.";   
        }
        else{
        $q0 = "UPDATE student_profile SET `student_app_id`='$student_app_id', `camp_management_id`='$camp_management_id',`first_name`='$first_name', `last_name`='$last_name' $fileListimg , `standard`='$standard', `gender`='$gender', `nationality`='$nationality', `age_year`='$age_year', `age_month`='$age_month', `grade`='$grade', `address`='$address' ,`boarding_room_id`='$boarding_room_id' where student_profile_id='$student_app_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {               
        $success = true;
        $msg= "Student Profile  updated successfully."; 
        }
        else{
            $msg= "Some Problem Occur try after sometime.";
        }
        }

    }else {
       
       $q2=mysqli_query($db,"select std_email from student_profile where std_email='$email'");
        if(mysqli_num_rows($q2)>0)
        {
        $msg= "Email already available.";   
        }
        else{
        $q0 = "INSERT INTO `student_profile` SET `student_app_id`='$student_app_id', `camp_management_id`='$camp_management_id', `std_email`='$email',`first_name`='$first_name', `last_name`='$last_name',`student_picture`='$filename',`standard`='$standard',`gender`='$gender',`nationality`='$nationality',`age_year`='$age_year',`age_month`='$age_month',`grade`='$grade',`address`='$address' ,`boarding_room_id`='$boarding_room_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
        
           $success = true;
            $msg= "Student Profile added successfully.";
        }
        else{
            $msg= "Some problem occur try after sometime.";
        }
        }
    }
}

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}*/



if(isset($_POST["type"]) && $_POST["type"]== 'AddStudentProfile')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    unset($_POST['type']);
    unset($_POST['txtid']);
    $student_app_id = $_POST['student_app_id'];
    //$camp_management_id = implode(',',$camp_management_id);

    if(!isset($_POST['allergies'])){
        $_POST['allergies'] = 'No';
    }
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);
    $stm_update = "";

    if(!isset($_POST['boarding_req'])){
        $_POST['boarding_req'] = 0;
    }
    if(!isset($_POST['boarding_allocation_req'])){
        $_POST['boarding_allocation_req'] = 0;
    }
    if(!isset($_POST['siblings'])){
        $_POST['siblings'] = 0;
    }
    if(!isset($_POST['support'])){
        $_POST['support'] = 0;
    }
    if(!isset($_POST['transport_student'])){
        $_POST['transport_student'] = 0;
    }
    if(!isset($_POST['illnesses'])){
        $_POST['illnesses'] = 0;
    }
    if(!isset($_POST['allergies'])){
        $_POST['allergies'] = 0;
    }
    if(!isset($_POST['mental_impairments'])){
        $_POST['mental_impairments'] = 0;
    }
    if(!isset($_POST['slept_away'])){
        $_POST['slept_away'] = 0;
    }
    if(!isset($_POST['asthma'])){
        $_POST['asthma'] = 0;
    }
    if(!isset($_POST['inhaler'])){
        $_POST['inhaler'] = 0;
    }
    if(!isset($_POST['hearing'])){
        $_POST['hearing'] = 0;
    }
    if(!isset($_POST['daily_medication'])){
        $_POST['daily_medication'] = 0;
    }
    if(!isset($_POST['child_swim'])){
        $_POST['child_swim'] = 0;
    }
    if(!isset($_POST['lenses'])){
        $_POST['lenses'] = 0;
    }
    if(isset($_POST['dob'])){
        $_POST['dob'] = date('Y-m-d',strtotime($_POST['dob']));
    }
    if(isset($_POST['$ack_date1'])){
        $_POST['$ack_date1'] = date('Y-m-d',strtotime($_POST['$ack_date1']));
        
    }
    if(isset($_POST['ack_date2'])){
        $_POST['ack_date2'] = date('Y-m-d',strtotime($_POST['ack_date2']));
        
    }
    if(isset($_POST['date_head'])){
        $_POST['date_head'] = date('Y-m-d',strtotime($_POST['date_head']));
        
    }if(isset($_POST['info_other_date1'])){
        $_POST['info_other_date1'] = date('Y-m-d',strtotime($_POST['info_other_date1']));
        
    }if(isset($_POST['info_other_date2'])){
        $_POST['info_other_date2'] = date('Y-m-d',strtotime($_POST['info_other_date2']));
        
    }if(isset($_POST['other_sign_student_date1'])){
        $_POST['other_sign_student_date1'] = date('Y-m-d',strtotime($_POST['other_sign_student_date1']));
    }
    if(isset($_POST['office_date'])){
        $_POST['office_date'] = date('Y-m-d',strtotime($_POST['office_date']));
    }
    
    foreach ($_POST as $key=>$val){
        if($key != 'student_app_id'){
            if(is_array($val)){
                $val = implode(',', $_POST[$key]);
                unset($_POST[$key]);
            }
            else{
                $val = mysqli_real_escape_string($db,$val);
            }
          $stm_update.="".$key."='$val',";
        }
    }
    $stm_update=substr($stm_update, 0, -1);

    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";
    $filename1="";
    $uploadOk1 = 1;
    $fileListimg1="";
    $filename2="";
    $uploadOk2 = 1;
    $fileListimg2="";
    $filename4="";
    $uploadOk4 = 1;
    $fileListimg4="";



    if (isset($_FILES["passport_copy"]))
    {
        $target_dir = "../uploads/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["passport_copy"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["passport_copy"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG","pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=uniqid().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["passport_copy"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",passport_copy='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",passport_copy='$filename'";
    }



    if (isset($_FILES["travel_insurance"]))
    {
        $target_dir1 = "../uploads/";
        // $path = "upload/product/";
        $target_file1 = $target_dir1 . basename($_FILES["travel_insurance"]["name"]);
        $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
        if ($_FILES["travel_insurance"]["size"] > 52428800) {
            $msg1=  "Sorry, your file is too large.";
            $uploadOk1 = 0;
        }
        $extallowed1 = array("jpg","jpeg","png","JPG","JPEG","PNG","pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType1),$extallowed1)){
            $msg1 = "Sorry,For jpg & png extension files are allowed";
            $status1 = false;
            $uploadOk1 = 0;
        }

        $filename1=uniqid().'.'.$imageFileType1;
        $filepath1=$target_dir1.$filename1;
        if ($uploadOk1 != 0) {

            if (move_uploaded_file($_FILES["travel_insurance"]["tmp_name"], $filepath1)) {
                $filename1=$filename1;
                $fileListimg1=",travel_insurance='$filename1'";
            } else {
                $uploadOk1 = 0;
                $msg1 = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename1='';
        $fileListimg1=",travel_insurance='$filename1'";
    }



    if (isset($_FILES["student_photo"]))
    {
        $target_dir2 = "../uploads/";
        // $path = "upload/product/";
        $target_file2 = $target_dir2 . basename($_FILES["student_photo"]["name"]);
        $imageFileType2 = pathinfo($target_file2,PATHINFO_EXTENSION);
        if ($_FILES["student_photo"]["size"] > 52428800) {
            $msg2=  "Sorry, your file is too large.";
            $uploadOk2 = 0;
        }
        $extallowed2 = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType2),$extallowed2)){
            $msg2 = "Sorry,For jpg & png extension files are allowed";
            $status2 = false;
            $uploadOk2 = 0;
        }

        $filename2=uniqid().'.'.$imageFileType2;
        $filepath2=$target_dir2.$filename2;
        if ($uploadOk2 != 0) {

            if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $filepath2)) {
                $filename2=$filename2;
                $fileListimg2=",student_photo='$filename2'";
            } else {
                $uploadOk2 = 0;
                $msg2 = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename2='';
        $fileListimg2=",student_photo='$filename2'";
    }
    
    
   if (isset($_FILES["final_application_form"]))
    {
        $target_dir4 = "../uploads/";
        // $path = "upload/product/";
        $target_file4 = $target_dir4 . basename($_FILES["final_application_form"]["name"]);
        $imageFileType4 = pathinfo($target_file4,PATHINFO_EXTENSION);
        if ($_FILES["final_application_form"]["size"] > 52428800) {
            $msg4=  "Sorry, your file is too large.";
            $uploadOk4 = 0;
        }
        $extallowed4 = array("jpg","jpeg","png","JPG","JPEG","PNG","pdf","doc","docx","txt","xls","xlsx","csv");
        if (!in_array(strtolower($imageFileType4),$extallowed4)){
            $msg4 = "Sorry,For jpg & png extension files are allowed";
            $status4 = false;
            $uploadOk4 = 0;
        }

        $filename4=uniqid().'.'.$imageFileType4;
        $filepath4=$target_dir4.$filename4;
        if ($uploadOk4 != 0) {

            if (move_uploaded_file($_FILES["final_application_form"]["tmp_name"], $filepath4)) {
                $filename4=$filename4;
                $fileListimg4=",final_application_form='$filename4'";
            } else {
                $uploadOk4 = 0;
                $msg4 = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename4='';
        $fileListimg4=",final_application_form='$filename4'";
    }
    

    $user_id = isset($_SESSION['userLoggedin']);
    //echo "SELECT * FROM users WHERE uid='$user_id'";
    

    if(isset($student_app_id) && !empty($student_app_id)){

        //echo "update `student_profile` set `student_app_id`='$student_app_id',`uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2 $fileListimg4 where `student_app_id`=$student_app_id";
        $q0 = "update `student_profile` set `student_app_id`='$student_app_id',`uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2 $fileListimg4 where `student_app_id`=$student_app_id";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));
        if($q1)
        {
            $success = true;
            $msg= "Student Profile updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {

        echo "INSERT INTO `student_profile` set `student_app_id`='$student_app_id',`uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2 $fileListimg4"; 
        $q0 = "INSERT INTO `student_profile` set `student_app_id`='$student_app_id',`uid`='$user_id', $stm_update $fileListimg $fileListimg1 $fileListimg2 $fileListimg4";
        $q1 = mysqli_query($db,$q0);
        $last_id = mysqli_insert_id($db);
        $student_app_id = mysqli_insert_id($db);

       
        if($q1)
        {
            $success = true;
            $msg= "Application added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}



//Delete Student Profile

if(isset($_POST["type"]) && $_POST["type"] == "DeleteStudentProfile")
{
    $student_profile_id = $_POST['student_profile_id'];
    //echo "DELETE FROM student_profile WHERE student_profile_id = '$student_profile_id'";
    $delrecord = mysqli_query($db,"DELETE FROM student_profile WHERE student_profile_id = '$student_profile_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Student Profile Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



/**************** Add Teacher / Resource Assignment ******************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddTeacherAssignment')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $teacher_resource_assignment_id = $_POST['txtid'];
    
  
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";

    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
       
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }
	  if(isset($_FILES['resume']) && $_FILES['resume']['name'] != "")
      {
	   $file1 = $_FILES['resume'];
        $target_dir1 = "../upload/";
        $target_file1 = $target_dir1 . basename($file1["name"]);
        $sysFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
        if ($file1["size"] > 50*MB) {
            $msg=  "Sorry, your doc file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("doc","docx","pdf");
        if (!in_array(strtolower($sysFileType),$extallowed)){
            $msg = "Sorry,For  doc file doc & pdf extension files are allowed";
            $uploadOk = 0;
        }
         $filename1=uniqid().".".$sysFileType;
         $filepath1=$target_dir1.$filename1;
		 $filename1=uniqid().".".$sysFileType;
         $filepath1=$target_dir1.$filename1;
		  move_uploaded_file($file1["tmp_name"], $filepath1);
	  }
	  else{
		  $filename1=$doc1;  
	  }

    if(isset($teacher_resource_assignment_id) && !empty($teacher_resource_assignment_id)){   
        if(empty($filename)){
            $sql = "SELECT image FROM teacher_resource_assignment WHERE teacher_resource_assignment_id='$teacher_resource_assignment_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }
		 $q2=mysqli_query($db,"select email_id from teacher_resource_assignment where email_id='$email_id' and `teacher_resource_assignment_id`!='$teacher_resource_assignment_id'");
		if(mysqli_num_rows($q2)>0)
		{
		$msg= "Email already available.";	
		}
		else{
        $q0 = "UPDATE `teacher_resource_assignment` SET `first_name`='$first_name',`last_name`='$last_name',`id_number`='$id_number',`designation`='$designation',`mobile_number`=$mobile_number,`address`='$address',`image`='$filename',`doc`='$filename1' WHERE `teacher_resource_assignment_id`='$teacher_resource_assignment_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Teacher Assignment Updated successfully.";
        }
        else{
            $msg= "Some problem Occur try after sometime.";
        }
		}

    }else {
       
       $q2=mysqli_query($db,"select email_id from teacher_resource_assignment where email_id='$email_id'");
		if(mysqli_num_rows($q2)>0)
		{
		$msg= "Email already available.";	
		}
		else{
       $q0 = "INSERT INTO `teacher_resource_assignment`(`first_name`, `last_name`, `id_number`, `designation`, `mobile_number`, `email_id`, `address`, `image`,`doc`) VALUES ('$first_name','$last_name','$id_number','$designation','$mobile_number','$email_id','$address','$filename','$filename1')";
        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Teacher Assignment added successfully.";
        }
        else{
            $msg= "Some problem occur try after sometime.";
        }
		}
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/*********************** Add Class Schedules *********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'Addclassschedules')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $class_schedules_id = $_POST['txtid'];
    


    if(isset($class_schedules_id) && !empty($class_schedules_id)){

        

        $q0 = "UPDATE `class_schedules` SET `camp_id`='$camp_name',`class_name`='$class_name',`day`='$day',`date`='$date',`time`='$time' WHERE `class_schedules_id`='$class_schedules_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Class Schedules Updated successfully.";
        }
        else{
            $msg= "Some Problem Occur try after sometime.";
        }

    }else {
       
      
       $q0 = "INSERT INTO `class_schedules`(`camp_id`, `class_name`, `day`, `date`, `time`) VALUES ('$camp_name','$class_name','$day','$date','$time')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Class Schedules added successfully.";
        }
        else{
            $msg= "Some problem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}



/***********************Add Class Academic*********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddClassAcademic')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
	
    $class_academic_id = $_POST['txtid'];
     $teacher_resource_assignment_id=implode(",",$teacher_resource_assignment_id);
    $student_app_id = implode(',',$student_app_id);	
    if(isset($class_academic_id) && !empty($class_academic_id)){
		
        $q0 = $q0 = "UPDATE `class_academic` SET `class_academic_name`='$class_academic_name',`start_date`='$start_date',`finish_date`='$finish_date',`student_app_id`='$student_app_id',`schedule`='$schedule',`teacher_resource_assignment_id`='$teacher_resource_assignment_id',`camp_management_id`='$camp_management_id',`school_staff_id`='$school_staff_id' ,`class_room_id`='$class_room_id' WHERE `class_academic_id`='$class_academic_id'" ;

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Class Academic Updated successfully.";
        }
        else{
            $msg= "Some problem Occur try after sometime.";
        }

    }else {
       
    
      $q0 = "INSERT INTO `class_academic`(`class_academic_name`, `start_date`, `finish_date`, `student_app_id`, `schedule`,`teacher_resource_assignment_id`,`camp_management_id`,`school_staff_id` , `class_room_id`) VALUES ('$class_academic_name','$start_date', '$finish_date','$student_app_id','$schedule','$teacher_resource_assignment_id','$camp_management_id','$school_staff_id' ,'$class_room_id' )";
        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Class Academic added successfully.";
        }
        else{
            $msg= "Some problem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/***********************Add CCA (Sporting)*********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddCCA')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $cca_id = $_POST['txtid'];
     $teachers_id=implode(",",$teachers_id);	
     $student_app_id = implode(',',$student_app_id);
     
    $start_date = str_replace('/','-',$start_date);
    $start_date = date('Y-m-d',strtotime($start_date));
    $start_date = date('Y-m-d',strtotime($start_date));
    
    $finish_date = str_replace('/','-',$finish_date);
    $finish_date = date('Y-m-d',strtotime($finish_date));
    $finish_date = date('Y-m-d',strtotime($finish_date));
   
    if(isset($cca_id) && !empty($cca_id)){
        $q0 = "UPDATE `cca` SET `cca_name`='$cca_name',`student_app_id`='$student_app_id',`start_date`='$start_date',`finish_date`='$finish_date',`schedule`='$schedule', `teachers_id`= '$teachers_id', `cca_group`='$cca_group' WHERE `cca_id`='$cca_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "CCA Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
        $q0 = "INSERT INTO `cca`(`cca_name`, `student_app_id`, `start_date`,`finish_date`, `schedule`,`teachers_id`, `cca_group`) VALUES ('$cca_name','$student_app_id','$start_date','$finish_date','$schedule','$teachers_id','$cca_group')";
        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "CCA added successfully.";
        }
        else{
            $msg= "Some problem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}




/***********************Add Creative Classes*********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddCreativeClasses')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $creative_classes_id = $_POST['txtid'];
    $teachers_id=implode(",",$teachers_id);	
    $student_app_id=implode(",",$student_app_id);	
    
    $start_date = str_replace('/','-',$start_date);
    $start_date = date('Y-m-d',strtotime($start_date));
    $start_date = date('Y-m-d',strtotime($start_date));
    
    $finish_date = str_replace('/','-',$finish_date);
    $finish_date = date('Y-m-d',strtotime($finish_date));
    $finish_date = date('Y-m-d',strtotime($finish_date));
   
    if(isset($creative_classes_id) && !empty($creative_classes_id))
	{        

        $q0 = "UPDATE `creative_classes` SET `classes_name`='$classes_name',`start_date`='$start_date',`finish_date`='$finish_date',`student_app_id`='$student_app_id',`teachers_id`='$teachers_id', `schedule`='$schedule',`creative_group`='$creative_group' WHERE `creative_classes_id`='$creative_classes_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Creative Classes Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
        $q0 = "INSERT INTO `creative_classes`(`classes_name`, `start_date`, `finish_date`, `student_app_id`, `schedule` , `teachers_id` , `creative_group`) VALUES ('$classes_name','$start_date', '$finish_date','$student_app_id','$schedule', '$teachers_id' ,'$creative_group')";
       $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Creative Classes added successfully.";
        }
        else{
            $msg= "Some problem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


/*********************** Add Boarding Activities *********************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'AddBoardingActivities')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $boarding_activities_id = $_POST['txtid'];
  $teachers_id=implode(",",$teachers_id);	
    $student_app_id=implode(",",$student_app_id);	
    
    $start_date = str_replace('/','-',$start_date);
    $start_date = date('Y-m-d',strtotime($start_date));
    $start_date = date('Y-m-d',strtotime($start_date));
    
    $finish_date = str_replace('/','-',$finish_date);
    $finish_date = date('Y-m-d',strtotime($finish_date));
    $finish_date = date('Y-m-d',strtotime($finish_date));
   
    if(isset($boarding_activities_id) && !empty($boarding_activities_id))
	{       

        $q0 = "UPDATE `boarding_activities` SET `boarding_activities_name`='$boarding_activities_name',`start_date`='$start_date',`finish_date`='$finish_date',`student_app_id`='$student_app_id',`schedule`='$schedule',`teachers_id`='$teachers_id' WHERE `boarding_activities_id`='$boarding_activities_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Boarding Activities Updated successfully.";
        }
        else{
            $msg= "Some problem Occur try after sometime.";
        }

    }else {
       
       $q0 = "INSERT INTO `boarding_activities`(`boarding_activities_name`, `start_date`, `finish_date`, `student_app_id`, `schedule`,`teachers_id`) VALUES ('$boarding_activities_name','$start_date', '$finish_date','$student_app_id','$schedule','$teachers_id')";
        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Boarding Activities added successfully.";
        }
        else{
            $msg= "Some problem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}




// Schedule Details transport

if(isset($_POST["list_id"]))
{
  $output = '';
  $id = $_POST['list_id'];
      $result = mysqli_query($db, "SELECT t1.*,
                                    concat(t2.first_name,' ',t2.last_name) as full_name,
                                    t2.mobile_number,
                                    t3.student_app_id,
                                    t3.student_name
                                    FROM transport_students t1
                                    LEFT JOIN transport_drivers t2 
                                    ON t1.driver_id = t2.transport_drivers_id 
                                    LEFT JOIN school_application t3
                                    ON t1.students_id = t3.student_app_id
                                    WHERE t1.id = $id" );  
      echo '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($r1 = mysqli_fetch_array($result))  
      {  
              ?>
		   <tr>  
                     <th width="30%"><label>Pick Address</label></th>  
                     <td width="70%"><?php echo $r1["pick_location"];?></td>  
                </tr> 
				<tr>  
                     <th width="30%"><label>Drop Address</label></th>  
                     <td width="70%"><?php echo $r1["drop_loc_id"];?></td>  
                </tr>
				<tr>  
                     <th width="30%"><label>Students</label></th>  
                     <td width="70%"><?php echo $r1["student_name"];?>                        		 

                </tr>
				 <tr>  
                     <th width="30%"><label>Pickup Time</label></th>  
                     <td width="70%"><?php echo $r1["pickup_start_time"].' - '.$r1["pickup_end_time"];?></td>  
					  <tr>  
                     <th width="30%"><label>Remarks</label></th>  
                     <td width="70%"><?php echo $r1["remark"];?></td>  
                </tr> 
        
     <?php }  
      echo  "</table></div>";  
     // echo $output;  
    
}



/*if(isset($_POST["list_id"]))
{
  $output = '';
  $id = $_POST['list_id'];
      $result = mysqli_query($db, "SELECT t1.*,t2.drop_locations from transport_students as t1 join transport_routes as t2 on t1.drop_loc_id=t2.transport_routes_id where t1.id='$id'");  
      echo '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($r1 = mysqli_fetch_array($result))  
      {  
              ?>
		   <tr>  
                     <th width="30%"><label>Pick Address</label></th>  
                     <td width="70%"><?php echo $r1["pick_location"];?></td>  
                </tr> 
				<tr>  
                     <th width="30%"><label>Drop Address</label></th>  
                     <td width="70%"><?php echo $r1["drop_locations"];?></td>  
                </tr>
				<tr>  
                     <th width="30%"><label>Students</label></th>  
                     <td width="70%"><?php 
					 
					 $q2=mysqli_query($db,"SELECT t1.*,t2.first_name,t2.middle_name,t2.last_name FROM school_application as t1 join student_profile as t2 on t1.student_profile_id=t2.student_profile_id WHERE t1.student_profile_id IN(".$r1["students_id"].")"); 
		   while($r2=mysqli_fetch_assoc($q2))
		   {
			$std=$r2['first_name'].' '.$r2['middle_name'].' '.$r2['last_name'];  
			echo $std.',';
		   }
			?>		 

                </tr>
				 <tr>  
                     <th width="30%"><label>Pickup Time</label></th>  
                     <td width="70%"><?php echo $r1["pickup_start_time"].' - '.$r1["pickup_end_time"];?></td>  
					  <tr>  
                     <th width="30%"><label>Remarks</label></th>  
                     <td width="70%"><?php echo $r1["remark"];?></td>  
                </tr> 
        
     <?php }  
      echo  "</table></div>";  
     // echo $output;  
    
}*/


/**************************** Add Class Room *************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'Addclassroom')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $class_room_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";
    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($class_room_id) && !empty($class_room_id)){   
        if(empty($filename)){
            //$sql = "SELECT image FROM class_room WHERE class_room_id='$class_room_id'";
            //$query = mysqli_query($db,$sql) or die(mysqli_error($db));
            //$data = mysqli_fetch_assoc($query);
            //$filename = $data['image'];
        }
        //echo $q0 = "UPDATE `class_room` SET `class_room_number`='$class_room_number',`building_number`='$building_number' WHERE `class_room_id`='$class_room_id'";    
        $q0 = "UPDATE `class_room` SET `class_room_number`='$class_room_number',`building_number`='$building_number' WHERE `class_room_id`='$class_room_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Class Room Updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
        $q0 = "INSERT INTO `class_room`(`class_room_number`, `building_number`) VALUES ('$class_room_number', '$building_number')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Class Room added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}





/************************** Delete Class Room ************************/

if(isset($_POST["type"]) && $_POST["type"] == "Deleteclassroom")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM `class_room` WHERE  class_room_id = '$id'");
    //$delrecord4 = mysqli_query($db,"DELETE FROM add_reviews WHERE user_id='$id'");
    //$delrecord2 = mysqli_query($db,"DELETE FROM login WHERE login_id='$id'");
    if($delrecord )//&& $delrecord4 && $delrecord2)
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Class Room Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}



// Add Boarding Room

if(isset($_POST["type"]) && $_POST["type"]== 'AddBoardingRoom')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    //unset($_POST['type']);
    $boarding_room_id = $_POST['boarding_room_id'];
    //$student_app_id = implode(',',$student_app_id);
    //print_r($student_idcard_id);

    if(isset($boarding_room_id) && !empty($boarding_room_id)){

        
        $q0 = "UPDATE boarding_room SET `boarding_room_number`='$boarding_room_number',`floor_number`='$floor_number',`buiding_number`='$buiding_number',`boarding_staff_id`='$boarding_staff_id' where boarding_room_id='$boarding_room_id'";

        //echo "UPDATE boarding_room SET `boarding_room_number`='$boarding_room_number',`floor_number`='$floor_number',`buiding_number`='$buiding_number',`boarding_staff_id`='$boarding_staff_id' where boarding_room_id='$boarding_room_id'";

        $q1 = mysqli_query($db,$q0) or die(mysqli_error($db));;
        if($q1)
        {
            $success = true;
            $msg= "Boarding Room updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
       

        $q0 = "INSERT INTO `boarding_room`(`boarding_room_number`,`floor_number`,`buiding_number`,`boarding_staff_id`) VALUES ('$boarding_room_number','$floor_number','$buiding_number','$boarding_staff_id')";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Boarding Room added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }


    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}


// Delete Boarding Room  Card

if(isset($_POST["type"]) && $_POST["type"] == "DeleteBoadingRoom")
{
    $boarding_room_id = $_POST['id'];
    //echo "DELETE FROM testing_result WHERE test_result_id = '$test_result_id'";
    $delrecord = mysqli_query($db,"DELETE FROM boarding_room WHERE boarding_room_id = '$boarding_room_id'");
    //echo $deacrecord;
    if($delrecord)
    {
        echo json_encode(array(
            "success"=>true,
            "message" => "Boarding Room Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "success"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


 //adminfunction Transport Routes 

if(isset($_POST["type"]) && $_POST["type"] == "FetchStudentRoutes")
{
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);
    // $student_profile_id = "'".implode("','", $student_profile_id)."'";

    $sql = mysqli_query($db,"SELECT student_pickup FROM school_application WHERE student_app_id= '$student_app_id'");
    //print_r($sql['student_pickup']);
   

    if(mysqli_affected_rows($db)>0){
        $success = true;
        $res = mysqli_fetch_assoc($sql);

        if($res['student_pickup'] == '1'){
            $res['student_pickup'] = 'Danga Bay (Starbucks)';
            $res['pickup_id'] = '1';
        }   
        if($res['student_pickup'] == '2'){
            $res['student_pickup'] = 'Teega A (lobby)';
            $res['pickup_id'] = '2';
        }
        if($res['student_pickup'] == '3'){
            $res['student_pickup'] = 'Teega B (lobby)';
            $res['pickup_id'] = '3';
        }
        if($res['student_pickup'] == '4'){
            $res['student_pickup'] = 'Teega Suites (lobby)';
            $res['pickup_id'] = '4';
        }
        if($res['student_pickup'] == '5'){
            $res['student_pickup'] = 'Mall of medini(lobby)';
            $res['pickup_id'] = '5';
        } 
    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "res"     => $res
    ));
}



/**********Fetch Schedule for student************/

if(isset($_POST["type"]) && $_POST["type"] == "TransportModel")
{
    $success = false;
    $message = "";
    $html = "";
    extract($_POST);

    $sql = mysqli_query($db,"SELECT driver_id FROM transport_schedules WHERE transport_schedules_id='$transport_schedules_id'");

    if(mysqli_affected_rows($db)>0){
        $success = true;
        $row = mysqli_fetch_assoc($sql);
        $driver_id = "'".str_replace(",", "','", $row['driver_id'])."'";
        //echo $student_app_id;

        $sql2 = mysqli_query($db,"SELECT t1.*,t2.first_name,t2.last_name,t3.student_app_id,t3.student_name,t3.nationality,t3.age_year FROM transport_students as t1 LEFT JOIN transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id LEFT JOIN school_application as t3 on t1.students_id=t3.student_app_id WHERE schedule_id='$transport_schedules_id'") or die(mysqli_error($db));

        //echo "SELECT t1.*,t2.first_name,t2.last_name FROM transport_schedules as t1 join transport_drivers as t2 on t1.driver_id=t2.transport_drivers_id";

        //echo "SELECT s.* FROM transport_schedules s WHERE s.driver_id IN ($driver_id)";

        ob_start();

        $i = 1;
        while($data = mysqli_fetch_assoc($sql2)){ 
            
            $one = mysqli_query($db,"SELECT * FROM modal_schedule WHERE student_app_id = '$data[student_app_id]'  AND transport_schedules_id='$transport_schedules_id'") or die(mysqli_error($db));

           // echo "SELECT * FROM modal_schedule WHERE transport_drivers = '$data[driver_id]' AND transport_schedules_id='$transport_schedules_id'";

            $new_array = array();

            while($two = mysqli_fetch_assoc($one)){
                $attendance_date = strtotime($two['attendance_date']);
                $new_array[] = $attendance_date;
            }
            ?>
            <tr>
                <td><?=$i;$i++;?></td>
                <td><?=$data['first_name'].' '.$data['last_name'];?></td>
                <td><?=$data['student_name'];?></td>
                <td><?=$data['nationality'];?></td>
                <td><?=$data['age_year'];?></td>
             
                <!-- <td><?=$two['attendance_date'];?></td> -->
                
                    <?php 
                    $date = date('d-M-Y');
                    $ts = strtotime($date);
                    $year = date('o', $ts);
                    $week = date('W', $ts);
                    for($i = 1; $i <= 7; $i++) {
                        $ts = strtotime($year.'W'.$week.$i);
                        $date = date('Y-m-d',$ts);
                        $checked = (in_array($ts, $new_array))?'checked':'';
                    ?>
                        <td><input type="checkbox" name="student_app_id[<?=$ts?>][]" value="<?=$data['student_app_id']?>" <?=$checked;?>></td>
                    <?php  } ?>
                
            </tr>
        <?php } 
        $html = ob_get_clean();
    }

    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "html"    => $html
    ));
}




if(isset($_POST["type"]) && $_POST["type"] == "AddModalTransport")
{
    //print_r($_POST);
    $success = false;
    $message = "";
    $res = array();
    extract($_POST);
    // print_r($student_profile_id);

    $student_app_id_array = array();
    if(isset($student_app_id)){
        foreach ($student_app_id as $key => $value) {
            foreach ($value as $key2 => $value2) {
                // $student_profile_id_array[] = $value2;
                $student_app_id_array[$key][] = $value2;
                $date = date('Y-m-d',$key);
                
                $s = mysqli_query($db,"SELECT * FROM modal_schedule WHERE student_app_id='$value2' AND transport_schedules_id='$transport_id' AND CAST(attendance_date as DATE) = '$date'");
                if(mysqli_affected_rows($db)>0){
                }
                else{
                    $sql = mysqli_query($db,"INSERT INTO `modal_schedule`(`student_app_id`,`transport_schedules_id`,`attendance_date`,`status`) VALUES ('$value2','$transport_id','$date',1)");
                    if(mysqli_affected_rows($db)>0){
                        $success = true;
                        $message = "Transport Attendance marked successfully";
                    }
                }
            }
        }
    }
 
    $date = date('d-M-Y');
    $ts = strtotime($date);
    $year = date('o', $ts);
    $week = date('W', $ts);
    for($i = 1; $i <= 7; $i++) {
        $ts = strtotime($year.'W'.$week.$i);
        $timestamp = strtotime(date('Y-m-d',$ts));
        $date = date('Y-m-d',$ts);
        $date.PHP_EOL;
        if(isset($student_app_id_array[$timestamp])){
            $where_not_in = "'".implode("','", $student_app_id_array[$timestamp])."'";
            $sql = "DELETE FROM modal_schedule WHERE student_app_id NOT IN ($where_not_in) AND transport_schedules_id='$transport_id' AND attendance_date='$date'".PHP_EOL;
        }
        else{
            $sql = "DELETE FROM modal_schedule WHERE transport_schedules_id='$transport_id' AND attendance_date='$date'".PHP_EOL;
        }
        mysqli_query($db,$sql);
        if(mysqli_affected_rows($db)>0){
            $success = true;
            $message = "Transport Attendance Removed successfully";
        }
    }
    echo json_encode(array(
        "success" => $success,
        "message" => $message,
    ));

}


/*******************Change*********************/

if(isset($_POST['ajax_changepassword']))
 {
    

    $adminid =isset($_SESSION['adminloggedin'])?$_SESSION['adminloggedin']:'';
     $userid = isset($_SESSION['userLoggedin'])?$_SESSION['userLoggedin']:'';
    $current_password  = $_POST['ajax_current_password'] ;
    $new_password   = $_POST['ajax_new_password'];
    $confirm_password   = $_POST['ajax_confirm_password'];

        if((isset($adminid)) || (isset($userid)))
        {
            $data = mysqli_fetch_assoc(mysqli_query($db,"select * from admin where `id` = '$adminid'"));
             if ($current_password == $data['password'])
            {
                $query =  mysqli_query($db,"UPDATE `admin` SET `password`= '$new_password' WHERE `id` = '$adminid'");
                if($query)
                {
                    
                    echo json_encode(array(
                        "valid"=>1,
                        "message" => "Password updated successfully"
                    ));
                }
                else
                {
                    echo json_encode(array(
                        "valid"=>0,
                        "message" => "Password Cannot be Updated."
                    ));
                }

            }
        
            else
            {
           
                $new_password = encrypt_password($new_password);
                $data = mysqli_fetch_assoc(mysqli_query($db,"select * from users where `uid` = '$userid'"));
                if (verify_password($current_password, $data['password']))
                    {
                    $query =  mysqli_query($db,"UPDATE `users` SET `password`= '$new_password' WHERE `uid` = '$userid'");
                    if($query)
                    {
                        
                        echo json_encode(array(
                            "valid"=>1,
                            "message" => "Password updated successfully"
                        ));
                    }
                    else
                    {
                        echo json_encode(array(
                            "valid"=>0,
                            "message" => "Password Cannot be Updated."
                        ));
                    }

                }
            }
        }   

        
       
        else
        {
            echo json_encode(array(
                "valid" => 0,
                "message" => "Current password is incorrect"
            ));
        }
    
}






if(isset($_POST["type"]) && $_POST["type"] == "ForgotUserPass")
{

 
    $success = false;
    $message = "";
    $url="";
    extract($_POST);
    
    $username = $_POST['email'];

    if(isset($username))
    {
         $query = $db->query("SELECT * from users where email = '$username'");
         $q = $query->num_rows;
            $password = random_password(8);
            $e_password = encrypt_password($password);
            // $qry="INSERT INTO `users`(`password`) VALUES ('$e_password')";
             $qry="UPDATE `users` SET `password` = '$e_password' where email = '$username'";
            $q1=mysqli_query($db,$qry);
            if($q)
            {
                $data = mysqli_fetch_assoc($query);
                $userid = $data['uid'];
                $username = $data['email'];
                //$password = $data['password'];

                $first_name = $q['first_name'];
                $last_name = $q['last_name'];
                $loginurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";           
                $loginurl = str_replace("includes/adminfunction.php",'admin/login',$loginurl);
                $to = $username;
                $from = "";
                $subject = "$webtitle - Forgot Password Request";
                $body="
                    <b style='text-transform:capitalize;'>Dear $first_name $last_name, </b>
                    <br>
                    <p> Your Account Forgot Password Request accepted .</p>
                    <p> Username : $username</p>
                    <p> Password : $password </p>
                    <p> Please <a href='$loginurl'> click here to login </a></p>
                    <br>
                    <p>Thank You</p>
                    <img alt=\"$webname\" border=\"0\" width=\"250\" style=\"display:block\"  src=\"cid:logo_2u\"><br>
                ";
                
                send_phpmail( $first_name." ".$last_name, $to ,"", "" , $subject, $body  );
                $success = true;                
                $msg= "$username Forgot Password Request accepted successfully";
            }
        

        else{
              $query = $db->query("SELECT * from admin where email = '$username'");
         $q = $query->num_rows;
            $password = random_password(8);
            $e_password = $password;
            // $qry="INSERT INTO `users`(`password`) VALUES ('$e_password')";
             $qry="UPDATE `admin` SET `password` = '$e_password' where email = '$username'";
            $q1=mysqli_query($db,$qry);
            if($q)
            {
                $data = mysqli_fetch_assoc($query);
                $adminid = $data['id'];
                $username = $data['email'];
                //$password = $data['password'];

                $first_name = $q['first_name'];
                $last_name = $q['last_name'];
                $loginurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";           
                $loginurl = str_replace("includes/adminfunction.php",'admin/login',$loginurl);
                $to = $username;
                $from = "";
                $subject = "$webtitle - Forgot Password Request";
                $body="
                    <b style='text-transform:capitalize;'>Dear $first_name $last_name, </b>
                    <br>
                    <p> Your Account Forgot Password Request accepted .</p>
                    <p> Username : $username</p>
                    <p> Password : $password </p>
                    <p> Please <a href='$loginurl'> click here to login </a></p>
                    <br>
                    <p>Thank You</p>
                    <img alt=\"$webname\" border=\"0\" width=\"250\" style=\"display:block\"  src=\"cid:logo_2u\"><br>
                ";
                
                send_phpmail( $first_name." ".$last_name, $to ,"", "" , $subject, $body  );
                $success = true;                
                $msg= "$username Forgot Password Request accepted successfully";
            }
        }
    }


            else
            {
                $msg= "Some Problem Occur try after sometime";
            }   
     
 
            
     echo json_encode(array(
        'valid'=>$success,
        'url'=>$url,
        'msg'=>$msg
    ));
 }
 
 
 
  /****************************** Add Test **************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'Addtestname')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $test_name_id = $_POST['txtid'];
    
    //$question=mysqli_real_escape_string($db,$question);
    //$answer=mysqli_real_escape_string($db,$answer);


    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";
    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($test_name_id) && !empty($test_name_id)){   
        /*if(empty($filename)){
            $sql = "SELECT image FROM test_name WHERE test_name_id='$test_name_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }*/    
        $q0 = "UPDATE `student_test` SET `test_name`='$test_name' WHERE `test_name_id`='$test_name_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Test updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
        $q0 = "INSERT INTO `student_test`(`test_name`) VALUES ('$test_name')";


        

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Test added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }

    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}






/**********************************Delete Test Name *************************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletetestname")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM `student_test` WHERE  test_name_id = '$id'");
    
    if($delrecord )
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Test Name Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}


/****************Online Test Form********************/

if(isset($_POST["type"]) && $_POST["type"]== 'AddOnlineTest')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $test_id = $_POST['test_id'];

    if(isset($_SESSION['adminloggedin'])){
        $uid = $_SESSION['adminloggedin'];
    }
    if(isset($_SESSION['userLoggedin'])){
        $uid = $_SESSION['userLoggedin'];
    }
    $sql0001 = "SELECT * FROM student_profile WHERE uid = '$uid'";
    $query0001 = mysqli_query($db,$sql0001) or die(mysqli_error($db));
    if(mysqli_num_rows($query0001)>0){
        $row0001 = mysqli_fetch_assoc($query0001);
        $uid = $row0001['student_profile_id'];
    }
    else{
        $uid = 1;
    }
    /*if(!isset($online_test_id) && empty($online_test_id)){   
        
        $answer = implode(',', $answer);   
        $answer = rtrim($answer,',');
        $q0 = "UPDATE `online_test` SET `uid`='$uid',`test_name_id`='$test_name_id',`student_questions_id`='$student_questions_id',`answer`='$answer' WHERE `online_test_id`='$online_test_id'";

        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Test updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {
        // array
        $answer = implode(',', $answer);
        $q0 = "INSERT INTO `online_test`(`uid`, `test_name_id`, `student_questions_id`,`answer`) VALUES ('$uid','$test_name_id','$student_questions_id','$answer')";
        $q1 = mysqli_query($db,$q0);
        if($q1)
        {
            $success = true;
            $msg= "Test added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
       }*/
       /*$answer = "";*/
    $correct_answer_array = array();
    foreach ($answer as $question_id => $answer_str) {
        $sql = "INSERT INTO student_test_question_answer(`student_id`,`test_id`,`question_id`,`answer`) VALUES('$uid','$test_id','$question_id','$answer_str')";
        $query = mysqli_query($db,$sql) or die(myslqi_error($db));
        if($query){
            $success = true;
        }

        $sql2 = "SELECT * FROM `student_answer` WHERE student_questions_id = '$question_id'";
        $query1 = mysqli_query($db,$sql2) or die(mysqli_error($db));
        $row = mysqli_fetch_assoc($query1); 
        $total_answer = $row['answer'];
        $correct_answer = $row['correct_answer'];
        $total_answer_array = explode(',', $total_answer);
        $new_correct_answer_array = explode(',',$correct_answer);
        $i = 0;
        foreach ($new_correct_answer_array as $key => $value) {
            if($value == 1){
                $correct_answer_array[$question_id] = $total_answer_array[$i];
                break;
            }
            $i++;
        }
        // $correct_answer_array[$question_id]= $row['correct_answer'];
    }
    $sql3 = mysqli_query($db,"SELECT sum(question_marks) as total_marks FROM student_questions WHERE test_name_id = '$test_id'") or die(mysqli_error($db));
    $row3 = mysqli_fetch_assoc($sql3);
    $wrong_answer_count = 0;
    $correct_answer_count = 0;
    $total_marks = $row3['total_marks'];
    $obtained_marks = 0;
    // print_r($answer);
    foreach($correct_answer_array as $key=>$value){
        $sql04 = mysqli_query($db,"SELECT * FROM student_questions WHERE student_questions_id = '$key'") or die(mysqli_error($db));
        $row04 = mysqli_fetch_assoc($sql04);
        if($value == $answer[$key]){
            $correct_answer_count += 1; 
            $obtained_marks += $row04['question_marks'];
        }
        else{
            $wrong_answer_count += 1;
        }
       

     }
     // echo $obtained_marks.' =>'.$total_marks;
         $total_percentage = ($obtained_marks/$total_marks)*100;

       $sql2 = "INSERT INTO `student_test_result`(`student_id`, `test_id`, `wrong_answer_count`, `correct_answer_count`, `total_marks`, `obtained_marks`,`total_percentage` ) VALUES ('$uid','$test_id','$wrong_answer_count','$correct_answer_count','$total_marks','$obtained_marks','$total_percentage')";
        $query2 = mysqli_query($db,$sql2) or die(mysqli_error($db));    


    if($success == false){
        $message = "Some issue occured while communicating database";
    }
    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}




/**********Fetch Student Name Details For Selection************/

if(isset($_POST["type"]) && $_POST["type"] == "Fetchstudenttestdetails")
{
    $success = false;
    $message = "";
    $html = "";
    $res = array();
    extract($_POST);
    // $student_profile_id = "'".implode("','", $student_profile_id)."'";

    //echo "SELECT t1.student_name FROM `school_application` t1 WHERE CONCAT(',',t1.camp_management_id,',') LIKE '%,$camp_management_id,%'";

    $sql = mysqli_query($db,"SELECT t1.student_name,t1.student_profile_id FROM `student_profile` t1 WHERE CONCAT(',',t1.student_profile_id,',') LIKE '%,$student_profile_id,%'");


 // echo "SELECT DISTINCT test_id FROM student_test_question_answer WHERE student_id='1'"; 
   /* echo "SELECT t1.test_result_id,t1.test_id,t1.correct_answer_count,t2.test_name ,t3.student_name
                            FROM student_test_result t1 
                            INNER JOIN student_test t2 ON t2.test_name_id = t1.test_id 
                            INNER JOIN student_profile t3 ON t3.student_profile_id = t1.student_id
                            WHERE t1.student_id='$student_profile_id'";
*/                            
   $sql1 = mysqli_query($db,"SELECT t1.test_result_id,t1.test_id,t1.correct_answer_count,t2.test_name ,t3.student_name
                            FROM student_test_result t1 
                            INNER JOIN student_test t2 ON t2.test_name_id = t1.test_id 
                            INNER JOIN student_profile t3 ON t3.student_profile_id = t1.student_id
                            WHERE t1.student_id='$student_profile_id'") or die(mysqli_error($db));

    $i = 1;
    if(mysqli_affected_rows($db)){
        $success = true;
        ob_start();

        while($r11 = mysqli_fetch_assoc($sql1)){
            //print_r($r11);

    ?>
            <tr>
                <td><?=$i;$i++;?></td>
                <td><?=$r11['student_name'];?></td>
                <td><?=$r11['test_name'];?></td>
                <!-- <td><?=$r11['correct_answer_count'];?></td> -->


                <td><a class="btn btn-xs btn-info" href="student_marks.php?id=<?php echo $r11['test_result_id'];?>" ><i class="fa fa-print"></i></a>
                </td>
                 
                
            </tr> 
            
        <?php }    
        $html = ob_get_clean();
    }
    echo json_encode(array(
        "success" => $success,
        "message" => $message,
        "html"     => $html
    ));
}






/****************************** Add Questions Answer new **************************/ 


if(isset($_POST["type"]) && $_POST["type"]== 'Addstudentquestions')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $student_questions_id = $_POST['txtid'];
    
    $fileList = array();
    $filename="";
    $uploadOk = 1;
    $fileListimg="";
    if (isset($_FILES["picture"]) && $_FILES['picture']['error']==0)
    {
        $target_dir = "../upload/";
        // $path = "upload/product/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if ($_FILES["picture"]["size"] > 52428800) {
            $msg=  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        $extallowed = array("jpg","jpeg","png","JPG","JPEG","PNG");
        if (!in_array(strtolower($imageFileType),$extallowed)){
            $msg = "Sorry,For jpg & png extension files are allowed";
            $status = false;
            $uploadOk = 0;
        }

        $filename=time().'.'.$imageFileType;
        $filepath=$target_dir.$filename;
        if ($uploadOk != 0) {

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filepath)) {
                $filename=$filename;
                $fileListimg=",picture='$filename'";
            } else {
                $uploadOk = 0;
                $msg = "Sorry, your file was not uploaded.";
            }
        }
    }
    else{
        $filename='';
        $fileListimg=",picture='$filename'";
    }



    if(isset($student_questions_id) && !empty($student_questions_id)){   
        /*if(empty($filename)){
            $sql = "SELECT image FROM test_name WHERE student_questions_id='$student_questions_id'";
            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
            $data = mysqli_fetch_assoc($query);
            $filename = $data['image'];
        }*/    
        $q0 = "UPDATE `student_questions` SET `test_name_id`='$test_name_id',`questions`='$questions',`question_marks` = '$question_marks' WHERE `student_questions_id`='$student_questions_id'";
        $question_option_array = array();
        foreach($question_option as $value){
            if(!empty($value))
            $question_option_array[] = $value;
        }
        $question_option_count = count($question_option_array);
        $question_option = implode(',', $question_option_array);   
        $question_option = rtrim($question_option,',');

        $is_answer_array = array();
        for($i =0;$i<$question_option_count;$i++){
            $is_answer_array[] = $is_answer[$i];
        }

        $answer = implode(',', $is_answer_array);   
        $answer = rtrim($answer,',');

        $correct_answer = $answer; 

        // echo "UPDATE `student_answer` SET `student_questions_id`='$student_questions_id',`answer`='$question_option',`correct_answer`='$answer' WHERE `student_questions_id`='$student_questions_id'";

        $q01 = "UPDATE `student_answer` SET `student_questions_id`='$student_questions_id',`answer`='$question_option',`correct_answer`='$answer' WHERE `student_questions_id`='$student_questions_id'";
   

        $q1 = mysqli_query($db,$q0);
        $q1 = mysqli_query($db,$q01);

        if($q1 && $q01)
        {
            $success = true;
            $msg= "Question and answer updated successfully.";
        }
        else{
            $msg= "Some Promblem Occur try after sometime.";
        }

    }else {

        //echo "INSERT INTO `student_questions`(`test_name_id`, `questions`, `question_marks`) VALUES ('$test_name_id','$questions','$question_marks')";


        $q0 = "INSERT INTO `student_questions`(`test_name_id`, `questions`, `question_marks`) VALUES ('$test_name_id','$questions','$question_marks')";
       /* print_r($q0);*/
        /*for array*/

        $question_option = implode(',', $question_option);   
        $question_option = rtrim($question_option,',');

        $answer = implode(',', $is_answer);   
        $answer = rtrim($answer,',');

        $correct_answer = $answer;

        /*for insert student id */
        mysqli_query($db,$q0);
        $student_questions_id = mysqli_insert_id($db);

        //echo "INSERT INTO `student_answer`(`student_questions_id`, `answer`, `correct_answer`) VALUES ('$student_questions_id','$question_option', '$correct_answer')";

        $q01 = "INSERT INTO `student_answer`(`student_questions_id`, `answer`, `correct_answer`) VALUES ('$student_questions_id','$question_option', '$correct_answer')";
        

        $q1 = mysqli_query($db,$q01);
        if($q1 && $q01)
        {
            $success = true;
            $msg= "Question & answer added successfully.";
        }
        else{
            $msg= "Some promblem occur try after sometime.";
        }
    }




    echo json_encode(array(
        'valid'=>$success,
        'msg'=>$msg
    ));
}

/******************************** Delete Questions *************************/

if(isset($_POST["type"]) && $_POST["type"] == "Deletestudentquestions")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM `student_questions` WHERE  student_questions_id = '$id'");
    $delrecord = mysqli_query($db,"DELETE FROM `student_answer` WHERE  student_questions_id = '$id'") or die(mysqli_error($db));
    
    if($delrecord )
    {
        echo json_encode(array(
            "valid"=>true,
            "message" => "Student Question and Answer Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "message" => "Some Problem Occur, While Deleting."
        ));
    }

}








 
 
 
