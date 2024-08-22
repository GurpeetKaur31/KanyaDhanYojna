<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="dashboard_css.css">
    <style>
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    include '../connection/config.php';
    session_start();
    if (!isset($_SESSION['name'])) {
        header("Location: login_sector.php");
        exit();
    }
    ?>
    <div class="container">
        <div class="sidebar">
            <h2>Aadhar Panel</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Aadhar Entry</a></li>
                <li><a href="#">Update Aadhar</a></li>
                <li><a href="#">Report Aadhar</a></li>
            </ul>
        </div>


        <div class="content">
            <h1>New Aadhar Log 2024-25</h1>
            <div class="table-actions">
                <button class="btn" id="openModal">+ Register New Aadhar Log</button>
        </div>
            <div class="container mt-5">
       
        <table id="candidateTable" class="table table-striped">
            <thead>
                <tr>
                    <th>District</th>
                    <th>Block</th>
                    <!-- <th>Gram</th>
                    <th>Village</th> -->
                    <th>Area Type</th>
                    <th>Guardian UID</th>
                    <th>Candidate Name</th>
                    <th>Candidate UID</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Caste</th>
                    <th>Mother's Name</th>
                    <th>Father's/Guardian's Name</th>
                    <th>Relation with Guardian</th>
                    <th>Account Number</th>
                    <th>IFSC Code</th>
                    <th>Education Qualification</th>
                    <th>Contact Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM candidates WHERE district = '" . htmlspecialchars($_SESSION['district']) . "' AND block = '" . htmlspecialchars($_SESSION['block']) . "'";
                $result = mysqli_query($con, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['district']}</td>
                        <td>{$row['block']}</td>
                        <td>{$row['area_type']}</td>
                        <td>{$row['guardian_aadhar']}</td>
                        <td>{$row['candidate_name']}</td>
                        <td>{$row['candidate_aadhar']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['caste']}</td>
                        <td>{$row['mother_name']}</td>
                        <td>{$row['father_name']}</td>
                        <td>{$row['relation']}</td>
                        <td>{$row['account_no']}</td>
                        <td>{$row['ifsc']}</td>
                        <td>{$row['qualification']}</td>
                        <td>{$row['contact_no']}</td>
                    </tr>";
                }
            }else{
                echo "<tr>
            <td colspan='18' style='text-align: center;'>No data available in the table</td>
          </tr>";
            }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#candidateTable').DataTable();
        });
    </script>

        </div>
    </div>


        <!-- Add more dashboard content here -->

         <!-- The Modal -->
         <div id="candidateModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="modalBody">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>

    </div>


        <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Open the modal
            $('#openModal').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'CandidateReistrationForm.php',
                    type: 'GET',
                    data: {
                    district: '<?php echo htmlspecialchars($_SESSION['district']); ?>',
                    block: '<?php echo htmlspecialchars($_SESSION['block']); ?>'
                },
                    success: function(data) {
                        $('#modalBody').html(data);
                        $('#candidateModal').show();
                    },
                    error: function() {
                        alert('An error occurred while loading the form.');
                    }
                });
            });

            // Close the modal
            $('.close').click(function() {
                $('#candidateModal').hide();
            });

            $(window).click(function(event) {
                if ($(event.target).is('#candidateModal')) {
                    $('#candidateModal').hide();
                }
            });
        });
    </script>
</body>
</html>
