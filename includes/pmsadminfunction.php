<?php

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

     $q = mysqli_query($db,"select * from user where email  = '$email' AND password='$password'");
     $count= mysqli_num_rows($q);
   //echo "select * from user where email  = '$email' AND password='$password'";
    if($count ==1)
    {
       
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
  
   $q = mysqli_query($db,"select * from user where user_name  = '$username' AND email='$email'");

    // echo "select * from user where user_name  = '$username' AND email='$email'";
     $count= mysqli_num_rows($q);
      if($count == 0)
    {
       
        $q1 = mysqli_query($db,"INSERT INTO `user`(`first_name`, `last_name`, `user_name`, `email`, `password`,`gender`) VALUES ('$first_name','$last_name','$username','$email','$f_pwd','$gender')");
        
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



//Add &update member    
if(isset($_POST["type"]) && $_POST["type"]== 'AddMember')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);


    $id=$_POST['memberid'];

    
    if($id=='')
    { 

        $q1 = mysqli_query($db, "INSERT INTO `member`(`member`) VALUES ('$membername')");
        //echo "INSERT INTO `member`(`member`) VALUES ('$membername')";
        if($q1)
        {
            $success = true;
            $msg= "Member Added successfully";
        }
        else{
            $msg= "Failed";
        }
    }
    else
    {
        
        $q1 = mysqli_query($db, "update member set  member='$membername' where member_id='$id'");

        
 
        if($q1)
        {

            $success = true;
            $msg = "Member Updated Successfully";
        }
        else{
            $msg = "Failed";
        }
    }
echo json_encode(array(
        'valid'=>$success,
        'url'=>$url,
        'msg'=>$msg
    ));
    }


    
//delete Member
if(isset($_POST["type"]) && $_POST["type"] == "DeleteMember")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM member WHERE member_id = '$id'");
    //echo "DELETE FROM member WHERE id = '$id'";
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "msg" => "Member Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "msg" => "Some Problem Occur, While Deleting."
        ));
    }

}


// AddUpdate Project

if(isset($_POST["type"]) && $_POST["type"]== 'AddProject')
{
   // echo "hello";
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $update_str="";

        $filename="";
        $uploadOk = 1;
        if(isset($_FILES['project_file']) && $_FILES['project_file']['name'] != ""){
            $target_dir = "../uploads/projects/";
            $target_file = $target_dir . basename($_FILES["project_file"]["name"]);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if ($_FILES["project_file"]["size"] > 1000000) {
                $msg=  "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            $extallowed = array("jpg", "jpeg", "gif", "png", "zip", "xlsx");
            if (!in_array(strtolower($imageFileType),$extallowed)){
                $msg = "Sorry,For jpg & png extension files are allowed";
                $status = false;
                $uploadOk = 0;
            }

            $filename=uniqid().".".$imageFileType;
            $filepath=$target_dir.$filename;
            if ($uploadOk != 0) {

                if (move_uploaded_file($_FILES["project_file"]["tmp_name"], $filepath)) {
                    $update_str=",project_file='$filename'";
                } else {
                    $uploadOk = 0;
                    $msg = "Sorry, your file was not uploaded.";
                }
            }
        }
        if ($uploadOk == 0) {
            $success=false;
        } else { 

    $id=$_POST['projectid'];

    
    if($id=='')
    { 
       
        $q1 = mysqli_query($db, "INSERT INTO `project`(`project_name`, `project_des`, `project_member`, `project_file`) VALUES ('$project_name', '$project_des', '$project_member', '$filename')");
   
        if($q1)
        {
            $success = true;
            $msg= "Project Added successfully";
        }
        else{
            $msg= "Failed";
        }
    }
    else
    {
        $q1 = mysqli_query($db, "UPDATE `project` SET `project_name`='$project_name',`project_des`='$project_des',`project_member`='$project_member' ,`project_file`='$filename' where `project_id`='$id'");

        //echo "UPDATE `project` SET `project_name`='$project_name',`project_des`='$project_des',`project_member`='$project_member', `project_file`='$filename' where `project_id`='$id'";
        if($q1)
        {

            $success = true;
            $msg = "Project Updated Successfully";
        }
        else{
            $msg = "Failed";
        }
    }
    }
echo json_encode(array(
        'valid'=>$success,
        'url'=>$url,
        'msg'=>$msg
    ));
    }
   
//delete Project
if(isset($_POST["type"]) && $_POST["type"] == "DeleteProject")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM project WHERE project_id = '$id'");
    //echo "DELETE FROM member WHERE id = '$id'";
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "msg" => "Project Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "msg" => "Some Problem Occur, While Deleting."
        ));
    }

}


// AddUpdate Milestone

if(isset($_POST["type"]) && $_POST["type"]== 'AddMilestone')
{
   // echo "hello";
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    $update_str="";

        $filename="";
        $uploadOk = 1;
        if(isset($_FILES['gantt_chart']) && $_FILES['gantt_chart']['name'] != ""){
            $target_dir = "../uploads/ganttchart/";
            $target_file = $target_dir . basename($_FILES["gantt_chart"]["name"]);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if ($_FILES["gantt_chart"]["size"] > 8000000) {
                $msg=  "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            $extallowed = array("jpg", "jpeg", "gif", "png", "zip", "xlsx");
            if (!in_array(strtolower($imageFileType),$extallowed)){
                $msg = "Sorry,For jpg & png extension files are allowed";
                $status = false;
                $uploadOk = 0;
            }

            $filename=uniqid().".".$imageFileType;
            $filepath=$target_dir.$filename;
            if ($uploadOk != 0) {

                if (move_uploaded_file($_FILES["gantt_chart"]["tmp_name"], $filepath)) {
                    $update_str=",gantt_chart='$filename'";
                } else {
                    $uploadOk = 0;
                    $msg = "Sorry, your file was not uploaded.";
                }
            }
        }
        if ($uploadOk == 0) {
            $success=false;
        } else { 

    $id=$_POST['proid'];

    
    if($id=='')
    { 
       
        $q1 = mysqli_query($db, "INSERT INTO `milestone`(`pro_name`, `pro_des`, `pro_member`, `gantt_chart`) VALUES ('$pro_name', '$pro_des', '$pro_member', '$filename')");
        echo "INSERT INTO `milestone`(`pro_name`, `pro_des`, `pro_member`, `gantt_chart`) VALUES ('$pro_name', '$pro_des', '$pro_member', '$filename')";
   
        if($q1)
        {
            $success = true;
            $msg= "Project Added successfully";
        }
        else{
            $msg= "Failed";
        }
    }
    else
    {
        $q1 = mysqli_query($db, "UPDATE `milestone` SET `pro_name`='$pro_name',`pro_des`='$pro_des',`pro_member`='$pro_member' ,`gantt_chart`='$filename' where `mile_id`='$id'");

       // echo "UPDATE `milestone` SET `pro_name`='$pro_name',`pro_des`='$pro_des',`pro_member`='$pro_member' ,`gantt_chart`='$filename' where `mile_id`='$id'";
        if($q1)
        {

            $success = true;
            $msg = "Project Updated Successfully";
        }
        else{
            $msg = "Failed";
        }
    }
    }
echo json_encode(array(
        'valid'=>$success,
        'url'=>$url,
        'msg'=>$msg
    ));
    }
   
//delete Milestone
if(isset($_POST["type"]) && $_POST["type"] == "DeleteMilestone")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM milestone WHERE mile_id = '$id'");
   // echo "DELETE FROM milestone WHERE mile_id = '$id'";
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "msg" => "Project Deleted successfully"
        ));
    }
    else
    {
        echo json_encode(array(
            "valid"=>false,
            "msg" => "Some Problem Occur, While Deleting."
        ));
    }

}


//Add Project Issue 
if(isset($_POST["type"]) && $_POST["type"]== 'AddProjectissue')
{
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);


    $id=$_POST['psid'];

    
    if($id=='')
    { 

        $q1 = mysqli_query($db, "INSERT INTO `projectissue`(`member_id`, `project_issue`) VALUES ('$projectteam','$projectissue')");
        //echo "INSERT INTO `member`(`member`) VALUES ('$membername')";
        if($q1)
        {
            $success = true;
            $msg= "Project Issue  Added successfully";
        }
        else{
            $msg= "Failed";
        }
    }
   
echo json_encode(array(
        'valid'=>$success,
        'url'=>$url,
        'msg'=>$msg
    ));
    }

    ?>