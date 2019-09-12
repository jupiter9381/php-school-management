<?php include("header.php"); ?>

    <section id="middle">
        
        <header id="page-header">
            <h1>Users</h1>
        </header>
        <div id="content" class="dashboard padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Users</strong>
                    </span>
                                         
                    <a href="adduser.php" class="btn btn-info btn-xs pull-right">Add User</a>
                    
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
									<th>Last Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=0;

                                $q1 = mysqli_query($db,"SELECT * from users");
                                while($r1 = mysqli_fetch_assoc($q1))
                                {  $i++;
                                    ?>
                                    <tr id="customer<?php echo $r1['id'];?>">

                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $r1['first_name'];?></td>
										<td><?php echo $r1['last_name'];?></td>
                                        <td><?php echo $r1['email'];?></td>
                                        <td><?php echo $r1['username'];?></td>
                                        <!--<td> <a href="javascript:void(0);" title ="Generate Password for <?php echo $r1['firstname']." ".$r1['lastname'];?>" data-detail='<?php echo json_encode($r1); ?>' class="btn btn-xs btn-danger GeneratePassword" data-id="<?php echo $r1['uid'];?>" title="Generate Password"><i class="fa fa-key"></i> Generate</a></td>-->                                       
                                        <td>
                                            <?php //if(permission_access($db,$adminloggedin,'users_edit') == 1){?>
                                            <a class="btn btn-xs btn-info"  href="adduser.php?id=<?php echo $r1['uid'];?>" ><i class="fa fa-edit"></i> Edit</a>&nbsp;
											<?php //} ?>
                                            <?php //if(permission_access($db,$adminloggedin,'users_delete') == 1){?>
											<a class="btn btn-xs btn-danger DeleteUser" href="javascript:void(0);" title="Delete User"  data-id="<?php echo $r1['uid']; ?>"><i class="fa fa-trash"> Delete</i></a>&nbsp;
                                                                                  
                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
    </div>
    </section>
<?php include("footer.php"); ?>
