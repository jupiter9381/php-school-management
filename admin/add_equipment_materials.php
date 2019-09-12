<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `equipment_assignment` WHERE `equipment_assignment_id` = '$id'"));
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Add Equipment / Materials Assignment </h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['cca_id'])?'Edit Equipment / Materials Assignment ':'Add Equipment / Materials Assignment';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddequipmentmaterials" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Equipment / Materials Name *</label>
                                    <input type="text"  placeholder = "Equipment / Materials Name" class = "form-control" name = "equipment_assignment_name" id = "equipment_assignment_name" title = "Equipment / Materials Required"  value="<?php echo isset($data['equipment_assignment_name'])?$data['equipment_assignment_name']:''?>"required>
                                </div>
                                 <div class="col-md-6 col-sm-6 ">
                                <label>Category of Equipment / Materials *</label>
                                <div class="fancy-form fancy-form-select">
                                <select class="form-control select2" id="   category_of_equipment" name=" category_of_equipment">
                                        <option value="">--Select--</option>

                                        <option value="Sports">Sports</option>
                                        <option value="Creative">Creative</option>
                                    <?php
                                    //     $selectpck = "SELECT * FROM member";
                                    //     $sql = mysqli_query($db, $selectpck);
                                    // while ($row = mysqli_fetch_array($sql)) {
                                    //     $selected = (isset($data['member_id']) && $row['member_id'] == $data['member_id'])?'selected':'';
                                    ?>
                                       <!--  <option value="<?php //echo $row['member_id']; ?>" <?=$selected; ?>><?php //echo $row['member']; ?></option> -->
                                    
                                    <?php// }?> 
                                    </select>
                                </div>  
                                </div>                                                  
                            
                            </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddEquipmentMaterials">
                                        <input type="submit"  id="formvalidate" data-form="formaddequipmentmaterials"  class="btn btn-info btn-md btn-submit" value="Add Equipment / Materials">
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
