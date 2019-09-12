<?php include "header.php";?>
		<!--MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Team Task</h1>
					
				</header>
				<!-- /page title -->


				<div id="content" class="padding-30">

					
					<div id="panel-1" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Team Task Details</strong> <!-- panel title -->
							</span>
							
							</div>

							
						</div>
					
						<!-- panel content -->
						<div class="panel-body">

							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
								<thead>
									<tr>
										<th>S.no</th>
										<th>List Of Team</th>
										<th>Task</th>
									
										<th>Discription</th>
										
										<tbody>
										<tbody>
									<tr>
										<?php $qry= mysqli_query($db,"SELECT t1.*,t2.* FROM task As t1 LEFT JOIN member AS t2 ON t1.member_id=t2.member_id ");
										
										//echo "SELECT t1.*,t2.*,t3.* FROM task As t1 LEFT JOIN member AS t2 ON t1.member_id=t2.member_id left join extend_date as t3 on t1.ex_id= t3.ex_id ";
										
                                    $i=1;
                                    while($row= mysqli_fetch_assoc($qry))
                                    {?>
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										
										<td>
										 
											 <?php echo $row['member']; ?>
											
										</td>
										<td>
										     <?php echo $row['task'];?>
										</td>
									<!--	
										<td>
											 <?php echo $row['ex_date']; ?>
										</td>-->
										
										<td>
										 
											  <?php echo $row['task_des']; ?>
										
											
										</td>
								</tbody>
								<?php  $i++; } ?>
							</table>
								</thead>
							</tr>
						
					</tr>
		
			</div>
			</div>
		</section>

<?php include "footer.php";?>
