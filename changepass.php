<?php

//database connection
include './includes/header.php';

$emaill = 'false';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {

        $email = $_POST['email'];

        $sql1 = "SELECT * FROM user where email='$email' ";

        $result1 = mysqli_query($con, $sql1);

        if (mysqli_num_rows($result1) != 1) {
            $_SESSION['emaill'] = 'true';
            //  echo " sql error occur: ".mysqli_error();
        } else {
            $temp1 = mysqli_fetch_assoc($result1);
            $_SESSION['email'] = $temp1['email'];

        }

    }

    if (isset($_POST['pass1'])) {

        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        if ($pass1 == $pass2) {

            $sql3 = "UPDATE user set password= '$pass1' where sno=1 ";

            $result3 = mysqli_query($con, $sql3);

            if (!$result3) {
                echo " sql error occur: " . mysqli_error();
            }
            $_SESSION['change'] = 'true';
            header("Location: ./signin.php");
            exit;
        } else {
            $_SESSION['pass'] = 'true';
        }


    }


}

if (isset($_SESSION['email'])) {
    ?>


    <?php
    if (isset($_SESSION['pass'])) {

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
<strong>Both password are not same!</strong> 
<a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
</button>
</div>";
    }
    ?>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class=" align-items-center justify-content-between mb-3">
                                <a href="index.php" class="">
                                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>I Am Foodie</h3>
                                </a>
                                <h6>Enter password here</h6>
                            </div>
                            <a href="signin.php">Back</a>
                        </div>
                        <form action="changepass.php" method="post">
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="pass" placeholder="Enter Password"
                                    name='pass1' required>
                                <label for="floatingPassword">Enter Password</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="cpass" placeholder="Confirm Password"
                                    name='pass2' required>
                                <label for="floatingPassword">Confirm Password</label>
                            </div>



                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>


 


    <!-- Footer Start -->
    <?php include './includes/footer.php'; ?>
    <!-- Footer End -->


    <?php
} else {
    // Redirect browser
    header("Location: ./forgotpass.php");

    exit;
}
?>