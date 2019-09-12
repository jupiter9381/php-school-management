<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `commission_fee` WHERE `commission_fee_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Commission Fee</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['project_id'])?'Edit Commission Fee':'Add Commission Fee';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddcommissionfee" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Student Name *</label>
                                    <select class="form-control select2" id="student_comission_fee" name="student_comission_fee">
                                        <option value="">--Select--</option>
                                             <?php
                                                $selectpck = "SELECT * FROM student_profile";
                                                $sql = mysqli_query($db, $selectpck);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                $selected = (isset($data['commission_fee_id']) && $row['student_profile_id'] == $data['commission_fee_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row['first_name']; ?>" <?=$selected; ?>><?php echo $row['first_name']; ?></option>
                                            
                                            <?php }?> 
                                    </select>
                                    
                                </div>
                           
                                 <div class="col-md-6 col-sm-6 ">
                                    <label>Comission Fee *</label>
                                    <input type="text"  placeholder = "Comission Fee" class = "form-control" name = "commission_fee" id = "commission_fee" title = "Comission Fee Required"  value="<?php echo isset($data['commission_fee'])?$data['commission_fee']:''?>" required>
                                </div>
                            </div>

                        		   
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "commissionfeeid" id="commissionfeeid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddCommissionFee">
                                    <input type="submit"  id="formvalidate" data-form="formaddcommissionfee"  class="btn btn-info btn-md btn-submit"  value="Add Commission Fee">
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
