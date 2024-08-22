<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Verified Accounts</title>
</head>

<body>
    <?php
    include '../connection/config.php';
    session_start();

    // Query to get verified accounts
    $sql = "SELECT * FROM candidates WHERE district = '{$_SESSION['district']}' AND status = 'Approved'";
    $result = mysqli_query($con, $sql) or die("Error");

    ?>
    <div class="container mt-2">
        <h3 class="text-center mb-3">Verified Account Details</h3>
        <table class="table table-bordered">
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
                if (mysqli_num_rows($result) > 0) {
                    $count = 1;
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
                    echo "<tr><td colspan='21' class='text-center'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
