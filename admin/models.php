
<style type="text/css">
  .select2{
    width: 100% !important;
  }
</style>
       
  <!-- Add New Schedule Model -->
            <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
						<form  class="" method = "post" id='ManageSchedule' action = ""  enctype="multipart/form-data"> 
                        <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="heading-text4">Add New Schedule</h4>
                        </div>
                        <div class="modal-body">
					
                            <fieldset>
							             <div class="row">
                              <div class="form-group">
							                  <div class="col-md-6">
                                 <label>Route Name *</label>
                                 <input type="text" class="form-control"  placeholder = "Route Name" name = "route_name" id = "route_name" title = "Route Name Required"  value="<?php echo isset($data['route_name'])?$data['route_name']:''?>"required>
                                   
                              </div> 
								              <div class="col-md-6">
                                 <label>Date *</label>
                                <input type="text " name="sdate" required="" id="sdate" placeholder="Schedule Date" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" title="Date is required" class="form-control datepicker" value="<?php echo isset($data['sdate'])?date('d-m-Y',strtotime($data['sdate'])):'';?>"required>
								
								
                                </div>
                                <div class="clearfix"></div>
                               </div>
                             </div>
                             <div class="row">
                              <div class="form-group">
                                <div class="col-md-6">
                                 <label>Transport Driver *</label>
                                   <select name="driver_id" id="driver_id" required="" class=" form-control selectpicker">
                                <option value="">Select</option>
                                <?php 
                                $q3=mysqli_query($db,"select *from transport_drivers order by first_name asc");
                                while($r2=mysqli_fetch_assoc($q3))
                                {
                                 $driver=$r2["first_name"].' '.$r2["last_name"];
                                ?>
                                <option value="<?php echo $r2["transport_drivers_id"];?>"><?php echo $driver;?></option>
                                <?php } ?>
                                </select>
                              </div> 
                              <div class="col-md-6">
                                 <label>Transport Driver (Phone)*</label>
                                <input type="text " name="phone" required="" id="phone" placeholder="Transport Driver (Phone)" title="Transport Driver (Phone) required" class="form-control" value="<?php echo isset($data['phone'])?$data['phone']:''?>"required>                
                
                                </div>
                                <div class="clearfix"></div>
                               </div>
                             </div>
							
                            <div class="row">

                              <div class="form-group">

                              <div class="col-md-6">
                                 <label>Transport Vehicle *</label>
                                <input type="text" class="form-control"  placeholder = "Route Name" name = "vehicle" id = "vehicle" title = "Transport Vehicle Required"  value="<?php echo isset($data['vehicle'])?$data['vehicle']:''?>"required>                
                
                                </div>

                              
							  
								              <div class="col-md-6">
                                  <label>Boarding Staff * </label><br>
                                  <select class="form-control select2" name="staff_id[]" id="staff_id" multiple="multiple" required="" >


                                    <?php



                                        $staff_list = array();
                                        if(isset($data['boarding_staff_id'])){
                                            if(strpos($data['boarding_staff_id'], ',')){
                                                $staff_list = explode(',', $data['boarding_staff_id']);
                                            }else{
                                                $staff_list[] = $data['boarding_staff_id'];
                                            }
                                        }

                                        $selectpck = "SELECT * FROM boarding_staff";
                                        $sql = mysqli_query($db, $selectpck);
                                    while ($row = mysqli_fetch_array($sql)) {
                                        $str = $row['boarding_staff_id'];
                                        if(strpos($str, ',')){
                                            $str = "'".str_replace(",", "','", $str)."'";
                                        }
                                        else{
                                            $str = "'".$str."'";
                                        }
                                        $sql002 = "SELECT * FROM boarding_staff WHERE boarding_staff_id IN ($str)";
                                        $query002 = mysqli_query($db,$sql002) or die(mysqli_error($db));
                                        $row002 = mysqli_fetch_assoc($query002,MYSQLI_ASSOC);
                                        $first_name = array();
                                        foreach ($row002 as $key => $value) {
                                            $first_name[] = $value['first_name'];
                                        }
                                        
                                        $first_name = implode(',',$first_name);
                                        $selected = (in_array($row['boarding_staff_id'], $staff_list))?'selected':'';
                                    ?>



  								
      								              <?php 
      								              /*$q4=mysqli_query($db,"select * from boarding_staff order by first_name asc");
      								              while($r1=mysqli_fetch_assoc($q4))
      								              {
      									              $staff=$r1["first_name"].' '.$r1["last_name"];*/
      								              ?>
      								              <option value="<?php echo $row["boarding_staff_id"];?>" <?=$selected; ?>><?php echo $row["first_name"];?></option>
      								            <?php } ?>
                                  </select>
                                </div>
								              <div class="clearfix"></div>
								
                               
                               </div>
                             </div>
							 
                                
                            </fieldset>
                       
                        </div>
                        <div class="modal-footer">
						       <input type="hidden" name="type" value="ManageSchedule">
								 <input type="hidden" name="id"  id="id">
                              <button name = "submit" id="formvalidate" data-form="ManageSchedule" type = "submit"  class="btn btn-info btn-sm btn-submit btn4" >Submit</button>
                            <button type="button" class="btn btn-link btn-default" data-dismiss="modal">CLOSE</button>
                        </div>
						 </form>
                    </div>
                </div>
            </div>
				

       
  <!-- One View Model -->
            <div class="modal fade" id="oneviewModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
					
                        <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="heading-text4">Schedule Details</h4>
                        </div>
                        <div class="modal-body">
							 <div class="row">
							   <div class="col-md-12">
                                
							<div id="schedule_detail"> 	
								
								
                                </div> 
                                <div class="clearfix"></div>
                               
                             </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link btn-default" data-dismiss="modal">CLOSE</button>
                        </div>
						 
                    </div>
                </div>
            </div>
				

	
	
	