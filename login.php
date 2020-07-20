<?php include 'header.php';?>

<main class="login">
    <div class="container">
        <div class="wrapper">
            <div class="row  text-center">
                <div class="col-12">

                    <div class="logo">
                        <img src="images/logo.png" class="img-fluid">
                    </div>

                    <div class="login-form mt-3">
                        <form action="/examples/actions/confirmation.php" method="post">
                            <h2 class="text-center mb-2">Log in</h2>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-trans btn-block">Log in</button>
                            </div>
                            <!-- <div class="clearfix">
                                <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                                <a href="#" class="float-right">Forgot Password?</a>
                            </div> -->
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php';?>
<script src="js/login/login.js"></script>