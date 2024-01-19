<?php

//database connection
include './includes/header.php';

if (isset($_GET['uid'])) {
    $id = $_GET['uid'];
    if ($_GET['type'] == 'edit') {
        $sql3 = "SELECT * from faq where sno='$id'";

        $result3 = mysqli_query($con, $sql3);
        $temp3 = mysqli_fetch_assoc($result3);


        if (isset($_POST['add'])) {

            $question = $_POST['question'];
            $answer = $_POST['answer'];
            $status = $_POST['page_status'];

            $id = $_POST['edit'];

            $sql2 = "UPDATE  faq SET  question='$question', answer='$answer', status='$status' Where sno='$id'";

            $result2 = mysqli_query($con, $sql2);

            if (!$result2) {
                echo " sql error occur: " . mysqli_error();
            } else {
                $alertupdate = 'true';
                echo "<script>window.location.href='listfaq.php'</script>";
            }

        }
    }
} else {

    if (isset($_POST['add'])) {

        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $status = $_POST['page_status'];


        $sql2 = "INSERT INTO faq  (question, answer, status) value ('$question', '$answer', '$status')";

        $result2 = mysqli_query($con, $sql2);

        if (!$result2) {
            echo " sql error occur: " . mysqli_error();
        } else {
            $alerthotels = 'true';
            echo "<script>window.location.href='listfaq.php'</script>";
        }

    }
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
                                <h5 class="mb-4">FAQ</h5>
                                <a class="btn btn-primary" style='height:35px;' href='listfaq.php'>FAQ List</a>
                            </div>

                            <form method='post'>

                                <input type="hidden" name="edit"
                                    value='<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $temp3['sno'] : ''; ?>'>
                                <div class="row mb-6">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Question</label>
                                    <div>
                                        <input type="text" name='question' class="form-control" id="inputEmail3" required
                                            value='<?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $temp3['question'] : ''; ?>'>
                                    </div>
                                </div>
                                <br>


                                <label for="inputEmail3" class="col-sm-2 col-form-label">Answer</label>
                                <textarea id='content' name="answer" rows="5" cols="8"
                                    required><?php echo isset($_GET['type']) && $_GET['type'] == "edit" ? $temp3['answer'] : ''; ?></textarea>

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