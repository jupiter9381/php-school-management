<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Student Profile</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Student Profile</strong>
                    </span>
                                        
                    <!--<a href="add_student_profile.php" class="btn btn-info btn-xs pull-right">Add Student Profile</a>-->
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Date Of Birth</th>
                                    <th>Nationality</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                 
                                $i=1; 

                                if(permission_access($db,$per_id,'userlist_view')==1){

                                    $q1 = mysqli_query($db,"SELECT * FROM student_profile");
                                }

                                else{
                                
                                    $user_id = isset($_SESSION['userLoggedin'])?$_SESSION['userLoggedin']:'';
                                    $i=1;
                                    
                                    
                                    if(!empty($user_id)){
                                        //echo "SELECT * FROM student_profile WHERE uid = '$user_id'"; 
                                        $q1 = mysqli_query($db,"SELECT * FROM student_profile WHERE uid='$user_id'");
                                    }else{
                                        //echo "SELECT * FROM student_profile";
                                        $q1 = mysqli_query($db,"SELECT * FROM student_profile");
                                    }
                                }
                                
                                
                                //$q1 = mysqli_query($db,"SELECT * FROM student_profile");

                                $num=mysqli_num_rows($q1); 
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                    //print_r($r1['std_email']);
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        
                                        <td><a href="view_student_profile.php?id=<?php echo $r1['student_app_id'];?>"><?php echo $r1["student_name"]; ?></a></td>
                                        <td><?php echo $r1["gender"]; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($r1['dob'])); ?></td>
                                        <td><?php echo $r1["nationality"]; ?></td>
                                        <td>
                                              
                                            <a class="btn btn-xs btn-info" href="add_student_profile.php?id=<?php echo $r1['student_app_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'student_profile_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteStudentProfile" href="javascript:void(0);" title="Delete Student Profile" data-id="<?php echo $r1['student_profile_id']; ?>"><i class="fa fa-trash"> Delete</i></a>

                                            <?php  } ?>
                                            
                                        </td>
                                    </tr>  
                                <?php $i++; } ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>
