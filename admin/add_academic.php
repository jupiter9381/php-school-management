<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `academic` WHERE `academic_id` = '$id'"));
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Academic</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['academic_id'])?'Edit Academic':'Add Academic';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddacademic" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Academic Name *</label>
                                    <input type="text"  placeholder = "Academic Name" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['first_name'])?$data['first_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "last_name" id = "last_name" title = "last Name Required"  value="<?php echo isset($data['last_name'])?$data['last_name']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                <label>Student Name *</label>
                                <select class="form-control" id="project_member" name="project_member">
                                        <option value="">--Select--</option>
                                    <?php
                                        $selectpck = "SELECT * FROM member";
                                        $sql = mysqli_query($db, $selectpck);
                                    while ($row = mysqli_fetch_array($sql)) {
                                        $selected = (isset($data['member_id']) && $row['member_id'] == $data['member_id'])?'selected':'';
                                    ?>
                                        <option value="<?php echo $row['member_id']; ?>" <?=$selected; ?>><?php echo $row['member']; ?></option>>
                                    
                                    <?php }?> 
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Class Schedule *</label>
                                    <input type="text"  placeholder = "Class Schedule" class = "form-control" name = "mobile_number" id = "mobile_number" title = "Mobile Number Required"  value="<?php echo isset($data['mobile_number'])?$data['mobile_number']:''?>"required>
                                </div>  
                            </div>                         
                            
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddAcademic_id">
                                        <input type="submit"  id="formvalidate" data-form="formaddacademic"  class="btn btn-info btn-md btn-submit"  value="Add Academic">
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
