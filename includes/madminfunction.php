<?php
 include '../db_config.php';

 //manager login
if(isset($_POST["type"]) && $_POST["type"]== 'AddNewlogin')
{
  // echo "hello";
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);

     $q = mysqli_query($db,"select * from manager where email  = '$email' AND password='$password'");
     $count= mysqli_num_rows($q);
   //echo "select * from manager where email = '$email'";
    if($count == 1)
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

if(isset($_POST["type"]) && $_POST["type"]== 'AddNewform')
{
  // echo "hello";
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    
   // $id=$_POST['taskid'];
    if($f_pwd ==  $password)
   {
  
   $q = mysqli_query($db,"select * from manager where user_name  = '$username' AND email='$email'");

    // echo "select * from user where user_name  = '$username' AND email='$email'";
     $count= mysqli_num_rows($q);
      if($count == 0)
    {

       
        $q1 = mysqli_query($db,"INSERT INTO `manager`(`first_name`, `last_name`, `user_name`, `email`, `password`,`gender`) VALUES ('$first_name','$last_name','$username','$email','$f_pwd','$gender')");
        
     // echo "INSERT INTO `manager`(`first_name`, `last_name`, `user_name`, `email`, `password`,`gender`) VALUES ('$first_name','$last_name','$username','$email','$f_pwd','$gender')";
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


//Add &update manager_project    
if(isset($_POST["type"]) && $_POST["type"]== 'AddMember')
{
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
		
		
}	
		

// AddUpdate Extend_date

if(isset($_POST["type"]) && $_POST["type"]== 'AddDate')
{
  // echo "hello";
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    
    $id=$_POST['ex_id'];

    
    if($id=='')
    { 
       
        $q1 = mysqli_query($db,"INSERT INTO `extend_date`(`member_id`, `project_id`, `ex_date`) VALUES ('$project_member' , '$project_name', '$ex_date')");
		
      // echo"INSERT INTO `extend_date`(`member_id`, `project_id`, `ex_date`) VALUES ('$member_id' , '$project_id', '$ex_date')";
   
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
        $q1 = mysqli_query($db, "UPDATE `extend_date` SET `member_id`='$project_member',`project_id`='$project_name',`ex_date`='$ex_date' where `ex_id`='$id'");

       // echo  "UPDATE `extend_date` SET `member_id`='$member_id',`project_id`='$project_id',`ex_date`='$ex_date' where `ex_id`='$id'";
        if($q1)
        {

            $success = true;
            $msg = "Date Updated Successfully";
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
   
//delete Extend_date
if(isset($_POST["type"]) && $_POST["type"] == "DeleteDate")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM extend_date WHERE ex_id = '$id'");
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


// AddUpdate task

if(isset($_POST["type"]) && $_POST["type"]== 'AddNewtask')
{
  // echo "hello";
    $success = false;
    $msg = "";
    $url="";
    extract($_POST);
    
    $id=$_POST['taskid'];

    
    if($id=='')
    { 
       
        $q1 = mysqli_query($db,"INSERT INTO `task`(`member_id`, `task`, `task_des`) VALUES ('$projectteam' , '$addteamtask','$taskdes')");
		
      // echo "INSERT INTO `task`(`member_id`, `task`,  `task_des`) VALUES ('$projectteam' , '$addteamtask','$taskdes')";
   
        if($q1)
        {
            $success = true;
            $msg= "Task Added successfully";
        }
        else{
            $msg= "Failed";
        }
    }
    else
    {
        $q1 = mysqli_query($db, "UPDATE `task` SET `member_id`='$projectteam',`task`='$addteamtask',`task_des`='$taskdes' where `task_id`='$id'");

      // echo "UPDATE `task` SET `member_id`='$projectteam',`task`='$addteamtask',`task_des`='$taskdes' where `task_id`='$id'";
        if($q1)
        {

            $success = true;
            $msg = "Task Updated Successfully";
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
   
//delete Task
if(isset($_POST["type"]) && $_POST["type"] == "DeleteTask")
{
    $id = $_POST['id'];

    $delrecord = mysqli_query($db,"DELETE FROM task WHERE task_id = '$id'");
   // echo "DELETE FROM milestone WHERE mile_id = '$id'";
    if($delrecord)
    {
        echo json_encode(array(
            "valid"=>true,
            "msg" => "Task Deleted successfully"
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
}
       


    

?>
