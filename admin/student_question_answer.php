<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_answer` WHERE `student_answer_id` = '$id'"));

        $data1 = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_questions` WHERE `student_questions_id` = '$id'"));


    }
 ?>
 
<section id="middle">
        <header id="page-header">
            <h1>Student Questions And Answer</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Questions And Answer</strong>
                    </span>
                                        
                    <a href="add_question.php" class="btn btn-info btn-xs pull-right">Add Questions And Answer</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Test Name</th>                                  
                                    <th>Questions</th>
                                    <th>Answer</th>
                                    <th>Correct Answer</th>
                                    <th>Question Marks</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db,"SELECT t1.*,t2.test_name,t3.answer,t3.correct_answer
                                                    FROM `student_questions` t1 
                                                    LEFT JOIN student_test t2 ON t1.test_name_id=t2.test_name_id
                                                    LEFT JOIN student_answer t3 ON t3.student_questions_id = t1.student_questions_id"); 

                            /*$q1 = mysqli_query($db, "SELECT t1.*,t2.test_name FROM `student_questions` t1 
                                LEFT JOIN student_test t2 ON t1.test_name_id=t2.test_name_id
                                LEFT JOIN student_answer t3 ON t2.test_name_id=t3.student_answer_id");*/

                           /* $q1 = mysqli_query($db,"SELECT t1.*
                            FROM student_questions t1 
                            INNER JOIN student_test t2 ON t2.test_name_id = t1.student_questions_id 
                            INNER JOIN student_answer t3 ON t3.student_answer_id = t1.student_questions_id
                            WHERE t1.test_name_id='$student_questions_id'") or die(mysqli_error($db));*/

                            //print_r($q1);



                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['student_questions_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $r1['test_name']; ?></td>
                                    <td><?php echo $r1['questions']; ?></td>
                                    <td><?php echo $r1['answer']; ?></td>
                                    <td><?php echo $r1['correct_answer']; ?></td>
                                    <td><?php echo $r1['question_marks']; ?></td>
                                    
                                    
                                        
                      <td>                       
                        
                        <a class="btn btn-xs btn-info" href="add_question.php?id=<?php echo $r1['student_questions_id'];?>"><i class="fa fa-edit"></i></a>
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