<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>District Portal</title>
    <link rel="stylesheet" href="../assets/css/login_DPS_css.css">
</head>

<body>
    <div class="container">
        <h2>District Portal</h2>
        <form id="loginForm" method="POST" action="">
            <h3>Login</h3>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="loginType">Login Type:</label>
                <input type="text" id="loginType" name="loginType" value="District" disabled>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
        <p>Not registered yet? <a href='Signin_district.php'>Register Here</a></p>
    </div>

    <?php
    include "../connection/config.php";
    
    if (isset($_POST['login'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM district_new WHERE name='$name' AND password='$password'";
        $result = mysqli_query($con, $sql);
    
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if ($user['status'] == 'active') {
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.location.href='../dashboard/dashboard_district.php';</script>";
            } else {
                echo "<script>alert('Account not active. Please update your password.');</script>";
                echo "<script>window.location.href='update_district_password.php?name=$name';</script>";
            }
        } else {
            echo "<script>alert('Invalid credentials');</script>";
        }
    }
    ?>
</body>
</html>
