<?php include 'header.php'; ?>

<!-- Right side header -->
<div class="header">
    <h2>Dashboard</h2>
    <a href="#" class="hidden-xs"><img src="images/user.jpg" class="header-img"></a>
    <a class="header-logout hidden-xs" href="#"><i class="fa fa-sign-out"></i><br>Logout</a>
</div>
<!-- End right side header -->

<div class="clearfix"></div>

<div class="main-content-frame">
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

                    <div class="header-pager-panel pr-0">

                        <div class="row w-100">
                            <div class="col-md-3">
                                <div class="download-btn">
                                    <button class="btn btn-trans">Get Report</button>
                                </div>
                            </div>
                            <div class="col-md-9 pr-0">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="frm-con-tag my-2 my-lg-0">
                                            <input class="frm-con effect-3" type="text" placeholder="Parlor Code">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="frm-con-tag my-2 my-lg-0">
                                            <input class="frm-con effect-3" type="text" placeholder="Parlor Name">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="frm-con-tag my-2 my-lg-0">
                                            <input class="frm-con effect-3" type="text" placeholder="Location">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="frm-con-tag my-2 my-lg-0">
                                            <input class="frm-con effect-3" type="text" placeholder="Region">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <div class="wrap">Visited Time</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Parlour</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Location</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Region</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Verified By</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Checked By</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Approved By</div>
                                        </th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01/07/2020</td>
                                        <td>Visit 1 2020</td>
                                        <td>Bolghatty</td>
                                        <td>Ernakulam</td>
                                        <td>Kerala</td>
                                        <td>Radhu </td>
                                        <td>Mohan</td>
                                        <td>Rafeeq</td>
                                        <td><i class="fa fa-eye" aria-hidden="true"></i></td>
                                    </tr>
                                    <tr>
                                        <td>01/07/2020</td>
                                        <td>Visit 1 2020</td>
                                        <td>Bolghatty</td>
                                        <td>Ernakulam</td>
                                        <td>Kerala</td>
                                        <td>Radhu </td>
                                        <td>Mohan</td>
                                        <td>Rafeeq</td>
                                        <td><i class="fa fa-eye" aria-hidden="true"></i></td>
                                    </tr>
                                    <tr>
                                        <td>01/07/2020</td>
                                        <td>Visit 1 2020</td>
                                        <td>Bolghatty</td>
                                        <td>Ernakulam</td>
                                        <td>Kerala</td>
                                        <td>Radhu </td>
                                        <td>Mohan</td>
                                        <td>Rafeeq</td>
                                        <td><i class="fa fa-eye" aria-hidden="true"></i></td>
                                    </tr>
                                    <tr>
                                        <td>01/07/2020</td>
                                        <td>Visit 1 2020</td>
                                        <td>Bolghatty</td>
                                        <td>Ernakulam</td>
                                        <td>Kerala</td>
                                        <td>Radhu </td>
                                        <td>Mohan</td>
                                        <td>Rafeeq</td>
                                        <td><i class="fa fa-eye" aria-hidden="true"></i></td>
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



<?php include 'footer.php'; ?>