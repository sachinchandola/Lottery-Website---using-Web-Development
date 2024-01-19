<?php
include ('./includes/config.php');



if (isset($_GET['state']) && isset($_GET['district'])) {

    $state_id = $_GET['state'];
    $district_id = $_GET['district'];
    // $state_id=2;
    // $district_id=15;

    $sql = "SELECT * FROM `districts` WHERE `state_id` = $state_id";
    $result = mysqli_query($con, $sql);
     


        if (mysqli_num_rows($result) > 0) {
            $districtOptions = "";
            $districtOptions .= '<option value="">Select District...</option>';
            while ($row = $result->fetch_assoc()) {
                
                if ($row['id'] == $district_id) {

                     
                $districtOptions .= "<option value='" . $row['id'] . "' Selected>" . $row['district_name'] . "</option>";
                } else {
                    
                $districtOptions .= "<option value='" . $row['id'] . "'>" . $row['district_name'] . "</option>";
                    
                }

                // $districtOptions .= "<option value='" . $row['id'] . "'>" . $row['district_name'] . "</option>";
            }
        }
    
    


    $con->close();

    echo $districtOptions;
}

?>
