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
    <h2 id="heading"></h2>
    <a onclick="editVisit()" href="#" class="btn btn-trans header-img">Edit</a>
    <a class="header-logout hidden-xs" onclick="deleteVisit()" href="#"><i class="fa fa-sign-out"></i><br>Delete</a>
</div>
<!-- End right side header -->

<div class="clearfix"></div>

<main class="main-content-frame new-record">
    <!-- Requested Appointments -->
    <div class="container-fluid ">
        <div class="row">



            <div class="col-12">
                <ul class="nav nav-tabs row no-gutters" id="myTab" role="tablist">
                    <li class="nav-item col">
                        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false">Camera Details</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">DVR Details</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">Network Cable Details</a>
                    </li>

                    <li class="nav-item col">
                        <a class="nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab" aria-controls="fifth" aria-selected="false">TV Details</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">

                        <div class="col-md-12 mt-5">



                            <div class="row">

                            <div class="col">
                                    <div class="date-wrap ml-auto">


                                        <div class="input-group">
                                            <input id="date" type="text" class="form-control endDate frm-con" placeholder="Date" disabled>
                                        </div>


                                    </div>
                                </div>

                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="region">Select Region</label>
                                        <select id="region" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" required="" disabled>
                                            <option value="" selected="" ></option>
                                            <!-- <option value="1">Kochi</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="location">Select Location</label>
                                        <select id="location" name="refrence" aria-required="true"  aria-invalid="false" class="frm-con effect-3" disabled>
                                            <option value="" selected="" ></option>
                                            <!-- <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option> -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="parlor">Select Parlor</label>
                                        <select id="parlor" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" required="" disabled>
                                            <option value="" selected="" ></option>
                                            <!-- <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option> -->
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="choose_doctor">Visited Time</label>
                                        <select name="refrence" aria-required="true" id="choose_doctor" aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option>
                                        </select>
                                    </div>
                                </div> -->



                            </div>
                            <div class="table-contents">
                                <div class="row">

                                    <div class="col-12 bottom-sec">

                                        <div class="frm-con-tag mt-5  mb-0">
                                            <textarea name="" id="comment" class="w-100 frm-con" disabled></textarea>
                                            <label for="comment">Comments</label>
                                            <span class="focus-border"></span>
                                        </div>

                                        <div class="row">

                                            <div class="col-12">

                                                <h4 class="mt-5 pb-4 mb-3">Survey status verification</h4>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Verified By</h6>

                                                <div class="frm-con-tag input-group">
                                                    <label for="verified_by">Name</label>
                                                    <input class="frm-con effect-3" type="text" id="verified_by" required="" disabled>
                                                    <span class="focus-border"></span>
                                                </div>

                                                <div class="date-wrap frm-con-tag">
                                                    <div class="input-group">
                                                        <input id="verified_date" type="text" class="form-control frm-con endDate" placeholder="Date" disabled>
                                                        <span class="focus-border"></span>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Checked By</h6>

                                                <div class="frm-con-tag input-group">
                                                    <label for="checked_by">Name</label>
                                                    <input class="frm-con effect-3" type="text" id="checked_by" required="" disabled>
                                                    <span class="focus-border"></span>
                                                </div>

                                                <div class="date-wrap ml-auto frm-con-tag">
                                                    <div class="input-group">
                                                        <input  id="checked_date" type="text" class="form-control frm-con endDate" placeholder="Date" disabled>
                                                        <span class="focus-border"></span>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Approved By</h6>

                                                <div class="frm-con-tag input-group">
                                                    <label for="approved_by">Name</label>
                                                    <input class="frm-con effect-3" type="text" id="approved_by" required="" disabled>
                                                    <span class="focus-border"></span>
                                                </div>

                                                <div class="date-wrap ml-auto">
                                                    <div class="input-group">
                                                        <input id="approved_date" type="text" class="form-control frm-con endDate" placeholder="Date" disabled>
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
                    <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">

                        <!-- <div class="top-inputs col-12 mt-4">
                            <div class="row">

                                <div class="frm-con-tag input-group col">
                                    <label for="no_of_channels">No Of Channels</label>
                                    <input class="frm-con effect-3" type="number" id="no_of_channels" required="" disabled>
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="dvr_brand">Brand</label>
                                    <input class="frm-con effect-3" type="text" id="dvr_brand" required="" disabled>
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <div class="frm-con-tag  mb-0">
                                        <label for="record_availability">Recording Availability</label>
                                        <select name="refrence" aria-required="true" id="record_availability" aria-invalid="false" class="frm-con effect-3" required="" disabled>
                                            <option value="" selected="" ></option>
                                            <option value="Available">Available</option>
                                            <option value="Not Available">Not Available</option>

                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="hdd_capacity">HDD Capaciity</label>
                                    <input class="frm-con effect-3" type="text" id="hdd_capacity" required="" disabled>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="row">

                                <div class="frm-con-tag input-group col">
                                    <label for="dvr_remark">Remark</label>
                                    <input class="frm-con effect-3" type="text" id="dvr_remark" required="" disabled>
                                    <span class="focus-border"></span>
                                </div>


                               <div class="frm-con-tag input-group col">
                                    <label for="two_ip">IP Detail</label>
                                    <input class="frm-con effect-3" type="text" id="two_ip" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="dvr_suggestion">Suggestion</label>
                                    <input class="frm-con effect-3" type="text" id="dvr_suggestion" required="" >
                                    <span class="focus-border"></span>
                                </div>
                                <div class="col">
                                    <button onclick="addDvr()" class="btn btn-trans btn-add">ADD</button>
                                </div>
                            </div>
                        </div> -->

                        <div class="table-contents">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-wrapper">
                                        <div class="table-responsive">
                                            <table class="table table2excel table2excel_with_colors">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="wrap">Sn No.</div>
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
                    </div>
                    <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">

                        <!-- <div class="top-inputs col-12 mt-4">
                            <div class="row">


                                <div class="frm-con-tag input-group col">
                                    <label for="network_point">Network Point</label>
                                    <input class="frm-con effect-3" type="text" id="network_point" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <div class="frm-con-tag  mb-0">
                                        <label for="network_status">Status</label>
                                        <select name="refrence" aria-required="true" id="network_status" aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected></option>
                                            <option value="OK">OK</option>
                                            <option value="Not OK">Not OK</option>

                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="network_suggestions">Suggestion</label>
                                    <input class="frm-con effect-3" type="text" id="network_suggestions" required="">
                                    <span class="focus-border"></span>
                                </div>
                                <div class="col">
                                    <button onclick="addNetworkCabel()" class="btn btn-trans btn-add">ADD</button>
                                </div>

                            </div>
                        </div> -->


                        <div class="table-contents">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-wrapper">
                                        <div class="table-responsive">
                                            <table class="table table2excel table2excel_with_colors">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="wrap">Sn No.</div>
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
                    </div>















                    <div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="fifth-tab">

<!-- <div class="top-inputs col-12 mt-4">
    <div class="row">


        <div class="frm-con-tag input-group col">
            <label for="tv_point">Network Point</label>
            <input class="frm-con effect-3" type="text" id="tv_point" required="">
            <span class="focus-border"></span>
        </div>

        <div class="frm-con-tag input-group col">
            <div class="frm-con-tag  mb-0">
                <label for="tv_status">Status</label>
                <select name="refrence" aria-required="true" id="tv_status" aria-invalid="false" class="frm-con effect-3" required="">
                    <option value="" selected></option>
                    <option value="OK">OK</option>
                    <option value="Not OK">Not OK</option>

                </select>
                <span class="focus-border"></span>
            </div>
        </div>

        <div class="frm-con-tag input-group col">
            <label for="tv_remark">Remark</label>
            <input class="frm-con effect-3" type="text" id="tv_remark" required="">
            <span class="focus-border"></span>
        </div>

        <div class="frm-con-tag input-group col">
            <label for="tv_suggestions">Suggestion</label>
            <input class="frm-con effect-3" type="text" id="tv_suggestions" required="">
            <span class="focus-border"></span>
        </div>
        <div class="col">
            <button onclick="addTV()" class="btn btn-trans btn-add">ADD</button>
        </div>

    </div>
</div> -->
<div class="table-contents">
    <div class="row">
        <div class="col-md-12">

            <div class="table-wrapper">
                <div class="table-responsive">
                    <table class="table table2excel table2excel_with_colors">
                        <thead>
                            <tr>
                                <th>
                                    <div class="wrap">Sn No.</div>
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
</div>

















                    <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
                        <!-- <div class="top-inputs col-12 mt-4">
                            <div class="row">

                                <div class="frm-con-tag input-group col">
                                    <label for="camera_type">Type</label>
                                    <input class="frm-con effect-3" type="text" id="camera_type" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="camera_brand">Brand</label>
                                    <input class="frm-con effect-3" type="text" id="camera_brand" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="camera_count">Count</label>
                                    <input class="frm-con effect-3" type="number" id="camera_count" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">




                                <label for="camera_status">Status</label>
                                        <select name="refrence" aria-required="true" id="camera_status" aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected></option>
                                            <option value="OK">OK</option>
                                            <option value="Not OK">Not OK</option>

                                        </select>
                                        <span class="focus-border"></span>



                                    <label for="camera_status">Status</label>
                                    <input class="frm-con effect-3" type="text" id="camera_status" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="camera_remark">Remark</label>
                                    <input class="frm-con effect-3" type="text" id="camera_remark" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="camera_ip">IP Detail</label>
                                    <input class="frm-con effect-3" type="text" id="camera_ip" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="camera_suggestion">Suggestion</label>
                                    <input class="frm-con effect-3" type="text" id="camera_suggestion" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="col">
                                    <button onclick="addCamera()" class="btn btn-trans btn-add">ADD</button>
                                </div>

                            </div>
                        </div> -->
                        <div class="table-contents">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-wrapper">
                                        <div class="table-responsive">
                                            <table class="table table2excel table2excel_with_colors">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="wrap">Sn No.</div>
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

                                                    </tr>
                                                </thead>
                                                <tbody  class="camera-table">
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
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end invite patient content -->
</main>

<?php include 'footer.php';?>
<script src="js/main/common.js"></script>
<script src="js/main/visit.js"></script>