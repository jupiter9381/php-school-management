<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Student Attendance</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Student Attendance</strong>
                    </span>
                                        
                    <a href="add_student_attendance.php" class="btn btn-info btn-xs pull-right">Add Student Attendance</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>                           
                                    <th>Roll Number</th>
                                    <th>Standard</th>
                                    <th>Date</th>                            
                                    <th>Present/Absent</th>  
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                $q1 = mysqli_query($db,"SELECT a.*,p.first_name,p.middle_name,p.last_name,p.standard FROM student_attendance a LEFT JOIN student_profile p ON a.student_profile_id=p.student_profile_id");
                                $num=mysqli_num_rows($q1);
                                
                                while($r1 = mysqli_fetch_assoc($q1))
                                {
                                ?>
                                    <tr id="name">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['first_name'].' '.$r1['middle_name'].' '.$r1['last_name'] ; ?></td>
                                        <td><?php echo $r1['roll_number']; ?></td>
                                        <td><?php echo $r1['standard']; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($r1['atted_date'])); ?></td>
                                        <td><?php echo $r1['present_absent']; ?></td>
                                        <td>
                                              
                                            <a class="btn btn-xs btn-info" href="add_student_attendance.php?id=<?php echo $r1['student_attendance_id'];?>" ><i class="fa fa-edit"> Edit</i></a>
                                            
                                            <?php if(permission_access($db,$per_id,'student_attendance_delete')==1){ ?>

                                            <a class="btn btn-xs btn-danger DeleteStudentAttendance" href="javascript:void(0);" title="Delete Student Attendance" data-id="<?php echo $r1['student_attendance_id']; ?>"><i class="fa fa-trash"> Delete</i></a>
                                          <?php } ?>
                                            
                                        </td>
                                    </tr>  
                                <?php $i++;} ?>  
                            </tbody>
                              
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>
