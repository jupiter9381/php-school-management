<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `boarding_room` WHERE `boarding_room_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Boarding Room</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['camp_fee_id'])?'Edit Boarding Room':'Add Boarding Room';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddboardingroom" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Boarding Room Number *</label>
                                    <input type="text" class="form-control" name="boarding_room_number" id="boarding_room_number" value="<?php echo isset($data['boarding_room_number'])?$data['boarding_room_number']:''?>">
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Floor Number *</label>
                                    <input type="text" class="form-control" name="floor_number" id="floor_number" value="<?php echo isset($data['floor_number'])?$data['floor_number']:''?>">
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Buiding Number *</label>
                                    <input type="text" class="form-control" name="buiding_number" id="buiding_number" value="<?php echo isset($data['buiding_number'])?$data['buiding_number']:''?>">
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Boarding Staff *</label>
                                      <select class="form-control select2" name="boarding_staff_id" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $selectpck = "SELECT * FROM  boarding_staff";
                                            $sql = mysqli_query($db, $selectpck);
                                        while ($row = mysqli_fetch_array($sql)) {
                                            $selected = (isset($data['boarding_staff_id']) && $row['boarding_staff_id'] == $data['boarding_staff_id'])?'selected':'';
                                        ?>
                                        <option value="<?php echo $row['boarding_staff_id']; ?>" <?=$selected; ?>><?php echo $row['first_name']; ?></option>
                                        
                                        <?php }?> 
                                    </select>
                                </div>
                            </div>                              
                           
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                   <input type ="hidden" name = "boarding_room_id" id="boarding_room_id" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddBoardingRoom">
                                    <input type="submit"  id="formvalidate" data-form="formaddboardingroom"  class="btn btn-info btn-md btn-submit"  value="Add Camp Fee">
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
