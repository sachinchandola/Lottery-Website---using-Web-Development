<?php

//database connection
include './includes/header.php';
$alertrestimg = 'false';
$alertresortimg = 'false';
$alerthotelimg = 'false';
$alerthomeimg = 'false';


//add data
if (isset($_FILES['hotelimage'])) {


    $namee = $_FILES['hotelimage']['name'];
    $temp = $_FILES['hotelimage']['tmp_name'];

    move_uploaded_file($temp, './img/' . $namee);

    $sql = "UPDATE banners SET hotelimage='$namee' where sno=1";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alerthotelimg = 'true';
    }



}
if (isset($_FILES['homeimage'])) {


    $namee = $_FILES['homeimage']['name'];
    $temp = $_FILES['homeimage']['tmp_name'];

    move_uploaded_file($temp, './img/' . $namee);

    $sql = "UPDATE banners SET homeimage='$namee' where sno=1";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alerthomeimg = 'true';
    }



}
if (isset($_FILES['resortimage'])) {


    $namee = $_FILES['resortimage']['name'];
    $temp = $_FILES['resortimage']['tmp_name'];

    move_uploaded_file($temp, './img/' . $namee);

    $sql = "UPDATE banners SET resortimage='$namee' where sno=1";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alertresortimg = 'true';
    }



}
if (isset($_FILES['restimage'])) {


    $namee = $_FILES['restimage']['name'];
    $temp = $_FILES['restimage']['tmp_name'];

    move_uploaded_file($temp, './img/' . $namee);

    $sql = "UPDATE banners SET restimage='$namee' where sno=1";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alertrestimg = 'true';
    }



}





$sql4 = "SELECT * FROM banners where sno=1  ";
$result4 = mysqli_query($con, $sql4);
$temp = mysqli_fetch_assoc($result4);


if (isset($_SESSION['username'])) {
    ?>

    <style>
        .inputs1 {
            border: 1px solid black;
            height: auto;
            width: 100%;


        }

        .inputs1 p {
            margin-top: 0.5rem;
        }

        .inputs1 img {
            width: 15%;
            height: auto;
            margin-top: 0;
            margin-bottom: 1rem;


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
            if ($alerthotelimg == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Hotel image updated successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alertrestimg == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Restaurant image Updated successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alerthomeimg == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Homestay image updated successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alertresortimg == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Resort image updated successful!</strong> 
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
                                <h5 class="mb-4">Update Banner Image</h5>
                                <!-- <a class="btn btn-primary" style='height:35px;' href='locationlist.php'>Location Image</a> -->
                            </div>

                            <form action='staybanner.php' method='post' enctype="multipart/form-data">


                                <div class="row mb-6">
                                    <label for="formFile" class="form-label"> Hotel banner image</label>

                                    <input class="form-control bg-dark" name='hotelimage' accept='.jpg, .jpeg, .png'
                                        id='file' onchange="preview()" type="file" style=' width:1000px;' size="60"
                                        required>

                                    <div id='inputs' style="margin-top:20px;">
                                        <div id='images'>
                                            <p style="margin-top: 55px; margin-left: 40px;">No image selected</p>
                                        </div>
                                    </div>
                                    <div class='inputs1' style="margin-top:20px;">
                                        <p style=' width:150px; margin-left:45px;'>Previous Image</p>
                                        <div id='imag'> <img src="./img/<?php echo $temp['hotelimage']; ?>" alt=""></div>
                                    </div>
                                </div>
                                <br>
                                <br>



                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>
                            <br>
                            <hr>

                            <form action='staybanner.php' method='post' enctype="multipart/form-data">


                                <div class="row mb-6">
                                    <label for="formFile" class="form-label"> Resort banner image</label>

                                    <input class="form-control bg-dark" name='resortimage' accept='.jpg, .jpeg, .png'
                                        id='file1' onchange="preview1()" type="file" style=' width:1000px;' size="60"
                                        required>

                                    <div id='inputs' style="margin-top:20px;">
                                        <div id='images4'>
                                            <p style="margin-top: 55px; margin-left: 40px;">No image selected</p>
                                        </div>
                                    </div>
                                    <div class='inputs1' style="margin-top:20px;">
                                        <p style=' width:150px; margin-left:45px;'>Previous Image</p>
                                        <div id='imag'> <img src="./img/<?php echo $temp['resortimage']; ?>" alt=""></div>
                                    </div>
                                </div>
                                <br>
                                <br>



                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>
                            <br>
                            <hr>
                            <form action='staybanner.php' method='post' enctype="multipart/form-data">


                                <div class="row mb-6">
                                    <label for="formFile" class="form-label"> Homestay banner image</label>

                                    <input class="form-control bg-dark" name='homeimage' accept='.jpg, .jpeg, .png'
                                        id='file2' onchange="preview2()" type="file" style=' width:1000px;' size="60"
                                        required>

                                    <div id='inputs' style="margin-top:20px;">
                                        <div id='images2'>
                                            <p style="margin-top: 55px; margin-left: 40px;">No image selected</p>
                                        </div>
                                    </div>
                                    <div class='inputs1' style="margin-top:20px;">
                                        <p style=' width:150px; margin-left:45px;'>Previous Image</p>
                                        <div id='imag'> <img src="./img/<?php echo $temp['homeimage']; ?>" alt=""></div>
                                    </div>
                                </div>
                                <br>
                                <br>



                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>

                            <br>
                            <hr>
                            <form action='staybanner.php' method='post' enctype="multipart/form-data">


                                <div class="row mb-6">
                                    <label for="formFile" class="form-label"> Restaurant banner image</label>

                                    <input class="form-control bg-dark" name='restimage' accept='.jpg, .jpeg, .png'
                                        id='file3' onchange="preview3()" type="file" style=' width:1000px;' size="60"
                                        required>

                                    <div id='inputs' style="margin-top:20px;">
                                        <div id='images3'>
                                            <p style="margin-top: 55px; margin-left: 40px;">No image selected</p>
                                        </div>
                                    </div>
                                    <div class='inputs1' style="margin-top:20px;">
                                        <p style=' width:150px; margin-left:45px;'>Previous Image</p>
                                        <div id='imag'> <img src="./img/<?php echo $temp['restimage']; ?>" alt=""></div>
                                    </div>
                                </div>
                                <br>
                                <br>



                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>
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