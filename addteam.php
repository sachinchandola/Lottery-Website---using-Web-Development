<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);



$sql1 = "SELECT * from team ";

$result1 = mysqli_query($con, $sql1);
$temp1 = mysqli_fetch_assoc($result1);

if (!$result1) {
    echo " sql error occur: " . mysqli_error();
}


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



            <!-- content start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div style='display:flex; justify-content: space-between'>
                                <h5 class="mb-4">Change team
 Content</h5>
                                <a class="btn btn-primary" style='height:35px;' href='team.php'>Back to content</a>
                            </div>

                            <form action='team.php' method='post'>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">Content</label>
                                <textarea id='content' name="about" rows="5" cols="8"
                                    required><?php echo $temp1['about']; ?></textarea>

                                <script>
                                    CKEDITOR.replace('content');
                                </script>

                                <br>

                                <button type="submit" class="btn btn-primary">Save</button>
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