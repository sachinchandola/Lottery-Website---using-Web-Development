<?php
include('./includes/config.php');
require_once('./TCPDF-main/tcpdf.php');

if (isset($_GET['id'])) {

    $resultId = $_GET['id'];
    $sql = "SELECT dates, times FROM resultlist WHERE id='$resultId'";
    $result= $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date=$row['dates'];
            $time=$row['times'];
        }
    }
    function fetchData($con, $prize, $resultId)
    {
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $sql1 = "SELECT * FROM ticketlist WHERE result_id='$resultId' and prize='$prize'";
        $result1 = $con->query($sql1);
        $data1 = array();
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $data1[] = $row1['ticket'];
            }
        }
        return $data1;
    }
}

class CustomPDF extends TCPDF
{
    public function Header()
    {
        $imageWidth = 200;
        $this->Image('./img/lottery.png', 5, 8, $imageWidth, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->SetY(5);
        $this->Cell(0, 10, date('d/m/y H:i:s'), 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 10);
        // $this->Cell(0, 10, 'Result ' . $date  , 0, false, 'R', 0, '', 0, false, 'M', 'M');
    }
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C');
    }
   
}


$pdf = new CustomPDF();
$pdf->AddPage();

$data1 = fetchData($con, 'firstprize', $resultId);
$data2 = fetchData($con, 'secondprize',  $resultId);
$data3 = fetchData($con, 'thirdprize',  $resultId);
$data4 = fetchData($con, 'fourthprize',  $resultId);
$data5 = fetchData($con, 'fifthprize',  $resultId);

$pdf->SetFont('helvetica', '', 20);
$pdf->SetY(34);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(0, 13,  date('m/d/y', strtotime($date)), 0, 1, 'L'); 

$pdf->SetFont('helvetica', '', 20);
$pdf->SetY(34);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(0, 13,  $time, 0, 1, 'R'); 

$pdf->SetFont('helvetica', '', 30);
$pdf->SetY(75);
$pdf->SetTextColor(255, 0, 0);
drawTable1st($pdf,  array_map('strtoupper', $data1));

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 14);
$pdf->SetY(107);
drawTable2nd($pdf, $data2);

$pdf->SetFont('helvetica', '', 14);
$pdf->SetY(133);
drawTable3rd($pdf, $data3);

$pdf->SetFont('helvetica', '', 14);
$pdf->SetY(160);
drawTable4th($pdf, $data4);

$pdf->SetFont('helvetica', '', 9);
$pdf->SetY(193);
drawTable5th($pdf, $data5);

function drawTable1st($pdf, $data1)
{
    $cellWidth = 30;
    $xCoordinate = ($pdf->getPageWidth() - $cellWidth) / 2;

    foreach ($data1 as $col) {
        $pdf->SetX($xCoordinate);

        $pdf->Cell($cellWidth, 7, $col, 0, 1, 'C');
    }
}

function drawTable2nd($pdf, $data2)
{
    $cellWidth = 30;
    $breakAfter = 5;
    $tableWidth = $cellWidth * $breakAfter;

    $counter = 0;
    foreach ($data2 as $col) {
        $xCoordinate = ($pdf->getPageWidth() - $tableWidth) / 2 + $counter * $cellWidth;
        $pdf->SetX($xCoordinate);

        $pdf->Cell($cellWidth, 7, $col, 0, 0, 'C');
        $counter++;

        if ($counter % $breakAfter == 0) {
            $pdf->Ln();
            $counter = 0;
        }
    }
    $pdf->Ln();
}

function drawTable3rd($pdf, $data3)
{

    $cellWidth = 30;
    $breakAfter = 5;
    $tableWidth = $cellWidth * $breakAfter;


    $counter = 0;
    foreach ($data3 as $col) {
        $xCoordinate = ($pdf->getPageWidth() - $tableWidth) / 2 + $counter * $cellWidth;
        $pdf->SetX($xCoordinate);

        $pdf->Cell($cellWidth, 7, $col, 0, 0, 'C');
        $counter++;

        if ($counter % $breakAfter == 0) {
            $pdf->Ln();
            $counter = 0;
        }
    }
    $pdf->Ln();
}


function drawTable4th($pdf, $data4)
{

    $cellWidth = 30;
    $breakAfter = 5;
    $tableWidth = $cellWidth * $breakAfter;

    $counter = 0;
    foreach ($data4 as $col) {
        $xCoordinate = ($pdf->getPageWidth() - $tableWidth) / 2 + $counter * $cellWidth;
        $pdf->SetX($xCoordinate);

        $pdf->Cell($cellWidth, 7, $col, 0, 0, 'C');
        $counter++;

        if ($counter % $breakAfter == 0) {
            $pdf->Ln();
            $counter = 0;
        }
    }
    $pdf->Ln();
}

function drawTable5th($pdf, $data5)
{
    $cellWidth = 17;
    $breakAfter = 10;
    $tableWidth = $cellWidth * $breakAfter;

    $counter = 0;
    foreach ($data5 as $col) {
        $xCoordinate = ($pdf->getPageWidth() - $tableWidth) / 2 + $counter * $cellWidth;
        $pdf->SetX($xCoordinate);

        $pdf->Cell($cellWidth, 5, $col, 0, 0, 'C');
        $counter++;

        if ($counter % $breakAfter == 0) {
            $pdf->Ln();
            $counter = 0;
        }
    }
    $pdf->Ln();
}

// ob_end_clean();
// $pdf->Output('Nepal Lottery', 'I');


$filename = tempnam(sys_get_temp_dir(), 'Nepal_Lottery');
$pdf->Output($filename, 'F');

// Set headers to force download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Nepal_Lottery.pdf"');

// Output the PDF
readfile($filename);

// Delete the temporary file
unlink($filename);

// Perform JavaScript redirect
echo '<script>window.location.href = "index.php";</script>';
exit;