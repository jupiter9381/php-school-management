<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `camp_teacher` WHERE `camp_teacher_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Camp Revenue</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['camp_teacher_id'])?'Edit CampRevenue':'Add Camp Revenue';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddcamprevenue" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Camp Revenue Name *</label>
                                    <input type="text"  placeholder = "Camp Revenue Name" class = "form-control" name = "first_name" id = "first_name" title = "First Name Required"  value="<?php echo isset($data['first_name'])?$data['first_name']:''?>"required>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Student Required *</label>
                                    <div class="fancy-form fancy-form-select">
                                    <select class="form-control select2" id="project_member" name="project_member">
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
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Revenue *</label>
                                    <div class="fancy-file-upload fancy-file-primary">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="image" onchange="jQuery(this).next('input').val(this.value);"  accept="jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx'">
                                        <input type="text" class="form-control" placeholder="No file selected" readonly=""  value="<?php echo isset($data['project_des'])?$data['project_file']:''?>" required> 
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Boarding Number *</label>
                                    <input type="text"  placeholder = "Boarding Number" class = "form-control" name = "mobile_number" id = "mobile_number" title = "Mobile Number Required"  value="<?php echo isset($data['mobile_number'])?$data['mobile_number']:''?>"required>
                                </div>  
                            </div>
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddCampRevenue">
                                        <input type="submit"  id="formvalidate" data-form="formaddcamprevenue"  class="btn btn-info btn-md btn-submit"  value="Add Camp Revenue">
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
