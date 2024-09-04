<?php 
    session_start();
    include "../connection/config.php";
    
    if (isset($_POST['project_log'])) {
        $projectName = $_POST['project_name'];
        $password = $_POST['LoginPassword'];
        $sql = "SELECT * FROM sector_district WHERE project_name='$projectName' AND def_password='$password'";
        $result = mysqli_query($con, $sql) or die("Error");

        if ($result) {
            echo "<script>alert('Login successfully')</script>";
            echo "<script>window.open('../auth/login_project.php', '_self')</script>";
        }
    }
    
    if (isset($_POST['district_log'])) {
        $districtName = $_POST['district_name'];
        $password = $_POST['LoginPassword'];
        $sql = "SELECT * FROM sector_district WHERE district='$districtName' AND def_password='$password'";
        $result = mysqli_query($con, $sql) or die("Error");

        if ($result) {
            echo "<script>alert('Login successfully')</script>";
            echo "<script>window.open('../auth/login_district.php', '_self')</script>";
        }
    }   

    if (isset($_POST['sector_log'])) {
        $sectorName = $_POST['sector_name'];
        $districtName = $_POST['district_name'];
        $password = $_POST['LoginPassword'];
        $sql = "SELECT * FROM sector_district WHERE sector='$sectorName' AND district='$districtName' AND def_password='$password'";
        $result = mysqli_query($con, $sql) or die("Error");

        if ($result) {
            echo "<script>alert('Login successfully')</script>";
            echo "<script>window.open('../auth/login_sector.php', '_self')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            width: 850px;
            padding: 0;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
        }

        .left-box {
            background: #007bff;
            color: white;
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .left-box img {
            width: 100%;
            max-width: 200px;
            margin-bottom: 30px;
        }

        .left-box h3 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .left-box p {
            font-size: 18px;
            font-weight: 300;
            line-height: 1.5;
        }

        .right-box {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 28px;
        }

        form input[type="text"],
        form input[type="password"],
        form select {
            width: 100%;
            padding: 14px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
            font-size: 16px;
        }

        form input[type="text"]:focus,
        form input[type="password"]:focus,
        form select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 14px;
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        label {
            color: #555;
            font-weight: 500;
        }

        .radio-group {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include "../connection/config.php"; ?>
    <div class="container">
        <div class="left-box">
            <img src="../assets/images/uk_logo.svg" alt="Logo">
            <h3>Welcome Back!</h3>
            <p>Access your project, district, or sector portal by selecting the appropriate option.</p>
        </div>

        <div class="right-box">
            <h2>Login</h2>
            <form id="mainForm" method="POST" action="">
                <div class="radio-group">
                    <label>
                        <input type="radio" name="loginType" value="project"> Project
                    </label>
                    <label>
                        <input type="radio" name="loginType" value="district"> District
                    </label>
                    <label>
                        <input type="radio" name="loginType" value="sector"> Sector
                    </label>
                </div>
                <div id="formContainer"></div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('input[name="loginType"]').change(function() {
                var selectedType = $('input[name="loginType"]:checked').val();
                var formContent = '';

                if (selectedType === 'project') {
                    formContent = `
                        <div class="form-group">
                            <label for="projectName">Project Name:</label>
                            <select name="project_name" id="project_name" class="form-control">
                                <option value="" selected="" disabled="">Choose project Name</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="LoginPassword">Login Password:</label>
                            <input type="password" id="LoginPassword" name="LoginPassword">
                        </div>

                        <button name="project_log" class="btn btn-primary w-100">Submit</button>
                    `;
                } else if (selectedType === 'district') {
                    formContent = `
                        <div class="form-group">
                            <label for="districtName">District Name:</label>
                            <select name="district_name" id="district_name" class="form-control">
                                <option value="" selected="" disabled="">Choose District Name</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="LoginPassword">Login Password:</label>
                            <input type="password" id="LoginPassword" name="LoginPassword">
                        </div>

                        <button name="district_log" class="btn btn-primary w-100">Submit</button>
                    `;
                } else if (selectedType === 'sector') {
                    formContent = `
                        <div class="form-group">
                            <label for="districtName">District Name:</label>
                            <select name="district_name" id="district_name" class="form-control">
                                <option value="" selected="" disabled="">Choose District Name</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sectorName">Sector Name:</label>
                            <select name="sector_name" id="sector_name" class="form-control">
                                <option value="" selected="" disabled="">Choose Sector Name</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="LoginPassword">Login Password:</label>
                            <input type="password" id="LoginPassword" name="LoginPassword">
                        </div>

                        <button name="sector_log" class="btn btn-primary w-100">Submit</button>
                    `;
                }

                $('#formContainer').html(formContent);
                if (selectedType === 'project') {
                    $.ajax({
                        url: '../dashboard/getProject.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var options = '<option value="" selected="" disabled="">Choose project Name</option>';
                            var districts = {};

                            response.forEach(function(project) {
                                if (!districts[project.district]) {
                                    districts[project.district] = [];
                                }
                                districts[project.district].push(project);
                            });

                            for (var district in districts) {
                                options += `<optgroup label="${district}">`;
                                districts[district].forEach(function(project) {
                                    options += `<option value="${project.project_code}">${project.project_name}</option>`;
                                });
                                options += `</optgroup>`;
                            }

                            $('#project_name').html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching project names:", status, error);
                        }
                    });
                } else if (selectedType === 'district') {
                    $.ajax({
                        url: '../dashboard/getDistrict.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var options = '<option value="" selected="" disabled="">Choose District Name</option>';
                            response.forEach(function(district) {
                                options += `<option value="${district}">${district}</option>`;
                            });
                            $('#district_name').html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching district names:", status, error);
                        }
                    });
                } else if (selectedType === 'sector') {
                    $.ajax({
                        url: '../dashboard/getDistrict.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var options = '<option value="" selected="" disabled="">Choose District Name</option>';
                            response.forEach(function(district) {
                                options += `<option value="${district}">${district}</option>`;
                            });
                            $('#district_name').html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching district names:", status, error);
                        }
                    });

                    $('#district_name').change(function() {
                        var selectedDistrict = $('#district_name').val();
                        $.ajax({
                            url: '../dashboard/getSector.php',
                            type: 'GET',
                            data: {
                                district: selectedDistrict
                            },
                            dataType: 'json',
                            success: function(response) {
                                var options = '<option value="" selected="" disabled="">Choose Sector</option>';
                                var projectSectors = {};

                                response.forEach(function(item) {
                                    if (!projectSectors[item.project_code]) {
                                        projectSectors[item.project_code] = [];
                                    }
                                    projectSectors[item.project_code].push(item.sector);
                                });

                                for (var projectCode in projectSectors) {
                                    options += `<optgroup label="${projectCode}">`;
                                    projectSectors[projectCode].forEach(function(sector) {
                                        options += `<option value="${sector}">${sector}</option>`;
                                    });
                                    options += `</optgroup>`;
                                }

                                $('#sector_name').html(options);
                            },
                            error: function(xhr, status, error) {
                                console.error("Error fetching sectors:", status, error);
                            }
                        });
                    });
                }
            });

            // Trigger change event on page load to set the default form
            $('input[name="loginType"]:checked').trigger('change');
        });
    </script>
</body>
</html>
