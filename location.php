<?php

//database connection
include './includes/header.php';


$alerthotels = 'false';
$alertgallery = 'false';
$alertmusic = 'false';
$alertcontact = 'false';
$login = 'false';

//add data
if (isset($_FILES['image'])) {




    //  image add 



    $namee = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp, './img/' . $namee);

    $sql = "UPDATE location SET image='$namee' ";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alerthotels = 'true';
    }
    // copy('../djzarkin/assets/images/' . $name, './img/' . $name);


}









if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $sql6 = "SELECT * FROM user where password= '$password' AND email='$email' ";

        $result6 = mysqli_query($con, $sql6);

        if (mysqli_num_rows($result6) != 1) {
            session_regenerate_id(true);
            $_SESSION['login'] = 'true';
            //  echo " sql error occur: ".mysqli_error();
        } else {

            $temp6 = mysqli_fetch_assoc($result6);
            $_SESSION['username'] = $temp6['username'];

        }

    }

}

if (isset($_POST['del'])) {
    $del = $_POST['del'];
    $sql7 = "DELETE FROM banner where sno= '$del'";
    $result7 = mysqli_query($con, $sql7);
}







$sql4 = "SELECT * FROM location  ";

$result4 = mysqli_query($con, $sql4);

$temp = mysqli_fetch_assoc($result4);
// if(!$result1)
// {
//  echo " sql error occur: ".mysqli_error();
// }

if (isset($_SESSION['username'])) {
    ?>
    <style>
        /* #images {
            display: flex;

            height: 100px;

            margin-top: 10px;

        }

        #inputs {
            border: 1px solid black;
            height: 180px;
            width: 250px;
        } */

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
            if ($alerthotels == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Image updated successful!</strong> 
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
                                <h5 class="mb-4">Change Location Banner</h5>
                                <!-- <a class="btn btn-primary" style='height:35px;' href='locationlist.php'>Location Image</a> -->
                            </div>

                            <form action='location.php' method='post' enctype="multipart/form-data">


                                <div class="row mb-6">
                                    <label for="formFile" class="form-label">Add new image</label>

                                    <input class="form-control bg-dark" name='image' accept='.jpg, .jpeg, .png' id='file'
                                        onchange="preview()" type="file" id="formFile" style=' width:100%;' size="60"
                                        required>

                                    <div id='inputs' style="margin-top:20px;">
                                        <div id='images'>
                                            <p style="margin-top: 55px; margin-left: 40px;">No image selected</p>
                                        </div>
                                    </div> 
                                    <div id='inputs1' style="margin-top:20px;">
                                        <p>Previous Image</p>
                                        <div id='imag'> <img src="./img/<?php echo $temp['image']; ?>" alt=""></div>
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







            <div class="modal fade" id="exampleM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p style="font-size: large; color: black;"> <b> Are you sure?</b></p>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action='banner.php' method='post'>



                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="hidden" name='del' id='delet' class="form-control" />

                            </div>



                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block"
                                style='margin-left:200px; margin-bottom:3px;'>Delete</button>
                        </form>

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