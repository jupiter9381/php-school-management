<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        //$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `school_application` WHERE `student_app_id` = '$id'"));

         $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_test_question_answer` WHERE `test_question_answer_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Student Test File</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['student_profile_id'])?'Edit Student Test File':'Student Test File';?></h2>
            </div>
            <div class="panel-body">
                <form action="idcard_info.php" id = "formaddstudenttestfile" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Student Name *</label>
                                    <select class="form-control select2" id="student_test_details" name="student_profile_id" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT DISTINCT t2.student_name,t2.student_profile_id,t1.student_id,t3.id FROM student_test_result t1 INNER JOIN student_profile t2 ON t1.student_id=t2.student_profile_id LEFT JOIN admin t3 ON t1.student_id=t3.id";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['student_profile_id']) && $row['student_profile_id'] == $data['student_profile_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['student_profile_id']; ?>" <?=$selected; ?>><?php echo $row['student_name']; ?></option>
                                        
                                        <?php }?> 
                                    </select>
                                </div>

                            </div>


                            <div class="row">
                                
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Student Name</th> 
                                                    <th>Test Name</th>
                                                    <!-- <th>Correct Answer</th> -->
                                                    <th>Print Test File</th>  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                                   
                            <!-- <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "student_name" id="student_name" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddStudenttestfile">
                                    <input type="submit"  id="formvalidate" data-form="formaddstudenttestfile"  class="btn btn-info btn-md btn-submit"  value="Add Student Test File">
                                </div>
                            
                            </div> -->
                        </div>
            
                    </fieldset>

                </form>
            </div>
        </div>
        
    </div>
</section>
<?php include("footer.php"); ?>
