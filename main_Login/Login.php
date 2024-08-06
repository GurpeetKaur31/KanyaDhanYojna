<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php include "../connection/config.php"; ?>
    <div class="container">
        <h2>Login Form</h2>
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

    <script>
        $(document).ready(function() {
            $('input[name="loginType"]').change(function() {
                var selectedType = $('input[name="loginType"]:checked').val();
                var formContent = '';

                if (selectedType === 'project') {
                    formContent = `
                        <div class="form-group">
                            <label for="LoginType">Login Type:</label>
                            <input type="text" id="LoginType" name="LoginType" value="Project" disabled>
                        </div>

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
                         <div class="form-group">
                            <input type="submit" name="project_log" value="submit">
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

    <?php 
    if(isset($_POST['project_log']))
    {
        $loginType=$_POST['loginType'];
        $projectName=$_POST['project_name'];
        $Password=$_POST['LoginPassword'];
        $sql="SELECT * FROM sector_district WHERE project_code='$projectName' AND def_password='$Password'";
        $result=mysqli_query($con, $sql)or die("Error");
        if($result)
        {
            echo "<script>alert('Login successfully')</script>";
            echo "<script>window.open('login_project.php','_self')</script>";
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
</body>

</html>