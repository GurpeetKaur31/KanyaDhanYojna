<?php
// Start session
session_start();

include "../connection/config.php";

// Escape user inputs for security
$candidate_id=mysqli_real_escape_string($con,$_POST['candidate_id']);
$district = mysqli_real_escape_string($con, $_POST['district']);
$block = mysqli_real_escape_string($con, $_POST['block']);
// $gram = mysqli_real_escape_string($con, $_POST['gram']);
// $village = mysqli_real_escape_string($con, $_POST['village']);
$area_type = mysqli_real_escape_string($con, $_POST['area_type']);
$guardian_aadhar = mysqli_real_escape_string($con, $_POST['guardian_aadhar']);
$candidate_name = mysqli_real_escape_string($con, $_POST['candidate_name']);
$candidate_aadhar = mysqli_real_escape_string($con, $_POST['candidate_aadhar']);
$dob = mysqli_real_escape_string($con, $_POST['dob']);
$gender = mysqli_real_escape_string($con, $_POST['gender']);
$caste = mysqli_real_escape_string($con, $_POST['caste']);
$mother_name = mysqli_real_escape_string($con, $_POST['mother_name']);
$father_name = mysqli_real_escape_string($con, $_POST['father_name']);
$relation = mysqli_real_escape_string($con, $_POST['relation']);
$account_no = mysqli_real_escape_string($con, $_POST['account_no']);
$ifsc = mysqli_real_escape_string($con, $_POST['ifsc']);
$qualification = mysqli_real_escape_string($con, $_POST['qualification']);
$contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);

// Prepare the SQL query
$sql = "INSERT INTO candidates (candidate_id,district, block, area_type, guardian_aadhar, candidate_name, candidate_aadhar, dob, gender, caste, mother_name, father_name, relation, account_no, ifsc, qualification, contact_no) 
        VALUES ('$candidate_id','$district', '$block', '$area_type', '$guardian_aadhar', '$candidate_name', '$candidate_aadhar', '$dob', '$gender', '$caste', '$mother_name', '$father_name', '$relation', '$account_no', '$ifsc', '$qualification', '$contact_no')";

// Execute the query and check for errors
if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    header('Location:dashboard.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Close the connection
mysqli_close($con);
?>
