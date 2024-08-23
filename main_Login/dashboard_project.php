<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Kanya Yojna</title>
</head>

<body>
    <?php
    include '../connection/config.php';
    session_start();
    $sql = "SELECT * FROM candidates WHERE  district = '" . htmlspecialchars($_SESSION['district']) . "' AND block = '" . htmlspecialchars($_SESSION['block']) . "'";
    $result = mysqli_query($con, $sql) or die("Error");
    ?>
    <div class=" mt-2">
        <h3 class="text-center mb-3">Account Details</h3>
        <table id="display" class="table table-bordered">
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
                        $bgColor = ($row['status'] == 'Approved') ? 'background-color: lightgreen;' : (($row['status'] == 'Pending') ? 'background-color: lightcoral;' : '');

                        echo "<tr style='$bgColor'>";
                        // echo "<td style='display:none;'>" . $row['sno'] . "</td>";
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
                        <form method='post' action='update_status.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='hidden' name='status' value='Approved'>
                            <button type='submit' class='btn btn-success btn-sm'>Approved</button>
                        </form>
                        <form method='post' action='update_status.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='hidden' name='status' value='Pending'>
                            <button type='submit' class='btn btn-danger btn-sm'>Pending</button>
                        </form>
                      </td>";
                        echo "</tr>";
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