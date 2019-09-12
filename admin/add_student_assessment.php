<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_assessment` WHERE `assessment_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Student Assessment</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['assesement_id'])?'Edit Student Assessment':'Add Student Assessment';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formstudentassessment" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Student Name*</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" name="student_name" id="student_name">
                                            <option>--Select--</option>
                                            <option>ABC</option>
                                            <option>XYZ</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-6">
                                    <label>Listing Exam*</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" name="listing_exam" id="listing_exam">
                                            <option>--Select--</option>
                                            <option>Unit Test</option>
                                            <option>Semester</option>
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Oral Test*</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" name="oral_test" id="oral_test">
                                            <option>--Select--</option>
                                            <option>Test 1</option>
                                            <option>Test 2</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-6">
                                    <label>Notes *</label>
                                    <textarea class="form-control" rows="5" name="assesment_notes" id="assesment_notes"><?php echo isset($data['assesment_notes'])?$data['assesment_notes']:''?></textarea>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <input type ="hidden" name = "assessmentid" id="assessmentid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddStudentAssessment">
                                    <input type="submit"  id="formvalidate" data-form="formaddstudentassessment"  class="btn btn-info btn-md btn-submit"  value="Add Student Assessment">
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

