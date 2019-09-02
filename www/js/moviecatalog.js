
class MovieDatabase 
{
    addMovie(movie) 
    {
        $.post('process/editMovie.php', {addcriteria:movie}, function(data)
        {
            if(data.indexOf('Error') > 1)
            {
                console.log('Error: ' + data);
            }
            else
            {
                $('#addMovieModal').modal('hide');
                displayRecords();
            }
        });
    }

    editMovie(movie)
    {
        $.post('process/editMovie.php', {editcriteria:movie}, function(data)
        {
            if(data.indexOf('Update Error') > 1)
            {
                console.log('Error: ' + data);
            }
            else
            {
                $('#editModal').modal('hide');
                displayRecords();
            }
        });  
    }

    deleteMovie(movie)
    {
        $.post('process/editMovie.php', {deletecriteria:movie}, function(data)
        {
            if(data.indexOf('Delete Error') > 1)
            {
                console.log('Error: ' + data);
            }
            else
            {
                $('#deleteModal').modal('hide');
                displayRecords();
            }
        });
    }
}

displayRecords();

function displayRecords()
{
    $.ajax({
        url: 'process/getMovies.php',
        type: 'POST',
        data: '',
        dataType: 'html',
        success: function(data, textStatus, jqXHR)
        {
            var jsonObject = JSON.parse(data);

            var table = $('#example1').DataTable({
                "data": jsonObject,
                "columns": [
                    {
                        "data": "",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol)
                        {
                            $(nTd).html("<a href='#' id='editLink'><i class='fas fa-edit'></i></a>  <a href='#' id='deleteLink'><i class='fas fa-times'></i></a>");
                        }
                    },
                    {"data": "movieId"},
                    {"data": "movieName"},
                    {"data": "genre"},
                    {"data": "rating"},
                    {"data": "comments"},
                    {"data": "instock"},
                    {"data": "price"}
                ],
                "iDisplayLength": 25,
                "order": [[ 1, "desc" ]],
                "paging": true,
                "scrollY": 400,
                /*"scrollX": true,*/
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

$('#addNew').on('click', function()
{
    $('#addMovieModal').modal('show');
});

$('#addNewSubmit').on('click', function()
{
    var mdb = new MovieDatabase();

    var movie = {
        addTitle: $('#addTitle').val(),
        addGenre: $('#addGenre').val(),
        addRating: $('#addRating').val(),
        addInStock: $('#addInStock').val(),
        addPrice: $('#addPrice').val(),
        addComments: $('#addComments').val()
    }

    mdb.addMovie(movie);
});

$('#example1').on('click', 'tr > td > a#editLink', function(e)
{
    e.preventDefault();
    var $dataTable = $('#example1').DataTable();
    var tr = $(this).closest('tr');
    var data = $dataTable.rows().data();
    var rowData = data[tr.index()];

    var editId = rowData.movieId;
    var editName = rowData.movieName;
    var editGenre = rowData.genre;
    var editRating = rowData.rating;
    var editInstock = rowData.instock;
    var editPrice = rowData.price;

    $('#editId').val(editId);
    $('#editName').val(editName);
    $('#editGenre').val(editGenre);
    $('#editRating').val(editRating);
    $('#editInstock').val(editInstock);
    $('#editPrice').val(editPrice);
    
    $('#editModal').modal('show');
});

$('#editSubmit').on('click', function()
{
    var mdb = new MovieDatabase();

    var movie = {
        editId: $('#editId').val(),
        editName: $('#editName').val(),
        editGenre: $('#editGenre').val(),
        editRating: $('#editRating').val(),
        editInstock: $('#editInstock').val(),
        editPrice: $('#editPrice').val()
    }

    mdb.editMovie(movie);
});

$('#example1').on('click', 'tr > td > a#deleteLink', function(e)
{
    e.preventDefault();
    var $dataTable = $('#example1').DataTable();
    var tr = $(this).closest('tr');
    var data = $dataTable.rows().data();
    var rowData = data[tr.index()];

    var deleteId = rowData.movieId;
    var deleteName = rowData.movieName;
    var deleteGenre = rowData.genre;
    var deleteRating = rowData.rating;
    var deleteInstock = rowData.instock;
    var deletePrice = rowData.price;

    $('#deleteId').val(deleteId);
    $('#deleteName').val(deleteName);
    $('#deleteGenre').val(deleteGenre);
    $('#deleteRating').val(deleteRating);
    $('#deleteInstock').val(deleteInstock);
    $('#deletePrice').val(deletePrice);
    
    $('#deleteModal').modal('show');
});

$('#deleteSubmit').on('click', function()
{
    var mdb = new MovieDatabase();

    var movie = {
        deleteId: $('#deleteId').val(),
        deleteName: $('#deleteName').val(),
        deleteGenre: $('#deleteGenre').val(),
        deleteRating: $('#deleteRating').val(),
        deleteInstock: $('#deleteInstock').val(),
        deletePrice: $('#deletePrice').val()
    }

    mdb.deleteMovie(movie);
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

