<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_answer` WHERE `student_answer_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Student Answer</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['student_answer_id'])?'Edit Student Test File':'Add Student Answer';?></h2>
            </div>
            <div class="panel-body">
                <form action="student_answer.php" id = "formaddstudentanswer" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Question *</label>
                                    <select class="form-control select2" id="student_answer" name="student_questions_id" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM student_questions";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['student_questions_id']) && $row['student_questions_id'] == $data['student_questions_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['student_questions_id']; ?>" <?=$selected; ?>><?php echo $row['questions']; ?></option>
                                        
                                        <?php }?> 
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label> Answer * </label>

                                    <div class="table-responsive">  
                                        <table class="table table-bordered" id="dynamic_field">
                                            
                                        <?php 
                                        if(isset($data['answer'])){ ?>
                                                <?php $answer = array();
                                                if(strpos($data['answer'],',')){
                                                    $answer = explode(',',$data['answer']);
                                                }
                                                else{
                                                    $answer = $data['answer'];
                                                }
                                                $i = 1;

                                                foreach ($answer as $key => $value) {
                                                    echo '<tr id="row'.$i.'">
                                                            <td>
                                                                <input type="text" name="answer[]" placeholder="Enter your Answer" class="form-control name_list" value="'.$value.'"/>
                                                            </td>
                                                            <td>
                                                                <button type="button" name="remove" id="'.$i.'" class="btn btn-danger btn_remove">X</button>
                                                            </td>
                                                        </tr>';
                                                    $i++;
                                                }
                                            }
                                            else{
                                                ?>
                                            <!-- <tr>
                                                <td>
                                                <input type="text" name="answer[]" id= "answer[]" placeholder="Enter your Answer" class="form-control name_list" value="<?php echo isset($data['answer'])?$data['answer']:''?>" />
                                            </td> 
                                        </tr> -->
                                            <?php } ?>
                                                                                  
                                            <tr>
                                                <td>
                                                    <input type="text" name="answer[]" placeholder="Enter your Answer" class="form-control name_list" value=""/>
                                                </td>
                                                <td>
                                                    <button type="button" name="add" id="add" class="btn btn-success"> + </button>
                                                </td>
                                            </tr>    
                                        </table>  
                                       
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Correct Answer *</label>
                                    <input type="text" id="correct_answer" name="correct_answer" placeholder="Enter your Answer" class="form-control name_list" value="<?php echo isset($data['correct_answer'])?$data['correct_answer']:''?>">
                                </div>
                            </div>

                                   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <input type="hidden" name="test_id" value="<?=$test_id;?>">
                                    <input type ="hidden" name = "type" value="Addstudentanswer">
                                    <input type="submit"  id="formvalidate" data-form="formaddstudentanswer"  class="btn btn-info btn-md btn-submit"  value="Add Answer">
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
        <!-- <header id="page-header">
            <h1>Student Answer</h1>
        </header -->
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                        <strong>Student Answer </strong>
                    </span>
                                        
                    <!-- <a href="add_cca.php" class="btn btn-info btn-xs pull-right">Add CCA (Sporting)</a> -->
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                    <th>ID</th>     
                                    <th>Student Question</th>
                                    <th>Answer</th>                                    
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT t1.*,t2.questions FROM student_answer t1 LEFT JOIN student_questions t2  ON t1.student_questions_id=t2.student_questions_id");
                                                           
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                                $i++;      
                
                            ?>
                                <tr id="invoice<?php echo $r1['student_answer_id'];?>">                                  
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $r1['questions']; ?></td>
                                    <td><?php echo $r1['answer']; ?></td>

                                    
                                    <!-- <td><?php //echo $r1['email_id']; ?></td>
                                    <td><?php //echo $r1['address']; ?></td>
                                    <td><img src="../upload/<?php //echo $r1['image'];?>" alt="Image" width="100" height="100"></td>
                                         -->
                                    <td> 
                                        <a class="btn btn-xs btn-info" href="student_answers.php?id=<?php echo $r1['student_answer_id'];?>" ><i class="fa fa-edit"></i></a>
                                        &nbsp;                         
                                       
                                        <a class="btn btn-xs btn-danger Deletestudentanswer" href="javascript:void(0);" title="Delete Student Answer" data-id="<?php echo $r1['student_answer_id']; ?>"><i class="fa fa-trash"> </i></a>
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



 <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="answer[]" placeholder="Enter your Answer" class="form-control name_list"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"student_answers.php",  
                method:"POST",  
                data:$('#add_answer').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_answer')[0].reset();  
                }  
           });  
      });  
 });  
 </script>
