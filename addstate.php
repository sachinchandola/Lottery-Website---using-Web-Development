<?php
  
//database connection
include './includes/header.php';
unset($_SESSION['edit']);


// //images location in form
$sql1 = "SELECT * from states ";

$result1 = mysqli_query($con, $sql1);


if (!$result1) {
    echo " sql error occur: " . mysqli_error();
}

if (isset($_SESSION['username'])) {
    ?>


    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">




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
                                        <h5 class="mb-4">Add district</h5>
                                        <a class="btn btn-primary" style='height:35px;' href='state.php'>
                                            Back</a>
                                    </div>

                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6">
                                                <form action='state.php' method='post'>

                                                    <div class="row mb-6">
                                                        <label for="inputEmail3"
                                                            class="col-sm-2 col-form-label">State</label>
                                                        <div class="select-dropdown">
                                                            <select name="state" id="state" class="form-control" required>
                                                                <option value="">Select State</option>

                                                                <?php
                                                                while ($temp1 = mysqli_fetch_assoc($result1)) {
                                                                    echo " <option value='" . $temp1['id'] . "'>" . $temp1['state_name'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row mb-6">
                                                        <label for="name" class="col-sm-2 col-form-label">District</label>
                                                        <div>
                                                            <input type="text" name='district' class="form-control"
                                                                id="name" required>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <button type="submit" class="btn btn-primary"
                                                        style='margin-left:20px; margin-bottom: 20px;'>Add</button>
                                                </form>

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