<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <!-- Signup Form -->
        <form id="signupForm" method="POST" action="">
            <h3>Sign Up</h3>
            <div class="form-group">
                <label for="employeeName">Employee Name:</label>
                <input type="text" id="employeeName" name="employeeName" required>
            </div>

            <div class="form-group">
                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="designation" required>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" id="mobile" name="mobile" required>
            </div>

            <div class="form-group">
                <label for="whatsapp">WhatsApp No:</label>
                <input type="text" id="whatsapp" name="whatsapp" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="project">Project:</label>
                <input type="text" id="project" name="project" required>
            </div>

            <div class="form-group">
                <label for="sector">Sector:</label>
                <input type="text" id="sector" name="sector" required>
            </div>

            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" id="district" name="district" value="District" readonly>
            </div>

            <div class="form-group">
                <input type="submit" name="signup" value="Sign Up">
            </div>
        </form>
    </div>

    <?php
    
    if (isset($_POST['signup'])) {
        $employeeName = $_POST['employeeName'];
        $designation = $_POST['designation'];
        $mobile = $_POST['mobile'];
        $whatsapp = $_POST['whatsapp'];
        $email = $_POST['email'];
        $project = $_POST['project'];
        $sector = $_POST['sector'];
        $district = $_POST['district'];
        $password = '12345';
        $status = 'not active';
    
        $sql = "INSERT INTO distict_new (employee_name, designation, mobile, whatsapp, email, project, sector, district, password, status, login_type) VALUES ('$employeeName', '$designation', '$mobile', '$whatsapp', '$email', '$project', '$sector', '$district', '$password', '$status', 'District')";
        // Change login_type to 'Sector' or 'Project' accordingly
    
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Signup successful. Please update your password.');</script>";
            // Redirect to password update page
        } else {
            echo "<script>alert('Error during signup.');</script>";
        }
    }
    ?>

</body>
</html>