<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `camp_teacher` WHERE `camp_teacher_id` = '$id'"));


    }
 ?>
<section id="middle">
    
    <header id="page-header">
        <h1>Boarding / Accommodation Assignment</h1>
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['camp_teacher_id'])?'Edit  BoardingAssignment':' Boarding / Accommodation Assignment';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddboardingassignment" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">                                
                                <div class="col-md-6 col-sm-6 ">
                                    <label> Boarding / Accommodation Assignment *</label>
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
                                <div class="col-md-6 col-sm-6" style=" top: 25px";>
                                    
                                    <input type = "hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="Add boardingassignment">
                                        <input type="submit"  id="formvalidate" data-form="formaddboardingassignment"  class="btn btn-info btn-md btn-submit"  value="Search Boarding Assignment">
                                </div> 
                            </div>
                           
                        </div>
                          
                          <!--   <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-left">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php //echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="AddCampRevenue">
                                        <input type="submit"  id="formvalidate" data-form="formaddcamprevenue"  class="btn btn-info btn-md btn-submit"  value="Search Camp Revenue">
                                    </div>
                                </div>
                            </div> -->
                        
                       
                    </fieldset>
                </form>
            </div>
        </div>
        
    </div>
</section>
<section id="middle">
        <header id="page-header">
            <!-- <h1>Camp Revenue</h1> -->
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis">
                        <!-- panel title -->
                       <!--  <strong>Camp Revenue</strong>
                    </span> -->
                                        
                    <!-- <a href="add_camp_revenue.php" class="btn btn-info btn-xs pull-right">Add Camp Revenue</a> -->
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                            <thead>
                                <tr>
                                                                     
                                    
                                    <th>Boarding / Accommodation Assignment</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <!-- <tbody>
                            <?php
                            $i=0;

                            $q1 = mysqli_query($db, "SELECT * FROM `camp_teacher`");                               
                                while($r1 = mysqli_fetch_assoc($q1)) 
                              
                               {             
                            $i++;      
                
                                ?>
                            <tr id="invoice<?php echo $r1['camp_teacher_id'];?>">                                  
                                    
                                    
                                    <td><?php echo $r1['id_number']; ?></td>
                                    <td><?php echo $r1['first_name']; ?></td>
                                    <td><?php echo $r1['last_name']; ?></td>
                                    <td><?php echo $r1['mobile_number'];?></td>
                                    <td><?php echo $r1['email_id']; ?></td>
                                    <td><?php echo $r1['address']; ?></td>
                                    <td><img src="../upload/<?php echo $r1['image'];?>" alt="Image" width="100" height="100"></td>
                                        
                      <td>                       
                        
                        <a class="btn btn-xs btn-info" href="add_campteachers.php?id=<?php echo $r1['camp_teacher_id'];?>" ><i class="fa fa-edit"></i></a>
                        &nbsp;                         
                       
                        <a class="btn btn-xs btn-danger DeleteCampRevenue" href="javascript:void(0);" title="Delete Camp Teacher" data-id="<?php echo $r1['camp_teacher_id']; ?>"><i class="fa fa-trash"> </i></a>
                        &nbsp;                                       
                      </td>
                    </tr>
                             <?php }?>
                            
                            </tbody> -->
                              
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include("footer.php"); ?>
