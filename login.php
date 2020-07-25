<?php
if (isset($_COOKIE['token'])) {
    if ($_COOKIE['token'] != '') {
        header("Location: index.php");
        exit();
    }
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
            <li class="nav-item "><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="add-record.php"><i class="fas fa-clipboard"></i> Add new record</a></li>
            <li class="nav-item"><a class="nav-link" href="expense.php"><i class="fas fa-comment-dollar"></i> Expense</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="users.php"><i class="fas fa-users"></i> Users</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="users.php"><i class="fas fa-sign-out-alt"></i> Logout </a>
            </li>
        </ul>

    </div>
</nav>

<main class="login">
    <div class="container">
        <div class="wrapper">
            <div class="row  text-center">
                <div class="col-12">

                    <div class="logo">
                        <img src="images/logo.png" class="img-fluid">
                    </div>

                    <div class="login-form mt-3">

                            <h2 class="text-center mb-2">Log In</h2>
                            <div class="form-group">
                                <input maxlength="50" id="username" type="text" class="form-control" placeholder="Username" required="required">
                            </div>
                            <div class="form-group">
                                <input maxlength="50" id="password" type="password" class="form-control" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <button id="login" type="submit" class="btn btn-trans btn-block">Log in</button>
                            </div>
                            <!-- <div class="clearfix">
                                <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                                <a href="#" class="float-right">Forgot Password?</a>
                            </div> -->

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php';?>
<script src="js/main/common.js"></script>
<script src="js/main/login.js"></script>
