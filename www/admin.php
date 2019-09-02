<?php
    include("include/sessions.php"); 
    if($sesslevel != '9'){header("location:javascript://history.go(-1)");}
    if($sessusername == ""){header("location:logout.php");}
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
                <li><a href="moviecatalog.php">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?php echo $sessfirstname . ' ' . $sesslastname; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="admin.php">Admin</a></li>
                        <li><a href="#" id="signoutLink">Logout</a></li>
                    </ul>
                </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
        <span style="font-size:18px;">Movie Catalogue </span><small>Admin</small>
        <hr />
        <div class="box-body">
            <div class="box-header" style="margin-bottom: 10px;">
                <div class="row">
                    <div class="col-lg-3">
                    <button type="button" class="btn btn-primary btn-flat btn-xs" id="addNewUser">Add New</button>
                    </div>
                </div>
            </div>
            <table id="usersDatatable" class="table table-bordered table-hover table-condensed" style="width: 1200px;">
                <thead>
                    <tr>
                        <th style="width:50px;"></th>
                        <th style="width:50px;">ID</th>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th>LEVEL</th>
                        <th>DEPARTMENT</th>
                        <th style="width:150px;">TITLE</th>
                        <th>PHONE</th>
                        <th style="width:150px;">ADD_DATE</th>
                        <th>ADD_USER</th>
                        <th style="width:150px;">LAST_LOGIN</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- addUserModal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Add User</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="addUserForm">
                <div class="row">
                    <div class="col-lg-6">
                        <label>Add First Name</label>
                        <input type="text" class="form-control" id="addFirstName" placeholder="Enter First Name" />
                    </div>
                    <div class="col-lg-6">
                        <label>Add Last Name</label>
                        <input type="text" class="form-control" id="addLastName" placeholder="Enter Last Name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label>Add Username</label>
                        <input type="text" class="form-control" id="addUsername" placeholder="Enter Username" />
                    </div>
                    <div class="col-lg-6">
                        <label>Add Email</label>
                        <input type="text" class="form-control" id="addEmail" placeholder="Enter Email" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <labeL>Add Userlevel</label>
                        <select class="form-control" id="addUserlevel">
                            <option value="9">9 - Admin</option>
                            <option value="1">1 - User</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Add Department</label>
                        <input type="text" class="form-control" id="addDept" placeholder="Enter Department" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label>Add Title</label>
                        <input type="text" class="form-control" id="addTitle" placeholder="Enter Title" />
                    </div>
                    <div class="col-lg-6">
                        <label>Add Phone</label>
                        <input type="text" class="form-control" id="addPhone" placeholder="Enter Phone" />
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addNewSubmit">Submit</button>
            </div>
            </div>
        </div>
    </div>
    <!-- end addUserModal -->

    <!-- editUserModal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">Edit User</h4>
                </div>
                <div class="modal-body">
                <form role="form" id="editUserForm">
                <div class="row">
                    <div class="col-lg-6">
                        <label>Edit First Name</label>
                        <input type="text" class="form-control" id="editFirstName" placeholder="Enter First Name" />
                        <input type="hidden" id="editId" />
                    </div>
                    <div class="col-lg-6">
                        <label>Edit Last Name</label>
                        <input type="text" class="form-control" id="editLastName" placeholder="Enter Last Name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label>Edit Username</label>
                        <input type="text" class="form-control" id="editUsername" placeholder="Enter Username" />
                    </div>
                    <div class="col-lg-6">
                        <label>Edit Email</label>
                        <input type="text" class="form-control" id="editEmail" placeholder="Enter Email" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <labeL>Edit Userlevel</label>
                        <select class="form-control" id="editUserlevel">
                            <option value="9">9 - Admin</option>
                            <option value="1">1 - User</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Edit Department</label>
                        <input type="text" class="form-control" id="editDept" placeholder="Enter Department" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label>Edit Title</label>
                        <input type="text" class="form-control" id="editTitle" placeholder="Enter Title" />
                    </div>
                    <div class="col-lg-6">
                        <label>Edit Phone</label>
                        <input type="text" class="form-control" id="editPhone" placeholder="Enter Phone" />
                    </div>
                </div>
                </form>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-primary pull-left resetPassLink" id="resetPassLink">Reset Password</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editUserSubmit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end editUserModal -->

    <!-- editPassModal -->
    <div class="modal fade" id="editPassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">Reset Password</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="resetPassForm">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Enter Reset Password</label>
                            <input type="password" class="form-control" id="resetPass" placeholder="Enter Reset Password" />
                            <input type="hidden" id="resetId" />
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="resetPassSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end editPassModal -->

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
    <script src="js/admin.js" type="text/javascript"></script>
    <script src="js/global.js" type="text/javascript"></script>
</body>
</html>