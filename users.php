<?php
if (isset($_COOKIE['token'])) {
    if ($_COOKIE['token'] == '') {
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

include 'header.php';

?>

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
                                        <th>
                                            <div class="wrap"></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="user-table">

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
                <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row">

                        <div class="frm-con-tag input-group col-12">
                            <label for="name">Name</label>
                            <input class="frm-con effect-3" type="text" id="name" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col-5">
                            <label for="username">Username</label>
                            <input class="frm-con effect-3" type="text" id="username" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col-5 offset-2">
                            <label for="password">Password</label>
                            <input class="frm-con effect-3" type="text" id="password" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class=" input-group col-12">
                            <label for="Previllage" class="mr-5">Privilege</label>
                            <label for="all" class="mr-3"><input type="radio" id="all" value="0" name="mode" class="mr-2" checked="checked"> All</label>
                            <label for="Edit" class="mr-3"><input type="radio" id="Edit" value="1" name="mode" class="mr-2">Only Edit</label>
                            <label for="View" class="mr-3"><input type="radio" id="View" value="2" name="mode" class="mr-2">Only View</label>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-trans mr-0" data-dismiss="modal">Cancel</button>
                <button onclick="addUser()" type="button" class="btn btn-trans ml-0">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="userModify" tabindex="-1" role="dialog" aria-labelledby="userModifyTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModifyTitle">Modify</h5>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row">

                        <div class="frm-con-tag input-group col-12">
                            <label for="mname">Name</label>
                            <input class="frm-con effect-3" type="text" id="mname" required="" disabled>
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col-5">
                            <label for="musername">Username</label>
                            <input class="frm-con effect-3" type="text" id="musername" required="" disabled>
                            <span class="focus-border"></span>
                        </div>


                        <div class=" input-group col-12">
                            <label for="Previllage" class="mr-5">Privilege</label>
                            <label for="mall" class="mr-3"><input type="radio" id="mall" value="0" name="mmode" class="mr-2" > All</label>
                            <label for="mEdit" class="mr-3"><input type="radio" id="mEdit" value="1" name="mmode" class="mr-2">Only Edit</label>
                            <label for="mView" class="mr-3"><input type="radio" id="mView" value="2" name="mmode" class="mr-2">Only View</label>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-trans mr-0" data-dismiss="modal">Cancel</button>
                <button onclick="changePassword()" type="button" class="btn btn-trans ml-0">Change Password</button>
                <button onclick="savePrivilege()" type="button" class="btn btn-trans ml-0">Save Privilege</button>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php';?>
<script src="js/main/common.js"></script>
<script src="js/main/user.js"></script>