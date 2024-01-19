<?php

//database connection
include './includes/header.php';

$alertofone = 'false';
$alerthotels = 'false';
$alertgallery = 'false';
$alertmusic = 'false';
$alertcontact = 'false';
$login = 'false';

  

//add data
if (isset($_FILES['image'])) {


    $name = $_POST['name'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $description = $_POST['description'];
    $phoneNo = $_POST['phoneNo'];
    $email = $_POST['email'];
    $gmap = $_POST['gmap'];


    $sql2 = "INSERT INTO hotels  (name, state, district, description, phoneNo, email, gmap)  value ('$name', '$state', '$district', '$description', '$phoneNo', '$email', '$gmap') ";

    $result2 = mysqli_query($con, $sql2);
    $id = $con->insert_id;
    if (!$result2) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alerthotels = 'true';
    }


    $c = count($_FILES['image']['name']);

    for ($i = 0; $i < $c; $i++) {
        $namee = $_FILES['image']['name'][$i];
        $temp = $_FILES['image']['tmp_name'][$i];

        move_uploaded_file($temp, './img/' . $namee);
        $sql = "INSERT INTO imagehotel (images, id) value ('$namee', '$id')";
        $result = mysqli_query($con, $sql);

    }

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
    $k = $_POST['edit'];
    $sql4 = "SELECT * from imagehotel where id='$k'";
    $result4 = mysqli_query($con, $sql4);
    $count = mysqli_num_rows($result4);

    if ($count != 1) {
        $sql7 = "DELETE FROM imagehotel where sno= '$del'";
        $result7 = mysqli_query($con, $sql7);

    } else {
        $alertofone = 'true';
    }
}



if (isset($_POST['edit'])) {
    $_SESSION['edit'] = $_POST['edit'];
    $k = $_POST['edit'];
    $sql3 = "SELECT * from hotels where sno='$k'";

    $result3 = mysqli_query($con, $sql3);
    $temp3 = mysqli_fetch_assoc($result3);

    $sql4 = "SELECT * from imagehotel where id='$k'";
    $result4 = mysqli_query($con, $sql4);
    $count = mysqli_num_rows($result4);
} else {

    $k = $_SESSION['edit'];
    $sql3 = "SELECT * from hotels where sno='$k'";

    $result3 = mysqli_query($con, $sql3);
    $temp3 = mysqli_fetch_assoc($result3);

    $sql4 = "SELECT * from imagehotel where id='$k'";
    $result4 = mysqli_query($con, $sql4);
    $count = mysqli_num_rows($result4);
}
// if(!$result1)
// {
//  echo " sql error occur: ".mysqli_error();
// }
if (isset($_SESSION['edit'])) {
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

            img {
                width: 80px;
                height: 80px;
                margin-left: 40px;
                margin-top: 10px;
                margin-bottom: 10px;
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
                if ($alertofone == 'true') {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Oops...🙂 Atleast one image is required</strong> 
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
                                    <h5 class="mb-4">Edit Hotel</h5>
                                    <a class="btn btn-primary" style='height:35px;' href='listhotel.php'>Hotel List</a>
                                </div>

                                <form action='listhotel.php' method='post' enctype="multipart/form-data" id='form' onsubmit="return valid()">
                                    <!-- <input type="hidden" id='req' name='req' value='<?php echo $count; ?>'> -->
                                    <input type="hidden" name="edit" value=<?php echo $_SESSION['edit']; ?>>
                                    <div class="row mb-6">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Hotel Name</label>
                                        <div>
                                            <input type="text" name='name' class="form-control" id="inputEmail3"
                                                value='<?php echo $temp3['name']; ?>' required>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row mb-6">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">State</label>:
                                        <?php echo $temp3['state']; ?>
                                        <div class="select-dropdown">
                                            <select name="state" id="state" class="form-control" required>
                                                <option value="">Select State</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jharkhand" selected>Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha">Odisha</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                                <!-- Add options for other states here -->
                                            </select>
                                        </div>
                                    </div>

                                    <br>


                                    <div class="row mb-6">
                                        <label for="formfile" class="col-sm-2 col-form-label">District</label>:
                                       
                                        <div>
                                            <select name="district" id="city" class="form-control" required></select>
                                            <option value=" <?php echo $temp3['district']; ?>" selected> <?php echo $temp3['district']; ?></option>
                                        </div>
                                    </div>

                                    <br>

                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                                    <textarea id='content' name="description" rows="5" cols="8"
                                        required><?php echo $temp3['description']; ?></textarea>

                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>

                                    <br>

                                    <div class="row mb-6">
                                        <label for="formFile" class="form-label"> Add images for Gallery</label>


                                        <input class='form-control bg-dark' name='image[]' multiple accept='.jpg, .jpeg, .png'
                                            id='file' onchange='preview()' type='file' id='formFile' style=' width:1000px;'
                                            size='60' />
                                        <div id='inputs'>
                                            <div id='images'>
                                                <p style="margin-top: 35px; margin-left: 400px;">No image selected</p>
                                            </div>
                                        </div>
                                        <p style="margin-top: 10px;">Previous images</p>
                                        <div id='images1'>
                                            <?php
                                            $i = 1;
                                            while ($temp4 = mysqli_fetch_assoc($result4)) {

                                                echo "<div>
                                               <img src='./img/" . $temp4['images'] . "' alt='' >
                                                  <p>
                                                
                                                  <button value='" . $temp4['sno'] . "'  class='btn btn-primary' style='margin-left:50px;   text-align: center; font-size: 5px;  ' data-bs-toggle='modal' data-bs-target='#exampleM' onclick='mFunction(this)'>delete</button></p>
                                                    </div>";
                                                $i++;
                                            }
                                            ?>
                                        </div>

                                    </div>

                                    <br>

                                    <div class="row mb-6">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Discount Offer in %</label>
                                        <div>
                                            <input type="text" name='offer' class="form-control" maxlength="3" onkeypress="return regex(event)" id="offer" onkeyup="offerr()"
                                                value='<?php echo $temp3['offer']; ?>' required>
                                                <span id='textt'></span>
                                            </div>
                                    </div>
                                    <br>

                                    <div class="row mb-6">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Whatsapp Number</label>
                                        <div>
                                            <input type="text" name='whatsapp' class="form-control" maxlength="10" onkeypress="return regex(event)" id="inputEmail3"
                                                 required value='<?php echo $temp3['whatsapp']; ?>'>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row mb-6">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div>
                                            <input type="text" name='phoneNo' class="form-control" id="inputEmail3"
                                            maxlength="10" onkeypress="return regex(event)" required value='<?php echo $temp3['phoneNo']; ?>'>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row mb-6">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                        <div>
                                            <input type="text" name='email' class="form-control" id="email" required
                                                value='<?php echo $temp3['email']; ?>'>
                                                <span id='text'></span>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row mb-6">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Google map Link</label>
                                        <div>
                                            <input type="text" name='gmap' class="form-control" id="inputEmail3" required
                                                value='<?php echo $temp3['gmap']; ?>'>
                                        </div>
                                    </div>
                                    <br>

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>




                <div class="modal fade" id="exampleM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content p-4">
                        <div class="modal-header p-0">
                            <p style="font-size: large; color: black;"> <b>Are you sure you want to delete this item?</b>
                            </p>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action='edithotel.php' method='post'>


                                <input type="hidden" name="edit" value=<?php echo $_SESSION['edit']; ?>>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="hidden" name='del' id='delet' class="form-control" />

                                </div>



                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block">Yes, Delete !!</button>
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
} else {
    header("Location: ./index.php");

    exit;
}
?>