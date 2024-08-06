<?php
session_start();
include "../connection/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile No:</label>
                <input type="text" id="mobile" name="mobile" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="change_password" value="Change Password">
            </div>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['change_password']))
{
    $name = $_POST['name'];
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if($new_password == $confirm_password)
    {
        // Update password in database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        if ($_SESSION['loginType'] == 'project') {
            $project_code = $_SESSION['project_code'];
            $sql = "UPDATE sector_district SET new_password='$hashed_password', name='$name', username='$username', mobile='$mobile' WHERE project_code='$project_code'";
        } else if ($_SESSION['loginType'] == 'district') {
            $district = $_SESSION['district'];
            $sql = "UPDATE sector_district SET new_password='$hashed_password', name='$name', username='$username', mobile='$mobile' WHERE district='$district'";
        } else if ($_SESSION['loginType'] == 'sector') {
            $sector = $_SESSION['sector'];
            $district = $_SESSION['district'];
            $sql = "UPDATE sector_district SET new_password='$hashed_password', name='$name', username='$username', mobile='$mobile' WHERE sector='$sector' AND district='$district'";
        }

        $result = mysqli_query($con, $sql) or die("Error updating password");

        if($result)
        {
            echo "<script>alert('Password changed successfully');</script>";
            echo "<script>window.location.href='welcome.php';</script>";
        }
    }
    else
    {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>
