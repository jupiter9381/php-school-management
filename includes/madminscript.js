
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

    $("#registerform").submit(function(e)
    {  alert("register.....");
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/madminfunction.php",
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
 * Manager Login
 */

$("#loginform").submit(function(e)
{  alert("login.....");
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/madminfunction.php",
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


// Add Extend_date
$("#formaddexdate").submit(function(e)
    {  alert("date");
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/madminfunction.php",
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
                             location.href='extendeadline.php';
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

   // Delete Extend_date

$("body").on('click', '.exdelete', function()
    {  
        
       var id = $(this).attr("data-id");
        $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/madminfunction.php",
            data :  {
            id : id,
            type : "DeleteDate"
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
                             location.href='extendeadline.php';
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
	
	//Add&update Task
	$("#formaddtask").submit(function(e)
    {  alert("date");
    e.preventDefault();
        
       
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/madminfunction.php",
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
                             location.href='teamtask.php';
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

   // Delete Task

$("body").on('click', '.taskdelete', function()
    {  
        
       var id = $(this).attr("data-id");
        $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/madminfunction.php",
            data :  {
            id : id,
            type : "DeleteTask"
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
                             location.href='teamtask.php';
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
   