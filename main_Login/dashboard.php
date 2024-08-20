<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <!-- <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
        <p>This is your dashboard. You can access all the features here.</p>
        <p>District: <?php echo htmlspecialchars($_SESSION['district']); ?></p>
        <p>Block: <?php echo htmlspecialchars($_SESSION['block']); ?></p>
        <p>Sector: <?php echo htmlspecialchars($_SESSION['sector']); ?></p> -->


        <div class="content">
            <h1>New Aadhar Log 2024-25</h1>
            <div class="table-actions">
                <button class="btn" id="openModal">+ Register New Aadhar Log</button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>District</th>
                            <th>Project</th>
                            <th>Sector</th>
                            <th>Acknowledgement Number</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Remarks</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="11" style="text-align: center;">No data available in table</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


        <!-- Add more dashboard content here -->

        <!-- Link to open the modal -->
        <!-- <div class="form-actions">
            <button id="openModal" class="btn">Register Candidate</button>
        </div> -->


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
