<script src="js/main/common.js"></script>
<script>
if(getCookie("token") == ""){
    location.replace("login.php");
}
</script>
<?php include 'header.php';?>

<!-- Right side header -->
<div class="header">
    <h2>Dashboard</h2>
    <a href="#" class="hidden-xs"><img src="images/user.jpg" class="header-img"></a>
    <a class="header-logout hidden-xs" onclick="logOut()" href="#"><i class="fa fa-sign-out"></i><br>Logout</a>
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
                                    <input id="from_date" type='text' class="form-control startDate" placeholder="From" />
                                </div>
                                <div class='input-group'>
                                    <input id="to_date" type='text' class="form-control endDate" placeholder="To" />
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
                                    <!-- <div class="col-sm-3">
                                        <div class="frm-con-tag my-2 my-lg-0">
                                            <input class="frm-con effect-3" type="text" placeholder="Parlor Code">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-3">
                                        <div class="frm-con-tag my-2 my-lg-0">
                                        <label for="choose_region">Select Region</label>
                                        <select id="region" name="refrence" aria-required="true"  aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="Kochi">Kochi</option>
                                            <option value="MM Radha">MM Radha</option>
                                            <option value="P Paul">P Paul</option>
                                            <option value="Alexander">Alexander</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="frm-con-tag my-2 my-lg-0">
                                        <label for="choose_location">Select Location</label>
                                        <select id="location" name="refrence" aria-required="true"  aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="frm-con-tag my-2 my-lg-0">
                                        <label for="choose_doctor">Select Parlor</label>
                                        <select id="parlor" name="refrence" aria-required="true"  aria-invalid="false" class="frm-con effect-3" required="">
                                            <option value="" selected="" disabled=""></option>
                                            <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option>
                                        </select>
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
                                <tbody class="visits-table">


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="footer-pager-panel">
                        <div class="nav-btns">
                            <a href="#" onclick="fetchAllVisits()" class="btn btn-trans">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- end invite patient content -->
</div>



<?php include 'footer.php';?>
<script src="js/main/home.js"></script>