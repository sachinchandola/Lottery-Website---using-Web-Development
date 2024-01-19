<?php
include ('./includes/config.php');

if (isset($_GET['sno'])) {
    $sno = $_GET['sno'];

    // Sanitize the input (to prevent SQL injection)
    $sno = mysqli_real_escape_string($con, $sno);

    // Perform the deletion operation
    $sql = "DELETE FROM imageresort WHERE `sno` = $sno";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Deletion successful
        echo "Item with sno $sno deleted successfully";
    } else {
        // Deletion failed
        echo "Error deleting item: " . mysqli_error($con);
    }
} else {
    // 'sno' parameter not set
    echo "Invalid request";
}

// Close the database connection
mysqli_close($con);
?>
