
$("#formvalidate").click(function(e)
{
    var formname = $(this).attr("data-form");
    $('#'+formname).validate();
    if($('#'+formname).valid())
    {
        $('#'+formname).submit();
        return false;
    }
    else
    {
        return false
    }
});


//regiter form

    $("#registerform1").submit(function(e)
    {  alert("date");
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='index.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });


/*
 * user Login
 */

$("#loginform1").submit(function(e)
{  alert("login....");
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='dashboard.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });



//Add Member
$("#formaddmember").submit(function(e)
    {  alert(register.....);
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='member.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });

    // Delete member
$("body").on('click', '.memberdelete', function()
    {  
        
       var id = $(this).attr("data-id");
        $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data :  {
            id : id,
            type : "DeleteMember"
        },
           
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='member.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });

//Add project
$("#formaddproject").submit(function(e)
    {  alert();
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='project.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });

   // Delete Project
$("body").on('click', '.projectdelete', function()
    {  
        
       var id = $(this).attr("data-id");
        $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data :  {
            id : id,
            type : "DeleteProject"
        },
           
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='project.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });


//Add Milestone
$("#formaddmilestone").submit(function(e)
    {  alert();
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='milestone.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });

   // Delete Milestone
$("body").on('click', '.milestonedelete', function()
    {  
        
       var id = $(this).attr("data-id");
        $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data :  {
            id : id,
            type : "DeleteMilestone"
        },
           
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='milestone.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });


//Add Project Issue
$("#formaddprojectissue").submit(function(e)
    {  alert();
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/pmsadminfunction.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='projectissue.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });
