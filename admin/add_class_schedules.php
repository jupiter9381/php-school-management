<?php include("header.php");
   if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT t1.*,t2.camp_name FROM `class_schedules` as t1 join `camp_management` as t2 on t1.camp_id=t2.camp_management_id WHERE t1.class_schedules_id = '$id'"));
    }
 ?>
<section id="middle">
    
  
    <div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo isset($data['class_schedules_id'])?'Edit Class Schedules':'Add Class Schedules';?></h2>
            </div>
            <div class="panel-body">
                <form action="" id = "formaddclassschedules" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Camp Name *</label>
									<div class="fancy-form fancy-form-select">
                                        <select class="form-control select2" id="camp_name" name="camp_name">
                                        <option value="<?php echo isset($data['camp_id'])?$data['camp_id']:''?>"><?php echo isset($data['camp_id'])?$data['camp_name']:'-Select-'?></option>
                                        <?php                                      
                                        $sql = mysqli_query($db,"SELECT * FROM camp_management");
                                        while ($r1 = mysqli_fetch_array($sql)) {                                            
                                        ?>
                                        <option value="<?php echo $r1['camp_management_id']; ?>" ><?php echo $r1['camp_name']; ?></option>
                                        
                                        <?php }?> 
                                        </select>
                                    </div>
									
                                    
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Class Name *</label>
                                    <input type="text"  placeholder = "Class Name" class = "form-control" name = "class_name" id = "class_name" title = "Class Name Required"  value="<?php echo isset($data['class_name'])?$data['class_name']:''?>"required>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Day *</label>
                                    <select class="form-control" id="day" name="day" title = "Day Required" required>
                                        <option value="<?php echo isset($data['day'])?$data['day']:''?>"><?php echo isset($data['day'])?$data['day']:'-Select-'?></option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                   
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Date *</label>
                                    <input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"  placeholder = "Date" class = "form-control" name = "date" id = "date"title = "Date Required" value="<?php echo isset($data['date'])?$data['date']:''?>"required>
                                </div>  
                            </div> 
                             <div class="row">
                                <div class="col-md-6 col-sm-6 ">
                                    <label>Time *</label>
                                    <input type="text"  placeholder = "Time" class = "form-control timepicker" name = "time" id = "time" title = "Time Required"  value="<?php echo isset($data['time'])?$data['time']:''?>"required>
                                </div>
                                 
                            </div>                        
                            
                        </div>
                          
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 text-center">
                                       <input type ="hidden" name = "txtid" id="txtid" value="<?php echo isset($id)?$id:'';?>">
                                        <input type ="hidden" name = "type" value="Addclassschedules">
                                        <input type="submit"  id="formvalidate" data-form="formaddclassschedules"  class="btn btn-info btn-md btn-submit"  value="<?php echo isset($id)?'Edit Class Schedules':'Add Class Schedules';?>">
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
