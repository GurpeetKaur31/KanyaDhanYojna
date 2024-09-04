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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            color: #333;
        }

        .sidebar {
            width: 250px;
            padding: 1rem;
            background-color: #120844;
            color: #f7fafc;
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 1rem;
        }

        .sidebar ul li a {
            color: #edf2f7;
            text-decoration: none;
            font-size: 1.1rem;
        }

        .sidebar ul li a:hover {
            color: #e2e8f0;
        }

        .content {
            margin-left: 270px;
            padding: 2rem;
        }

        .table-actions .btn {
            background-color: #4a5568;
            color: #fff;
            padding: 0.6rem 1.2rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .table-actions .btn:hover {
            background-color: #2d3748;
        }

        table thead th {
            background-color: #007bff !important;
            color: #fff;
        }

        table tbody tr {
            background-color: #ffffff;
        }

        table tbody tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        table tbody tr:hover {
            background-color: #e2e8f0;
        }

        .btn-primary {
            background-color: #120844;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2d3748;
        }

    </style>
</head>
<body>
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
        <h1 class="mb-4">New Aadhar Log 2024-25</h1>
        <div class="table-actions mb-3">
            <a href="CandidateRegistrationForm.php?district=<?php echo urlencode($_SESSION['district']); ?>&block=<?php echo urlencode($_SESSION['block']); ?>" class="btn btn-primary">+ Register New Candidate</a>
        </div>
        <div class="table-container mt-5">
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
                        <th>Download Receipt</th>

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
                                    if (empty($row['payment_id'])) {
                                        echo "<a href='add_payment.php?candidate_id={$row['id']}' class='btn btn-primary btn-sm'>Add Payment</a>";
                                    } else {
                                        echo "<span class='text-muted'>No Payment Info</span>";
                                    }
                                echo "</td>
                                <td><a href='receipt.php?candidate_id={$row['id']}' class='btn btn-primary btn-sm'>Download Receipt</a></td>    
                            </tr>";
                        }
                    } else {
                        echo "<tr>
                            <td colspan='18' class='text-center'>No data available in the table</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#candidateTable').DataTable({
                "scrollX": true,
                "scrollY": true
            });
        });
    </script>
</body>
</html>
