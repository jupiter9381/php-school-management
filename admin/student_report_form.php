<?php include("header.php"); ?>

    <section id="middle">
        <header id="page-header">
            <h1>Student Report form</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Student Report form</strong>
                    </span>
                                        
                    <a href="add_student_report_form.php" class="btn btn-info btn-xs pull-right">Add Student Report form</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Student Name</th>
                                    <th>Nationality </th>  
                                    
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            //echo "SELECT a.*,s.student_name,t.first_name FROM student_report_form a LEFT JOIN school_application s ON a.student_app_id=s.student_app_id LEFT JOIN camp_teacher t ON a.camp_teacher_id=t.camp_teacher_id";

                            $q1 = mysqli_query($db, "SELECT a.*,s.student_name,t.first_name FROM student_report_form a LEFT JOIN school_application s ON a.student_app_id=s.student_app_id LEFT JOIN teacher_resource_assignment t ON a.teacher_resource_assignment_id=t.teacher_resource_assignment_id" );



                            /*$q1 = mysqli_query($db, "SELECT * FROM student_report_form");*/

                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['student_report_form_id'];?>">                                  
                                    
                                    
                                    
                                <td><?php echo $r1['first_name']; ?></td>
                                
                                <td><?php echo $r1['student_name']; ?></td>
                                
                                <td><?php echo $r1['nationality']; ?></td>
                                <td>

                                    <a class="btn btn-xs btn-info" href="report.php?id=<?php echo $r1['student_report_form_id'];?>" ><i class="fa fa-print"></i></a>
                                    &nbsp;                       
                                    
                                    <a class="btn btn-xs btn-info" href="add_student_report_form.php?id=<?php echo $r1['student_report_form_id'];?>" ><i class="fa fa-edit"></i></a>
                                    &nbsp;                         
                                   
                                    <?php if(permission_access($db,$per_id,'student_report_delete')==1){ ?>
                                    <a class="btn btn-xs btn-danger Deletestudentreportform" href="javascript:void(0);" title="Delete Student Report Form" data-id="<?php echo $r1['student_report_form_id']; ?>"><i class="fa fa-trash"> </i></a>
                                    &nbsp; 
                                    <?php }?>                                  
                                </td>
                    </tr>
                             <?php }?>
                            
                            </tbody> 
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>


