<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT t.*,a.student_pickup FROM transport_routes t LEFT JOIN school_application a ON t.student_app_id=a.student_app_id WHERE `transport_routes_id` = '$id'"));

    }
    $pickup_location = "";
    if(isset($data['pickup_id'])){
        if($data['pickup_id'] == 1){
            $pickup_location = "Danga Bay (Starbucks)";
        }
        if($data['pickup_id'] == 2){
            $pickup_location = "Teega A (lobby)";
        }
        if($data['pickup_id'] == 3){
            $pickup_location = "Teega B (lobby)";
        }
        if($data['pickup_id'] == 4){
            $pickup_location = "Teega Suites (lobby)";
        }
        if($data['pickup_id'] == 5){
            $pickup_location = "Mall of medini(lobby)";
        }
        
    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Transport Routes – Pickup / Drop Locations </h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['transport_routes_id'])?'Edit Transport Routes':'Add Transport Routes';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddtransportroutes" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Student Name *</label>
                                    <div class="fancy-form fancy-form-select">
                                        <select class="form-control select2"  id="student_routes" name="student_app_id">
                                                <option value="">--Select--</option>
                                            <?php
                                                $selectpck2 = "SELECT * FROM school_application";
                                                $sql2 = mysqli_query($db, $selectpck2);
                                            while ($row2 = mysqli_fetch_array($sql2)) {
                                                $selected2 = (isset($data['student_app_id']) && $row2['student_app_id'] == $data['student_app_id'])?'selected':'';
                                            ?>
                                                <option value="<?php echo $row2['student_app_id']; ?>" <?=$selected2; ?>><?php echo $row2['student_name']; ?></option>
                                            
                                            <?php }?> 
                                        </select>
                                    </div>   
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Pickup Locations *</label>
                                    <input type="text"  placeholder = "Pickup Locations" class = "form-control" name = "" id = "student_pickup" title = "Pickup Locations Required"  value="<?php echo $pickup_location;?>" disabled >
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Drop Locations *</label>
                                    <input type="text"  placeholder = "Drop Locations" class = "form-control" name = "drop_locations" id = "drop_locations" title = "Drop Locations Required"  value="<?php echo isset($data['drop_locations'])?$data['drop_locations']:''?>"required>
                                </div>  
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Route Number *</label>
                                    <input type="text"  placeholder = "Route Number" class = "form-control" name = "route_number" id = "route_number" title = "Route Number Required" value="<?php echo isset($data['route_number'])?$data['route_number']:''?>"required>
                                </div>
                                  
                            </div>
                                <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                       <input type ="hidden" name = "pickup_id" value="<?php echo isset($data['pickup_id'])?$data['pickup_id']:''?>" id="pickup_id">
                                        <input type ="hidden" name = "type" value="Addtransportroutes">
                                        <input type="submit"  id="formvalidate" data-form="formaddtransportroutes"  class="btn btn-info btn-md btn-submit"  value="Add Transport Routes">
                                    </div>
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
