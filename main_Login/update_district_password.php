<?php
include "../connection/config.php";

if (isset($_POST['updatePassword'])) {
    $name = $_POST['name'];
    $newPassword = $_POST['newPassword'];

    $sql = "UPDATE district_new  SET password='$newPassword', status='active' WHERE name='$name'";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Password updated successfully');</script>";
        echo "<script>window.location.href='login.php';</script>"; // Redirect to login page
    } else {
        echo "<script>alert('Error updating password');</script>";
    }
}

$name = $_GET['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Update Password</h2>
        <form id="updatePasswordForm" method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>

            <div class="form-group">
                <input type="submit" name="updatePassword" value="Update Password">
            </div>
        </form>
    </div>
</body>
</html>
