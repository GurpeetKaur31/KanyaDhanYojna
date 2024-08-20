<?php 
    session_start();
    include "../connection/config.php";
    if(isset($_POST['project_log']))
    {
        $loginType=$_POST['loginType'];
        $projectName=$_POST['project_name'];
        $Password=$_POST['LoginPassword'];
        $sql="SELECT * FROM sector_district WHERE project_name='$projectName' AND def_password='$Password'";
        $result=mysqli_query($con, $sql)or die("Error");
        if($result)
        {
            echo "<script>alert('Login successfully')</script>";
            echo "<script>window.open('login_prject.php','_self')</script>";
        }
    
    }
    
    
    if(isset($_POST['district_log']))
    {
        $loginType=$_POST['loginType'];
        $districtName=$_POST['district_name'];
        $Password=$_POST['LoginPassword'];
        $sql="SELECT * FROM sector_district WHERE district='$districtName' AND def_password='$Password'";
        $result=mysqli_query($con, $sql)or die("Error");
        if($result)
        {
            echo "<script>alert('Login successfully')</script>";
            echo "<script>window.open('login_district.php','_self' )</script>";
        }
    
    }   

if(isset($_POST['sector_log']))
{
    $loginType=$_POST['loginType'];
    $sectorName=$_POST['sector_name'];
    $districtName=$_POST['district_name'];
    $Password=$_POST['LoginPassword'];
    $sql="SELECT * FROM sector_district WHERE sector='$sectorName' AND district='$districtName' AND def_password='$Password'";
    $result=mysqli_query($con, $sql)or die("Error");
    if($result)
    {
        echo "<script>alert('Login successfully')</script>";
        echo "<script>window.open('login_sector.php','_self')</script>";
    }

}   
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <style>
            body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #ffffff;
    width: 400px; /* Increased the width */
    padding: 30px; /* Adjusted padding */
    border-radius: 15px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    color: #333;
    margin-bottom: 20px;
    font-weight: 700; /* Added font weight for bold */
}

/* form {
    display: flex;
    flex-direction: row;
    align-items: center;
} */

form input[type="text"],
form input[type="email"],
form input[type="password"],
form select {
    width: 100%;
    padding: 12px; /* Adjusted padding */
    margin: 12px 0; /* Adjusted margin */
    border: 1px solid #ddd;
    border-radius: 8px; /* Increased border radius */
    box-sizing: border-box;
    transition: border-color 0.3s ease-in-out;
}

form input[type="text"]:focus,
form input[type="email"]:focus,
form input[type="password"]:focus,
form select:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Added box shadow */
}

button {
    background-color: #007bff;
    color: white;
    padding: 12px; /* Adjusted padding */
    margin-top: 20px;
    border: none;
    border-radius: 8px; /* Increased border radius */
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

input[type="checkbox"] {
    margin-right: 10px;
}

label {
    margin-top: 10px;
    color: #555;
    display: flex;
    align-items: center;
    font-weight: 500; /* Added font weight */
}

p {
    color: #666;
    font-size: 14px;
    margin-top: 20px;
}

p a {
    color: #007bff;
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}

.left-box {
    background: #103cbe;
    color: white;
    padding: 20px;
    border-radius: 15px 0 0 15px;
    text-align: center;
}

.left-box img {
    width: 100%; /* Make the image responsive */
    max-width: 250px;
}

.left-box p {
    font-size: 24px;
    font-weight: 600;
    margin-top: 20px;
}

.left-box small {
    display: block;
    margin-top: 10px;
    font-size: 14px;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}



    </style>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php include "../connection/config.php"; ?>
     <!----------------------- Main Container -------------------------->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->
    <div class="row border rounded-5 p-3 bg-white shadow box-area">

        <!--------------------------- Left Box ----------------------------->
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
           <div class="featured-image mb-3">
            <img src="images/1.png" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this platform.</small>
       </div> 


       <!--------------------------- Right Box ---------------------------->
       <div class="col-md-6 right-box">
       <div class="row align-items-center">
       <div class="header-text mb-4">
        <h2>Login Form</h2>
       </div>
        <form id="mainForm" method="POST" action="">
            <label>
                <input type="radio" name="loginType" value="project"> Project
            </label>
            <label>
                <input type="radio" name="loginType" value="district"> District
            </label>
            <label>
                <input type="radio" name="loginType" value="sector"> Sector
            </label>

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
                        <div class="container border rounded-3 mt-2 p-3">
                        <div class="input-group mb-3">
                            <label for="LoginType">Login Type: </label>
                            <input type="text" id="LoginType" name="LoginType" value="Project" disabled>
                        </div>

                        <div class="input-group mb-3">
                            <label for="projectName">Project Name: </label>
                            <select name="project_name" id="project_name" class="form-control">
                                <option value="" selected="" disabled="">Choose project Name</option>
                            </select>
                        </div>

                         <div class="input-group mb-3 ">
                            <label for="LoginPassword">Login Password: </label>
                            <input type="password" id="LoginPassword" name="LoginPassword">
                        </div>
                          <div class="input-group mb-3">
                    <button  name="project_log" class="btn btn-sm btn-primary w-100 fs-6">Submit</button>
                </div>
                        </div>
                    `;
                } else if (selectedType === 'district') {
                    formContent = `
                        <div class="form-group">
                            <label for="LoginType">Login Type:</label>
                            <input type="text" id="LoginType" name="LoginType" value="District" disabled>
                        </div>

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
                         <div class="form-group">
                            <input type="submit" name="district_log" value="submit">
                        </div>
                    `;
                } else if (selectedType === 'sector') {
                    formContent = `
                        <div class="form-group">
                            <label for="LoginType">Login Type:</label>
                            <input type="text" id="LoginType" name="LoginType" value="Sector" disabled>
                        </div>

                       <div class="form-group">
                            <label for="DistrictName">District Name:</label>
                            <select name="district_name" id="district_name" class="form-control">
                                <option value="" selected="" disabled="">Choose District Name</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sectorName">Choose Sector:</label>
                            <select name="sector_name" id="sector_name" class="form-control">
                                <option value="" selected="" disabled="">Choose Sector</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="LoginPassword">Login Password:</label>
                            <input type="password" id="LoginPassword" name="LoginPassword">
                        </div>
                         <div class="form-group">
                            
                            <input type="submit" name="sector_log" value="submit">
                        </div>
                    `;
                }

                $('#formContainer').html(formContent);
                if (selectedType === 'project') {
                    $.ajax({
                        url: 'getProject.php',
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
                        url: 'getDistrict.php',
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
                        url: 'getDistrict.php',
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
                            url: 'getSector.php',
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