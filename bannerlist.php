<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$alertdelete = 'false';
$alertbanner = 'false';

//add data
if (isset($_FILES['image'])) {

    //  image add 
    $c = count($_FILES['image']['name']);

    for ($i = 0; $i < $c; $i++) {
        $namee = $_FILES['image']['name'][$i];
        $temp = $_FILES['image']['tmp_name'][$i];

        move_uploaded_file($temp, './img/' . $namee);

        $sql = "INSERT INTO banner (image) value ('$namee')";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alertbanner = 'true';
        }

    }

}





if (isset($_GET['uid'])) {

    if (isset($_GET['uid'])) {
        $id = $_GET['uid'];
        $sql8 = "DELETE FROM banner where sno= '$id'";


        $result8 = mysqli_query($con, $sql8);


        if (!$result8) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alertdelete = 'true';
        }

    }

}


// //images location in form
$sql1 = "SELECT * from banner ";
$result1 = mysqli_query($con, $sql1);
if (!$result1) {
    echo " sql error occur: " . mysqli_error();
}


if (isset($_SESSION['username'])) {
    ?>

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->


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
            if ($alertdelete == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
                    <strong>Image deleted successful!</strong> 
                    <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
                    </button>
                    </div>";
            }

            if ($alertbanner == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Images added successful!</strong> 
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
                                        <h5 class="mb-4">Banner Images List</h5>
                                        <a class="btn btn-primary" style='height:35px;' href='banner.php'>Add New
                                            Banner</a>
                                    </div>

                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6">


                                                <table id="myTable" class="table dt-table-hover mt-3 table_cont"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">S.N.</th>
                                                            <th>Image</th>
                                                            <th>Action</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sno = 1;
                                                        while ($temp = mysqli_fetch_assoc($result1)) {


                                                            ?>
                                                            <tr>
                                                                <td style='max-width:200px; overflow:hidden;'>
                                                                    <?php echo $sno ?>
                                                                </td>
                                                                <td style='max-width:200px; overflow:hidden;'>
                                                                    <img src='./img/<?php echo $temp['image'] ?>' alt=''>
                                                                </td>
                                                                <td style='max-width:300px; overflow:hidden;'>
                                                                    <div style='display:flex;'>
                                                                        <button type='submit' value='<?php echo $temp['sno'] ?>'
                                                                            class='btn btn-primary' style=' margin-left:5px;'
                                                                            data-bs-toggle='modal'
                                                                            data-bs-target='#banner<?php echo $temp['sno'] ?>'
                                                                            onclick='Function(this)'><svg width='1.5em'
                                                                                height='1.5em' viewBox='0 0 24 24' fill='none'
                                                                                xmlns='http://www.w3.org/2000/svg'>
                                                                                <path
                                                                                    d='M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z'
                                                                                    fill='#0D0D0D'></path>
                                                                            </svg></button>

                                                                    </div>
                                                                </td>

                                                            </tr>

                                                            <?php
                                                            $sno++;
                                                            ?>
                                                            <div class='modal fade' id='banner<?php echo $temp['sno']; ?>'
                                                                tabindex='-1' aria-labelledby='exampleModalLabel'
                                                                aria-hidden='true'>
                                                                <div class='modal-dialog'>
                                                                    <div class='modal-content p-4'>
                                                                        <div class='modal-header p-0'>
                                                                            <p style='font-size: large; color: black;'> <b>Are
                                                                                    you sure you want to delete this item?</b>
                                                                            </p>
                                                                            <button type='button' class='btn-close'
                                                                                data-bs-dismiss='modal'
                                                                                aria-label='Close'></button>
                                                                        </div>
                                                                        <a class='btn btn-primary'
                                                                            href='bannerlist.php?type=delete&uid=<?php echo $temp['sno']; ?>'>Yes,
                                                                            Delete !!</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
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