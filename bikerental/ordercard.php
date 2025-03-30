<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login if the session is not set
    header('Location: login.php');
    exit();
}

require_once("dbconfig.php");

// Fetch logged-in user's name
$username = $_SESSION['username'];

// Fetch bookings for the logged-in user
$sql = "SELECT * FROM MotorcycleBookings WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }

        .container {
            margin-top: 50px;
        }

        table {
            margin-top: 20px;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }

        td, th {
            text-align: center;
            padding: 10px;
        }

        .btn-back {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center">Your Bookings</h1>
    <p class="text-center">Welcome, <strong><?php echo htmlspecialchars($username); ?></strong>! Here are your current bookings:</p>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Motorcycle</th>
                    <th>Pickup Date</th>
                    <th>Drop-off Date</th>
                    <th>Address</th>
                    <th>Additional Accessory</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['desired_motorcycle']); ?></td>
                        <td><?php echo htmlspecialchars($row['pickup_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['dropoff_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['additional_accessory']); ?></td>
                        <td><?php echo htmlspecialchars($row['confirmation']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">You have no bookings yet!</p>
    <?php endif; ?>

    <div class="text-center">
        <button class="btn-back" onclick="window.location.href='index2.html'">Back to Dashboard</button>
    </div>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
