<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Welcome</title>
</head>
<body>
    <h1>Welcome to the Project Dashboard</h1>
    <p>You have successfully logged in as a Project user.</p>
    <form method="POST" action="">
        <label for="new_password">Enter New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <input type="submit" name="change_password" value="Change Password">
    </form>

    <?php 
    include "../connection/config.php";
    session_start();
    if (isset($_POST['change_password'])) {
        $newPassword = $_POST['new_password'];
        $projectName = $_SESSION['project_name']; // Assume project_name is stored in session after login
        $sql = "UPDATE sector_district SET new_password='$newPassword' WHERE project_code='$projectName'";
        $result = mysqli_query($con, $sql) or die("Error updating password");
        if ($result) {
            echo "<script>alert('Password changed successfully.');</script>";
        }
    }
    ?>
</body>
</html>
