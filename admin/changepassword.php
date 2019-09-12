<?php include "header.php";?>


			<!-- 
				MIDDLE 
			-->
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>Change Password</h1>
					
				</header>
				<!-- /page title -->

				<div id="content" class="padding-30">

					
					<div id="panel-1" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Change Password</strong> <!-- panel title -->
							</span>
							
							</div> 	

							
						</div>
						
                      <form class="form-horizontal style-form" action="" id="adminchangepass" method="post" name="chngpwd" onSubmit="return valid();">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Current Password</label>
                              <div class="col-sm-10">
                                   <input type="password"  placeholder = "Please type your current password" class = "form-control" name ="current_password" id ="current_password" title ="Enter current password !" min="6">
                              </div>
                          </div>

                             <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">New Password</label>
                              <div class="col-sm-10">
                                    <input type="password"  placeholder = "Please enter your new password" class = "form-control" name ="new_password" id = "new_password"  title="Enter New Password">
                              </div>
                          </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
                              <div class="col-sm-10">
                                   <input type="password"  placeholder = "Please retype your new password" class = "form-control" name = "confirm_password" id ="rpassword">
                              </div>
                          </div>
                         
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 text-center">
                                            <button type="submit" name ="updatepassword"  class="btn btn-info btn-md btn-submit" >Update Password</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                         
                          </form>
                          </div>
                          </div>
                          </div>
                          
          	
          	
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

<?php include "footer.php";?>