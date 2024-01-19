<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$alerthotels = 'false';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['title'])) {

        $title = $_POST['title'];
        $about = $_POST['about'];


        $sql2 = "UPDATE homeabout SET title=\"$title\",  about=\"$about\" where sno=1 ";
        $result2 = mysqli_query($con, $sql2);

        if (!$result2) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alerthotels = 'true';
        }
    }


}


// //images location in form
$sql1 = "SELECT * from homeabout ";

$result1 = mysqli_query($con, $sql1);
$temp1 = mysqli_fetch_assoc($result1);

if (!$result1) {
    echo " sql error occur: " . mysqli_error();
}

if (isset($_SESSION['username'])) {
    ?>


    <style>
        table {
            border: 1px solid black;
            width: 1000px;
            margin-top: 30px;
        }

        th {
            border: 1px solid black;
            height: 30px;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 10px;

        }

        td {
            border: 1px solid black;
            max-width: 900px;
            height: 100px;
            padding-left: 10px;
            overflow: auto;
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
            if ($alerthotels == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>About information changed successful!</strong> 
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
                            <div id="content" class="main-content">
                                <div class="layout-px-spacing">
                                    <div style='display:flex; justify-content: space-between'>
                                        <h5 class="mb-4">About Section Contents</h5>
                                        <a class="btn btn-primary" style='height:35px;' href='about.php'>
                                            Change Content
                                        </a>
                                    </div>

                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6 table-responsive-xl">

                                                <table class="table">
                                                    <tr>
                                                        <th><b>Title:</b></th>
                                                        <th><b>About:</b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php echo $temp1['title'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $temp1['about'] ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

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