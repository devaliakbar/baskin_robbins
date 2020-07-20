<?php include 'header.php'; ?>

<!-- Right side header -->
<div class="header">
    <h2>Expense</h2>
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

                    <div class="header-pager-panel mb-3">


                        <div class="date-wrap ml-auto">

                            <form class="form-inline date-range">
                                <label for="" class="mr-3">Date:</label>
                                <div class='input-group date mr-5'>
                                    <input type='text' class="form-control startDate" placeholder="From" />
                                </div>
                                <div class='input-group'>
                                    <input type='text' class="form-control endDate" placeholder="To" />
                                </div>
                            </form>

                        </div>

                    </div>

                    <div class="header-pager-panel">

                        <div class="btn-wrap mr-auto">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-trans" data-toggle="modal" data-target="#exampleModalLong">
                                Add Expense
                            </button>
                        </div>
                        <div class="search-wrap">
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control" type="text" placeholder="Search">
                                <button class="btn my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
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
                                            <div class="wrap">Date</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Name</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Description</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Amount</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="wrap">20/06/20</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Abin</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Goodwill</div>
                                        </td>
                                        <td>
                                            <div class="wrap">564</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="wrap">20/06/20</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Abin</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Goodwill</div>
                                        </td>
                                        <td>
                                            <div class="wrap">564</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="wrap">20/06/20</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Abin</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Goodwill</div>
                                        </td>
                                        <td>
                                            <div class="wrap">564</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="wrap">20/06/20</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Abin</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Goodwill</div>
                                        </td>
                                        <td>
                                            <div class="wrap">564</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="wrap">20/06/20</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Abin</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Goodwill</div>
                                        </td>
                                        <td>
                                            <div class="wrap">564</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="wrap">20/06/20</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Abin</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Goodwill</div>
                                        </td>
                                        <td>
                                            <div class="wrap">564</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="wrap">20/06/20</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Abin</div>
                                        </td>
                                        <td>
                                            <div class="wrap">Goodwill</div>
                                        </td>
                                        <td>
                                            <div class="wrap">564</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="footer-pager-panel">
                        <div class="nav-btns">
                            <a href="" class="btn btn-trans">Load More</a>
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
                    <div class="date-wrap col-5 frm-con-tag">
                    <div class="input-group">
                        <input type="text" class="form-control frm-con endDate" placeholder="Date">
                        <span class="focus-border"></span>
                    </div>
                </div>

                <div class="frm-con-tag input-group col-5 offset-2">
                    <label for="three_Network">Name</label>
                    <input class="frm-con effect-3" type="text" id="three_Network" required="">
                    <span class="focus-border"></span>
                </div>

                <div class="frm-con-tag input-group col-12">
                    <label for="Description">Description</label>
                    <input class="frm-con effect-3" type="text" id="Description" required="">
                    <span class="focus-border"></span>
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