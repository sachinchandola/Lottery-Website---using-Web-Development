<?php
 
session_start();
session_destroy();
include './includes/header.php';
?>
<?php
      if(isset($_SESSION['login'])){
        
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
<strong>Please enter correct password and email!</strong> 
<a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
</button>
</div>";
    }

    if(isset($_SESSION['change'])){
        
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
    <strong>Successfully Reset Password!</strong> 
    <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
    </button>
    </div>";
        }
    ?>

    <div class="container-fluid position-relative d-flex flex-column p-0 signup_cont">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
     
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-4 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <a href="index.php" class="">
                                <img class="logo_img" src="./img/logo.png" alt="">
                            </a>
                            
                        </div>
                        <form action="index.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name='email' required>
                                <label for="floatingInput">Admin email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name='password' required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <a href="forgotpass.php">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100" style="font-weight: 600;">Sign in</button>
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

    

