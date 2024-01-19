<?php

//database connection
include './includes/header.php';
unset($_SESSION['edit']);

$alertadd = 'false';
$alertupdate = 'false';
$alertdelete = 'false';



if (isset($_GET['uid'])) {
    $id = $_GET['uid'];
    $sql8 = "DELETE FROM abouts where sno= '$id'";


    $result8 = mysqli_query($con, $sql8);


    if (!$result8) {
        echo " sql error occur: " . mysqli_error();
    } else {
        $alertdelete = 'true';
    }

}




// //images location in form
$sql1 = "SELECT * from abouts ";

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




            <?php
            if ($alertdelete == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>About information deleted successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }

            if ($alertupdate == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>About information updated successful!</strong> 
  <a href='#' class='close' data-dismiss='alert' aria-label='close' onclick='myRemoveFunction()'>&times;</a>
  </button>
</div>";
            }

            if ($alertadd == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='tutorial' >
  <strong>About information added successful!</strong> 
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
                                        <h5 class="mb-4">About Page Contents List</h5>
                                        <a class="btn btn-primary" style='height:35px;' href='editabout.php'>
                                            Add New Content</a>
                                    </div>

                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6">


                                                <table id="myTable" class="table dt-table-hover mt-3 table_cont"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N.</th>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>Image</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sno = 1;
                                                        while ($temp = mysqli_fetch_assoc($result1)) {

                                                            ?>
                                                            <tr>
                                                                        <td style='max-width:200px; overflow:hidden;'><?php echo $sno ?></td>
                                                                        <td style='max-width:200px; overflow:hidden;'><?php echo $temp['title'] ?></td>
                                                                        <td style='max-width:200px; overflow:hidden;' class='long_para'><?php echo $temp['about'] ?></td>
                                                                        <td style='max-width:200px; overflow:hidden;'> <img src='./img/<?php echo $temp['image'] ?>' alt='' height='60' width='60'></td>
                                                                        
                                                                        <?php if($temp['status'] == 'Y'){?>
                                                    <td width="10%"><span class="badge bg-success">Active</span></td>
                                                <?php } else {?>
                                                    <td width="10%"><span class="badge bg-warning">Inactive</span></td>
                                                <?php }?>
                                                                        
                                                                        <td style='max-width:300px; overflow:hidden;'><div style='display:flex;'>
                                                                         
                                                                        
                                                                        <a href='editabout.php?type=edit&uid=<?php echo $temp['sno'] ?>' class='btn btn-primary'><svg width='1.5em' height='1.5em' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                                                        <path d='M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z'></path>
                                                                    </svg></a>
                                                                        
                                                                        
                                                                        <button   class='btn btn-primary'  style=' margin-left:5px;' data-bs-toggle='modal' data-bs-target='#about<?php echo $temp['sno'] ?>'><svg width='1.5em' height='1.5em' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                                        <path d='M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z' fill='#0D0D0D'></path>
                                                                    </svg></button></div>
                                                                        </td>
                                                                    </tr>

                                                                    <?php
                                                            $sno++;

                                                            ?>
                                                            <div class="modal fade" id="about<?php echo $temp['sno'] ?>"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content p-4">
                                                                        <div class="modal-header p-0">
                                                                            <p>
                                                                                <b>Are you sure you want to delete this
                                                                                    item?</b>
                                                                            </p>

                                                                            <button type="button" class="btn-close p-0 m-0"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>

                                                                        <a class="btn btn-primary"
                                                                            href='listabout.php?type=delete&uid=<?php echo $temp['sno'] ?>'>Yes,
                                                                            Delete !!</a>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php

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
            <?php
} else {

    // Redirect browser
    header("Location: ./signin.php");
    exit;
}
?>