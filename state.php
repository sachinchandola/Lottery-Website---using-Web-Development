<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$alertupdate = 'false';
$alertdelete = 'false';
$oops = 'false';
$oopss = 'false';


//add data


if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if (isset($_POST['state'])) {
        $state = $_POST['state'];
        $district = $_POST['district'];

        $sql2 = "SELECT * from districts where state_id='$state' and district_name='$district' ";

        $result2 = mysqli_query($con, $sql2);


        if (mysqli_num_rows($result2) == 0) {
            $sql6 = "INSERT INTO districts (district_name, State_id) value ('$district', '$state')";

            $result6 = mysqli_query($con, $sql6);

            if (!$result6) {
                echo " sql error occur: " . mysqli_error();
            } else {
                $alertupdate = 'true';
            }

        } else {
            $oops = true;
        }

    }


    if (isset($_POST['edit'])) {
        $id = $_POST['edit'];
        $district = $_POST['districtt'];

        $sql3 = "UPDATE  districts SET district_name='$district' where id='$id' ";

        $result3 = mysqli_query($con, $sql3);


        if ($result3) {

            $oopss = 'true';
        }

    }


}


if (isset($_GET['type'])) {
    $id = $_GET['uid'];
    $sql8 = "DELETE FROM districts where id= '$id'";


    $result8 = mysqli_query($con, $sql8);


    if (!$result8) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alertdelete = 'true';
    }

}



// //images location in form
$sql1 = "SELECT * from states ";

$result1 = mysqli_query($con, $sql1);


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
            width: 20px;
        }

        td {
            border: 1px solid black;
            max-width: 900px;
            height: 60px;
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
            if ($alertdelete == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>District information deleted successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($oops == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>Already added!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }
            if ($oopss == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>District updated successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }

            if ($alertupdate == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>District added successful!</strong> 
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
                                        <h5 class="mb-4">Settings</h5>

                                    </div>
                                    <?php include 'includes/settingnav.php'; ?>
                                    <div class="row" id="cancel-row">

                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6 table-responsive-xl">
                                                <a class="btn btn-primary"
                                                    style='height:35px; margin-left: 860px; margin-top: 20px;'
                                                    href='addstate.php'>
                                                    Add More</a>
                                                <table class="table">
                                                    <tr>
                                                        <th><b>Sno</b></th>
                                                        <th><b>State</b></th>
                                                        <th><b>District</b></th>

                                                    </tr>
                                                    <?php
                                                    $sno = 1;
                                                    while ($temp1 = mysqli_fetch_assoc($result1)) {
                                                        $id = $temp1['id'];
                                                        $sql3 = "SELECT * from districts where state_id='$id' ";

                                                        $result3 = mysqli_query($con, $sql3);
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $sno; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $temp1['state_name']; ?>
                                                            </td>
                                                            <td>
                                                                <table style="width: 400px; margin-top: 8px;">
                                                                    <?php
                                                                    while ($temp3 = mysqli_fetch_assoc($result3)) {

                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?php echo $temp3['district_name']; ?>
                                                                            </td>
                                                                            <td style="width: 200px;"><button
                                                                                    data-value="<?php echo $temp3['district_name']; ?>"
                                                                                    value='<?php echo $temp3['id']; ?>'
                                                                                    class='btn btn-primary' data-bs-toggle='modal'
                                                                                    data-bs-target='#example'
                                                                                    onclick='stateFunction(this)'><svg width='1.5em'
                                                                                        height='1.5em' viewBox='0 0 24 24'
                                                                                        xmlns='http://www.w3.org/2000/svg'>
                                                                                        <path
                                                                                            d='M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z'>
                                                                                        </path>
                                                                                    </svg></button>
                                                                                    <button   class='btn btn-primary'  style=' margin-left:5px;' data-bs-toggle='modal' data-bs-target='#state<?php echo $temp3['id'] ?>'><svg width='1.5em' height='1.5em' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                                        <path d='M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z' fill='#0D0D0D'></path>
                                                                    </svg></button>
                                                                            </td>
                                                                        </tr>


                                                                        <div class="modal fade" id="state<?php echo $temp3['id'] ?>"
                                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content p-4">
                                                                                    <div class="modal-header p-0">
                                                                                        <p>
                                                                                            <b>Are you sure you want to delete this
                                                                                                item?</b>
                                                                                        </p>

                                                                                        <button type="button"
                                                                                            class="btn-close p-0 m-0"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close"></button>
                                                                                    </div>

                                                                                    <a class="btn btn-primary"
                                                                                        href='state.php?type=delete&uid=<?php echo $temp3['id'] ?>'>Yes,
                                                                                        Delete !!</a>


                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </table>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                        $sno++;
                                                    }

                                                    ?>


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






            <div class="modal fade" id="example" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-4">
                        <div class="modal-header p-0">
                            <p style="font-size: large; color: black;"> <b>Edit district</b>
                            </p>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="state.php" method="post">
                            <!-- Name input -->


                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="hidden" name="edit" id='deletee' class="form-control" />

                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="districtt" id='hidee' class="form-control" required />

                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
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