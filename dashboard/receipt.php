<?php
require_once('../libs/fpdf/fpdf.php');
require_once('../connection/config.php');

if (!isset($_GET['candidate_id'])) {
    die("Invalid request");
}

$candidate_id = $_GET['candidate_id'];

// Fetch candidate and payment details
$sql = "SELECT c.*, p.amount, p.payment_date FROM candidates c 
    LEFT JOIN payments p ON c.candidate_id = p.candidate_id
    WHERE c.id = '$candidate_id'";
$result = mysqli_query($con, $sql) or die("Error fetching data");

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("No data found for the candidate");
}

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Candidate Payment Receipt', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(50, 10, 'candidate is:', 1);
$pdf->Cell(0, 10, $row['candidate_id'], 1, 1);


$pdf->Cell(50, 10, 'District:', 1);
$pdf->Cell(0, 10, $row['district'], 1, 1);

$pdf->Cell(50, 10, 'Block:', 1);
$pdf->Cell(0, 10, $row['block'], 1, 1);

$pdf->Cell(50, 10, 'Area Type:', 1);
$pdf->Cell(0, 10, $row['area_type'], 1, 1);

$pdf->Cell(50, 10, 'Candidate Name:', 1);
$pdf->Cell(0, 10, $row['candidate_name'], 1, 1);

$pdf->Cell(50, 10, 'Candidate UID/Aadhar:', 1);
$pdf->Cell(0, 10, $row['candidate_aadhar'], 1, 1);

$pdf->Cell(50, 10, 'Date of Birth:', 1);
$pdf->Cell(0, 10, $row['dob'], 1, 1);

$pdf->Cell(50, 10, 'Gender:', 1);
$pdf->Cell(0, 10, $row['gender'], 1, 1);

$pdf->Cell(50, 10, 'Caste:', 1);
$pdf->Cell(0, 10, $row['caste'], 1, 1);

$pdf->Cell(50, 10, 'Mother\'s Name:', 1);
$pdf->Cell(0, 10, $row['mother_name'], 1, 1);

$pdf->Cell(50, 10, 'Father\'s/Guardian\'s Name:', 1);
$pdf->Cell(0, 10, $row['father_name'], 1, 1);

$pdf->Cell(50, 10, 'Relation with Guardian:', 1);
$pdf->Cell(0, 10, $row['relation'], 1, 1);

$pdf->Cell(50, 10, 'Account Number:', 1);
$pdf->Cell(0, 10, $row['account_no'], 1, 1);

$pdf->Cell(50, 10, 'IFSC Code:', 1);
$pdf->Cell(0, 10, $row['ifsc'], 1, 1);

$pdf->Cell(50, 10, 'Education Qualification:', 1);
$pdf->Cell(0, 10, $row['qualification'], 1, 1);

$pdf->Cell(50, 10, 'Contact Number:', 1);
$pdf->Cell(0, 10, $row['contact_no'], 1, 1);

// Add payment details
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Payment Details', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(50, 10, 'Amount:', 1);
$pdf->Cell(0, 10, $row['amount'], 1, 1);

$pdf->Cell(50, 10, 'Payment Date:', 1);
$pdf->Cell(0, 10, $row['payment_date'], 1, 1);

$pdf->Ln(10);
$pdf->Cell(0, 10, 'Thank you for your attention.', 0, 1, 'C');
$pdf->Cell(0, 10, '© ' . date('Y') . ' Aadhar Panel', 0, 1, 'C');

// Output PDF
$pdf->Output('D', 'receipt_' . $candidate_id . '.pdf');
?>
