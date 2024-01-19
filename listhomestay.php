<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$alerthotels = 'false';
$alertupdate = 'false';
$alertdelete = 'false';
$alertabout = 'false';
$alertgallery = 'false';
$alertmusic = 'false';
$alertcontact = 'false';
$login = 'false';

$query = "SELECT * FROM `homestays`;";
$result = mysqli_query($con, $query);

//add data 
//changing images

if (isset($_SESSION['username'])) {
    ?>

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>


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
            <!-- Navbar End -->




            <?php
            if ($alertdelete == 'true') {
                ?>
                <div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial'>
                    <strong>Homestays information deleted successful!</strong>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
                    </button>
                </div>
                <?php
            }
            ?>
            <?php

            if ($alertupdate == 'true') {
                ?>

                <div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial'>
                    <strong>Homestays information updated successful!</strong>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
                    </button>
                </div>
                <?php
            } ?>
            <?php
            if ($alerthotels == 'true') {
                ?>
                <div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial'>
                    <strong>Homestays information added successful!</strong>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
                    </button>
                </div>
                <?php
            } ?>


            <!-- content start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div id="content" class="main-content">
                                <div class="layout-px-spacing">
                                    <div style='display:flex; justify-content: space-between'>
                                        <h5 class="mb-4">Homestay List</h5>
                                        <a class="btn btn-primary" style='height:35px;' href='edithomestay.php'>
                                            Add New homestay</a>
                                    </div>

                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6">


                                                <table id="myTable" class="table dt-table-hover mt-3 table_cont"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N.</th>
                                                            <th>Homestay Name</th>
                                                            <th>Details</th>
                                                            <!-- <th>Image</th> -->
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result) > 0) {
                                                            $count = 1;
                                                            while ($data = mysqli_fetch_assoc($result)) {


                                                                ?>


                                                                <tr>

                                                                    <td>
                                                                        <?php echo $count ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $data['name'] ?>
                                                                    </td>

                                                                    <?php
                                                                    $query_state = "SELECT state_name FROM `states` WHERE id= $data[state]";
                                                                    $result_state = mysqli_query($con, $query_state);
                                                                    if ($result_state) {
                                                                        $row = mysqli_fetch_assoc($result_state);
                                                                        $state_name = $row['state_name'];

                                                                    }
                                                                    $query_district = "SELECT district_name FROM `districts` WHERE id= $data[district]";
                                                                    $result_district = mysqli_query($con, $query_district);
                                                                    if ($result_district) {
                                                                        $row = mysqli_fetch_assoc($result_district);
                                                                        $district_name = $row['district_name'];

                                                                    }



                                                                    ?>

                                                                    <td>State:
                                                                        <?php echo $state_name ?><br>District:
                                                                        <?php echo $district_name ?><br>Phone Number:
                                                                        <?php echo $data['phoneNo'] ?><br>Whatsapp Number:
                                                                        <?php echo $data['whatsapp'] ?><br>Offer:
                                                                        <?php echo $data['offer'] ?><br>Email:
                                                                        <?php echo $data['email'] ?>
                                                                    </td>
                                                                    <!-- <td > <img src='./img/<?php echo $data['image'] ?>' alt='' height='60' width='60'></td> -->
                                                                    <td>
                                                                        <div style='display:flex;'>

                                                                            <a href='edithomestay.php?type=edit&uid=<?php echo $data['sno'] ?>'
                                                                                class='btn btn-primary'><svg width='1.5em'
                                                                                    height='1.5em' viewBox='0 0 24 24'
                                                                                    xmlns='http://www.w3.org/2000/svg'>
                                                                                    <path
                                                                                        d='M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z'>
                                                                                    </path>
                                                                                </svg></a>
                                                                            <a class='btn btn-primary' style='margin-left: 5px'
                                                                                data-bs-toggle='modal'
                                                                                data-bs-target='#deleteModal<?php echo $data['sno'] ?>'><svg
                                                                                    width='1.5em' height='1.5em' viewBox='0 0 24 24'
                                                                                    fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                                                    <path
                                                                                        d='M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z'
                                                                                        fill='#0D0D0D'></path>
                                                                                </svg></a>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                                <div class="modal fade" id="deleteModal<?php echo $data['sno'] ?>"
                                                                    tabindex="-1" aria-labelledby="deleteModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content p-4">
                                                                            <div class="modal-header p-0">
                                                                                <p style="font-size: large; color: black;"> <b>Are
                                                                                        you sure you want to delete this item?</b>
                                                                                </p>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>

                                                                            <div class="modal-footer border-0">

                                                                                <a class="btn btn-primary"
                                                                                    href='edithomestay.php?type=delete&uid=<?php echo $data['sno'] ?>'>Yes,
                                                                                    Delete !!</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                $count++;
                                                            }
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



            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-4">
                        <div class="modal-header p-0">
                            <p style="font-size: large; color: black;"> <b>Are you sure you want to delete this item?</b>
                            </p>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <button type="button" class="btn btn-primary"
                            onclick="deleteItem('<?php echo $data['sno']; ?>')">Yes, Delete !!</button>

                    </div>
                </div>
            </div>



            <?php
} else {

    // Redirect browser
    header("Location: ./signin.php");

    exit;
}
?>