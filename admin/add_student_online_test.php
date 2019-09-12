<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        /*$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `project` WHERE `project_id` = '$id'"));*/
}

?>
<section id="middle">
    
    <header id="page-header">
        <h1>Student Online Test</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['communication_id'])?'Edit Student Test File':'Add Student Online Test';?></h2>
            </div>
            <?php 
            if(isset($_SESSION['adminloggedin'])){
                $user_id = $_SESSION['adminloggedin'];
             }
             else if(isset($_SESSION['userLoggedin'])){
                $user_id = $_SESSION['userLoggedin'];
             }
            $sql0001 = "SELECT * FROM student_profile WHERE uid = '$user_id'";
            $query0001 = mysqli_query($db,$sql0001) or die(mysqli_error($db));
            if(mysqli_num_rows($query0001)>0){
                $row0001 = mysqli_fetch_assoc($query0001);
                $user_id = $row0001['student_profile_id'];
            }
            else{
                $user_id = 1;
            }
            $sql = "SELECT DISTINCT test_id  FROM `student_test_result` WHERE `student_id` = '$user_id' AND total_percentage >=50 order by test_id DESC, total_percentage DESC LIMIT 1";
            $query = mysqli_query($db, $sql) or die(mysqli_query($db));
            $last_test_id = 1;
            if(mysqli_num_rows($query)>0){
                $data = mysqli_fetch_assoc($query);
                $last_test_id = $data['test_id'];
            }
            $sql001 = "SELECT test_name_id FROM student_test WHERE test_name_id>'$last_test_id' LIMIT 1";
            $sql001 = mysqli_query($db,"SELECT test_name_id FROM student_test WHERE test_name_id>'$last_test_id' LIMIT 1");
            if(mysqli_num_rows($sql001)>0){
                $row001 = mysqli_fetch_assoc($sql001);
                $last_test_id = $row001['test_name_id'];
            }
            // echo $last_test_id;
            // print_r($data);
            ?>
            <div class="panel-body">
                <form action="online_test.php" id = "formaddstudenttestonline" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Test *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="online_test" name="online_test" id="online_test_details">
                                            <option value="">--Select--</option>
                                            <?php
                                                $selectpck2 = "SELECT * FROM student_test WHERE test_name_id = '$last_test_id'";
                                                $sql2 = mysqli_query($db, $selectpck2);
                                            while ($row2 = mysqli_fetch_array($sql2)) {
                                                $selected2 = (isset($data['test_name_id']) && $row2['test_name_id'] == $data['test_name_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row2['test_name_id']; ?>" <?=$selected2; ?>><?php echo $row2['test_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                    </div>
                                </div> 
                            </div> 

                         
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "testfileid" id="testfileid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddOnlineTesting">
                                    <input type="submit"  id="formvalidate" data-form="formaddstudenttestfile"  class="btn btn-info btn-md btn-submit"  value="Start Test">
                                </div>
                            </div>

                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        
    </div>
</section>
<?php include("footer.php"); ?>