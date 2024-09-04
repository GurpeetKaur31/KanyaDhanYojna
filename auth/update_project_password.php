<?php
include "../connection/config.php";
session_start(); // Start session for user management

if (isset($_POST['updatePassword'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $newPassword = mysqli_real_escape_string($con, $_POST['newPassword']);

    // Hash the new password for security
    $hashedPassword = $newPassword;

    $sql = "UPDATE project_new SET password='$hashedPassword', status='active' WHERE name='$name'";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Password updated successfully');</script>";
        echo "<script>window.location.href='index.php';</script>"; // Redirect to login page
    } else {
        echo "<script>alert('Error updating password');</script>";
    }
}

$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 5rem;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Update Password</h2>
        <form id="updatePasswordForm" method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" class="form-control" required>
            </div>

            <div class="mb-3 text-center">
                <button type="submit" name="updatePassword" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
