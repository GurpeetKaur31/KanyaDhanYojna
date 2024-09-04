<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <title>Verified Accounts</title>

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
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
        }

        .table {
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

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    include '../connection/config.php';
    session_start();

    // Query to get verified accounts
    $sql = "SELECT * FROM candidates WHERE district = '{$_SESSION['district']}' AND status = 'Approved'";
    $result = mysqli_query($con, $sql) or die("Error");
    ?>

    <div class="container mt-5">
        <div class="card">
            <h3>Verified Account Details</h3>
            <div class="table-responsive">
                <table id="example" class="table table-bordered">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
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
                        } else {
                            echo "<tr><td colspan='16' class='text-center'>No records found</td></tr>";
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
