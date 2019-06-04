displayRecords();

class MovieDatabase {
    addMovie(movie) {
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
    
}

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
                            $(nTd).html("<a href='#' id='editLink'><i class='fas fa-edit'></i></a>  <a href='#' id='delLink'><i class='fas fa-times'></i></a>");
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
                "scrollY": 550,
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

$('#addNewSubmit').on('click', function(e)
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

