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

<!-- Left Panel -->
<nav class="navbar navbar-light navbar-expand-md">
    <a class="navbar-brand"><img src="images/logo.png" class="img-fluid"></a>

    <a href="#" class="hidden-md"><img src="images/user.jpg" class="header-img"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">

        <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <?php if ($_COOKIE['type'] == 0) { ?>
                <li class="nav-item"><a class="nav-link" href="add-record.php"><i class="fas fa-clipboard"></i> Add new record</a></li>
            <?php } ?>


            <?php if ($_COOKIE['type'] != 2) { ?>
                <li class="nav-item"><a class="nav-link" href="parlor.php"><i class="fas fa-igloo"></i> Parlor</a>
                </li>
            <?php } ?>

            <li class="nav-item"><a class="nav-link" href="expense.php"><i class="fas fa-comment-dollar"></i> Expense</a>
            </li>
            <?php if ($_COOKIE['type'] == 0) { ?>
                <li class="nav-item"><a class="nav-link" href="users.php"><i class="fas fa-users"></i> Users</a>
                </li>
            <?php } ?>
            <li class="nav-item ">
                <a class="nav-link" onclick="logOut()" href="#"><i class="fas fa-sign-out-alt"></i> Logout </a>
            </li>
        </ul>

    </div>
</nav>

<!-- Right side header -->
<div class="header  new-record">
    <h2>BASKIN ROBBINS PARLOUR</h2>

    <div class="header-img buttons">
        <?php if ($_COOKIE['type'] != 2) { ?>
            <a onclick="editVisit()" href="#" class="btn btn-trans">Edit</a>
        <?php } ?>
        <?php if ($_COOKIE['type'] == 0) { ?>
            <a class="btn btn-trans" onclick="deleteVisit()" href="#">Delete</a>
        <?php } ?>
    </div>
</div>
<!-- End right side header -->

<div class="clearfix"></div>

<main class="main-content-frame new-record visit-page">
    <!-- Requested Appointments -->
    <div class="container-fluid ">
        <div class="row">



            <div class="col-12">
                <div class="tab-content">

                    <h4 id="heading"></h4>

                    <div class="topmost">
                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-auto ml-auto">
                                    <div class="date-wrap ml-auto mb-3">


                                        <div class="frm-con-tag  mb-0">
                                            <input id="date" type="text" class="form-control endDate frm-con" placeholder="Date" disabled>
                                        </div>


                                    </div>
                                </div>



                            </div>

                            <div class="row">


                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <select id="region" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" disabled>
                                            <option value="" selected=""></option>
                                        </select>
                                        <label for="region">REGION</label>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <select id="location" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" disabled>
                                            <option value="" selected=""></option>
                                        </select>
                                        <label for="location">LOCATION</label>
                                    </div>
                                </div>

                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <select id="parlor" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" disabled>
                                            <option value="" selected=""></option>
                                        </select>
                                        <label for="parlor">PARLOR</label>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="parlour_code">Parlour Code</label>
                                        <input maxlength="50" class="frm-con effect-3" type="text" id="parlour_code" disabled>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="Latitude">Latitude</label>
                                        <input maxlength="50" class="frm-con effect-3" type="text" id="Latitude" disabled>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="Longitude">Longitude</label>
                                        <input maxlength="50" class="frm-con effect-3" type="text" id="Longitude" disabled>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                            </div>

                        </div>
                    </div>

                    <div class="top-inputs col-12 mt-2 ">
                        <div class="row">


                            <h4 class="mt-3">CAMERA DETAILS</h4>



                        </div>
                    </div>
                    <div class="table-contents">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-wrapper">
                                    <div class="table-responsive">
                                        <table class="table table2excel table2excel_with_colors">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="wrap">No.</div>
                                                    </th>
                                                    <th>
                                                        <div class="wrap">Type</div>
                                                    </th>
                                                    <th>
                                                        <div class="wrap">Brand</div>
                                                    </th>
                                                    <th>
                                                        <div class="wrap">Count</div>
                                                    </th>
                                                    <th>
                                                        <div class="wrap">Status</div>
                                                    </th>
                                                    <th>
                                                        <div class="wrap">Remarks</div>
                                                    </th>
                                                    <th>
                                                        <div class="wrap">IP Details</div>
                                                    </th>
                                                    <th>
                                                        <div class="wrap">Suggestions</div>
                                                    </th>
                                                    <th>
                                                        <div class="wrap"></div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="camera-table">

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="top-inputs col-12 mt-4">
                            <div class="row">

                                <div class="col-12">
                                    <h4 class="mt-3 border-top-divider pt-3">DVR DETAILS</h4>
                                </div>


                            </div>

                            <div class="table-contents">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="table-wrapper">
                                            <div class="table-responsive">
                                                <table class="table table2excel table2excel_with_colors">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <div class="wrap">No.</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">No. of channels</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Brand</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Record Availability</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">HDD Capacity</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Remarks</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Suggestions</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap"></div>
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="dvr-table">


                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="top-inputs col-12 mt-4 border-top-divider">
                                <div class="row">

                                    <div class="col-12">
                                        <h4 class="mt-3">NETWORK CABEL DETAILS</h4>
                                    </div>



                                </div>
                            </div>
                            <div class="table-contents">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-wrapper">
                                            <div class="table-responsive one-line-field-top">
                                                <table class="table table2excel table2excel_with_colors">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <div class="wrap">No.</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Network Point</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Status</div>
                                                            </th>

                                                            <th>
                                                                <div class="wrap">Suggestions</div>
                                                            </th>

                                                            <th>
                                                                <div class="wrap"></div>
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="network-cabel-table">


                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="top-inputs col-12 mt-4  border-top-divider">
                                <div class="row">

                                    <div class="col-12">
                                        <h4 class="mt-3">TV DETAILS</h4>
                                    </div>


                                </div>
                            </div>
                            <div class="table-contents">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="table-wrapper one-line-field-top">
                                            <div class="table-responsive one-line-field-top">
                                                <table class="table table2excel table2excel_with_colors">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <div class="wrap">No.</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Network Point</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Status</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Remarks</div>
                                                            </th>
                                                            <th>
                                                                <div class="wrap">Suggestions</div>
                                                            </th>

                                                            <th>
                                                                <div class="wrap"></div>
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="tv-table">


                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-contents">

                                <div class="col-12 bottom-sec">


                                    <div class="row">

                                        <div class="col-md-12 d-flex">
                                            <h4 class="mt-4 pb-4 mr-4 pt-2">COMMENTS</h4>
                                            <div class="frm-con-tag mt-4 mb-0 comment-wrap">
                                                <textarea maxlength="250" name="" id="comment" class="w-100 frm-con h-100"></textarea>
                                                <span class="focus-border"></span>
                                            </div>

                                        </div>



                                        <div class="col-md-12 survey-wrap">
                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <h4 class="mt-4 pb-4 mb-3">SURVEY STATUS VERIFICATION</h4>


                                                    <div class="ml-auto">
                                                        <a id="attachment" class="btn btn-trans mr-3" href="#" target="_blank">Download Attachment</a>
                                                    </div>
                                                </div>

                                                <div class="col-auto d-flex">

                                                    <h6 class=" d-flex align-items-center">Verified By</h6>

                                                    <div class="wrap d-flex align-items-center">
                                                        <div class="frm-con-tag input-group">
                                                            <label for="verified_by">Name</label>
                                                            <input disabled maxlength="50" class="frm-con effect-3" type="text" id="verified_by" required="">
                                                            <span class="focus-border"></span>
                                                        </div>

                                                        <div class="date-wrap">
                                                            <div class="frm-con-tag input-group">
                                                                <input disabled id="verified_date" type="text" class="form-control frm-con endDate" placeholder="Date">
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto d-flex">
                                                    <h6 class=" d-flex align-items-center">Checked By</h6>

                                                    <div class="wrap d-flex align-items-center">
                                                        <div class="frm-con-tag input-group">
                                                            <label for="checked_by">Name</label>
                                                            <input disabled maxlength="50" class="frm-con effect-3" type="text" id="checked_by" required="">
                                                            <span class="focus-border"></span>
                                                        </div>

                                                        <div class="date-wrap ml-auto">
                                                            <div class="frm-con-tag input-group">
                                                                <input disabled id="checked_date" type="text" class="form-control frm-con endDate" placeholder="Date">
                                                                <span class="focus-border"></span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto d-flex">
                                                    <h6 class=" d-flex align-items-center">Approved By</h6>

                                                    <div class="wrap d-flex align-items-center">
                                                        <div class="frm-con-tag input-group">
                                                            <label for="approved_by">Name</label>
                                                            <input disabled maxlength="50" class="frm-con effect-3" type="text" id="approved_by" required="">
                                                            <span class="focus-border"></span>
                                                        </div>

                                                        <div class="date-wrap ml-auto">
                                                            <div class="frm-con-tag input-group">
                                                                <input disabled id="approved_date" type="text" class="form-control frm-con endDate" placeholder="Date">
                                                                <span class="focus-border"></span>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end invite patient content -->
</main>

<?php include 'footer.php'; ?>
<script src="js/main/common.js"></script>
<script src="js/main/visit.js"></script>