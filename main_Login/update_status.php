<?php
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
?>
