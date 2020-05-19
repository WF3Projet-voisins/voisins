<script type="text/javascript" language="javascript" >

    $(document).ready(function(){       

        $('#add_button').click(function(){
            $('#user_form')[0].reset();
            $('.modal-title').text("Add User");
            $('#action').val("Add");
            $('#operation').val("Add");
            $('#user_uploaded_image').html('');
        });

        var dataTable = $('#user_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url:"fetch.php",
                type:"POST"
            },
            "columnDefs":[
                {
                    "targets":[0, 3, 4],
                    "orderable":false,
                },
            ],

        });

        $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var name = $('#name').val();
            var password = $('#password').val();
            var email = $('#email').val();
            var facebook = $('#facebook').val();
            var linkedin = $('#linkedin').val();
            var twitter = $('#twitter').val();
             
            if(name != '' && password != '' && email != '') {
                $.ajax({
                    url:"./assets/admin.ajax.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data) {
                        alert(data);
                        $('#user_form')[0].reset();
                        $('#userModal').modal('hide');
                        dataTable.ajax.reload();
                    }
                });
            } else {
                alert("Both Fields are Required");
            }
        });

        $(document).on('click', '.update', function() {
            var user_id = $(this).attr("id");
            $.ajax({
                url:"fetch_single.php",
                method:"POST",
                data:{user_id:user_id},
                dataType:"json",
                success:function(data) {
                    $('#userModal').modal('show');
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('.modal-title').text("Edit User");
                    $('#user_id').val(user_id);
                    $('#action').val("Edit");
                    $('#operation').val("Edit");
                }
            })
        });
 
        $(document).on('click', '.delete', function() {
            var user_id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    url:"delete.php",
                    method:"POST",
                    data:{user_id:user_id},
                    success:function(data) {
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            } else {
                return false; 
            }
        });  

    });

</script> 