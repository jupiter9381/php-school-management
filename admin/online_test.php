<?php include("header.php");
   /*if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `transport_incident_reports` WHERE `transport_incident_reports_id` = '$id'"));
    }*/

    $online_test = $_POST['online_test'];
    //echo "SELECT * FROM `student_questions` WHERE `test_name_id` = '$online_test'";

    

 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Online Test</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['transport_incident_reports_id'])?'Edit TransportIncidentReports':'Online Test';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formolinetest" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <!-- Pagination -->
                            <div id="panel-misc-portlet-r5" class="panel panel-default">

                                <div class="panel-heading responsible ">
  
                                    <ul class="pagination pagination-sm pull-center">
                                       
                                       <?php 

                                        for($i=1;$i<=10;$i++)
                                        {    
                                            
                                            $active = "";      
                                            if($i==1)
                                            {
                                                $active = "active";
                                            }                                           
                                        ?>
                                        <li class="<?=$active; ?>"><a href="#fragment-<?php echo $i; ?>"  data-toggle="tab"><?php echo $i; ?> </a></li>

                                        <?php } ?>
                                    
                                </div>

                            </div>
                            
                            <div class="tab-content transparent">

                            <?php 
                            //echo "SELECT * FROM `student_questions` WHERE `test_name_id` = '$online_test'";
                            $sql = mysqli_query($db, "SELECT * FROM `student_questions` WHERE `test_name_id` = '$online_test'");
                            $i = 1;
                            $question_count = mysqli_num_rows($sql);
                            while($data = mysqli_fetch_assoc($sql))
                            { 
                                $active1 = '';
                                if($i == 1){
                                    $active1 = 'active';
                                }
                               
                                                                           
                            ?>

                            <div id="fragment-<?php echo $i; ?>" class="tab-pane <?=$active1; ?>">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label><?php echo $i; ?>. <?php  echo $data['questions']; ?> </label>
                                        <br> 
                                        <?php 
                                            $sql2 = "SELECT * FROM `student_answer` WHERE `student_questions_id` = '$data[student_questions_id]'";
                                            $query2 = mysqli_query($db,$sql2) or die(mysqli_error($db));
                                            $row2 = mysqli_fetch_assoc($query2);
                                            $answer_array = array();
                                            if(strpos($row2['answer'], ','))
                                            {
                                                $answer_array = explode(',',$row2['answer']);
                                            }
                                            else{
                                                $answer_array[] = $row2['answer']; 
                                            }
                                            foreach($answer_array as $options)
                                            echo '<label class="radio-inline">
                                            <input type="radio" name="answer['.$row2['student_questions_id'].']" id="answer" value="'.$options.'">'.$options.'</label> <br>';
                                        ?>
                                    </div>  
                                </div>
                                <div class="tab-pane" id="fragment-1">
                                    <a class="btn btn-primary btnPrevious" style="display: none;">Previous</a>
                                    <a class="btn btn-primary btnNext">Next</a>
                                </div>
                            </div>

                            <?php $i++; } ?>

                         
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                    <input type ="hidden" name = "test_id" id="test_id" value="<?php echo isset($online_test)?$online_test:'';?>">
                                    <input type ="hidden" name = "type" value="AddOnlineTest">

                                    <input type="submit" id="formvalidate" data-form="formaddtransportincidentreports" class="btn btn-info btn-md btn-submit" style="display: none;"  value="Submit Online Test">
                                    </div>
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
<script type="text/javascript">
    var question_count = '<?=$question_count;?>';
    var prev_next_action_count = 1;
    $('.btnNext').click(function(){
        $('.btnPrevious').show();
        prev_next_action_count++;
        if(prev_next_action_count > 1){
            $('.btnPrevious').show();
        }
         if(prev_next_action_count == 10){
            $('#formvalidate').show();
        }
        $('.pagination').find('li.active').next().find('a').click();
    })
    $('.btnPrevious').click(function(){
        $elm = $(this);
        prev_next_action_count--;
        if(prev_next_action_count == 1){
            // console.log(prev_next_action_count);
            $('.btnPrevious').hide();
        }
        if(prev_next_action_count<10){
            $('#formvalidate').hide();
        }
        $('.pagination').find('li.active').prev().find('a').click();
    }) 
</script>
