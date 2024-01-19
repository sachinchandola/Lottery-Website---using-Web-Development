<?php include_once('includes/header.php');
 
$alertofone = 'false';
$alerthotels = 'false';
$alertgallery = 'false';
$alertmusic = 'false';
$alertcontact = 'false';
$login = 'false';
$sqlStates = "SELECT * FROM state";

if (isset($_GET['uid'])) {
    
    $id = $_GET['uid'];
    if ($_GET['type'] == 'edit') {
        $getdata = mysqli_query($con, "SELECT * FROM `hotels` WHERE `sno`=$id");
        $res_data = mysqli_fetch_array($getdata);

        if (isset($_POST['add'])) {

            $name = $_POST['name'];
            $description = $_POST['description'];
            $state = $_POST['state'];
            $district = $_POST['district'];
            $offer = $_POST['offer'];
            $whatsapp = $_POST['whatsapp'];
            $phoneNo = $_POST['phoneNo'];
            $email = $_POST['email'];
            $gmap = $_POST['gmap'];

            $sql = "UPDATE hotels SET `name`='$name', `description`='$description', `state`='$state', `district`='$district', `phoneNo`='$phoneNo', `email`='$email', `gmap`='$gmap', `whatsapp`='$whatsapp', `offer`='$offer'  WHERE `sno`=$id";

            if ($con->query($sql) === TRUE) {

                $c = count($_FILES['images']['name']);
                for ($i = 0; $i < $c; $i++) {
                    $namee = $_FILES['images']['name'][$i];
                    $temp = $_FILES['images']['tmp_name'][$i];
                    if (!empty($namee) && !empty($temp)) {
                        move_uploaded_file($temp, './img/' . $namee);
                        $sql = "INSERT INTO imagehotel (images, id) value ('$namee', '$id')";
                        $result = mysqli_query($con, $sql);
                    }
                }

                echo "<script>window.location.href='listhotel.php'</script>";
                exit();
            } else {
                echo "Error updating record: " . $con->error;
            }

            $con->close();
        }
    } else if ($_GET['type'] == 'delete') {

        mysqli_query($con, "DELETE FROM `hotels`  WHERE sno =$id");
        mysqli_query($con, "DELETE FROM `imagehotel`  WHERE id =$id");

        echo "<script>window.location.href='listhotel.php?alertdelete=true'</script>";
        exit();
    }
} else {
    // this is for add pages
    if (isset($_POST['add'])) {
        
        $name = $_POST['name'];
        $description = $_POST['description'];
        $state = $_POST['state'];
        $district = $_POST['district'];
        $offer = $_POST['offer'];
        $whatsapp = $_POST['whatsapp'];
        $phoneNo = $_POST['phoneNo'];
        $email = $_POST['email'];
        $gmap = $_POST['gmap'];
        // insert pages
        $page_sql = "INSERT INTO hotels (`name`, `description`, `state`, `district`, `offer`, `whatsapp`, `phoneNo`, `email`, `gmap` )
            VALUES ('$name', '$description', '$state', '$district', '$offer', '$whatsapp', '$phoneNo', '$email', '$gmap' )";

        if ($con->query($page_sql) === TRUE) {

            $last_inserted_id = $con->insert_id;

            $c = count($_FILES['images']['name']);
            for ($i = 0; $i < $c; $i++) {
                $namee = $_FILES['images']['name'][$i];
                $temp = $_FILES['images']['tmp_name'][$i];
                if (!empty($namee) && !empty($temp)) {
                    move_uploaded_file($temp, './img/' . $namee);
                    $sql = "INSERT INTO imagehotel (images, id) value ('$namee', '$last_inserted_id')";
                    $result = mysqli_query($con, $sql);
                }
            }

            echo "<script>window.location.href='listhotel.php'</script>";
            exit();
        } else {
            echo "<script>alert('Something went wrong...');</script>";
        }

        $con->close();
    }
}

if(isset($_POST['img_delete'])){
    $hotel_id = $_POST['hotel_id'];
    $img_id = $_POST['img_id'];
    // delete image
    mysqli_query($con, "DELETE FROM `imagehotel`  WHERE `sno` =$img_id");
    echo "<script>window.location.href='edithotel.php?type=edit&uid=' + hotel_id</script>";
}
?>


<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <?php include './includes/sidebar.php'; ?>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <?php include './includes/navbar.php'; ?>
     
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <div style='display:flex; justify-content: space-between'>
                            <h5 class="mb-4">Hotel</h5>
                            <a class="btn btn-primary" style='height:35px;' href='listhotel'>Hotel List</a>
                        </div>

                        <form method='post' enctype="multipart/form-data" id='form' onsubmit="return valid()">
                            <div class="row mb-6">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Hotel Name</label>
                                <div>
                                    <input type="text" name='name' class="form-control" id="name" value="<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $res_data['name'] : ""; ?>">
                                </div>
                            </div>
                            <br>

                            <div class="row mb-6">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">State</label>
                                <input type="hidden" class="form-control" id="district" value="<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $res_data['district'] : ""; ?>">

                                <select class="form-control" name="state" id="state">
                                    <option value="">Select state...</option>
                                    <?php
                                    $sqlStates = "SELECT * FROM states";
                                    $resultStates = $con->query($sqlStates);

                                    while ($row = $resultStates->fetch_assoc()) {
                                        if ($row['id'] == $res_data['state']) {

                                            echo "<option value='" . $row['id'] . "' Selected>" . $row['state_name'] . "</option>";
                                        } else {
                                            echo "<option value='" . $row['id'] . "'>" . $row['state_name'] . "</option>";
                                        }
                                    }


                                    ?>

                                </select>
                            </div>

                            <br>
                            <div class="row mb-6">
                                <label for="formfile" class="col-sm-2 col-form-label">District</label>
                                <select class="form-control" id="districtSelect" name="district">

                                </select>

                            </div>
                            <br>

                            <div class="row mb-6">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                                <div>
                                    <textarea id='content' name="description" rows="5" cols="8"><?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $res_data['description'] : ""; ?></textarea>
                                </div>
                                <script>
                                    CKEDITOR.replace('content');
                                </script>

                                <br>
                            </div>
                            <br>


                            <div class="row mb-6">
                                <label for="formFile" class="form-label"> Add images for Gallery</label>
                                <input class='form-control bg-dark' type="file" name="images[]" id="images" multiple accept='.jpg, .jpeg, .png' style=' width:1000px;' size='60' onchange="previewImages(this);">
                                <br>
                                <div id="image-preview-container">
                                    <div id='images'>
                                       
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET['uid'])) {
                                ?>

                                    <p style="margin-top: 10px;">Previous images</p>
                                    <div id='images1'>
                                        <?php
                                        $sql_image = "SELECT * from `imagehotel` where `id`='{$res_data['sno']}'";
                                        $result_image = mysqli_query($con, $sql_image);

                                        while ($data_image = mysqli_fetch_assoc($result_image)) {

                                        ?>
                                            <div>
                                                <img src='./img/<?php echo $data_image['images'] ?>' alt=''>
                                                <p>
                                                    <button type="button" value='<?php echo $data_image['sno'] ?>' class='btn btn-primary' style='margin-left:50px; text-align: center; font-size: 5px;' data-bs-toggle='modal' data-bs-target='#exampleM' onclick='imgDeleteFunction(this)'>Delete</button>
                                                </p>
                                            </div>

                                            

                                        <?php
                                        }
                                        ?>
                                      
                                    </div>
                                <?php
                                }
                                ?>

                            </div>



                            <br>

                            <div class="row mb-6">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Discount Offer in %</label>
                                <div>
                                    <input type="text" name='offer' class="form-control" maxlength="2" value="<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $res_data['offer'] : ""; ?>">
                                    <span id='textt'></span>
                                </div>
                            </div>
                            <br>

                            <div class="row mb-6">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Whatsapp Number</label>
                                <div>
                                    <input type="text" name='whatsapp' class="form-control" maxlength="10" value="<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $res_data['whatsapp'] : ""; ?>">
                                </div>
                            </div>
                            <br>
                            <div class="row mb-6">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                                <div>
                                    <input type="text" name='phoneNo' class="form-control" id="inputEmail3" maxlength="10" value="<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $res_data['phoneNo'] : ""; ?>">
                                </div>
                            </div>
                            <br>

                            <div class="row mb-6">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div>
                                    <input type="email" name='email' class="form-control" id="email" value="<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $res_data['email'] : ""; ?>">
                                    <span id='text'></span>
                                </div>
                            </div>
                            <br>
 
                            <div class="row mb-6">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Google map Link</label>
                                <div>
                                    <input type="text" name='gmap' class="form-control" id="inputEmail3" value="<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $res_data['gmap'] : ""; ?>">
                                </div>
                            </div>
                            <br>

                            <button type="submit" name="add" class="btn btn-primary btnsubPage">Save</button>
                        </form>

                    </div>
                </div>
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
            <form method='post'>
                <div class="form-outline mb-4">
                    <input type="hidden" name='hotel_id' id='hotel_id' class="form-control" value="<?php echo $_GET['uid']; ?>"/>
                    <input type="hidden" name='img_id' id='img_id' class="form-control" value=""/>
                </div>
                <button type="submit" name="img_delete" class="btn btn-primary btn-block">Yes, Delete !!</button>
            </form>

        </div>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>

<script>
    $(document).ready(function() {
        $("#state").change(function() {
            $("#districtSelect").html('');
            var state = $("#state").val();
            var district = $("#district").val();
            $.ajax({
                type: "GET",
                url: "get_districts.php",
                data: {
                    "state": state,
                    "district": district
                },
                success: function(result) {
                    // alert(result);
                    $("#districtSelect").html(result)

                }
            });
        });
        //by default get state wise district
        $(document).ready(function() {
            $("#districtSelect").html('');
            var state = $("#state").val();
            var district = $("#district").val();
            $.ajax({
                type: "GET",
                url: "get_districts.php",
                data: {
                    "state": state,
                    "district": district
                },
                success: function(result) {
                    // alert(result);
                    $("#districtSelect").html(result)

                }
            });
        });
    });
</script>
<script>
    function previewImages(input) {
        var previewContainer = document.getElementById('image-preview-container');

        var files = input.files;

        for (var i = 0; i < files.length; i++) {
            var preview = document.createElement('img');
            preview.className = 'image-preview';
            preview.style.maxWidth = '100px';
            preview.style.maxHeight = '100px';

            var reader = new FileReader();


            (function(file, preview) {
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(file);

                previewContainer.appendChild(preview);
            })(files[i], preview);
        }
    }
</script>


<script>
    $(document).ready(function() {
        $(".btnsubPage").click(function() {

            $("#pageFrm").submit();
        });
    });
</script>
<script>
    function imgDeleteFunction(element) {
        document.getElementById("img_id").value = element.value;
    }
</script>