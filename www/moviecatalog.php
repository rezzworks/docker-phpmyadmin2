<?php
    session_start();
    include("include/sessions.php"); 
?>
<html>
<head>
    <title>Docker - Movie List</title>
    <meta charset="utf-8" /> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
    <style>
        body {padding-top:70px;}
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Docker-Compose</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Welcome, <?php echo $sessfirstname . ' ' . $sesslastname; ?></a></li>
        <li><a href="#" id="signoutLink"> Sign Out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <h1>Movie Catalogue </h1> <span class="pull-right"></span></small>
    <hr />
    <div class="box-body">
        <div class="box-header" style="margin-bottom: 10px;">
            <div class="row">
                <div class="col-lg-3">
                <button type="button" class="btn btn-primary btn-flat btn-xs" id="addNew">Add New</button>
                </div>
            </div>
        </div>
        <table id="example1" class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:25px;"></th>
                    <th style="width:50px;">ID</th>
                    <th>TITLE</th>
                    <th>GENRE</th>
                    <th>RATING</th>
                    <th>COMMENTS</th>
                    <th>INSTOCK</th>
                    <th>PRICE</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>




    <!-- addMovieModal -->
    <div class="modal fade" id="addMovieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <!--<h5 class="modal-title" id="exampleModalLabel">Add Movie</h5>-->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form role="form" id="addNameForm">
            <div class="row">
                <div class="col-lg-12">
                    <label>Add Movie Title</label>
                    <input type="text" class="form-control" id="addTitle" placeholder="Enter Movie Title" />
                </div>
                <div class="col-lg-6">
                    <label>Add Genre</label>
                    <select class="form-control" id="addGenre">
                        <option></option>
                        <option value="ACTION">ACTION</option>
                        <option value="ADVENTURE">ADVENTURE</option>
                        <option value="COMEDY">COMEDY</option>
                        <option value="DRAMA">DRAMA</option>
                        <option value="DOCUMENTARY">DOCUMENTARY</option>
                        <option value="FANTASY">FANTASY</option>
                        <option value="HORROR">HORROR</option>
                        <option value="MYSTERY">MYSTERY</option>
                        <option value="ROMANCE">ROMANCE</option>
                        <option value="THRILLER">THRILLER</option>
                        <option value="SCI-FI">SCI-FI</option>                 
                    </select>
                </div>
                <div class="col-lg-6">
                    <label>Add Rating</label>
                    <select class="form-control" id="addRating">
                        <option></option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <labeL>Add InStock</label>
                    <input type="text" class="form-control" id="addInStock" placeholder="Enter Total In Stock" />
                </div>
                <div class="col-lg-6">
                    <label>Add Price</label>
                    <input type="text" class="form-control" id="addPrice" placeholder="Enter Price" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label>Add Comments</label>
                    <textarea class="form-control" id="addComments" cols="6" rows="3"></textarea>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="addNewSubmit">Save changes</button>
        </div>
        </div>
    </div>
    </div>

    <!-- editModal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Movie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="editNameForm">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Edit Movie Title</label>
                            <input type="text" class="form-control" id="editName" placeholder="Enter Movie Title" />
                            <input type="hidden" id="editId" />
                        </div>
                        <div class="col-lg-6">
                            <label>Edit Genre</label>
                            <select class="form-control" id="editGenre">
                                <option></option>
                                <option value="ACTION">ACTION</option>
                                <option value="ADVENTURE">ADVENTURE</option>
                                <option value="COMEDY">COMEDY</option>
                                <option value="DRAMA">DRAMA</option>
                                <option value="DOCUMENTARY">DOCUMENTARY</option>
                                <option value="FANTASY">FANTASY</option>
                                <option value="HORROR">HORROR</option>
                                <option value="MYSTERY">MYSTERY</option>
                                <option value="ROMANCE">ROMANCE</option>
                                <option value="THRILLER">THRILLER</option>
                                <option value="SCI-FI">SCI-FI</option>                 
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>Edit Rating</label>
                            <select class="form-control" id="editRating">
                                <option></option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <labeL>Edit InStock</label>
                            <input type="text" class="form-control" id="editInstock" placeholder="Enter Total In Stock" />
                        </div>
                        <div class="col-lg-6">
                            <label>Edit Price</label>
                            <input type="text" class="form-control" id="editPrice" placeholder="Enter Price" />
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editSubmit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- deleteModal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Movie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="deleteNameForm">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Movie Title</label>
                            <input type="text" class="form-control" id="deleteName" readonly placeholder="Enter Movie Title" />
                            <input type="hidden" id="deleteId" />
                        </div>
                        <div class="col-lg-6">
                            <label>Genre</label>
                            <input type="text" class="form-control" id="deleteGenre" readonly />
                        </div>
                        <div class="col-lg-6">
                            <label>Rating</label>
                            <input type="text" class="form-control" id="deleteRating" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <labeL>InStock</label>
                            <input type="text" class="form-control" id="deleteInstock" readonly placeholder="Enter Total In Stock" />
                        </div>
                        <div class="col-lg-6">
                            <label>Price</label>
                            <input type="text" class="form-control" id="deletePrice" readonly placeholder="Enter Price" />
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="deleteSubmit">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="js/global.js" type="text/javascript"></script>
</body>
</html>