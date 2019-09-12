<?php include "header.php";?>

<section id="middle">
		<div id="content" class="dashboard padding-20">
        <div class="panel panel-default">
          <div class="panel-heading">
              <h2 class="panel-title">Add Team task</h2>
          </div>
            <div class="panel-body">
                <form action="" id = "formaddtask" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="row">
                            <div class="form-group">
                                  </div>
                                 <div class="col-md-6 col-sm-6">
                                    <label>Old Task</label>
                                    
                                    <input type="text" name="old_task" id="old_task" placeholder="Old Task" class="form-control" value="" >


                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <label>Add New Task</label>
                                    
                                    <input type="text" name="add_new_task" id="add_new_task" placeholder="New Task" class="form-control" value="" >
                                </div>

                                     <div class="col-md-6 col-sm-6">
                                    <label>Project Team List</label>
                                    
                                   <select class="form-control">
                                   <option value="">---Project Team List ---</option>
                                    <option value="1">Option 1</option>
                                   <option value="2">option 2</option>
                                   <option value="3">option 3</option>
                                   </select>
                               </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                         


                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <input type ="hidden" name = "taskid" id="taskid" value="<?php echo isset($id)?$id:'';?>">
                                    <input type ="hidden" name = "type" value="AddNewtask">
                                    <input type="submit" title="submit" id="formvalidate" data-form="formaddtask"  class="btn btn-info btn-md btn-submit"  value="Submit">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
	</section>
  <?php include "footer.php";?>
