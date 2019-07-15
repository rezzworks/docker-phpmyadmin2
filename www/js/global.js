
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
                }
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


