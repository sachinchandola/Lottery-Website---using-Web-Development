<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$member = 'false';
$business = 'false';


//changing images
if (isset($_POST['member'])) {
    $var = $_POST['member'];

    $sql6 = "UPDATE googleform SET member='$var' where sno=1";

    $result6 = mysqli_query($con, $sql6);

    if (!$result6) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $member = 'true';
    }

}


if (isset($_POST['business'])) {
    $var = $_POST['business'];

    $sql6 = "UPDATE googleform SET business='$var' where sno=1";

    $result6 = mysqli_query($con, $sql6);

    if (!$result6) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $business = 'true';
    }

}


// //images location in form
$sql1 = "SELECT * from googleform ";

$result1 = mysqli_query($con, $sql1);
$temp1 = mysqli_fetch_assoc($result1);



if (isset($_SESSION['username'])) {
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


        <!-- Sidebar Start -->
        <?php include './includes/sidebar.php'; ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include './includes/navbar.php'; ?>
            <!-- Navbar End -->

            <?php
            if ($member == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Membership google form Changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($business == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Business google form Changed successful!</strong> 
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
                                <h5 class="mb-4">Settings</h5>

                            </div>

                            <div class="setting">

                                <?php include 'includes/settingnav.php'; ?>

                                <div class='contentt'>
                                    <br>
                                    <form action='gform.php' method='post'>
                                        <div class="row mb-6">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Business form</label>
                                            <div>
                                                <input type="text" name='business' value='<?php echo $temp1['business'] ?>'
                                                    class="form-control" id="inputEmail" required>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Change</button>
                                    </form>
                                    <hr>
                                    <br>
                                    <form action='gform.php' method='post'>
                                        <div class="row mb-6">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Membership form</label>
                                            <div>
                                                <input type="text" name='member'
                                                    value='<?php echo $temp1['member'] ?>' class="form-control"
                                                    id="inputEmail3" required>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Change</button>
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