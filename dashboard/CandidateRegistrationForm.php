<?php
// Start session
session_start();

// Get session variables
$defaultDistrict = isset($_GET['district']) ? htmlspecialchars($_GET['district']) : '';
$defaultBlock = isset($_GET['block']) ? htmlspecialchars($_GET['block']) : '';

// Generate candidate_id
$x = "KD";
$y = rand(1000, 9999); // Generates a random number between 1000 and 9999
$candidate_id = $x . $y;
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Candidate-Registration-Form</title>
        <link rel="stylesheet" href="../Style.css">
        <script src="CandidateRegFormValidation.js"></script>
        
    </head>
    <body>
        <center><h1>Candidate Registration Form</h1></center>
        <form action="submit_registration.php" method="POST" class="form-group">
             <!-- Hidden field to store candidate_id -->
            <input type="hidden" name="candidate_id" value="<?php echo $candidate_id; ?>">
            <table>
                <tr>
                    <th>S.No</th>
                    <th>-</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>District</td>
                    <td>
                    <input type="text" id="district" name="district" value="<?php echo $defaultDistrict; ?>" readonly>
                    <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Block</td>
                    <td>
                    <input type="text" id="block" name="block" value="<?php echo $defaultBlock; ?>" readonly>
                    <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Gram<span class="required">*</span></td>
                    <td>
                    <select id="gram" name="gram"  >
                            <option value="">Select Gram</option>
                            <!-- Options will be loaded dynamically -->
                        </select>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Village<span class="required">*</span></td>
                    <td>
                    <select id="village" name="village"  >
                            <option value="">Select Village</option>
                            <!-- Options will be loaded dynamically -->
                        </select>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Area Type<span class="required">*</span></td>
                    <td>
                        <select id="area_type" name="area_type" required>
                            <option value="">Choose Area Type</option>
                            <option value="rural">Rural</option>
                            <option value="urban">Urban</option>
                        </select>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Guardian UID / Aadhar No<span class="required">*</span></td>
                    <td>
                        <input type="text" id="guardian_aadhar" name="guardian_aadhar" placeholder="Enter 12 digit UID/Aadhar No." required>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Candidate Name<span class="required">*</span></td>
                    <td>
                        <input type="text" id="candidate_name" name="candidate_name" placeholder="Enter Candidate Name" required>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Candidate UID / Aadhar No<span class="required">*</span></td>
                    <td>
                        <input type="text" id="candidate_aadhar" name="candidate_aadhar" placeholder="Enter 12 digit UID/Aadhar No." required>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Candidate DOB<span class="required">*</span></td>
                    <td>
                        <input type="date" id="dob" name="dob" required>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Gender<span class="required">*</span></td>
                    <td>
                        <select id="gender" name="gender" required>
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>   
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Caste<span class="required">*</span></td>
                    <td>
                        <select id="caste" name="caste" required>
                            <option value="">Choose Caste Category</option>
                            <option value="general">General</option>
                            <option value="obc">OBC</option>
                            <option value="sc">SC</option>
                            <option value="st">ST</option>
                            <!-- Add more options as needed -->
                        </select>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Mother's Name<span class="required">*</span></td>
                    <td>
                        <input type="text" id="mother_name" name="mother_name" placeholder="Enter Mother's Name" required>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Father/Guardian Name</td>
                    <td>
                        <input type="text" id="father_name" name="father_name" placeholder="Enter Father's Name" required>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Relation with Guardian<span class="required">*</span></td>
                    <td>
                        <select id="relation" name="relation" required>
                            <option value="">Choose type of Relation</option>
                            <option value="father">Father</option>
                            <option value="mother">Mother</option>
                            <option value="guardian">Guardian</option>
                            <option value="uncle">Uncle</option>
                            <option value="aunt">Aunt</option>
                            <!-- Add more options as needed -->
                        </select>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>A/C No<span class="required">*</span></td>
                    <td>
                        <input type="text" id="account_no" name="account_no" placeholder="Enter Account Number" required>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>IFSC Code<span class="required">*</span></td>
                    <td>
                        <input type="text" id="ifsc" name="ifsc" placeholder="Enter IFSC Code" required>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>Education Qualification<span class="required">*</span></td>
                    <td>
                        <select id="qualification" name="qualification" required>
                            <option value="">Choose Qualification</option>
                            <option value="highschool">High School</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="graduate">Graduate</option>
                            <option value="postgraduate">Post Graduate</option>
                            <!-- Add more options as needed -->
                        </select>
                        <span class="error-message"></span>
                    </td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>Contact No<span class="required">*</span></td>
                    <td>
                        <input type="tel" id="contact_no" name="contact_no" placeholder="Enter 10 digit Mobile No." required>
                        <span class="error-message"></span>
                    </td>
                </tr>
            </table>
            <div class="form-actions">
                <button type="submit">Register</button>
            </div>
        </form>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                function loadData(type, type_id){
                    $.ajax({
                        url : "getData.php",
                    type : "POST",
                    data : {type : type, id : type_id},
                    success : function(data){
                        if(type == "gramData"){
                            $("#gram").html(data);
                        } else if(type == "villageData"){
                            $("#village").html(data);
                        }
                    }
                });
                }
                loadData();


                var defaultBlock = $('#block').val();
            if(defaultBlock) {
                loadData("gramData", defaultBlock);
            }
            var defaultGram = $('#gram').val();
            if(defaultGram) {
                loadData("villageData", defaultGram);
            }

            $("#block").on("change", function(){
                var block = $(this).val();
                if(block != ""){
                    loadData("gramData", block);
                } else {
                    $("#gram").html("<option value=''>Select Gram</option>");
                }
            });

            $("#gram").on("change", function(){
                var gram = $(this).val();
                if(gram != ""){
                    loadData("villageData", gram);
                } else {
                    $("#village").html("<option value=''>Select Village</option>");
                }
            });
        });
    </script>
    </body>
    </html>