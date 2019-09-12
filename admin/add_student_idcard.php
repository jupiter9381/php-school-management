<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `student_idcard` WHERE `student_idcard_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Student ID Card</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['idcard_id'])?'Edit Student ID Card':'Add Student ID Card';?></h2>
            </div>
            <div class="panel-body">
                <form action="idcard_info.php" id = "formaddstudentidcard" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Camp Name *</label>
                                    <select class="form-control select2" id="student_idcard_details" name="camp_management_id" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM camp_management";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['camp_management_id']) && $row['camp_management_id'] == $data['camp_management_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['camp_management_id']; ?>" <?=$selected; ?>><?php echo $row['camp_name']; ?></option>
                                        
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
                                                    <th>First Name</th> 
                                                    <th>Generate ID Cards</th>  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "idcardid" id="idcardid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddStudentIDCard">
                                    <input type="submit"  id="formvalidate" data-form="formaddstudentidcard"  class="btn btn-info btn-md btn-submit"  value="Add Student ID Card">
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
