<?php

//database connection
include './includes/config.php';


$alerthotels = 'false';
$alertgallery = 'false';
$alertmusic = 'false';
$alertcontact = 'false';
$login = 'false';

if (isset($_GET['uid'])) {
    $id = $_GET['uid'];
    if ($_GET['type'] == 'edit') {

        $sql3 = "SELECT * from testimonial where sno='$id'";

        $result3 = mysqli_query($con, $sql3);
        $temp3 = mysqli_fetch_assoc($result3);

        if (isset($_POST['add'])) {
            $id = $_POST['edit'];
            $name = $_POST['user'];
            $message = $_POST['message'];
            $status = $_POST['page_status'];

            $sql2 = "UPDATE  testimonial SET username='$name', message='$message', status='$status' Where sno='$id'";


            $result8 = mysqli_query($con, $sql2);


            if (!$result8) {
                echo " sql error occur: " . mysqli_error();
            } else {
                $alertupdate = 'true';
                echo "<script>window.location.href='listtestimonial.php'</script>";
            }
        }

    }

} else {

    if (isset($_POST['add'])) {
        $message = $_POST['message'];
        $user = $_POST['user'];
        $status = $_POST['page_status'];

        $sql6 = "INSERT INTO testimonial (username, message, status) value ('$user', '$message', '$status')";

        $result6 = mysqli_query($con, $sql6);

        if (!$result6) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alerttest = 'true';
            echo "<script>window.location.href='listtestimonial.php'</script>";
        }

    }


}

if (isset($_SESSION['username'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>DarkPan - Bootstrap 5 Admin Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
            rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


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
  <strong>Restaurants information added successful!</strong> 
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
                                    <h5 class="mb-4">Testimonial</h5>
                                    <a class="btn btn-primary" style='height:35px;' href='listtestimonial.php'>Testimonials
                                        List</a>
                                </div>

                                <form method='post'>
                                    <!-- <input type="hidden" id='req' name='req' value='<?php echo $count; ?>'> -->
                                    <input type="hidden" name="edit" value=<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $temp3['sno'] : ''; ?>>


                                    <div class="row mb-6">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">User Name</label>
                                        <div>
                                            <input type="text" name='user' class="form-control" id="inputEmail3"
                                                value='<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $temp3['username'] : ''; ?>'
                                                required>
                                        </div>
                                    </div>

                                    <br>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Message</label>
                                    <textarea id='content' name="message" rows="5" cols="8"
                                        required><?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $temp3['message'] : ''; ?></textarea>

                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>

                                    <br>

                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type'] == "edit") { ?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if ($temp3['status'] == 'Y') {
                                                echo 'checked="checked"';
                                            } ?>>
                                            <input type="hidden" id="page_status" name="page_status"
                                                value="<?php echo $temp3['status']; ?>">
                                        <?php } else { ?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="page_status" name="page_status" value="Y">
                                        <?php } ?>
                                    </div>
                                    <br>


                                    <button type="submit" name='add' class="btn btn-primary">Save</button>
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