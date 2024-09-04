<?php
session_start(); // Start the session

include '../connection/config.php';  // Ensure this file contains your database connection

if (isset($_POST['Pay_submit'])) {
    // Sanitize and validate input data
    $candidate_id = mysqli_real_escape_string($con, $_POST['candidate_id']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $payment_date = mysqli_real_escape_string($con, $_POST['payment_date']);

    // Store selected candidate ID in the session
    $_SESSION['candidate_id'] = $candidate_id;

    // Prepare the SQL statement for inserting payment record
    $sql = "INSERT INTO payments (candidate_id, amount, payment_date) VALUES ('$candidate_id', '$amount', '$payment_date')";

    // Execute the query and check the result
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Payment updated successfully');</script>";
        echo "<script>window.location.href='Login_type_page.php'</script>";
    } else {
        echo "<script>alert('Data not inserted successfully: " . mysqli_error($con) . "');</script>";
    }

    // Close the connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">
  <h2>Add Payment</h2>
  <form action="" method="post">
    <div class="mb-3">
      <label for="candidate_id" class="form-label">Candidate ID:</label>
      <input type="text" name="candidate_id" class="form-control" id="candidate_id" value="<?php 
         if (isset($_GET['candidate_id'])) {
             $candidate_id = mysqli_real_escape_string($con, $_GET['candidate_id']);
             $sql = "SELECT candidate_id FROM candidates WHERE candidate_id='$candidate_id'";
             $result = mysqli_query($con, $sql);
             if (mysqli_num_rows($result) > 0) {
                 $row = mysqli_fetch_assoc($result);
                 echo $row['candidate_id'];
             }
         }
      ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="amount" class="form-label">Amount:</label>
      <input type="text" class="form-control" id="amount" placeholder="Enter payment amount" name="amount" required>
    </div>
    <div class="mb-3">
      <label for="payment_date" class="form-label">Payment Date:</label>
      <input type="date" name="payment_date" class="form-control" id="payment_date" required>
    </div>
    <button type="submit" name="Pay_submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
