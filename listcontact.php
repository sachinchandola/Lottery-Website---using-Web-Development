<?php
 
//database connection
include './includes/header.php';
unset($_SESSION['edit']);


// //images location in form
$sql1 = "SELECT * from contact ";

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
            width: 450px;

        }

        th {
            border: 1px solid black;
            width: 200px;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 10px;
        }

        td {
            border: 1px solid black;
            overflow: auto;
            padding-left: 10px;
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
                            <div id="content" class="main-content">
                                <div class="layout-px-spacing">
                                    <div style='display:flex; justify-content: space-between'>
                                        <h5 class="mb-4">Contact Information</h5>
                                        <a class="btn btn-primary" style='height:35px;' href='addcontact.php'>Change
                                            Contact</a>
                                    </div>

                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6">




                                                <table style="width:100%;">
                                                    <!-- <tr>
                                                        <th><b>Address :</b></th>
                                                        <td>
                                                            <?php echo $temp1['address'] ?>
                                                        </td>
                                                    </tr> -->
                                                    <tr>
                                                        <th><b>Phone Number :</b></th>
                                                        <td>
                                                            <?php echo $temp1['phoneNo'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Email :</b></th>
                                                        <td>
                                                            <?php echo $temp1['email'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Facebook Link :</b></th>
                                                        <td>
                                                            <?php echo $temp1['facebook'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Instagram Link :</b></th>
                                                        <td>
                                                            <?php echo $temp1['instagram'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><b>Twitter Link :</b></th>
                                                        <td>
                                                            <?php echo $temp1['twitter'] ?>
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