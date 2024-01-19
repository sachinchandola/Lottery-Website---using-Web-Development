<?php
include "./includes/config.php";

// today date
$dates = date("Y-m-d");


// form data of last 5 result
if (isset($_POST['check'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];

    // get today result data
    $sqllast = "SELECT * FROM resultlist WHERE dates='$date' and times='$time'";
    $resultlastresult = mysqli_query($con, $sqllast);
    $count = mysqli_num_rows($resultlastresult);
   
    if ($count==0) {
        echo "<script>window.location.href='index?notfound=1'</script>";
        exit();
    }
    $templastresult = mysqli_fetch_assoc($resultlastresult);
    $id = $templastresult['id'];
    if(isset($id)){
        echo "<script>window.location.href='result?LastId=".$id."'</script>";
        exit();
    }
}

$count=0;
// get today result data
$sqlresult = "SELECT * FROM resultlist WHERE dates='$dates'";
$resultticket = mysqli_query($con, $sqlresult);

// get logo banner data
$sqldata = "SELECT * FROM logofavi";
$resultdata = mysqli_query($con, $sqldata);
$tempdata = mysqli_fetch_assoc($resultdata);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./zpanel/<?php echo $tempdata['favicon']; ?>">
    <title><?php echo $tempdata['title']; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="banner">
        <a href="<?= BASE_URL ?>">
            <h1><?php echo $tempdata['title']; ?></h1>
        </a>
        <img src="./zpanel/<?php echo $tempdata['banner']; ?>" alt="">
    </div>

    <div class="lot_heading">
        <img src="./img/lot-heading.png" alt="">
        <h2>Today's Results</h2>
    </div>

    <!--11:15a.m result -->
    <div class="results">
        <?php
        while($tempresult = mysqli_fetch_assoc($resultticket)){
    
        if ($tempresult['publish'] == '1' && $tempresult['times'] == '11:15 AM') {
            $count++;

            $id = $tempresult['id'];
            $sqlticketresult = "SELECT * FROM ticketlist WHERE result_id='$id' AND prize='firstprize'";
            $ticketresult = mysqli_query($con, $sqlticketresult);
            $tempticket = mysqli_fetch_assoc($ticketresult);

            ?>
            <a href="result?id=<?php echo $id; ?>" class="card">
                <div class="left">
                    <h2>27 Lakh</h2>
                    <p>
                        <?php echo $tempticket['ticket']; ?>
                    </p>
                </div>
                <div class="right">
                    <h3>11:15<span>AM</span></h3>
                    <p>RESULT</p>
                    <p>OUT</p>
                </div>
            </a>
            <?php
        }
        } 
        if($count==0) {
            ?>
            <a href='#' onclick="message('11:15 AM')" class="card">
                <div class="left">
                    <h2>27 Lakh</h2>
                    <p></p>
                </div>
                <div class="right">
                    <h3>11:15<span>AM</span></h3>
                    <p>RESULT</p>
                    <p>PENDING</p>
                </div>
            </a>
            <?php
        }
        ?>


        <!-- 03:15pm result -->
        <?php
        $count=0;
        // get today result data
        $sqlresult = "SELECT * FROM resultlist WHERE dates='$dates'";
        $resultticket = mysqli_query($con, $sqlresult);

        while($tempresult = mysqli_fetch_assoc($resultticket)){
        
        if ($tempresult['publish'] == '1' && $tempresult['times'] == '3:15 PM') {
            $count++;
            $id = $tempresult['id'];
            $sqlticketresult = "SELECT * FROM ticketlist WHERE result_id='$id' AND prize='firstprize'";
            $ticketresult = mysqli_query($con, $sqlticketresult);
            $tempticket = mysqli_fetch_assoc($ticketresult);

            ?>
            <a href="result?id=<?php echo $id; ?>" class="card">
                <div class="left">
                    <h2>27 Lakh</h2>
                    <p>
                        <?php echo $tempticket['ticket']; ?>
                    </p>
                </div>
                <div class="right">
                    <h3>3:15<span>PM</span></h3>
                    <p>RESULT</p>
                    <p>OUT</p>
                </div>
            </a>
            <?php
        }
        } 
        if($count==0) {
            ?>
            <a href='#' onclick="message('3:15 PM')" class="card">
                <div class="left">
                    <h2>27 Lakh</h2>
                    <p></p>
                </div>
                <div class="right">
                    <h3>3:15<span>PM</span></h3>
                    <p>RESULT</p>
                    <p>PENDING</p>
                </div>
            </a>
            <?php
        }
        ?>


        <!-- 07:30pm resultt -->
        <?php
        $count=0;
        // get today result data
        $sqlresult = "SELECT * FROM resultlist WHERE dates='$dates'";
        $resultticket = mysqli_query($con, $sqlresult);

        while($tempresult = mysqli_fetch_assoc($resultticket)){
        
        if ($tempresult['publish'] == '1' && $tempresult['times'] == '7:30 PM') {
        $count++;
            $id = $tempresult['id'];
            $sqlticketresult = "SELECT * FROM ticketlist WHERE result_id='$id' AND prize='firstprize'";
            $ticketresult = mysqli_query($con, $sqlticketresult);
            $tempticket = mysqli_fetch_assoc($ticketresult);

            ?>
            <a href="result?id=<?php echo $id; ?>" class="card">
                <div class="left">
                    <h2>27 Lakh</h2>
                    <p>
                        <?php echo $tempticket['ticket']; ?>
                    </p>
                </div>
                <div class="right">
                    <h3>7:30<span>PM</span></h3>
                    <p>RESULT</p>
                    <p>OUT</p>
                </div>
            </a>
            <?php
        }
        } 
        if($count==0) {
            ?>
            <a href='#' onclick="message('7:30 PM')" class="card">
                <div class="left">
                    <h2>27 Lakh</h2>
                    <p></p>
                </div>
                <div class="right">
                    <h3>7:30<span>PM</span></h3>
                    <p>RESULT</p>
                    <p>PENDING</p>
                </div>
            </a>
            <?php
        }
        ?>
    </div>

    <div class="lot_heading">
        <img src="./img/line.png" alt="">
    </div>


    <div class="details">
        <div class="boxed">
            <img src="./img/11am.png" alt="">
            <img src="./img/3pm.png" alt="">
            <img src="./img/7pm.png" alt="">
        </div>

        <div class="desc">
            <h3>See Previous results</h3>

            <form method="post">
                <div class="box">
                    <label for="date">Select date</label>
                    <select name="date" id="date">

                        <?php
                        // today date 
                        $dates = date("Y-m-d");
                        // get last 5 result data
                        $sqllastresult = "SELECT DISTINCT dates FROM resultlist order by id desc";
                        $resullast = mysqli_query($con, $sqllastresult);

                        while ($templast = mysqli_fetch_assoc($resullast)) {
                            if ($dates != $templast['dates']) {
                                ?>
                                <option value="<?php echo $templast['dates']; ?>">
                                    <?php echo $formattedDate = date("j/m/Y", strtotime($templast['dates'])); ?>
                                </option>
                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>

                <div class="box">
                    <label for="time">Select time</label>
                    <select name="time" id="time">
                        <option value="11:15 AM">11:15 AM</option>
                        <option value="3:15 PM">3:15 PM</option>
                        <option value="7:30 PM">7:30 PM</option>
                    </select>
                </div>
                <button type="submit" name='check'>Check Result</button>
            </form>
        </div>

        <div class="lot_heading">
            <img src="./img/line.png" alt="">
        </div>
    </div>


    <script>
        function message(time) {
            Swal.fire({
                title: time + " Result Not Announced Yet",
                width: 600,
                padding: "3em",
                color: "#716add",
                background: "#fff url(/images/trees.png)",
                backdrop: `
        rgba(0,0,123,0.4)
        url("/images/nyan-cat.gif")
        left top
        no-repeat
      `
            });
        }

    </script>
    <?php
    if (isset($_GET['notfound'])) {

        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Result Not Announced On This Date And Time',
            showConfirmButton: false,
            timer: 2000
          });
          setTimeout(() => {
            window.location.href='index';
          }, '2000'); 
          </script>";

    }
    ?>
</body>

</html>