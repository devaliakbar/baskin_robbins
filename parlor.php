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
            <li class=" nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <?php if ($_COOKIE['type'] == 0) {?>
            <li class="nav-item"><a class="nav-link" href="add-record.php"><i class="fas fa-clipboard"></i> Add new record</a></li>
            <?php }?>

            <li class="nav-item active"><a class="nav-link" href="parlor.php"><i class="fas fa-igloo"></i> Parlor</a>
                </li>

            <li class="nav-item "><a class="nav-link" href="expense.php"><i class="fas fa-comment-dollar"></i> Expense</a>
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
    <h2>Parlor</h2>

    <a class="header-img"><label for="Admin"><?php echo $_COOKIE['name']; ?></label></a>
</div>
<!-- End right side header -->

<div class="clearfix"></div>

<div class="main-content-frame expense-page">
    <!-- Requested Appointments -->
    <div class="container-fluid ">
        <form>
            <div class="row">

                <div class="col-md-12">

                    <div class="header-pager-panel mb-4">

                        <div class="btn-wrap mr-auto">
                            <!-- Button trigger modal -->
                            <?php if ($_COOKIE['type'] == 0) {?>
                            <button onclick="clearAll()" type="button" class="btn btn-trans" data-toggle="modal" data-target="#exampleModalLong">
                                Add Parlor
                            </button>
                            <?php }?>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="frm-con-tag my-2 my-lg-0">
                                <select id="region" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" required="">
                                    <option value="" selected="" disabled></option>
                                    <!-- <option value="Kochi">Kochi</option>
                                            <option value="MM Radha">MM Radha</option>
                                            <option value="P Paul">P Paul</option>
                                            <option value="Alexander">Alexander</option> -->
                                </select>
                                <label for="choose_region">Select Region</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="frm-con-tag my-2 my-lg-0">
                                <select id="location" name="refrence" aria-required="true" aria-invalid="false" class="frm-con effect-3" required="">
                                    <option value="" selected="" disabled=""></option>
                                    <!-- <option value="1">Anil Kumar</option>
                                            <option value="1">MM Radha</option>
                                            <option value="1">P Paul</option>
                                            <option value="1">Alexander</option> -->
                                </select>
                                <label for="choose_location">Select Location</label>
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
                                            <div class="wrap">Region</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Location</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Parlor</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Parlor Code</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Lat</div>
                                        </th>
                                        <th>
                                            <div class="wrap">Lon</div>
                                        </th>
                                        <th>
                                            <div class="wrap"></div>
                                        </th>
                                        <th>
                                            <div class="wrap"></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="expense-table">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="footer-pager-panel">
                        <div class="nav-btns">
                            <a href="#" onclick="setUpFilterAndGetExpenses()" class="btn btn-trans">Load More</a>
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
                                <input id="date" type="text" class="form-control frm-con endDate" placeholder="Date">
                                <span class="focus-border"></span>
                            </div>
                        </div>

                        <div class="frm-con-tag input-group col-5 offset-2">
                            <label for="user_name">Name</label>
                            <input maxlength="50" class="frm-con effect-3" type="text" id="user_name" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col-12">
                            <label for="description">Description</label>
                            <input maxlength="250" class="frm-con effect-3" type="text" id="description" required="">
                            <span class="focus-border"></span>
                        </div>

                        <div class="frm-con-tag input-group col-5">
                            <label for="amount">Amount</label>
                            <input maxlength="8" class="frm-con effect-3" type="number" id="amount" required="" id="no_of_channels" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <span class="focus-border"></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-trans mr-0" data-dismiss="modal">Cancel</button>
                <button onclick="saveExpense()" type="button" class="btn btn-trans ml-0">Save</button>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php';?>
<script src="js/main/common.js"></script>
<script src="js/main/parlor.js"></script>