$(document).ready(function(){
// check admin current password correct or not
$("#current_pwd").keyup(function(){
    var current_pwd = $("#current_pwd").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/check-current-password',
        data:{current_pwd:current_pwd},
        success:function(response){
            if(response == false){
                $("#verifycurrentpwd").html("<font color=red>Current Password is incorrect</font>");
            } else if(response == true){
                $("#verifycurrentpwd").html("<font color=green>Current Password is correct</font>");
            }
        },
        error:function(){
            alert("Error");
        }


    });
});

     // Update CMS Page Status
     $(document).on('click','.updateCmspageStatus', function(){
        var status = $(this).children('i').attr('status');
        var page_id = $(this).attr('page_id');
        //alert(page_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-cmspage-status',
            data:{status:status,page_id:page_id},
            success:function(res){

                if(res['status'] == 0){
                    $('#page-'+page_id).html('<i class="fas fa-toggle-off" status="Inactive" style="color: gray"></i>');
                }else if(res['status'] == 1){
                    $('#page-'+page_id).html('<i class="fas fa-toggle-on" status="Active"></i>');
                }

            },
            error:function(){
                alert("Error");
            }
        });
     });

// Delete Confirmation CMS-page
// $(document).on('click','.confirmDelete' , function(){

// var name = $(this).attr('name');
// if (confirm("Are you sure to delete this "+name+"?")) {
//     return true;
// }else {
//     return false;
// }

// });

//Delete Confirmation using Sweet alert

$(document).on('click', '.confirmDelete', function () {
    var record = $(this).attr('record');
    var recordID = $(this).attr('recordid');

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        // User confirmed, proceed with deletion
        Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon:"success"
      })
        // Redirect to the delete URL
        window.location.href = "delete-"+record+"/"+recordID;

      }
    });
  });

    // Update subadmin Status
    $(document).on('click','.subadminStatus', function(){
        var status = $(this).children('i').attr('status');
        var subadmin_id = $(this).attr('subadmin_id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-subadmin-status',
            data:{status:status,subadmin_id:subadmin_id},
            success:function(res){

                if(res['status'] == 0){
                    $('#subadmin-'+subadmin_id).html('<i class="fas fa-toggle-off" status="Inactive" style="color: gray"></i>');
                }else if(res['status'] == 1){
                    $('#subadmin-'+subadmin_id).html('<i class="fas fa-toggle-on" status="Active"></i>');
                }

            },
            error:function(){
                alert("Error");
            }
        });
     });

});
