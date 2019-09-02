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
                displayUsers();
                //console.log(data);
            }
        });
    }

    editUser(user)
    {
        $.post('process/editUser.php', {editcriteria:user}, function(data)
        {
            if(data.indexOf('Error') > 1)
            {
                console.log('Error: ' + data);
            }
            else
            {
                $('#editUserModal').modal('hide');
                displayUsers();
                //console.log(data);
            }
        });
    }

    resetPass(user)
    {
        $.post('process/editUser.php', {resetcritieria:user}, function(data)
        {
            if(data.indexOf('Error') > 1)
            {
                console.log('Error: ' + data);
            }
            else
            {
                $('#editPassModal').modal('hide');
                displayUsers();
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
                            $(nTd).html("<a href='#' id='editUserLink'><i class='fas fa-edit'></i></a>  <a href='#' id='deleteLink'><i class='fas fa-times'></i></a> <a href='#' id='resetPassLink'><i class='fas fa-unlock'></i></a>");
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

$('#usersDatatable').on('click', 'tr > td > a#editUserLink', function(e)
{
    e.preventDefault();
    var $datatable = $('#usersDatatable').DataTable();
    var tr = $(this).closest('tr');
    var data = $datatable.rows().data();
    var rowData = data[tr.index()];

    var editId = rowData.id;
    var editFirstName = rowData.firstName;
    var editLastName = rowData.lastName;
    var editUsername = rowData.username;
    var editEmail = rowData.email;
    var editUserlevel = rowData.userlevel;
    var editDept = rowData.department;
    var editTitle = rowData.title;
    var editPhone = rowData.phone;

    $('#editId').val(editId);
    $('#editFirstName').val(editFirstName);
    $('#editLastName').val(editLastName);
    $('#editUsername').val(editUsername);
    $('#editEmail').val(editEmail);
    $('#editUserlevel').val(editUserlevel);
    $('#editDept').val(editDept);
    $('#editTitle').val(editTitle);
    $('#editPhone').val(editPhone);
    
    $('#editUserModal').modal('show');
});

$('#editUserSubmit').on('click', function()
{
    var esr = new UserEdit();

    var user = {
        editId: $('#editId').val(),
        editFirstName: $('#editFirstName').val(),
        editLastName: $('#editLastName').val(),
        editUsername: $('#editUsername').val(),
        editEmail: $('#editEmail').val(),
        editUserlevel: $('#editUserlevel').val(),
        editDept: $('#editDept').val(),
        editTitle: $('#editTitle').val(),
        editPhone: $('#editPhone').val()
    }

    esr.editUser(user);
});

$('#usersDatatable').on('click', 'tr > td > a#resetPassLink', function(e)
{
    e.preventDefault();
    var $datatable = $('#usersDatatable').DataTable();
    var tr = $(this).closest('tr');
    var data = $datatable.rows().data();
    var rowData = data[tr.index()];

    var resetId = rowData.id;

    $('#resetId').val(resetId);

    $('#editPassModal').modal('show');

    console.log('here');
});

$('#resetPassSubmit').on('click', function()
{
    var psr = new UserEdit();

    var user = {
        resetId: $('#resetId').val(),
        resetPass: $('#resetPass').val()
    }

    psr.resetPass(user);
});

// Inactivity timeout function
var idleTime = 0;
$(document).ready(function()
{
    // Increment the idle time counter every minute
    var idleInterval = setInterval(timerIncrement, 60000);

    // Zero the idle timer on mouse movement
    $(this).mousemove(function(e)
    {
        idleTime = 0;
    });
    // Zero the idle timer on keypress
    $(this).keypress(function(e)
    {
        idleTime = 0;
    });
});

function timerIncrement()
{
    idleTime = idleTime + 1;
    console.log("time is " + idleTime);
    if(idleTime > 19)
    {
        window.location.href = "logout.php";
    }
}

