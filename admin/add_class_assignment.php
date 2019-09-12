<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT c.*,s.age_year FROM `class_assignment` c LEFT JOIN `school_application` s ON c.student_app_id=s.student_app_id WHERE `class_assignment_id` = '$id'"));


    }
    //print_r($data);
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Class Assignment</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['attendance_id'])?'Edit Class Assignment':'Add Class Assignment';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddclassassignment" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Student Name*</label>
                                    <select class="form-control select2" id="student_class_assignment" name="student_app_id" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM school_application";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['student_app_id']) && $row['student_app_id'] == $data['student_app_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['student_app_id']; ?>" <?=$selected; ?>><?php echo $row['student_name']; ?></option>
                                        
                                        <?php }?> 
                                    </select>
                                </div>
                           
                                 <div class="col-md-6 col-sm-6">
                                    <label>Age *</label>
                                    <input type="text"  placeholder = "Age" class = "form-control" name = "age_year" id = "age_year" title = "Age Required"  value="<?php echo isset($data['age_year'])?$data['age_year']:''?>" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Class Room *</label>
                                    <input type="text"  placeholder = "Class Room" class = "form-control" name = "class_room" id = "class_room" title = "Class Room Required"  value="<?php echo isset($data['class_room'])?$data['class_room']:''?>" required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                <label>Academic </label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="class_academic_id" name="class_academic_id">
                                            <option value="">--Select--</option>
                                            <?php
                                                $selectpck = "SELECT * FROM class_academic";
                                                $sql = mysqli_query($db, $selectpck);
                                            while ($row = mysqli_fetch_array($sql)) {
                                                $selected = (isset($data['class_academic_id']) && $row['class_academic_id'] == $data['class_academic_id'])?'selected':'';
                                            ?>
                                            <option value="<?php echo $row['class_academic_id']; ?>" <?=$selected; ?>><?php echo $row['class_academic_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                    </div>   
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                <label>CCA </label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="cca_id" name="cca_id">
                                            <option value="">--Select--</option>
                                            <?php
                                                $selectpck = "SELECT * FROM cca";
                                                $sql = mysqli_query($db, $selectpck);
                                            while ($row = mysqli_fetch_array($sql)) {
                                                $selected = (isset($data['cca_id']) && $row['cca_id'] == $data['cca_id'])?'selected':'';
                                            ?>
                                            <option value="<?php echo $row['cca_id']; ?>" <?=$selected; ?>><?php echo $row['cca_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                     </div>   
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                <label>Creative *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="creative_classes_id" name="creative_classes_id">
                                            <option value="">--Select--</option>
                                            <?php
                                                $selectpck = "SELECT * FROM creative_classes";
                                                $sql = mysqli_query($db, $selectpck);
                                            while ($row = mysqli_fetch_array($sql)) {
                                                $selected = (isset($data['creative_classes_id']) && $row['creative_classes_id'] == $data['creative_classes_id'])?'selected':'';
                                            ?>
                                            <option value="<?php echo $row['creative_classes_id']; ?>" <?=$selected; ?>><?php echo $row['classes_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                     </div>   
                                </div>
                            </div>


                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "classid" id="classid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddClassAssignment">
                                    <input type="submit"  id="formvalidate" data-form="formaddclassassignment"  class="btn btn-info btn-md btn-submit"  value="Add Class Assignment">
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
