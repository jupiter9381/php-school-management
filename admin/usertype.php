<?php include("header.php"); ?><section id="middle">    <?php //if(permission_access($db,$admin_pid,'grouprole_view') != 1 && !isset($_GET['id']))    /*{        echo '<header id="page-header">            <h1>Access Denied!</h1>            </header>';        include("footer.php");        die();    }*/    ?>    <header id="page-header">        <h1>User Type</h1>    </header>    <div id="content" class="dashboard padding-20">        <div id="panel-1" class="panel panel-default">            <div class="panel-heading">                <span class="elipsis">                    <strong>User Type</strong>                </span>                <?php //if(permission_access($db, $admin_pid,'grouprole_add') == 1) { ?>                    <a href="addusertype.php" class="btn btn-info btn-xs pull-right">Add User Type</a>				<?php //} ?>				<?php //if(permission_access($db,$admin_pid,'user_view') == 1){ ?>                    <a href="users.php" class="btn btn-info btn-xs pull-right">Admin User</a>                <?php //} ?>            </div>            <div class="panel-body">                <div class="table-responsive">                    <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">                        <thead>                            <tr>                                <th>ID</th>                                <th>Roles</th>                                <th>Action</th>                            </tr>                        </thead>                        <tbody>                        <?php                        $i = 0;                        $q0 = mysqli_query($db,"select * from permission_access where permission_id != 1");                        while ($r0 = mysqli_fetch_assoc($q0)){                            $i++;                            ?>                            <tr id="role<?php echo $r0['permission_id']; ?>">                                <td><?php echo $i; ?></td>                                <td><?php echo $r0['user_type']; ?></td>                                <td>                                    <?php //if(permission_access($db, $admin_pid,'grouprole_edit') == 1) { ?>                                    <a href="addusertype.php?id=<?php echo $r0['permission_id']; ?>" class="btn btn-xs btn-info"><i class="fa fa-edit">Edit</i></a>                                    <?php //} if(permission_access($db, $admin_pid,'grouprole_delete') == 1) { ?>                                    <a href="javascript:void(0)" data-id="<?php echo $r0['permission_id']; ?>" title="Delete Admin Role" class="btn btn-xs btn-danger delAdminRole"><i class="fa fa-trash">Delete</i></a>                                    <?php //} ?>                                </td>                            </tr>                        <?php } ?>                        </tbody>                    </table>                </div>            </div>        </div>    </div></section><?php include("footer.php"); ?>