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

if ($_COOKIE['type'] == 2) {
    header("Location: index.php");
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
            <li class=" nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <?php if ($_COOKIE['type'] == 0) {?>
                <li class="nav-item active"><a class="nav-link" href="add-record.php"><i class="fas fa-clipboard"></i> Add new record</a></li>
            <?php }?>


            <?php if ($_COOKIE['type'] != 2) {?>
                <li class="nav-item"><a class="nav-link" href="parlor.php"><i class="fas fa-igloo"></i> Parlor</a>
                </li>
            <?php }?>

            <li class="nav-item"><a class="nav-link" href="expense.php"><i class="fas fa-comment-dollar"></i> Expense</a>
            </li>
            <?php if ($_COOKIE['type'] == 0) {?>
                <li class="nav-item"><a class="nav-link" href="users.php"><i class="fas fa-users"></i> Users</a>
                </li>
            <?php }?>
            <li class="nav-item">
                <a class="nav-link" onclick="logOut()" href="#"><i class="fas fa-sign-out-alt"></i> Logout </a>
            </li>
        </ul>

    </div>
</nav>

<!-- Right side header -->
<div class="header">
    <h2 id="heading"></h2>
    <a onclick="saveVisit()" href="#" class="btn btn-trans header-img">Save</a>
</div>
<!-- End right side header -->

<div class="clearfix"></div>

<main class="main-content-frame new-record">
    <!-- Requested Appointments -->
    <div class="container-fluid ">
        <div class="row">

            <div class="tab-content">

                <div class="topmost">
                    <div class="col-md-12">

                        <div class="row">

                            <div class="col">
                                <div class="date-wrap ml-auto mb-3">


                                    <div class="frm-con-tag  mb-0">
                                        <input id="date" type="text" class="form-control endDate frm-con" placeholder="Date">
                                    </div>


                                </div>
                            </div>



                        </div>

                        <div class="row">


                            <div class="col">

                                <div class="frm-con-tag  mb-0">
                                    <select id="region" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" required="">
                                        <option value="" selected=""></option>
                                    </select>
                                    <label for="region">Select Region</label>
                                </div>
                            </div>
                            <div class="col">

                                <div class="frm-con-tag  mb-0">
                                    <select id="location" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" required="">
                                        <option value="" selected=""></option>
                                    </select>
                                    <label for="location">Select Location</label>
                                </div>
                            </div>

                            <div class="col">

                                <div class="frm-con-tag  mb-0">
                                    <select id="parlor" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" required="">
                                        <option value="" selected=""></option>
                                    </select>
                                    <label for="parlor">Select Parlor</label>
                                </div>
                            </div>
                            <div class="col">

                                <div class="frm-con-tag  mb-0">
                                    <label for="parlour_code">Parlour Code</label>
                                    <input maxlength="50" class="frm-con effect-3" type="text" id="parlour_code" required="" disabled>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col">

                                <div class="frm-con-tag  mb-0">
                                    <label for="Latitude">Latitude</label>
                                    <input maxlength="50" class="frm-con effect-3" type="text" id="Latitude" required="" disabled>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col">

                                <div class="frm-con-tag  mb-0">
                                    <label for="Longitude">Longitude</label>
                                    <input maxlength="50" class="frm-con effect-3" type="text" id="Longitude" required="" disabled>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="top-inputs col-12 mt-2 ">
                    <div class="row">

                        <div class="col-12">
                            <h4 class="mt-3">Camera Details</h4>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="camera_type">Type</label>
                            <input maxlength="50" class="frm-con effect-3" type="text" id="camera_type" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="camera_brand">Brand</label>
                            <input maxlength="50" class="frm-con effect-3" type="text" id="camera_brand" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="camera_count">Count</label>
                            <input maxlength="4" class="frm-con effect-3" type="number" id="camera_count" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">

                            <select name="refrence" aria-required="true" id="camera_status" aria-invalid="false" class="frm-con effect-3" required="">
                                <option value="" selected></option>
                                <option value="OK">OK</option>
                                <option value="Not OK">Not OK</option>

                            </select>
                            <label for="camera_status">Status</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="camera_remark">Remark</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="camera_remark" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="camera_ip">IP Detail</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="camera_ip" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="camera_suggestion">Suggestion</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="camera_suggestion" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="col">
                            <button onclick="addCamera()" class="btn btn-trans btn-add">ADD</button>
                        </div>

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
                                                    <div class="wrap">Remark</div>
                                                </th>
                                                <th>
                                                    <div class="wrap">IP Details</div>
                                                </th>
                                                <th>
                                                    <div class="wrap">Suggestion</div>
                                                </th>
                                                <th>
                                                    <div class="wrap"></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="camera-table">
                                            <!-- <tr>
                                                        <td>1</td>
                                                        <td>2</td>
                                                        <td>3</td>
                                                        <td>4</td>
                                                        <td>5</td>
                                                        <td>6</td>
                                                        <td>7</td>
                                                        <td>8</td>
                                                        <td>9</td>
                                                    </tr> -->


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                                    <div class="table-nav footer-pager-panel">
                                        <span class="entries-count">
                                            Showing 0 to 0 of 0 entries
                                        </span>
                                        <div class="nav-btns">
                                            <a href="" class="btn btn-trans">Previous</a>
                                            <a href="" class="btn btn-trans">Next</a>
                                        </div>
                                    </div>
                                </div> -->
                    </div>
                </div>

                <div class="top-inputs col-12 mt-4 border-top-divider">
                    <div class="row">

                        <div class="col-12">
                            <h4 class="mt-3">DVR Details</h4>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="no_of_channels">No Of Channels</label>
                            <input maxlength="4" class="frm-con effect-3" type="number" id="no_of_channels" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="dvr_brand">Brand</label>
                            <input maxlength="50" class="frm-con effect-3" type="text" id="dvr_brand" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <div class="frm-con-tag  mb-0">
                                <select name="refrence" aria-required="true" id="record_availability" aria-invalid="false" class="frm-con effect-3" required="">
                                    <option value="" selected=""></option>
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>

                                </select>
                                <label for="record_availability">Availability</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="hdd_capacity">HDD Capaciity</label>
                            <input maxlength="50" class="frm-con effect-3" type="text" id="hdd_capacity" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="dvr_remark">Remark</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="dvr_remark" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="dvr_suggestion">Suggestion</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="dvr_suggestion" required="">
                            <span class="focus-border"></span>
                        </div>
                        <div class="col">
                            <button onclick="addDvr()" class="btn btn-trans btn-add">ADD</button>
                        </div>
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
                                                    <div class="wrap">Remark</div>
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
                        <!-- <div class="col-12">
                                    <div class="table-nav footer-pager-panel">
                                        <span class="entries-count">
                                            Showing 0 to 0 of 0 entries
                                        </span>
                                        <div class="nav-btns">
                                            <a href="" class="btn btn-trans">Previous</a>
                                            <a href="" class="btn btn-trans">Next</a>
                                        </div>
                                    </div>
                                </div> -->
                    </div>
                </div>

                <div class="top-inputs col-12 mt-4 border-top-divider">
                    <div class="row">

                        <div class="col-12">
                            <h4 class="mt-3">Network Cabel Details</h4>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="network_point">Network Point</label>
                            <input maxlength="50" class="frm-con effect-3" type="text" id="network_point" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <div class="frm-con-tag  mb-0">
                                <select name="refrence" aria-required="true" id="network_status" aria-invalid="false" class="frm-con effect-3" required="">
                                    <option value="" selected></option>
                                    <option value="OK">OK</option>
                                    <option value="Not OK">Not OK</option>

                                </select>
                                <label for="network_status">Status</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="network_suggestions">Suggestion</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="network_suggestions" required="">
                            <span class="focus-border"></span>
                        </div>
                        <div class="col">
                            <button onclick="addNetworkCabel()" class="btn btn-trans btn-add">ADD</button>
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
                        <!-- <div class="col-12">
                                    <div class="table-nav footer-pager-panel">
                                        <span class="entries-count">
                                            Showing 0 to 0 of 0 entries
                                        </span>
                                        <div class="nav-btns">
                                            <a href="" class="btn btn-trans">Previous</a>
                                            <a href="" class="btn btn-trans">Next</a>
                                        </div>
                                    </div>
                                </div> -->
                    </div>
                </div>

                <div class="top-inputs col-12 mt-4  border-top-divider">
                    <div class="row">

                        <div class="col-12">
                            <h4 class="mt-3">TV Details</h4>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="tv_point">Network Point</label>
                            <input maxlength="50" class="frm-con effect-3" type="text" id="tv_point" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <div class="frm-con-tag  mb-0">
                                <select name="refrence" aria-required="true" id="tv_status" aria-invalid="false" class="frm-con effect-3" required="">
                                    <option value="" selected></option>
                                    <option value="OK">OK</option>
                                    <option value="Not OK">Not OK</option>

                                </select>
                                <label for="tv_status">Status</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="tv_remark">Remark</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="tv_remark" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col">
                            <label for="tv_suggestions">Suggestion</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="tv_suggestions" required="">
                            <span class="focus-border"></span>
                        </div>
                        <div class="col">
                            <button onclick="addTV()" class="btn btn-trans btn-add">ADD</button>
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
                                                    <div class="wrap">Remark</div>
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
                        <!-- <div class="col-12">
            <div class="table-nav footer-pager-panel">
                <span class="entries-count">
                    Showing 0 to 0 of 0 entries
                </span>
                <div class="nav-btns">
                    <a href="" class="btn btn-trans">Previous</a>
                    <a href="" class="btn btn-trans">Next</a>
                </div>
            </div>
        </div> -->
                    </div>
                </div>

                <div class="table-contents">

                    <div class="col-12 bottom-sec">


                        <div class="row">

                            <div class="col-md-4">
                                <h4 class="mt-4 pb-4 mb-3">Comments</h4>
                                <div class="frm-con-tag mb-0 comment-wrap">
                                    <textarea maxlength="250" name="" id="comment" class="w-100 frm-con h-100"></textarea>
                                    <span class="focus-border"></span>
                                </div>

                            </div>


                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="mt-4 pb-4 mb-3">Survey status verification</h4>
                                    </div>
                                    <div class="col-md-4">

                                        <h6>Verified By</h6>

                                        <div class="frm-con-tag input-group">
                                            <label for="verified_by">Name</label>
                                            <input maxlength="50" class="frm-con effect-3" type="text" id="verified_by" required="">
                                            <span class="focus-border"></span>
                                        </div>

                                        <div class="date-wrap">
                                            <div class="frm-con-tag input-group">
                                                <input id="verified_date" type="text" class="form-control frm-con endDate" placeholder="Date">
                                                <span class="focus-border"></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <h6>Checked By</h6>

                                        <div class="frm-con-tag input-group">
                                            <label for="checked_by">Name</label>
                                            <input maxlength="50" class="frm-con effect-3" type="text" id="checked_by" required="">
                                            <span class="focus-border"></span>
                                        </div>

                                        <div class="date-wrap ml-auto">
                                            <div class="frm-con-tag input-group">
                                                <input id="checked_date" type="text" class="form-control frm-con endDate" placeholder="Date">
                                                <span class="focus-border"></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <h6>Approved By</h6>

                                        <div class="frm-con-tag input-group">
                                            <label for="approved_by">Name</label>
                                            <input maxlength="50" class="frm-con effect-3" type="text" id="approved_by" required="">
                                            <span class="focus-border"></span>
                                        </div>

                                        <div class="date-wrap ml-auto">
                                            <div class="frm-con-tag input-group">
                                                <input id="approved_date" type="text" class="form-control frm-con endDate" placeholder="Date">
                                                <span class="focus-border"></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="custom-file">
                                                    <label for=" inputfile" class="custom-file-label">Choose file</label>
                                                    <input type='file' class="custom-file-input" name='inputfile' id='inputfile'>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <a id="attachment" class="btn btn-trans mr-3" href="#" target="_blank">Download Attachment</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end invite patient content -->
</main>

<?php include 'footer.php';?>
<script src="js/main/common.js"></script>
<script src="js/main/add-record.js"></script>
<script src="js/main/update-record.js"></script>