<?php
 
//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$alertphone = 'false';
$alertaddress = 'false';
$alertemail = 'false';
$alerttwitter = 'false';
$alertinstagram = 'false';
$alertfacebook = 'false';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if (isset($_POST['phoneNo'])) {
        $var = $_POST['phoneNo'];

        $sql6 = "UPDATE contact SET phoneNo='$var' where sno=1";

        $result6 = mysqli_query($con, $sql6);

        if (!$result6) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alertphone = 'true';
        }

    }


    // if (isset($_POST['address'])) {
    //     $var = $_POST['address'];

    //     $sql6 = "UPDATE contact SET address='$var' where sno=1";

    //     $result6 = mysqli_query($con, $sql6);

    //     if (!$result6) {
    //         echo " sql error occur: " . mysqli_error();
    //     } else {
    //         $alertaddress = 'true';
    //     }

    // }


    if (isset($_POST['email'])) {
        $var = $_POST['email'];

        $sql6 = "UPDATE contact SET email='$var' where sno=1";

        $result6 = mysqli_query($con, $sql6);

        if (!$result6) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alertemail = 'true';
        }

    }


    if (isset($_POST['instagram'])) {
        $var = $_POST['instagram'];

        $sql6 = "UPDATE contact SET instagram='$var' where sno=1";

        $result6 = mysqli_query($con, $sql6);

        if (!$result6) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alertinstagram = 'true';
        }

    }


    if (isset($_POST['facebook'])) {
        $var = $_POST['facebook'];

        $sql6 = "UPDATE contact SET facebook='$var' where sno=1";

        $result6 = mysqli_query($con, $sql6);

        if (!$result6) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alertfacebook = 'true';
        }

    }


    if (isset($_POST['twitter'])) {
        $var = $_POST['twitter'];

        $sql6 = "UPDATE contact SET twitter='$var' where sno=1";

        $result6 = mysqli_query($con, $sql6);

        if (!$result6) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alerttwitter = 'true';
        }

    }



}


$sql1 = "SELECT * from contact ";

$result1 = mysqli_query($con, $sql1);
$temp1 = mysqli_fetch_assoc($result1);

if (!$result1) {
    echo " sql error occur: " . mysqli_error();
}


if (isset($_SESSION['username'])) {
    ?>

    <style>
        #images {
            display: flex;
            overflow: auto;
            height: 100px;

            margin-top: 10px;

        }

        #inputs {
            border: 1px solid black;
            height: 180px;
        }

        img {
            width: 80px;
            height: 80px;
            margin-left: 10px;
            margin-top: 10px;
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
            if ($alertphone == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Phone number changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alertemail == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Email changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alertaddress == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Address changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alertfacebook == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Facebook link changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alerttwitter == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Twitter link changed successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($alertinstagram == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Instagram link changed successful!</strong> 
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
                                <h5 class="mb-4">Edit Contact</h5>
                                <a class="btn btn-primary" style='height:35px;' href='listcontact.php'>Contact
                                    Information</a>
                            </div>

                            <!-- <form action='addcontact.php' method='post'>


                                <div class="row mb-6">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Full address</label>
                                    <div>
                                        <input type="text" name='address' class="form-control" id="inputEmail3"
                                            value="<?php echo $temp1['address'] ?>" required>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>

                            <br> -->
                            <form action='addcontact.php' method='post'>
                                <div class="row mb-6">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div>
                                        <input type="text" name='phoneNo' value='<?php echo $temp1['phoneNo'] ?>'
                                            class="form-control" id="number" maxlength="10" onkeypress="return regex(event)"
                                            required>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>
                            <br>

                            <form action='addcontact.php'  method='post' id='form' onchange="return valid()">
                                <div class="row mb-6">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div>
                                        <input type="email" name='email' value='<?php echo $temp1['email'] ?>'
                                            class="form-control" id="email"  required>
                                        <span id='text'></span>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary" id='btn'>Change</button>
                            </form>
                            <br>
                            <form action='addcontact.php' method='post'>
                                <div class="row mb-6">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Facebook Link</label>
                                    <div>
                                        <input type="text" name='facebook' value='<?php echo $temp1['facebook'] ?>'
                                            class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>
                            <br>
                            <form action='addcontact.php' method='post'>
                                <div class="row mb-6">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Instagram Link</label>
                                    <div>
                                        <input type="text" name='instagram' value='<?php echo $temp1['instagram'] ?>'
                                            class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>
                            <br>
                            <form action='addcontact.php' method='post'>
                                <div class="row mb-6">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Twitter</label>
                                    <div>
                                        <input type="text" name='twitter' value='<?php echo $temp1['twitter'] ?>'
                                            class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>





            <!-- Footer Start -->
            <?php include './includes/footer.php'; ?>
            <!-- Footer End -->
            <script>

                function regex(e) {
                    var x = e.which || e.keycode;
                    if ((x >= 48 && x <= 57))
                        return true;
                    else
                        return false;
                }
            </script>

            <script>
                function valid() {
                    var form = document.getElementById("form");
                    var email = document.getElementById("email").value;
                    var text = document.getElementById("text");
                    // var btn = document.getElementById("btn");
                    // btn.preventDefault();
                    var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

                    if (email.match(pattern)) {
                        form.classList.add("valid");
                        form.classList.remove("invalid");
                        text.innerHTML = "Your Email Address is Valid.";
                        text.style.color = "#00ff00";
                    } else {
                        form.classList.remove("valid");
                        form.classList.add("invalid");
                        text.innerHTML = "Please Enter Valid Email Address.";
                        text.style.color = "#ff0000";
                        return false;
                   
                        if (email == "") {
                        form.classList.remove("valid");
                        form.classList.remove("invalid");
                        text.innerHTML = "";
                        text.style.color = "#00ff00";
                    }
                    }
                    
                }
            </script>

            <?php
} else {

    // Redirect browser
    header("Location: ./signin.php");

    exit;

}
?>