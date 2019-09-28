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

$(document).ready(function(){
    $(".AddMore").click(function(){
        $(".OtherForms").show();
        $(".AddMore").hide();
    });
});
//regiter form

$("#registerform1").submit(function(e)
{  //alert("register.....");
    e.preventDefault();
    
   
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url : "../includes/adminfunction.php",
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
                         location.href='confirmed_page.php';
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
{  //alert("login.....");
        e.preventDefault();
        
       
        $elm=$(".btn-submit");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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



/***************************************************
********** add / Edit User ************
**************************************************/
 $("#formadduser").submit(function(e)
    {
        /* alert("call"); */
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                var data = jQuery.parseJSON(data);
                if(data.valid)
                {
                   _toastr(data.msg,"bottom-right","success",false);
                    setTimeout(function(){
                             location.href='users.php';
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

//delete User
$("body").on('click', '.DeleteUser', function()
{
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteUser"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                $('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                            window.location.reload(); 
                    }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});



//permission UserType

$("#formUserType").submit(function(e)
{
    //alert('hello');
        e.preventDefault();
        var valid = false;
        $('[name*="permission"]').each(function(){
            if($(this).is(':checked')){
                valid = true;
            }
        })
        if(!valid){
            swal('Select at least one checkbox.');
            return false;
        }
        $elm = $(".btn-submit");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type        : 'POST',
            url         : '../includes/adminfunction.php',
            data        : formData,
            cache       : false,
            contentType : false,
            processData : false,
            success     : function(data){
                data = $.parseJSON(data);
                if(data.success){
                    _toastr(data.message,"bottom-right","success",false);
                    setTimeout(function(){
                        location.href='usertype.php';
                    },2000);
                }else{
                    $(".submit-loading").remove();
                    $elm.show();
                    _toastr(data.message,"bottom-right","error",false);
                    return false;
                }
            }
        });
    });



/**************************Ashish********************************/


$('.campers_valid').hide(); 
$("body").on('click', '#siblings', function(){
    if ($('#siblings').is(':checked') == true) {
        $('.campers_valid').show();
    }
    else {
        $('.campers_valid').hide();
    }
});     

$('.support_needed').hide(); 
$("body").on('click', '#support', function(){
    if ($('#support').is(':checked') == true) {
        $('.support_needed').show();
    }
    else {
        $('.support_needed').hide();
    }
});

$('.illnesses_details').hide(); 
$("body").on('click', '#illnesses', function(){
    if ($('#illnesses').is(':checked') == true) {
        $('.illnesses_details').show();
    }
    else {
        $('.illnesses_details').hide();
    }
});

$('.allergies_details').hide(); 
$("body").on('click', '#allergies', function(){
    if ($('#allergies').is(':checked') == true) {
        $('.allergies_details').show();
    }
    else {
        $('.allergies_details').hide();
    }
});

$('.mental_impairments_details').hide(); 
$("body").on('click', '#mental_impairments', function(){
    if ($('#mental_impairments').is(':checked') == true) {
        $('.mental_impairments_details').show();
    }
    else {
        $('.mental_impairments_details').hide();
    }
});


$('.boarding_details').hide(); 
$("body").on('click', '#boarding_allocation_req', function(){
    if ($('#boarding_allocation_req').is(':checked') == true) {
        $('.boarding_details').show();
    }
    else {
        $('.boarding_details').hide();
    }
});


var input = document.getElementById('age_month');
// console.log(input);
if(input != null){
    input.addEventListener('change', function(e) {
        
        var num = parseInt(this.value, 10),
            min = 1,
            max = 12;

        if (isNaN(num) || (num>12)) {
            alert('Fill Below Proper Month range');
            this.value = "";
            return;
        }

        this.value = Math.max(num, min);
        this.value = Math.min(num, max);
    });

}


$("#formaddstudentapp").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = "after_add_application.php?id="+obj.id;
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});



// Delete Application Student

$("body").on('click', '.DeleteApplicationStudent', function()
{
    //alert('hello');
    var student_app_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_app_id : student_app_id,
            type : "DeleteApplicationStudent"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


//To capmlete status for student application

$("body").on('click', '.MarkAsCompleted', function()
{
    //alert('hello');
    var student_app_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_app_id : student_app_id,
            type : "MarkAsCompleted"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



//To Cancel status for student application

$("body").on('click', '.CancelApplication', function()
{
    //alert('hello');
    var student_app_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_app_id : student_app_id,
            type : "CancelApplication"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


/**********Fetch student details for selection************/

$("body").on('change', '#student_profile_details', function(){
    var student_profile_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_profile_id : student_profile_id,
            type : "FetchStudentDetails"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                var res = data.res;
                $('#gender[value="'+res.gender+'"]').prop('checked',true);
                $('#age_year').val(res.age_year);
                $('#age_month').val(res.age_month);
                $('#current_grade').val(res.grade);
                $('#nationality').val(res.nationality);
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });

        
 });


//Student Profile

$("#formaddstudentprofile").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'student_profile.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});



$("body").on('click', '.DeleteStudentProfile', function()
{
    //alert('hello');
    var student_profile_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_profile_id : student_profile_id,
            type : "DeleteStudentProfile"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


$("#formaddattendance").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'student_attendance.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Student Attendance

$("body").on('click', '.DeleteStudentAttendance', function()
{
    //alert('hello');
    var student_attendance_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_attendance_id : student_attendance_id,
            type : "DeleteStudentAttendance"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


/*******************fetch Student attendance details for selection*********************/


$("body").on('change', '#student_attendance', function(){
    var student_profile_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_profile_id : student_profile_id,
            type : "FetchStudentAttendanceDetails"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                var res = data.res;
                $('#standard').val(res.standard);
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });

        
 });


// Testing Result

$("#formaddtestingresult").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'testing_result.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Testing Result

$("body").on('click', '.DeleteTestingResult', function()
{
    //alert('hello');
    var test_result_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            test_result_id : test_result_id,
            type : "DeleteTestingResult"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


// Class Assignment

$("#formaddclassassignment").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'class_assignment.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Class Assignment

$("body").on('click', '.DeleteClassAssignment', function()
{
    //alert('hello');
    var class_assignment_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            class_assignment_id : class_assignment_id,
            type : "DeleteClassAssignment"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});

/*******************fetch Student Class Assignment details for selection*********************/


$("body").on('change', '#student_class_assignment', function(){
    var student_profile_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_profile_id : student_profile_id,
            type : "FetchStudentClassAssignment"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                var res = data.res;
                $('#age_year').val(res.age_year);
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });

        
 });


// Incident Report

$("#formaddincidentreport").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'incident_report.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Incident Report

$("body").on('click', '.DeleteIncidentReport', function()
{
    //alert('hello');
    var incident_report_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            incident_report_id : incident_report_id,
            type : "DeleteIncidentReport"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



// Communication History

$("#formaddcammunication").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'communication_history.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Communication History

$("body").on('click', '.DeleteCommunicationoHistory', function()
{
    //alert('hello');
    var communication_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            communication_id : communication_id,
            type : "DeleteCommunicationoHistory"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



// Student Id Card

/*$("#formaddstudentidcard").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'student_idcard.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});*/


// Delete Student Id Card

$("body").on('click', '.DeleteStudentIDCard', function()
{
    //alert('hello');
    var student_idcard_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_idcard_id : student_idcard_id,
            type : "DeleteStudentIDCard"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


/*******************fetch Student Id Card details for selection*********************/


/*$("body").on('change', '#student_idcard_details', function(){
    //alert('hello');
    var student_app_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_app_id : student_app_id,
            type : "FetchStudentIDCardDetails"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                var res = data.res;
                
                $('#allergies').val(res.details);
                $('#cca_name').val(res.cca_name);
                $('#student_pickup').val(res.pickup);
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    }); 
 });*/

$("body").on('change', '#student_idcard_details', function(){
    //alert('hello');
    var camp_management_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            camp_management_id : camp_management_id,
            type : "FetchStudentIDCardDetails"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                $('#formaddstudentidcard').find('tbody').html(data.html);
                $('#formaddstudentidcard').find('[name="idcardid"]').val(camp_management_id);
                return false;
            }
            else
            {
                $('#formaddstudentidcard').find('tbody').html(data.html);
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    }); 
 });



// Image Gallery

$("#formaddstudentimagegallery").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'student_image_gallery.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Image Gallery

$("body").on('click', '.DeleteStudentImageGallery', function()
{
    //alert('hello');
    var student_image_gallery_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_image_gallery_id : student_image_gallery_id,
            type : "DeleteStudentImageGallery"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


// Image Gallery

$("#formimagegallery").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'image_gallery.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Image Gallery

$("body").on('click', '.DeleteImageGallery', function()
{
    //alert('hello');
    var image_gallery_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            image_gallery_id : image_gallery_id,
            type : "DeleteImageGallery"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



// Video Gallery

$("#formaddvideogellery").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'video_gallery.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Video Gallery

$("body").on('click', '.DeleteVideoGallery', function()
{
    //alert('hello');
    var video_gellery_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            video_gellery_id : video_gellery_id,
            type : "DeleteVideoGallery"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});




// Camp Fee

$("#formaddcampfee").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'camp_fee.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Camp Fee

$("body").on('click', '.DeleteCampFee', function()
{
    //alert('hello');
    var camp_fee_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            camp_fee_id : camp_fee_id,
            type : "DeleteCampFee"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



// Enrollment Status

$("#formaddenrollmentstatus").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'enrollment_status.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Enrollment Status

$("body").on('click', '.DeleteEnrollmentStatus', function()
{
    //alert('hello');
    var enrollment_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            enrollment_id : enrollment_id,
            type : "DeleteEnrollmentStatus"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});








// Student Assessment

$("#formstudentassessment").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'student_assessment.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Student Assessment

$("body").on('click', '.DeleteStudentAssessment', function()
{
    //alert('hello');
    var assessment_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            assessment_id : assessment_id,
            type : "DeleteStudentAssessment"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



// Agent Profile

$("#formaddagentprofile").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'sales_agent_profile.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Agent Profile

$("body").on('click', '.DeleteAgentProfile', function()
{
    //alert('hello');
    var agent_profile_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            agent_profile_id : agent_profile_id,
            type : "DeleteAgentProfile"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});




// Linked Student

$("#formaddlinkedstudent").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'linked_student.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Linked Student

$("body").on('click', '.DeleteLinkedStudent', function()
{
    //alert('hello');
    var linked_student_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            linked_student_id : linked_student_id,
            type : "DeleteLinkedStudent"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



// Commission Fee

$("#formaddcommissionfee").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'student_commission_fee.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Commission Fee

$("body").on('click', '.DeleteCommissionFee', function()
{
    //alert('hello');
    var commission_fee_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            commission_fee_id : commission_fee_id,
            type : "DeleteCommissionFee"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



// Agent Camp Fee

$("#formaddagentcampfee").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'agent_camp_fee.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Agent Camp Fee

$("body").on('click', '.DeleteAgentCampFee', function()
{
    //alert('hello');
    var agent_camp_fee_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            agent_camp_fee_id : agent_camp_fee_id,
            type : "DeleteAgentCampFee"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


// Agent Communication

$("#formaddagentcammunication").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'agent_communication_history.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Agent Communication

$("body").on('click', '.DeleteAgentCommunication', function()
{
    //alert('hello');
    var agent_communication_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            agent_communication_id : agent_communication_id,
            type : "DeleteAgentCommunication"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});


// Messaging Feature

$("#formaddmessagingfeature").submit(function(e)
{
    //alert("hello");
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var obj = jQuery.parseJSON(data);

            if(obj.valid)
            {
              _toastr(obj.msg,"bottom-right","success",false);
                setTimeout(function(){
                 location.href = 'messaging_feature.php';
                 }, 2000);
            }
            else
            {
                _toastr(obj.msg,"bottom-right","info",false);
                return false;
            }

        }
    });
});


// Delete Messaging Feature

$("body").on('click', '.DeleteMessagingFeature', function()
{
    //alert('hello');
    var messaging_feature_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            messaging_feature_id : messaging_feature_id,
            type : "DeleteMessagingFeature"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                //$('#name'+id).hide();
                _toastr(data.message,"bottom-right","success",false);
                 setTimeout(function(){
                     window.location.reload();
                 }, 2000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});




/******************************Amit*******************************************/

/*--------------------------------Add Camp Teacher--------------------------*/


$("#formaddcampteacher").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='camp_teachers.php';
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

/**************************  Delete Camp Teacher  *******************************/

$("body").on('click', '.DeleteCampTeacher', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteCampTeacher"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});

/*--------------------------------Add Boarding Staff--------------------------*/


$("#formaddboardingstaff").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='boardingstaff.php';
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

/**************************  Delete BoardingStaff  *******************************/

$("body").on('click', '.DeleteBoardingStaff', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteBoardingStaff"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});

/*--------------------------------Add School Staff--------------------------*/


$("#formaddschoolstaff").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='school_staff.php';
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

/************************** Delete School Staff*******************************/

$("body").on('click', '.DeleteSchoolStaff', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteSchoolStaff"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


/*--------------------------------Add Transport Drivers--------------------------*/


$("#formaddtransportdrivers").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='transport_drivers.php';
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


/************************** Delete Transport Drivers*******************************/

$("body").on('click', '.DeleteTransportDrivers', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteTransportDrivers"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


/*--------------------------------Add Transport Vehicles--------------------------*/


$("#formaddtransportvehicle").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='transport_vehicle.php';
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

/**************************Delete Transport Vechicles*******************************/

$("body").on('click', '.DeleteTransportVechicles', function()
{
    //alert('fgdgdfgd');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteTransportVechicles"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


/*----------------------------Add Driver Assignments--------------------------*/


$("#formadddriverassignments").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='driver_assignments.php';
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


/**************************Delete Driver Assignments*******************************/

$("body").on('click', '.DeleteDriverAssignments', function()
{
    //alert('fgdgdfgd');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteDriverAssignments"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


/*----------------------------Add Driver Assignments--------------------------*/


$("#formaddtransportincidentreports").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='transport_incident_reports.php';
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


/*********************** Delete Transport Incident Reports **************************/

$("body").on('click', '.DeleteTransportIncidentReports', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteTransportIncidentReports"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});

/*----------------------------Add Transport Audit--------------------------*/

$("#formaddtransportaudit").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='audit_of_transport.php';
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



/*********************** Delete Transport Incident Reports **************************/

$("body").on('click', '.DeleteTransportAudit', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteTransportAudit"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


/*----------------------------Add Add Academic--------------------------*/

$("#formclassaddacademic").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='class_academic.php';
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


/***********************Delete Class Academic**************************/

$("body").on('click', '.DeleteClassAcademic', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteClassAcademic"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});

/*----------------------------Add CCA (Sporting)--------------------------*/

$("#formaddcca").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='cca_sporting.php';
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


/***********************Delete CCA (Sporting)**************************/

$("body").on('click', '.Deletecca', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletecca"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});

/*---------------------------Add Creative Classes--------------------------*/

$("#formaddcreativeclasses").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='creative_classes.php';
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


/***********************Delete Creative Classes**************************/

$("body").on('click', '.Deletecreativeclasses', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletecreativeclasses"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


/*---------------------------Add Boarding Activities--------------------------*/

$("#formaddboardingactivities").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='boarding_activities.php';
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


/***********************Delete Boarding Activities**************************/

$("body").on('click', '.Deleteboardingactivities', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deleteboardingactivities"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


/*------------------------- Add Teacher Assignment ------------------------*/

$("#formaddteacherassignment").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='teacher_resource.php';
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


/***********************Delete Teacher Assignment**************************/

$("body").on('click', '.Deleteteacherassignment', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deleteteacherassignment"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


/*------------------------- Add Equipment Materials ------------------------*/

$("#formaddequipmentmaterials").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='equipment_materials.php';
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


/***********************Delete Equipment Assignment**************************/

$("body").on('click', '.Deleteequipmentassignment', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deleteequipmentassignment"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});



/*------------------------- Add Camp Management ------------------------*/

$("#formclassaddcampmanagement").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='camp_management.php';
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


/***********************Delete Equipment Assignment**************************/

// $("body").on('click', '.Deletecampmanagement', function()
// {
//     //alert('');
//     var id = $(this).attr("data-id");
//     $elm = $(this);
//     $elm.hide();
//     $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
//     $.ajax({
//         type : 'POST',
//         url : "../includes/adminfunction.php",
//         data :  {
//             id : id,
//             type : "Deletecampmanagement"
//         },
//         success : function(data)
//         {
//             $(".submit-loading").remove();
//             $elm.show();
//             var data = jQuery.parseJSON(data);
//             if(data.valid)
//             {
//                 _toastr(data.message,"bottom-right","success",false);
//                 setTimeout(function(){
//                     location.reload();
//                 }, 3000);
//                 return false;
//             }
//             else
//             {
//                 _toastr(data.message,"bottom-right","info",false);
//                 return false;
//             }
//             return false;
//         }
//     });

// });

$("body").on('dblclick', '.Deletecampmanagement', function()
{
    alert('');
    // var id = $(this).attr("data-id");
    // $elm = $(this);
    // $elm.hide();
    // $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    // $.ajax({
    //     type : 'POST',
    //     url : "../includes/adminfunction.php",
    //     data :  {
    //         id : id,
    //         type : "Deletecampmanagement"
    //     },
    //     success : function(data)
    //     {
    //         $(".submit-loading").remove();
    //         $elm.show();
    //         var data = jQuery.parseJSON(data);
    //         if(data.valid)
    //         {
    //             _toastr(data.message,"bottom-right","success",false);
    //             setTimeout(function(){
    //                 location.reload();
    //             }, 3000);
    //             return false;
    //         }
    //         else
    //         {
    //             _toastr(data.message,"bottom-right","info",false);
    //             return false;
    //         }
    //         return false;
    //     }
    // });

});


/*------------------------- Add Curriculum Overview ------------------------*/

$("#formaddcurriculumoverview").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='curriculum_overview.php';
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


/***********************Delete Curriculum overview ************************/

$("body").on('click', '.Deletecurriculumoverview', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletecurriculumoverview"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});




/*------------------------- Add Export Feature ------------------------*/

$("#formaddexportfeature").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='export_feature.php';
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


/***********************Delete Export Feature ************************/

$("body").on('click', '.Deleteexportfeature', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deleteexportfeature"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});

/*-------------------------Add Class Schedules------------------------*/

$("#formaddclassschedules").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='class_schedules.php';
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


/*********************** Delete Class Schedules ************************/

$("body").on('click', '.Deleteclassschedules', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deleteclassschedules"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});



/*-------------------------Add Transport Routes------------------------*/

$("#formaddtransportroutes").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='transport_routes.php';
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


/*********************** Delete Transport Routes ************************/

$("body").on('click', '.Deletetransportroutes', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletetransportroutes"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});
/*-------------------------Add Transport Schedules------------------------*/

$("#formaddtransportschedules").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='transport_schedules.php';
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




/*------Fetch age_year age_month nationality from student_profile_id----------*/

$("body").on('change', '#student_profile_report', function(){
    var student_app_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_app_id : student_app_id,
            type : "FetchStudentDetailsReport"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                var res = data.res;
                $('#age_year').val(res.age_year);
                $('#age_month').val(res.age_month);
                $('#nationality').val(res.nationality);
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });

        
 });

/*--------------Fetch first_name from camp_teacher_id---------------*/

$("body").on('change', '#teacher_resource_assignment_name', function(){
    var teacher_resource_assignment_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            teacher_resource_assignment_id : teacher_resource_assignment_id,
            type : "FetchCampteacherDetails"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            var option = "<option value=''>--Select--</option>"
            if(data.success)
            {
                var res = data.res;
                $('#first_name').val(res.first_name);
                $.each(data.student_list,function(key,value){
                    option += '<option value="'+value.student_app_id+'">'+value.student_name+'</option>';
                });
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                
            }
            $('#student_profile_report').html(option);
            return false;
        }
    });

        
 });
/*-------------------------Add Student Report form------------------------*/

$("#formaddstudentreportform").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='student_report_form.php';
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


/*********************** Delete Transport Schedules ************************/

$("body").on('click', '.Deletestudentreportform', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletestudentreportform"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});



/**********Attendance Model***********/


$("body").on('click', '.AttendanceModel', function()
{
    //alert('hello');
    var class_academic_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            class_academic_id : class_academic_id,
            type : "AttendanceModel"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                $('#FormModalAttendance').find('tbody').html(data.html);
                $('#FormModalAttendance').find('[name="academic_id"]').val(class_academic_id);

                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});



/****************Attendance Submission of form***********************/



$("#FormModalAttendance").submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData.getAll('student_app_id'));
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  formData,
        contentType:false,
        processData : false,
        cache:false,
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                _toastr(data.message,"bottom-right","success",false);
                $('#attendance').modal('hide');
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
            
        }
    });
 });


/************************************************************Team Lucknow ***************************/
/************************************************************************ ***************************/


/*********************** Delete Transport Schedules ************************/

$("body").on('click', '.Deletetransportschedules', function()
{
   if(confirm("Are you sure you want to delete schedule?"))
	{
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletetransportschedules"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });
	}
});




/*-------------------------Add Transport Schedules------------------------*/

$("#ManageSchedule").submit(function(e)
    {
       
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                    location.reload();
                }, 3000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                } 

            }
        }); 
    });


/*-------------------------Add Students in Schedules------------------------*/

$("#ManageScheduleStudents").submit(function(e)
    {
       
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href=data.url;
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

/*********************** Delete Students Schedules ************************/

$("body").on('click', '.DeleteStudentSchedule', function()
{
   if(confirm("Are you sure you want to delete students schedule?"))
	{
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteStudentSchedule"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });
	}
});



/***************************Edit scheduling*******************************************/


$(document).on('click', '.EditSchedule', function(){  
      $('#heading-text4').text('Edit Schedule');
      $('.btn4').text('Edit');
	   
	 $elm=$(this);	
	var id = $elm.attr("data-id");
	
	    $.ajax({
		      type :'POST',
		       url :'../includes/adminfunction.php',
		      data :{id:id,type :'EditSchedule'},           
            dataType:"json",  
            success:function(data)
			{     
              
				 $('#id').val(data.transport_schedules_id);                       
				 $('#sdate').val(data.schedule_date); 
				 $('#route_name').val(data.route_name);
                                 $('#phone').val(data.phone);
                                 $('#vehicle').val(data.vehicle);
                                 $('#staff_id').val(data.staff_id);
                                 $('#staff_id').select2();
				 //$('#driver_id').val(data.first_name);
                 		 $('#driver_id').val(data.driver_id);	 
				 $('#scheduleModal').modal('show');                         
            }  
           });  
		   
			
      });
/**********************************refresh form**********************/	  
$(document).on('click', '.addschedule', function(){  
     $('#heading-text4').text('Add New Schedule');
      $('.btn4').text('Save');	   	    		
		 $('#ManageSchedule')[0].reset();	
      }); 
 
 
/*******************************************Oneview***************************************/
$(document).on('click', '.oneviewData', function(){ 
	
	var list_id = $(this).attr("data-id");  
      	
	 $.ajax({  
			url:'../includes/adminfunction.php',  
			method:"post",  
			data:{list_id:list_id},  
			success:function(data){  
				 $('#schedule_detail').html(data);  
				 $('#oneviewModal').modal("show");  
			}  
           }); 	
      });


/***************************Fetch Pickup locations****************************************/

$('#student_pickup').on('change',function(){	
      var student_pickup = $(this).val();	
	  
        if(student_pickup)
		{
            $.ajax({    
                type:'POST',
                url:'../includes/adminfunction.php',
               data :{
                student_pickup : student_pickup,
                type : "PickupLocation"
                },
                success:function(result){
                    var res = JSON.parse(result);

                    $('#drop_location').html(res.drop_location); 
                    // $('#students').html(res.student_list); 
                }
            });        
		}
		else{
			 $('#drop_location').html('<option value="">--Select Pickup Location First--</option>');
		}
    });



/*$('#pickup_location').on('change',function(){	
      var pickup_location = $(this).val();	
	  
        if(pickup_location)
		{
            $.ajax({    
                type:'POST',
                url:'../includes/adminfunction.php',
               data :{
                pickup_location : pickup_location,
                type : "PickupLocation"
                },
                success:function(html){
                    $('#drop_location').html(html); 
                }
            });        
		}
		else{
			 $('#drop_location').html('<option value="">--Select Pickup Location First--</option>');
		}
    });*/
	
 

/***************************Tranport scheduling*******************************************/




$('#drop_location').on('change',function(){	
    //alert('hello');
      var drop_location_id = $(this).val();	
	 var pick_up_location = $('#student_pickup').val();
       
            $.ajax({    
                type:'POST',
                url:'../includes/adminfunction.php',
               data :{
                drop_location_id : drop_location_id,
                pick_up_location:pick_up_location,
                type : "StudentSchedule"
                },
                success:function(result){
                    
                    var res = JSON.parse(result);
                    $('#students').html(res.student_list);
                }
            });        
		
    });
	
 

/***************************Incident Update******************************************/



$("body").on('click', '.IncedentstatusUpdate', function()
{
   if(confirm("Are you sure you want to update Incident status?"))
	{
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "IncedentstatusUpdate"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });
}
});

/***********************************Multiselect options******************/ 
/*$('.multiselect').multiselect({
  nonSelectedText: 'Select ',
  enableFiltering: false,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'100%'
 });*/
 
 
 
 /*--------------------------------Add Class Room--------------------------*/


$("#formaddclassroom").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='class_room.php';
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

/**************************  Delete Class Room  *******************************/

$("body").on('click', '.Deleteclassroom', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deleteclassroom"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});
 
 
 
// Add Boarding Room
 
$("#formaddboardingroom").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='boarding_room.php';
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



/*********************** Delete Boarding Room **************************/

$("body").on('click', '.DeleteBoadingRoom', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "DeleteBoadingRoom"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});
 
 
 //adminscript Transport Route

$("body").on('change', '#student_routes', function(){
    var student_app_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_app_id : student_app_id,
            type : "FetchStudentRoutes"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                var res = data.res;
                $('#student_pickup').val(res.student_pickup);
                $('#pickup_id').val(res.pickup_id);
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });

        
 });

$("body").on('change', '#camp_fee', function(){
    //alert('hello');
    var student_app_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_app_id : student_app_id,
            type : "Fetchstudentcampfee"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                $('#camp_selection').html(data.html);
                $('#camp_selection').select2();
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    }); 
 });
 
 
 
 /******Transport Attendance for student*******/


$("body").on('click', '.TransportModel', function()
{
    //alert('hello');
    var transport_schedules_id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            transport_schedules_id : transport_schedules_id,
            type : "TransportModel"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                $('#FormModalTransport').find('tbody').html(data.html);
                $('#FormModalTransport').find('[name="transport_id"]').val(transport_schedules_id);

                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    });
});





$("#FormModalTransport").submit(function(e){
    //alert("hello");
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData.getAll('student_app_id'));
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  formData,
        contentType:false,
        processData : false,
        cache:false,
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                _toastr(data.message,"bottom-right","success",false);
                $('#transport').modal('hide');
            }
            else
            {
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
            
        }
    });
 });


//change password


$("#adminchangepass").submit(function(e)
{
  // alert('hello');
   e.preventDefault();
   $elm=$(".btn-submit");
   $elm.hide();
   $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
   var current_password = $("#current_password").val();
   var new_password = $("#new_password").val();
   var rpassword = $("#rpassword").val();
   if(current_password == "" || new_password == "" || rpassword == "")
   {
       $(".submit-loading").remove();
        $elm.show();
       _toastr("Currrent password or new password cannot be empty","bottom-right","info",false);
       return false;
   }
   else if(new_password !=  rpassword)
   {
       $(".submit-loading").remove();
        $elm.show();
       _toastr("New Password & Confirm Password does not match","bottom-right","info",false);
       return false;
   }
   else
   {
       $.ajax({
           type: "POST",
           url  : "../includes/adminfunction.php",
           data:{
               ajax_current_password : current_password,
               ajax_new_password : new_password,
               ajax_confirm_password : rpassword,
               ajax_changepassword : true
           },
           success: function (data)
           {
               var data = jQuery.parseJSON(data);
                $(".submit-loading").remove();
                $elm.show();
                if( data.valid == 1)
                {
                   _toastr(data.message,"bottom-right","success",false);
                   setTimeout(function(){
                       location.href = 'index.php';
                   }, 3000);
                   return false;
                }
                else
                {
                    _toastr(data.message,"bottom-right","info",false);
                    return false;
                }

           }
       });
   }
});


//forgot password


$('#formForgotPass').submit(function (e) {

    //alert("call"); 
    e.preventDefault();
    $elm=$(".btn-submit");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url : "../includes/adminfunction.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data)
        {
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

// Add Student Online Test
 
$("#formaddtestname").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='student_test_name.php';
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



/*********************** Delete Test **************************/

$("body").on('click', '.Deletetestname', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletetestname"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


// Add Student Question
/* 
$("#formaddstudentquestions_old").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='student_questions.php';
                    }, 2000);
                }
                else
                {
                    _toastr(data.msg,"bottom-right","info",false);
                    return false;
                }

            }
        });
    });*/



/*********************** Delete student question **************************/

/*$("body").on('click', '.Deletestudentquestions', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletestudentquestions"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});*/





/********************** Student Online Test ***************************/



/*$("body").on('change', '#online_test_details', function(){
    //alert('hello');
    var camp_management_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            camp_management_id : camp_management_id,
            type : "GenerateOnlineTest"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                $('#formaddstudenttestonline').find('tbody').html(data.html);
                $('#formaddstudenttestonline').find('[name="idcardid"]').val(camp_management_id);
                return false;
            }
            else
            {
                $('#formaddstudenttestonline').find('tbody').html(data.html);
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    }); 
 });*/



 // Add Student Answer
 
$("#formaddstudentanswer").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='student_answers.php';
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




/*********************** Delete Student Answer **************************/

$("body").on('click', '.Deletestudentanswer', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletestudentanswer"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


$("#formolinetest").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='student_online_test.php';
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


    // Add Student Test File

$("body").on('change', '#student_test_details', function(){
    //alert('hello');
    var student_profile_id = $(this).val();
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            student_profile_id : student_profile_id,
            type : "Fetchstudenttestdetails"
        },
        success : function(data)
        {
            var data = jQuery.parseJSON(data);
            if(data.success)
            {
                $('#formaddstudenttestfile').find('tbody').html(data.html);
                $('#formaddstudenttestfile').find('[name="student_name"]').val(student_profile_id);                

                return false;
            }
            else
            {
                $('#formaddstudenttestfile').find('tbody').html('');
                _toastr(data.message,"bottom-right","error",false);
                return false;
            }
            return false;
        }
    }); 
 });





// Add Question Answer new
 
$("#formaddstudentquestions").submit(function(e)
    {
        //alert('all'); 
       e.preventDefault();
       $elm=$(".btn-submit");
       $elm.hide();
       $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url : "../includes/adminfunction.php",
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
                             location.href='student_question_answer.php';
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



/*********************** Delete student question **************************/

$("body").on('click', '.Deletestudentquestions', function()
{
    //alert('');
    var id = $(this).attr("data-id");
    $elm = $(this);
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    $.ajax({
        type : 'POST',
        url : "../includes/adminfunction.php",
        data :  {
            id : id,
            type : "Deletestudentquestions"
        },
        success : function(data)
        {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid)
            {
                _toastr(data.message,"bottom-right","success",false);
                setTimeout(function(){
                    location.reload();
                }, 3000);
                return false;
            }
            else
            {
                _toastr(data.message,"bottom-right","info",false);
                return false;
            }
            return false;
        }
    });

});


