<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$alertlogo = 'false';


//changing images
if (isset($_FILES['logo'])) {

    $namee = $_FILES['logo']['name'];
    $temp = $_FILES['logo']['tmp_name'];

    move_uploaded_file($temp, './img/' . $namee);


    $image = $namee;

    $sql2 = "UPDATE logofavi SET logo='$image' where sno=1 ";

    $result2 = mysqli_query($con, $sql2);

    if (!$result2) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alertlogo = 'true';
    }



}


// get data
$sql1 = "SELECT * from logofavi ";
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
            if ($alertlogo == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Logo Changed successful!</strong> 
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
                                    <form action="setting.php" method='post' enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <label for="formFile" class="form-label"
                                                style=" margin-top: 5px; margin-left: 20px;"> Add Logo</label>

                                            <input class="form-control bg-dark" name='logo' accept='.jpg, .jpeg, .png'
                                                id='file' onchange="preview()" type="file" id="formFile"
                                                style=' width:1000px; margin-left: 30px;' size="60" required>
                                            <div id='inputs' style="width:1000px; margin-top: 25px; margin-left: 30px;">
                                                <div id='images'>
                                                    <p style="margin-top: 55px; margin-left: 40px;">No image selected</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div id='inputs1' style=" width:1000px; margin-top:20px; margin-left: 20px;">
                                            <p style='margin-left:20px;'>Previous Logo</p>
                                            <div id='images'> <img src="./img/<?php echo $temp['logo']; ?>" alt=""></div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary"
                                            style='margin-left:20px; margin-bottom: 20px;'>Change</button>
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