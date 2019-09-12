<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_questions` WHERE `student_questions_id` = '$id'"));

    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Student Questions</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['boarding_staff_id'])?'Edit Student Questions':'Add Student Questions';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddstudentquestions" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Test Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="test_name" name="test_name_id">
                                                <option value="">--Select--</option>
                                            <?php
                                                $selectpck2 = "SELECT * FROM student_test";
                                                $sql2 = mysqli_query($db, $selectpck2);
                                            while ($row2 = mysqli_fetch_array($sql2)) {
                                                $selected2 = (isset($data['test_name_id']) && $row2['test_name_id'] == $data['test_name_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row2['test_name_id']; ?>" <?=$selected2; ?>><?php echo $row2['test_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Questions *</label>
                                    <input type="text"  placeholder = "Questions" class = "form-control" name = "questions" id = "questions" title = "questions Required"  value="<?php echo isset($data['questions'])?$data['questions']:''?>"required>
                                </div>
                                
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="Addstudentquestions">
                                        <input type="submit" id="formvalidate" data-form="formaddstudentquestions"  class="btn btn-info btn-md btn-submit"  value="Add Questions">
                                    </div>
                                </div>
                            </div>
                        
                       
                    </fieldset>
                </form>
            </div>
        </div>
        
    </div>
</section>

<section id="middle">
        <header id="page-header">
            <h1>Student Questions</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
               

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Test Name</th>                                  
                                    <th>Questions</th>

                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT t1.*,t2.test_name FROM `student_questions` t1 LEFT JOIN student_test t2 ON t1.test_name_id=t2.test_name_id");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['student_questions_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $r1['student_questions_id']; ?></td>
                                    <td><?php echo $r1['test_name']; ?></td>
                                    <td><?php echo $r1['questions']; ?></td>
                                    
                                    
                                        
                      <td>                       
                        
                        <a class="btn btn-xs btn-info" href="student_questions.php?id=<?php echo $r1['student_questions_id'];?>"><i class="fa fa-edit"></i></a>
                        &nbsp;                         
                       
                        <a class="btn btn-xs btn-danger Deletestudentquestions" href="javascript:void(0);" title="Delete Student Questions" data-id="<?php echo $r1['student_questions_id']; ?>"><i class="fa fa-trash"> </i></a>
                        &nbsp;                                       
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
