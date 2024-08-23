<!-- php
include '../connection/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE candidates SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Status updated successfully'); window.location.href='dashboard_project.php';</script>";
    } else {
        echo "<script>alert('Error updating status'); window.location.href='dashboard_project.php';</script>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?> -->

<?php
include '../connection/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE candidates SET status = '$status' WHERE id = '$id'";
    if (mysqli_query($con, $sql)) {
        if ($status == 'Approved') {
            // Insert a record into the payments table for the approved candidate
            $insert_payment_sql = "INSERT INTO payments (candidate_id) VALUES ('$id')";
            mysqli_query($con, $insert_payment_sql);
        }
        header("Location: dashboard_project.php");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>

