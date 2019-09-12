<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_report_form` WHERE `student_report_form_id` = '$id'"));
    }
 ?>

<style>
    .radio i {
    position: absolute;
    top: -10px;
    left: 0;
    display: block;
    width: 19px;
    height: 19px;
    outline: none;
    border-width: 2px;
    border-style: solid;
    border-color: rgba(0,0,0,0.3);
    background: rgba(255,255,255,0.3);
}
</style>


<section id="middle">
    
    <header id="page-header">
        <h1>Student Report Form</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['student_report_id'])?'Edit Student Report Form':'Add Student Report Form';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddstudentreportform" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Teacher Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="teacher_resource_assignment_name" name="teacher_resource_assignment_id">
                                            <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM teacher_resource_assignment";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['teacher_resource_assignment_id']) && $row['teacher_resource_assignment_id'] == $data['teacher_resource_assignment_id'])?'selected':'';
                                        ?>
                                            <option value="<?php echo $row['teacher_resource_assignment_id']; ?>" <?=$selected; ?>><?php echo $row['first_name']; ?></option>>
                                        
                                        <?php }?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Student Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                    <select class="form-control select2"  id="student_profile_report" name="student_app_id">
                                        <option value="">--Select--</option>
                                    <?php
                                        $selectpck = "SELECT * FROM school_application";
                                        $sql = mysqli_query($db, $selectpck);
                                    while ($row = mysqli_fetch_array($sql)) {
                                        $selected = (isset($data['student_app_id']) && $row['student_app_id'] == $data['student_app_id'])?'selected':'';
                                    ?>
                                    <option value="<?php echo $row['student_app_id']; ?>" <?=$selected; ?>><?php echo $row['student_name']; ?></option>>
                                    
                                    <?php }?> 
                                    </select>
                                    </div>
                                </div>

                                </div>  
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                <label>Age *</label><br>
                                <div class="col-md-6 col-sm-6 ">
                                <input type="text"  placeholder = "Year" class = "form-control" name = "age_year" id = "age_year"  value="<?php echo isset($data['age_year'])?$data['age_year']:''?>">
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                <input type="text"  placeholder = "Month" class = "form-control" name = "age_month" id = "age_month" value="<?php echo isset($data['age_month'])?$data['age_month']:''?>">
                                </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Nationality *</label>
                                    <input type="text"  placeholder = "Nationality" class = "form-control" name = "nationality" id = "nationality" title = "Nationality Required"  value="<?php echo isset($data['nationality'])?$data['nationality']:''?>"required>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                            <thead>
                                                <tr>  
                                                    <th style="text-align: center;"></th>
                                                    <th style="text-align: center;">Minimal</th>
                                                    <th style="text-align: center;"></th>
                                                    <th style="text-align: center;">Fair</th> 
                                                    <th style="text-align: center;"></th>
                                                    <th style="text-align: center;">Excellent</th> 
                                                </tr>
                                                <tr>  
                                                    <th style="text-align: center;">Level of improvement:</th>
                                                    <th style="text-align: center;">1</th>
                                                    <th style="text-align: center;">2</th>
                                                    <th style="text-align: center;">3</th> 
                                                    <th style="text-align: center;">4</th>
                                                    <th style="text-align: center;">5</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>  
                                                    <td>Problem Solving and Thinking Skills</td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="problem_solving" value="1" <?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '1')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="problem_solving" value="2" <?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '2')){ echo "checked"; }?> >
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="problem_solving" value="3" <?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '3')){ echo "checked"; }?> >
                                                    <i></i>
                                                    </label></td> 
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="problem_solving" value="4" <?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '4')){ echo "checked"; }?> >
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="problem_solving" value="5" <?php if((isset($data['problem_solving'])) && ($data['problem_solving'] == '5')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                </tr>

                                                <tr>
                                                   <th><br></th>

                                                </tr>



                                                <tr>  
                                                    <td>Organizational and Research Skills</td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="organizational" value="1" <?php if((isset($data['organizational'])) && ($data['organizational'] == '1')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="organizational" value="2" <?php if((isset($data['organizational'])) && ($data['organizational'] == '2')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="organizational" value="3" <?php if((isset($data['organizational'])) && ($data['organizational'] == '3')){ echo "checked"; }?> >
                                                    <i></i>
                                                    </label></td> 
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="organizational" value="4" <?php if((isset($data['organizational'])) && ($data['organizational'] == '4')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="organizational" value="5" <?php if((isset($data['organizational'])) && ($data['organizational'] == '5')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                </tr>
                                                 <tr>
                                                   <th><br></th>

                                                </tr>
                                                <tr>  
                                                    <td>Communication Skills</td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="communication" value="1" <?php if((isset($data['communication'])) && ($data['communication'] == '1')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="communication" value="2" <?php if((isset($data['communication'])) && ($data['communication'] == '2')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="communication" value="3" <?php if((isset($data['communication'])) && ($data['communication'] == '3')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="communication" value="4" <?php if((isset($data['communication'])) && ($data['communication'] == '4')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="communication" value="5" <?php if((isset($data['communication'])) && ($data['communication'] == '5')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                </tr>
                                                 <tr>
                                                   <th><br></th>

                                                </tr>

                                                <tr>  
                                                    <td>Character and Interpersonal Skills</td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="character_skills" value="1" <?php if((isset($data['character_skills'])) && ($data['character_skills'] == '1')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="character_skills" value="2" <?php if((isset($data['character_skills'])) && ($data['character_skills'] == '2')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="character_skills" value="3" <?php if((isset($data['character_skills'])) && ($data['character_skills'] == '3')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="character_skills" value="4" <?php if((isset($data['character_skills'])) && ($data['character_skills'] == '4')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="character_skills" value="5" <?php if((isset($data['character_skills'])) && ($data['character_skills'] == '5')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                </tr>
                                                 <tr>
                                                   <th><br></th>

                                                </tr>
                                                <tr>  
                                                    <td>English Level at start of Camp</td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_start" value="1" <?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '1')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_start" value="2" <?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '2')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_start" value="3" <?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '3')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_start" value="4" <?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '4')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_start" value="5" <?php if((isset($data['english_level_start'])) && ($data['english_level_start'] == '5')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                </tr>
                                                <tr>
                                                   <th><br></th>

                                                </tr>    
                                                <tr>  
                                                    <td>English Level at end of Camp</td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_end" value="1" <?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '1')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_end" value="2" <?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '2')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_end" value="3" <?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '3')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_end" value="4" <?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '4')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td>
                                                    <td style="text-align: center;"><label class="radio">
                                                    <input type="radio" name="english_level_end" value="5" <?php if((isset($data['english_level_end'])) && ($data['english_level_end'] == '5')){ echo "checked"; }?>>
                                                    <i></i>
                                                    </label></td> 
                                                </tr>
                                            
                                            </tbody> 
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label>Teacher Comment *</label><br>
                                    <textarea rows="10" placeholder = "Teacher Comment" class = "form-control" name = "teacher_comment" id = "teacher_comment"><?php echo isset($data['teacher_comment'])?$data['teacher_comment']:''?></textarea>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                <label>Camp Director (Ian Nenke) </label>
                                </div>
                                <div class="col-md-6 col-sm-6">  
                                <label>Teacher </label>
                                <input type="text" placeholder = "Teacher" class = "form-control" name = "first_name" id = "first_name" value="<?php echo isset($data['first_name'])?$data['first_name']:''?>">
                                                           

                                </div>
                            </div>                  
                         
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddStudentReportForm">
                                    <input type="submit"  id="formvalidate" data-form="formaddstudentreportform"  class="btn btn-info btn-md btn-submit"  value="Add Student Report">
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

