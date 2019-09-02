
class LoginCheck 
{
    checkLogin(logincriteria)
    {
        if(logincriteria.user == "" || logincriteria.pass == "")
        {
            console.log('Enter username and password');
            return false; 
        }
        else
        {
            $.post('process/checkLogin.php', {logincriteria:logincriteria}, function(data)
            {
                if(data.indexOf('Error') >= 0)
                {
                    console.log(data);
                }
                else
                {
                    window.location.href = "moviecatalog.php";
                    //console.log(data);
                }
                //console.log(data);
            });
        }
    }
}

$('#loginSubmit').on('click', function()
{
    var lgc = new LoginCheck();

    var logincriteria = {
        user: $('#user').val(),
        pass: $('#pass').val()
    }

    lgc.checkLogin(logincriteria);
});

$('#signoutLink').on('click', function()
{
    window.location.href = "logout.php";
});

$('#adminLink').on('click', function()
{
    var sesslevel = $('#hiddenLevel').val();

    if(sesslevel != '9')
    {
        $('#errorModal').modal('show');
        return false;
    }
    else
    {
        window.location.href="admin.php";
    }
});



