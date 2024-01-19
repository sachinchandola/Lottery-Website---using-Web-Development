<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$alertphoto = 'false';
$alertpass = 'false';
$alertemail = 'false';
$alertops = 'false';


//changing images
if (isset($_FILES['photo'])) {

    $namee = $_FILES['photo']['name'];
    $temp = $_FILES['photo']['tmp_name'];

    move_uploaded_file($temp, './img/' . $namee);


    $image = $namee;

    $sql2 = "UPDATE user SET image='$image' where sno=1 ";

    $result2 = mysqli_query($con, $sql2);

    if (!$result2) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alertphoto = 'true';
    }
   
}



if (isset($_POST['email'])) {
    $var = $_POST['email'];

    $sql6 = "UPDATE user SET email='$var' where sno=1";

    $result6 = mysqli_query($con, $sql6);

    if (!$result6) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alertemail = 'true';
    }

}


if (isset($_POST['cpass'])) {
    $var = $_POST['cpass'];
    $varr = $_POST['pass'];

    if ($var == $varr) {
        $sql6 = "UPDATE user SET password='$var' where sno=1";

        $result6 = mysqli_query($con, $sql6);

        if (!$result6) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alertpass = 'true';
        }
    } else {
        $alertops = 'true';
    }

}
// //images location in form
$sql1 = "SELECT * from user ";

$result1 = mysqli_query($con, $sql1);
$temp = mysqli_fetch_assoc($result1);



if (isset($_SESSION['username'])) {
    ?>


    <style>
 

        #inputs1 {
            border: 1px solid black;
            height: auto;
            width: 100%;
            /* margin-left: 100px; */

        }

        #inputs1 p {
            margin-top: 0.5rem;
        }

        #inputs1 img {
            width: 15%;
            height: auto;
            margin-top: 0;
            margin-bottom: 1rem;

            /* margin-left: 35px; */

        }
    </style>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include './includes/sidebar.php'; ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include './includes/navbar.php'; ?>
            <!-- Navbar End -->

            <?php
            if ($alertphoto == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Image changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alertpass == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Password changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alertemail == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Email changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }

            if ($alertops == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Password not matched!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            ?>



            <!-- content start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div style='display:flex; justify-content: space-between'>
                                <h5 class="mb-4">My Account</h5>

                            </div>

                            <div class="setting">



                                <div class='contentt'>
                                    <div class="item-label mb-2" style="margin-left: 50px;"><strong>Photo</strong></div>

                                    <form id="profileFrm" action="account.php" method='post' enctype="multipart/form-data"
                                        class="width100">
                                        <div class="app-card-body px-4 w-100">
                                            <div class="item border-bottom py-3">
                                                <div class="row justify-content-between align-items-center">

                                                    <div class="col-auto">
                                                        <input type="file" name="photo" accept='.jpg, .jpeg, .png'
                                                            style='margin-left:10px;' id="profileImg" required>
                                                    </div>

                                                    <div class="col text-end">

                                                        <div class="item-data">
                                                            <img class="profile-image border-radius30"
                                                                src="./img/<?php echo $temp['image']; ?>" alt="user profile"
                                                                style="margin-right: 500px;">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="app-card-footer p-4 mt-auto">
                                                    <button type="submit" class="btn btn-primary"
                                                        style='margin-left:-18px; margin-bottom: 20px;'>Save</button>
                                                </div>
                                            </div>


                                    </form>

                                    <br>


                                    <i class='fas fa-shield-alt'></i> Security
                                    <br><br>

                                    <form action='account.php' method='post' id='form'>
                                        <div class="row mb-6">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div>
                                                <input type="text" name='email' value='<?php echo $temp['email'] ?>'
                                                    class="form-control" id="email" required onkeyup="onpressemail()">
                                                <span id='emessage'></span>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary" id='btn'>Save</button>
                                    </form>
                                    <br>
                                    <form action='account.php' method='post'>
                                        <div class="row mb-6">
                                            <label for="email" class="col-sm-2 col-form-label">New password</label>
                                            <div>
                                                <input type="text" name='pass' class="form-control" id="pass" required>

                                            </div>
                                            <label for="email" class="col-sm-2 col-form-label">Confirm password</label>
                                            <div>
                                                <input type="text" name='cpass' class="form-control" id="pass" required>

                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary" id='btn'>Save</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>





            <!-- Footer Start -->
            <?php include './includes/footer.php'; ?>
            <!-- Footer End -->



            <?php
} else {

    // Redirect browser
    header("Location: ./signin.php");

    exit;

}
?>