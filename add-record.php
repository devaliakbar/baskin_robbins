<?php include 'header.php'; ?>

<!-- Right side header -->
<div class="header">
    <h2>Add New Record</h2>
    <a href="#" class="hidden-xs"><img src="images/user.jpg" class="header-img"></a>
    <a class="header-logout hidden-xs" href="#"><i class="fa fa-sign-out"></i><br>Logout</a>
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
                        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">first</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">second</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">third</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false">fourth</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">

                        <div class="col-md-12 mt-5">



                            <div class="row">
                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="choose_region">Select Region</label>
                                        <select name="refrence" aria-required="true" id="choose_region" aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="1">Kochi</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="choose_location">Select Location</label>
                                        <select name="refrence" aria-required="true" id="choose_location" aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">

                                    <div class="frm-con-tag  mb-0">
                                        <label for="choose_doctor">Select Parlor</label>
                                        <select name="refrence" aria-required="true" id="choose_doctor" aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">

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
                                </div>

                                <div class="col">
                                    <div class="date-wrap ml-auto">


                                        <div class="input-group">
                                            <input type="text" class="form-control endDate frm-con" placeholder="To">
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="table-contents">
                                <div class="row">

                                    <div class="col-12 bottom-sec">

                                        <div class="frm-con-tag mt-5  mb-0">
                                            <textarea name="" id="comment" class="w-100 frm-con"></textarea>
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
                                                    <label for="ver_by">Name</label>
                                                    <input class="frm-con effect-3" type="text" id="ver_by" required="">
                                                    <span class="focus-border"></span>
                                                </div>

                                                <div class="date-wrap frm-con-tag">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control frm-con endDate" placeholder="To">
                                                        <span class="focus-border"></span>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Checked By</h6>

                                                <div class="frm-con-tag input-group">
                                                    <label for="chk_by">Name</label>
                                                    <input class="frm-con effect-3" type="text" id="chk_by" required="">
                                                    <span class="focus-border"></span>
                                                </div>

                                                <div class="date-wrap ml-auto frm-con-tag">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control frm-con endDate" placeholder="To">
                                                        <span class="focus-border"></span>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Approved By</h6>

                                                <div class="frm-con-tag input-group">
                                                    <label for="appr_by">Name</label>
                                                    <input class="frm-con effect-3" type="text" id="appr_by" required="">
                                                    <span class="focus-border"></span>
                                                </div>

                                                <div class="date-wrap ml-auto">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control frm-con endDate" placeholder="To">
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

                        <div class="top-inputs col-12 mt-4">
                            <div class="row">

                                <div class="frm-con-tag input-group col">
                                    <label for="two_type">No Of Channels</label>
                                    <input class="frm-con effect-3" type="text" id="two_type" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="two_brand">Brand</label>
                                    <input class="frm-con effect-3" type="text" id="two_brand" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <div class="frm-con-tag  mb-0">
                                        <label for="rec_avail">Recording Availability</label>
                                        <select name="refrence" aria-required="true" id="rec_avail" aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option>
                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="two_remark">Remark</label>
                                    <input class="frm-con effect-3" type="text" id="two_remark" required="">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="row">

                                <div class="frm-con-tag input-group col">
                                    <label for="two_remark">Remark</label>
                                    <input class="frm-con effect-3" type="text" id="two_remark" required="">
                                    <span class="focus-border"></span>
                                </div>


                                <div class="frm-con-tag input-group col">
                                    <label for="two_ip">IP Detail</label>
                                    <input class="frm-con effect-3" type="text" id="two_ip" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="two_suggestion">Suggestion</label>
                                    <input class="frm-con effect-3" type="text" id="two_suggestion" required="">
                                    <span class="focus-border"></span>
                                </div>
                                <div class="col">
                                    <button class="btn btn-trans btn-add">ADD</button>
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
                                                            <div class="wrap">ID</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Doctor Name</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Patient Name</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Date & Time</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Fees</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Payment ID</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Appt Status</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Doctor Status &<br>Screen Status</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Patient Status &<br>Screen Status</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="table-nav footer-pager-panel">
                                        <span class="entries-count">
                                            Showing 0 to 0 of 0 entries
                                        </span>
                                        <div class="nav-btns">
                                            <a href="" class="btn btn-trans">Previous</a>
                                            <a href="" class="btn btn-trans">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">

                        <div class="top-inputs col-12 mt-4">
                            <div class="row">


                                <div class="frm-con-tag input-group col">
                                    <label for="three_Network">Network Point</label>
                                    <input class="frm-con effect-3" type="text" id="three_Network" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <div class="frm-con-tag  mb-0">
                                        <label for="three_status">Status</label>
                                        <select name="refrence" aria-required="true" id="three_status" aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option>
                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="three_suggestion">Suggestion</label>
                                    <input class="frm-con effect-3" type="text" id="three_suggestion" required="">
                                    <span class="focus-border"></span>
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
                                                            <div class="wrap">ID</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Doctor Name</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Patient Name</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Date & Time</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Fees</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Payment ID</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Appt Status</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Doctor Status &<br>Screen Status</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Patient Status &<br>Screen Status</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="table-nav footer-pager-panel">
                                        <span class="entries-count">
                                            Showing 0 to 0 of 0 entries
                                        </span>
                                        <div class="nav-btns">
                                            <a href="" class="btn btn-trans">Previous</a>
                                            <a href="" class="btn btn-trans">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
                        <div class="top-inputs col-12 mt-4">
                            <div class="row">

                                <div class="frm-con-tag input-group col">
                                    <label for="one_type">Type</label>
                                    <input class="frm-con effect-3" type="text" id="one_type" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="one_brand">Brand</label>
                                    <input class="frm-con effect-3" type="text" id="one_brand" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="one_count">Count</label>
                                    <input class="frm-con effect-3" type="text" id="one_count" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="one_remark">Remark</label>
                                    <input class="frm-con effect-3" type="text" id="one_remark" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="one_ip">IP Detail</label>
                                    <input class="frm-con effect-3" type="text" id="one_ip" required="">
                                    <span class="focus-border"></span>
                                </div>

                                <div class="frm-con-tag input-group col">
                                    <label for="one_suggestion">Suggestion</label>
                                    <input class="frm-con effect-3" type="text" id="one_suggestion" required="">
                                    <span class="focus-border"></span>
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
                                                            <div class="wrap">ID</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Doctor Name</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Patient Name</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Date & Time</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Fees</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Payment ID</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Appt Status</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Doctor Status &<br>Screen Status</div>
                                                        </th>
                                                        <th>
                                                            <div class="wrap">Patient Status &<br>Screen Status</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Radhu</td>
                                                        <td>Jahar</td>
                                                        <td>24/02/20</td>
                                                        <td>2500</td>
                                                        <td>56
                                                        <td>
                                                        <td>Active</td>
                                                        <td>On</td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="table-nav footer-pager-panel">
                                        <span class="entries-count">
                                            Showing 0 to 0 of 0 entries
                                        </span>
                                        <div class="nav-btns">
                                            <a href="" class="btn btn-trans">Previous</a>
                                            <a href="" class="btn btn-trans">Next</a>
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