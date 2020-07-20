<?php include 'header.php'; ?>

<!-- Right side header -->
<div class="header">
    <h2>Users</h2>
    <a href="#" class="hidden-xs"><img src="images/user.jpg" class="header-img"></a>
    <a class="header-logout hidden-xs" href="#"><i class="fa fa-sign-out"></i><br>Logout</a>
</div>
<!-- End right side header -->

<div class="clearfix"></div>

<div class="main-content-frame expense-page">
    <!-- Requested Appointments -->
    <div class="container-fluid ">
        <form>
            <div class="row">

                <div class="col-md-12">


                    <div class="header-pager-panel">

                        <div class="btn-wrap mr-auto">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-trans" data-toggle="modal" data-target="#exampleModalLong">
                                Add User
                            </button>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-wrapper">
                        <div class="table-responsive">
                            <table class="table table2excel table2excel_with_colors">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="wrap">Name</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Username</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Previlage</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="wrap">Abin</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Goodwill</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Admin</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- end invite patient content -->
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Expense</h5>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row">

                        <div class="frm-con-tag input-group col-12">
                            <label for="Name">Name</label>
                            <input class="frm-con effect-3" type="text" id="Name" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col-5">
                            <label for="Username">Username</label>
                            <input class="frm-con effect-3" type="text" id="Username" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col-5 offset-2">
                            <label for="Password">Password</label>
                            <input class="frm-con effect-3" type="text" id="Password" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class=" input-group col-12">
                            <label for="Previllage" class="mr-5">Previllage</label>
                            <label for="all" class="mr-3"><input type="radio" id="all" value="all" name="mode" class="mr-2"> All</label>
                            <label for="Edit" class="mr-3"><input type="radio" id="Edit" value="Edit" name="mode" class="mr-2"> Edit</label>
                            <label for="View" class="mr-3"><input type="radio" id="View" value="View" name="mode" class="mr-2"> View</label>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-trans mr-0" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-trans ml-0">Save changes</button>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>