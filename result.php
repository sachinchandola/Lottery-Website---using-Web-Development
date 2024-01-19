<?php
include "./includes/config.php";

// today date 
$dates = date("d/m/Y");
$gameid = "";


// last 5 record id
if (isset($_GET['LastId'])) {
    $id = $_GET['LastId'];
    $gameid = $id;
    // get today result data
    $sqllast = "SELECT * FROM resultlist WHERE id='$id'";
    $resultlastresult = mysqli_query($con, $sqllast);
    $templastresult = mysqli_fetch_assoc($resultlastresult);

    $sqllastticket = "SELECT * from ticketlist where result_id='$id'";
    $resultlastticket = mysqli_query($con, $sqllastticket);

    $security='true';
}


// onclick ticket button get request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $gameid = $id;
    // get result data
    $sqlresult = "SELECT * FROM resultlist WHERE id='$id'";
    $result = mysqli_query($con, $sqlresult);
    $tempresult = mysqli_fetch_assoc($result);
    // get ticket data
    $sqlticket = "SELECT * FROM ticketlist WHERE result_id='$id'";
    $resultticket = mysqli_query($con, $sqlticket);

    $security = 'true';
}


// get logo banner data
$sqldata = "SELECT * FROM logofavi";
$resultdata = mysqli_query($con, $sqldata);
$tempdata = mysqli_fetch_assoc($resultdata);

if (isset($security) && $security == 'true') {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./zpanel/<?php echo $tempdata['favicon']; ?>">
        <title><?php echo $tempdata['title']; ?></title>

        <link rel="stylesheet" href="style.css">

        <style>
            @media print {
                .container {
                    /* border: 5px solid blue; */
                    height: 100vh;
                }

                .container .box_top {
                    padding-top: 10vw !important;
                }

                .container .box_top h1 {
                    font-size: 40px !important;
                }

                .container .box_one h1 {
                    padding-left: 10px !important;
                    font-size: 70px !important;
                }

                .container .box_two {
                    padding-top: 35px !important;
                    font-size: 18px !important;
                }

                .container .box_three {
                    padding-top: 50px !important;
                    font-size: 18px !important;
                }

                .container .box_four {
                    padding-top: 47px !important;
                    font-size: 18px !important;
                }

                .container .box_five {
                    padding-top: 55px !important;
                    padding-bottom: 27px !important;
                    font-size: 13px !important;
                    border: none !important;
                    border-bottom: 3px solid #000 !important;
                }
            }
        </style>

        <script>
            function printContent() {
                const dates = '<?php
                                if (isset($tempresult['dates'])) {
                                    echo $formattedDate = date("j/m/Y", strtotime($tempresult['dates']));
                                } else {
                                    echo $formattedDate = date("j/m/Y", strtotime($templastresult['dates']));
                                } ?>';
                const times = '<?php
                                if (isset($tempresult['dates'])) {
                                    echo $tempresult['times'];
                                } else {
                                    echo $templastresult['times'];
                                } ?>';

                const prtHtml = document.getElementById('printBox').innerHTML;

                document.body.innerHTML = prtHtml;
                document.title = 'Result-' + dates + '-' + times;
                window.print();
                location.reload();
            }
        </script>

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
            <h2>
                <span>
                    <?php
                    if (isset($tempresult['dates'])) {
                        echo $formattedDate = date("j/m/Y", strtotime($tempresult['dates']));
                    } else {
                        echo $formattedDate = date("j/m/Y", strtotime($templastresult['dates']));
                    } ?>
                </span> -
                <span>
                    <?php
                    if (isset($tempresult['dates'])) {
                        echo $tempresult['times'];
                    } else {
                        echo $templastresult['times'];
                    } ?> Result
                </span>
            </h2>
        </div>

        <section class="data">
            <!-- <div class="rainbow-btn" id="printBtn" onclick="printContent()"><span>Download Result</span></div> -->
            <div class="rainbow-btn" id="printBtn" onclick="window.location.href='pdf.php?id=<?= $gameid ?>'">
            <span>Download Result</span>
            </div>

            <!-- <div class="rainbow-btn" id="printBtn" onclick=""><span>Download Result</span></div> -->
            <div class="result_box" id="printBox" style=" 
        /* border: 3px solid magenta; */
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        ">
                <div class="container" style=" 
            /* border: 3px solid #000; */
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 133vw;
            background-image: url(./img/Lottery-result-bg.jpg);
            background-repeat: no-repeat;
            background-size: 100%;
            position: relative;
            ">
                    <div class="box_top" style="
                    /* border: 1px solid red; */
                    width: 93%;
                    display: flex;
                    justify-content: space-between;
                    padding: 0 3vw;
                    padding-top: 9vw;
                ">
                        <!-- ? -- Date -- ? -- -->
                        <h1 style="
                        color: #ff00fe; 
                        font-size: 60px;
                        font-weight: 900;
                        -webkit-text-stroke: 3px;
                        -webkit-text-stroke-color: #000;
                        ">
                            <?php
                            if (isset($tempresult['dates'])) {
                                echo $formattedDate = date("j/m/Y", strtotime($tempresult['dates']));
                            } else {
                                echo $formattedDate = date("j/m/Y", strtotime($templastresult['dates']));
                            } ?>
                        </h1>

                        <!-- ? -- Time -- ? -- -->
                        <h1 style="
                        color: #ff00fe; 
                        font-size: 60px;
                        font-weight: 900;
                        -webkit-text-stroke: 3px;
                        -webkit-text-stroke-color: #000;
                        ">
                            <?php
                            if (isset($tempresult['dates'])) {
                                echo $tempresult['times'];
                            } else {
                                echo $templastresult['times'];
                            } ?>
                        </h1>
                    </div>
                    <div class="box_one" style="
                    /* border: 1px solid red; */
                    width: 90%;
                    display: flex;
                    justify-content: center;
                    padding: 0 3vw;
                    padding-top: 14vw;
                    padding-left: 7vw;
                ">
                        <!-- ? -- 1st Prize -- ? -- -->
                        <h1 style="
                        color: rgb(255, 47, 47); 
                        font-size: 110px;
                        font-weight: 900;
                        -webkit-text-stroke: 3px;
                        -webkit-text-stroke-color: #fff;
                        ">
                            <?php
                            if (isset($tempresult['dates'])) {
                                $tempticket = mysqli_fetch_assoc($resultticket);
                                echo $tempticket['ticket'];
                            } else {
                                $templastticket = mysqli_fetch_assoc($resultlastticket);
                                echo $templastticket['ticket'];
                            } ?>
                        </h1>
                    </div>
                    <div class="box_two" style="
                    /* border: 1px solid blue; */
                    width: 91.5%;
                    padding: 4vw 3vw 0vw 3vw;
                    display: flex;
                    flex-wrap: wrap;
                    color: #000;
                    font-size: 30px;
                    font-weight: 600;
                ">

                        <!-- ? -- 2nd Prize -- ? -- -->
                        <?php
                        if (isset($tempresult['dates'])) {
                            for ($i = 1; $i <= 10; $i++) {
                                $tempticket = mysqli_fetch_assoc($resultticket);
                        ?>
                                <span style='width: 20%; display: flex; justify-content: center;'>
                                    <?php echo $tempticket['ticket'] ?>
                                </span>
                            <?php
                            }
                        } else {
                            for ($i = 1; $i <= 10; $i++) {
                                $templastticket = mysqli_fetch_assoc($resultlastticket);
                            ?>
                                <span style='width: 20%; display: flex; justify-content: center;'>
                                    <?php echo $templastticket['ticket'] ?>
                                </span>
                        <?php
                            }
                        } ?>
                    </div>
                    <div class="box_three" style="
                    /* border: 1px solid black; */
                    width: 91.5%;
                    padding: 6vw 3vw 0vw 3vw;
                    display: flex;
                    flex-wrap: wrap;
                    color: #000;
                    font-size: 30px;
                    font-weight: 600;
                ">
                        <!-- ? -- 3rd Prize -- ? -- -->
                        <?php
                        if (isset($tempresult['dates'])) {
                            for ($i = 1; $i <= 10; $i++) {
                                $tempticket = mysqli_fetch_assoc($resultticket);
                        ?>
                                <span style='width: 20%; display: flex; justify-content: center;'>
                                    <?php echo $tempticket['ticket'] ?>
                                </span>
                            <?php
                            }
                        } else {
                            for ($i = 1; $i <= 10; $i++) {
                                $templastticket = mysqli_fetch_assoc($resultlastticket);
                            ?>
                                <span style='width: 20%; display: flex; justify-content: center;'>
                                    <?php echo $templastticket['ticket'] ?>
                                </span>
                        <?php
                            }
                        } ?>
                    </div>
                    <div class="box_four" style="
                    /* border: 1px solid black; */
                    width: 91.5%;
                    padding: 6vw 3vw 0vw 3vw;
                    display: flex;
                    flex-wrap: wrap;
                    color: #000;
                    font-size: 30px;
                    font-weight: 600;
                ">
                        <!-- ? -- 4th Prize -- ? -- -->
                        <?php
                        if (isset($tempresult['dates'])) {
                            for ($i = 1; $i <= 10; $i++) {
                                $tempticket = mysqli_fetch_assoc($resultticket);
                        ?>
                                <span style='width: 20%; display: flex; justify-content: center;'>
                                    <?php echo $tempticket['ticket'] ?>
                                </span>
                            <?php
                            }
                        } else {
                            for ($i = 1; $i <= 10; $i++) {
                                $templastticket = mysqli_fetch_assoc($resultlastticket);
                            ?>
                                <span style='width: 20%; display: flex; justify-content: center;'>
                                    <?php echo $templastticket['ticket'] ?>
                                </span>
                        <?php
                            }
                        } ?>
                    </div>
                    <div class="box_five" style="
                    /* border: 5px solid green; */
                    width: 91.5%;
                    padding: 8vw 3vw 0vw 3vw;
                    display: flex;
                    flex-wrap: wrap;
                    color: #000;
                    font-size: 23px;
                    font-weight: 600;
                ">
                        <!-- ? -- 5th Prize -- ? -- -->
                        <?php
                        if (isset($tempresult['dates'])) {
                            for ($i = 1; $i <= 100; $i++) {
                                $tempticket = mysqli_fetch_assoc($resultticket);
                        ?>
                                <span style='width: 10%; margin: 2px 0;  display: flex; justify-content: center;'>
                                    <?php echo $tempticket['ticket'] ?>
                                </span>
                            <?php
                            }
                        } else {
                            for ($i = 1; $i <= 100; $i++) {
                                $templastticket = mysqli_fetch_assoc($resultlastticket);
                            ?>
                                <span style='width: 10%; margin: 2px 0;  display: flex; justify-content: center;'>
                                    <?php echo $templastticket['ticket'] ?>
                                </span>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </section>



    </body>

    </html>
<?php
} else {
    echo "<script>window.location.href='index'</script>";
}
?>