<?php

//database connection
include './includes/header.php';

$sql4 = "SELECT * FROM banner";
$result4 = mysqli_query($con, $sql4);

if (isset($_SESSION['username'])) {
    ?>
    <style>
        #images {
            display: flex;

            height: 100px;

            margin-top: 10px;

        }

        #inputs {
            border: 1px solid black;
            height: 150px;
            overflow: auto;
        }

        #images1 {
            display: flex;
            overflow: auto;
            border: 1px solid black;
            height: 180px;
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


            <!-- content start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div style='display:flex; justify-content: space-between'>
                                <h5 class="mb-4">Add Banner Images</h5>
                                <a class="btn btn-primary" style='height:35px;' href='bannerlist.php'>Back to list</a>
                            </div>

                            <form action='bannerlist.php' method='post' enctype="multipart/form-data">
                                <div class="row mb-6">
                                    <label for="formFile" class="form-label"> Add images</label>
                                    <input class='form-control bg-dark' name='image[]' multiple accept='.jpg, .jpeg, .png'
                                        id='file' onchange='preview()' type='file' id='formFile' style=' width:100%;'
                                        size='60' required>
                                    <div id='inputs'>
                                        <div id='images'>
                                            <p style="margin-top: 35px; margin-left: 400px;">No image selected</p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Add</button>
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