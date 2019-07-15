class UserEdit
{
    addUser(user) 
    {
        $.post('process/editUser.php', {addcriteria:user}, function(data)
        {
            if(data.indexOf('Error') > 1)
            {
                console.log('Error: ' + data);
            }
            else
            {
                $('#addUserModal').modal('hide');
                //displayUsers();
                console.log(data);
            }
        });
    }
}

displayUsers();

function displayUsers()
{
    $.ajax({
        url: 'process/getUsers.php',
        type: 'POST',
        data: '',
        dataType: 'html',
        success: function(data, textStatus, jqXHR)
        {
            var jsonObject = JSON.parse(data);

            var table = $('#usersDatatable').DataTable({
                "data": jsonObject,
                "columns": [
                    {
                        "data": "",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                        {
                            $(nTd).html("<a href='#' id='editLink'><i class='fas fa-edit'></i></a>  <a href='#' id='deleteLink'><i class='fas fa-times'></i></a>");
                        }
                    },
                    {"data": "id"},
                    {"data": "firstName"},
                    {"data": "lastName"},
                    {"data": "username"},
                    {"data": "email"},
                    {"data": "userlevel"},
                    {"data": "department"},
                    {"data": "title"},
                    {"data": "phone"},
                    {"data": "addDate"},
                    {"data": "addUser"},
                    {"data": "lastLogin"}
                ],
                "iDisplayLength": 25,
                "order": [[ 1, "desc" ]],
                "paging": true,
                "scrollY": 400,
                "scrollX": true,
                "bDestroy": true,
                "stateSave": true,
                "autoWidth": true,
                "deferRender": true
            });
        },
        error: function(jqHHR, textStatus, errorThrown)
        {
            $('#loadingDiv').hide();
            $('#errorModal').modal('show');
            $('.message').text('There was an error conducting your search. Please try again.');
            console.log('fail: '+ errorThrown);
            return false;       
        }
    });
}

$('#signoutLink').on('click', function()
{
    window.location.href = "logout.php";
});

$('#addNewUser').on('click', function()
{
    $('#addUserModal').modal('show');
});

$('#addNewSubmit').on('click', function()
{
    var usr = new UserEdit();

    var user = {
        addFirstName: $('#addFirstName').val(),
        addLastName: $('#addLastName').val(),
        addUsername: $('#addUsername').val(),
        addEmail: $('#addEmail').val(),
        addUserlevel: $('#addUserlevel').val(),
        addDept: $('#addDept').val(),
        addTitle: $('#addTitle').val(),
        addPhone: $('#addPhone').val()
    }

    usr.addUser(user);
});

