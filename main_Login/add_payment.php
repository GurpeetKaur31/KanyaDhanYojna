<?php
include '../connection/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_id = $_POST['payment_id'];
    $initial_payment = $_POST['initial_payment'];
    $partial_payment = $_POST['partial_payment'];
    $payment_date = $_POST['payment_date'];
    $policy_id = $_POST['policy_id'];
    $valid_upto = $_POST['valid_upto'];

    $sql = "UPDATE payments SET 
                initial_payment = '$initial_payment', 
                partial_payment = '$partial_payment',
                payment_date = '$payment_date',
                policy_id = '$policy_id',
                valid_upto = '$valid_upto'
            WHERE id = '$payment_id'";

    if (mysqli_query($con, $sql)) {
        header("Location: dashboard_sector.php");
    } else {
        echo "Error updating payment: " . mysqli_error($con);
    }
}
?>
