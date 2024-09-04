<?php
include '../connection/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the status in the candidates table
    $sql = "UPDATE candidates SET status = '$status' WHERE id = '$id'";
    if (mysqli_query($con, $sql)) {
        if ($status == 'Approved') {
            // Fetch the candidate_id from the candidates table
            $select_candidate_sql = "SELECT candidate_id FROM candidates WHERE id = '$id'";
            $result = mysqli_query($con, $select_candidate_sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $candidate_id = $row['candidate_id'];

                // Insert a record into the payments table for the approved candidate
                $insert_payment_sql = "INSERT INTO payments (candidate_id) VALUES ('$candidate_id')";
                if (mysqli_query($con, $insert_payment_sql)) {
                    header("Location: dashboard_project.php");
                    exit();
                } else {
                    echo "Error inserting payment record: " . mysqli_error($con);
                }
            } else {
                echo "Candidate ID not found.";
            }
        } else {
            header("Location: dashboard_project.php");
            exit();
        }
    } else {
        echo "Error updating status: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
