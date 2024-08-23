<?php
include '../connection/config.php';
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login_sector.php");
    exit();
}

$sql = "SELECT c.*, p.id AS payment_id FROM candidates c 
    LEFT JOIN payments p ON c.id = p.candidate_id
    WHERE c.district = '{$_SESSION['district']}' AND c.status = 'Approved'";
$result = mysqli_query($con, $sql) or die("Error");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <style>
        /* Custom Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050; /* Ensures modal is on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Allows scrolling if modal content exceeds viewport */
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            overflow: auto; /* Allows modal content to scroll if necessary */
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
        .sidebar {
            width: 200px;
            float: left;
            margin-right: 20px;
        }
        .content {
            margin-left: 220px;
        }
    </style>
</head>
<body>
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
            <div class="table-actions mb-3">
                <button class="btn btn-primary" id="openModal">+ Register New Aadhar Log</button>
            </div>
            <div class="container mt-5">
                <table id="candidateTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>District</th>
                            <th>Block</th>
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
                            <th>Payment Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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
                                    <td>";
                                        if (!empty($row['payment_id'])) {
                                            echo "<button class='btn btn-primary btn-sm' onclick='openPaymentModal({$row['payment_id']})'>Add Payment</button>";
                                        } else {
                                            echo "No Payment Info";
                                        }
                                    echo "</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr>
                                <td colspan='18' style='text-align: center;'>No data available in the table</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Payment Modal -->
            <div id="paymentModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closePaymentModal()">&times;</span>
                    <form method="post" action="add_payment.php">
                        <input type="hidden" name="payment_id" id="paymentId">
                        <div class="mb-3">
                            <label for="initialPayment" class="form-label">Initial Payment</label>
                            <input type="number" class="form-control" id="initialPayment" name="initial_payment" required>
                        </div>
                        <div class="mb-3">
                            <label for="partialPayment" class="form-label">Partial Payment</label>
                            <input type="number" class="form-control" id="partialPayment" name="partial_payment" required>
                        </div>
                        <div class="mb-3">
                            <label for="paymentDate" class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="paymentDate" name="payment_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="policyId" class="form-label">Policy ID</label>
                            <input type="text" class="form-control" id="policyId" name="policy_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="validUpto" class="form-label">Valid Upto</label>
                            <input type="date" class="form-control" id="validUpto" name="valid_upto" required>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Candidate Modal -->
    <div id="candidateModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalBody"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#candidateTable').DataTable({
                "scrollX": true
            });

            // Open the candidate modal
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

            // Close the candidate modal
            $('.close').click(function() {
                $('#candidateModal').hide();
            });

            $(window).click(function(event) {
                if ($(event.target).is('#candidateModal')) {
                    $('#candidateModal').hide();
                }
            });
        });

        function openPaymentModal(paymentId) {
            document.getElementById('paymentId').value = paymentId;
            document.getElementById('paymentModal').style.display = "block";
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = "none";
        }
    </script>
</body>
</html>
