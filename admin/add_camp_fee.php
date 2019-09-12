<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `camp_fee` WHERE `camp_fee_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Camp Fee/Cost Assignment</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['camp_fee_id'])?'Edit Camp Fee/Cost Assignment':'Add Camp Fee/Cost Assignment';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddcampfee" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label>Camp Name*</label>
                                    <select class="form-control select2" name="camp_name" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM  camp_management";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['camp_name']) && $row['camp_name'] == $data['camp_name'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['camp_name']; ?>" <?=$selected; ?>><?php echo $row['camp_name']; ?></option>
                                        
                                        <?php }?> 
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Camp Fee *</label>
                                    <input type="text" class="form-control" name="camp_fee" id="camp_fee" value="<?php echo isset($data['camp_fee'])?$data['camp_fee']:''?>">
                                </div>
                                
                            </div> 

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Transport Fee *</label>
                                    <input type="text" class="form-control" name="transport_fee" id="transport_fee" value="<?php echo isset($data['transport_fee'])?$data['transport_fee']:''?>">
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Activity Fee *</label>
                                    <input type="text" class="form-control" name="activity_fee" id="activity_fee" value="<?php echo isset($data['activity_fee'])?$data['activity_fee']:''?>">
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Notes *</label>
                                    <input type="text" class="form-control" name="camp_notes" id="camp_notes" value="<?php echo isset($data['camp_notes'])?$data['camp_notes']:''?>">
                                </div>
                            </div>                              
                           
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "campid" id="campid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddCampFee">
                                    <input type="submit"  id="formvalidate" data-form="formaddcampfee"  class="btn btn-info btn-md btn-submit"  value="Add Camp Fee">
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
