<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <title>Kanya Yojna</title>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #212529;
        }

        h3 {
            margin-top: 20px;
            font-weight: 700;
            color: #003d7a; /* Deep Blue */
            text-align: center;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ced4da;
        }

        table {
            width: 100%;
            margin-bottom: 0;
        }

        th, td {
            vertical-align: middle;
            text-align: center;
            padding: 10px;
        }

        .table thead th {
            background-color: #004d40; /* Dark Teal */
            color: #ffffff;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .status-approved {
            background-color: #d4edda; /* Light Green */
            color: #155724; /* Dark Green */
            font-weight: bold;
        }

        .status-pending {
            background-color: #f8d7da; /* Light Red */
            color: #721c24; /* Dark Red */
            font-weight: bold;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 14px;
        }

        .btn-success {
            background-color: #28a745; /* Green */
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545; /* Red */
            border-color: #dc3545;
        }

        .btn-success:hover {
            background-color: #218838; /* Darker Green */
            border-color: #1e7e34;
        }

        .btn-danger:hover {
            background-color: #c82333; /* Darker Red */
            border-color: #bd2130;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    include '../connection/config.php';
    session_start();
    $sql = "SELECT * FROM candidates WHERE district = '" . htmlspecialchars($_SESSION['district']) . "' AND block = '" . htmlspecialchars($_SESSION['block']) . "'";
    $result = mysqli_query($con, $sql) or die("Error");
    ?>
    
    <div class="container mt-5">
        <div class="card">
            <h3>Account Details</h3>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $rowClass = ($row['status'] == 'Approved') ? 'status-approved' : 'status-pending';

                                echo "<tr class='$rowClass'>";
                                echo "<td>" . $row['district'] . "</td>";
                                echo "<td>" . $row['block'] . "</td>";
                                echo "<td>" . $row['area_type'] . "</td>";
                                echo "<td>" . $row['guardian_aadhar'] . "</td>";
                                echo "<td>" . $row['candidate_name'] . "</td>";
                                echo "<td>" . $row['candidate_aadhar'] . "</td>";
                                echo "<td>" . $row['dob'] . "</td>";
                                echo "<td>" . $row['gender'] . "</td>";
                                echo "<td>" . $row['caste'] . "</td>";
                                echo "<td>" . $row['mother_name'] . "</td>";
                                echo "<td>" . $row['father_name'] . "</td>";
                                echo "<td>" . $row['relation'] . "</td>";
                                echo "<td>" . $row['account_no'] . "</td>";
                                echo "<td>" . $row['ifsc'] . "</td>";
                                echo "<td>" . $row['qualification'] . "</td>";
                                echo "<td>" . $row['contact_no'] . "</td>";
                                echo "<td>
                                    <form method='post' action='update_status.php' class='d-inline'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <input type='hidden' name='status' value='Approved'>
                                        <button type='submit' class='btn btn-success btn-sm'>
                                            <i class='bi bi-check-circle'></i> Approve
                                        </button>
                                    </form>
                                    <form method='post' action='update_status.php' class='d-inline'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <input type='hidden' name='status' value='Pending'>
                                        <button type='submit' class='btn btn-danger btn-sm'>
                                            <i class='bi bi-x-circle'></i> Pending
                                        </button>
                                    </form>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='17' class='text-center'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap and DataTables Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                scrollX: true,
                scrollY: 300,
                responsive: true,
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>

</body>

</html>
