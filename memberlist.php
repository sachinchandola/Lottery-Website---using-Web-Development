<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);
 
$alertabout = 'false';
$alertimage = 'false';


//changing images
if (isset($_FILES['image'])) {
    $namee = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp, './img/' . $namee);

    $image = $namee;



    $sql2 = "UPDATE membership SET image='$image' where sno=1 ";

    $result2 = mysqli_query($con, $sql2);

    if (!$result2) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alertimage = 'true';
    }
}








if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['about'])) {


        $about = $_POST['about'];


        $sql2 = "UPDATE membership SET  about='$about' where sno=1 ";

        $result2 = mysqli_query($con, $sql2);

        if (!$result2) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alertabout = 'true';
        }
    }
}



// //images location in form
$sql1 = "SELECT * from membership ";

$result1 = mysqli_query($con, $sql1);
$temp1 = mysqli_fetch_assoc($result1);

if (!$result1) {
    echo " sql error occur: " . mysqli_error();
}

if (isset($_SESSION['username'])) {
    ?>


    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

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
            height: 200px;
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
         if ($alertimage == 'true') {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
<strong>Membership  image changed successful!</strong> 
<a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
</button>
</div>";
        }

        if ($alertabout == 'true') {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
<strong>Membership  about changed successful!</strong> 
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
                                        <h5 class="mb-4">Membership List Content</h5>
                                        <a class="btn btn-primary" style='height:35px;' href='member.php'>
                                            Change Details
                                        </a>
                                    </div>

                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6 table-responsive-xl">

                                                <table class="table">
                                                    <tr>
                                                        <th><b>Image:</b></th>
                                                        <th><b>Details:</b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="./img/<?php echo $temp1['image'] ?>" alt="" style="width: 15vw; height: 15vw; margin: 1rem;">
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