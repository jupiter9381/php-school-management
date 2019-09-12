<?php include "header.php";?>

<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Delete Team Members</h1>
					
				</header>
				<!-- /page title -->


				<div id="content" class="padding-30">

					
					<div id="panel-1" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Delete Team </strong> <!-- panel title -->
							</span>
							<!--<button onclick="location.href='addteamember.php'" class=" pull-right btn btn-warning">Add Team Members</button>
							</div> 	-->

							
						</div>
						<!-- panel content -->
						<div class="panel-body">

							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
								<thead>
									<tr>
										<th>S.no</th>
										<th>Team Members</th>
										<th>Project</th>
										<th>Gannt_chart</th>
										<th>Remark</th>
										<th>Action</th>
										<tbody>
									<tr>
										<td>
											<!-- <?php echo $i; ?>-->
										</td>
										<td>
										 
											<!-- <?php echo $i; ?>-->
											
										</td>
										<td>
										<!-- <?php echo $i; ?>-->
										</td>
										
										<td>
											<!-- <?php echo $i; ?>-->
										</td>
										
										<td>
										 
											<!-- <?php echo $i; ?>-->
										
											<td>
											<!--<a class="btn btn-xs btn-success" href="#?id=<?php echo $row['id'];?>">

											Edit </a>--> &nbsp; <a class="btn btn-xs btn-danger pdelete" href="javascript:void(0);" data-id="<?php echo $row['id']; ?>">
											Delete </a>
										</td>
										</td>
								</tbody>
							</table>




									</tr>
								</thead>
<?php include "footer.php";?>


