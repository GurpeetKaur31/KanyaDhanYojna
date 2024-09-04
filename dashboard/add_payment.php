<?php
include '../connection/config.php';
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login_sector.php");
    exit();
}

// Get candidate ID from URL
$id = $_GET['id'];

// Fetch candidate details from the database using the ID
$sql = "SELECT * FROM candidates WHERE id = '$id'";
$result = mysqli_query($con, $sql);
$candidate = mysqli_fetch_assoc($result);

// Check if candidate exists
if (!$candidate) {
    die("Candidate not found.");
}

// Get the correct candidate_id for foreign key reference
$candidate_id = $candidate['candidate_id'];

// Check if the candidate already has an active policy
$sql = "SELECT * FROM payments WHERE candidate_id = '$candidate_id' AND policy_status = 'active'";
$result = mysqli_query($con, $sql);
$active_policy = mysqli_fetch_assoc($result);

$can_make_payment = true;
$valid_upto = '';
$due_date = '';
if ($active_policy) {
    $due_date = $active_policy['due_date'];
    $valid_upto = $active_policy['valid_upto'];
    $policy_id = $active_policy['policy_id'];  // Use the existing policy ID
    $current_date = date('Y-m-d');

    // Check if the due date has passed
    if ($current_date < $due_date) {
        $can_make_payment = false;
    }
} else {
    // Generate a new policy ID if none exists
    $x = substr($candidate['candidate_name'], 0, 4); // First four alphabets of the candidate name
    $y = date("Y"); // Current year
    $z = rand(1000, 9999); // Random number
    $policy_id = strtoupper($x . $y . $z);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $can_make_payment) {
    $amount = 1000; // Monthly payment
    $start_date = $_POST['start_date'];

    // Calculate the end date (14 years from the start date)
    $end_date = date('Y-m-d', strtotime('+14 years', strtotime($start_date)));

    // Calculate due date for next payment (one month from start date)
    $due_date = date('Y-m-d', strtotime('+1 month', strtotime($start_date)));

    if ($active_policy) {
        // Update the existing payment details in the database
        $sql = "UPDATE payments SET 
                amount = '$amount', 
                start_date = '$start_date', 
                valid_upto = '$end_date', 
                due_date = '$due_date', 
                policy_status = 'active' 
                WHERE candidate_id = '$candidate_id' AND policy_status = 'active'";
        
        if (mysqli_query($con, $sql)) {
            echo "Payment updated successfully!";
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        // Insert new payment details if no active policy exists
        $sql = "INSERT INTO payments (policy_id, candidate_id, amount, start_date, valid_upto, due_date, policy_status) 
                VALUES ('$policy_id', '$candidate_id', '$amount', '$start_date', '$end_date', '$due_date', 'active')";
        
        if (mysqli_query($con, $sql)) {
            echo "Payment added successfully!";
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            background: linear-gradient(145deg, #ffffff, #e0e0e0);
            border: none;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 1rem 1rem 0 0;
            padding: 1rem;
            font-size: 1.5rem;
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .text-muted {
            color: #6c757d !important;
        }
        .card-body {
            padding: 2rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            Add Payment for <?php echo htmlspecialchars($candidate['candidate_name']); ?>
        </div>
        <div class="card-body">
            <?php if (!$can_make_payment): ?>
                <div class="alert alert-warning" role="alert">
                    You cannot make a payment before the due date. The next payment can be made on or after <?php echo htmlspecialchars($due_date); ?>.
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="policy_id" class="form-label">Policy ID</label>
                    <input type="text" class="form-control" id="policy_id" name="policy_id" value="<?php echo htmlspecialchars($policy_id); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required <?php if (!$can_make_payment) echo 'disabled'; ?>>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" value="1000" readonly>
                </div>

                <?php if ($valid_upto && $due_date): ?>
                    <div class="mb-3">
                        <label for="valid_upto" class="form-label">Valid Upto</label>
                        <input type="date" class="form-control" id="valid_upto" name="valid_upto" value="<?php echo htmlspecialchars($valid_upto); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo htmlspecialchars($due_date); ?>" readonly>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary" <?php if (!$can_make_payment) echo 'disabled'; ?>>Add Payment</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
