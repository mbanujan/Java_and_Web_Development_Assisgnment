<?php
session_start(); // Start the session
if (!isset($_SESSION['username'])) {
    // Redirect to login if no session found
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="second.css">
    <style>

.popup {
    width: 400px;
    background: rgb(5, 110, 124);
    border-radius: 10px;
    position: fixed; /* Changed to fixed for better positioning */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.1);
    text-align: center;
    padding: 20px;
    color: rgb(255, 255, 255); /* Adjusted for better contrast */
    visibility: hidden;
    opacity: 0;
    transition: transform 0.4s ease-out, opacity 0.4s;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.open-popup {
    visibility: visible;
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

.popup img {
    width: 100px;
    margin-top: -40px;
    border-radius: 50%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.popup h2 {
    font-size: 32px;
    font-weight: 700;
    margin: 10px 0;
}

.popup p {
    font-size: 18px;
    font-weight: 400;
    margin: 20px 0;
    padding: 10px;
}

.popup button {
    width: 80%;
    padding: 12px 0;
    background: #000000;
    color: white;
    border: none;
    outline: none;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s, background 0.3s;
}

.popup button:hover {
    transform: scale(1.05);
    background: #222222;
}

.input {
    margin-bottom: 15px;
}

.input p {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.input select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 5px;
    background-color: white;
    color: #333;
    cursor: pointer;
    transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

/* Hover and focus effect */
.input select:hover,
.input select:focus {
    border-color: #4CAF50;  /* Green border on focus */
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
}

/* Style the dropdown options */
.input select option {
    font-size: 14px;
    padding: 5px;
    background-color: white;
    color: #333;
}

/* Disabled option */
.input select option[value="none"] {
    font-weight: bold;
    color: #888;
}




button {
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

button[type="submit"] {
    background-color: #28a745;
    color: white;
}

button[type="submit"]:hover {
    background-color: #218838;
    transform: scale(1.05);
}

button[type="button"] {
    background-color: #dc3545;
    color: white;
}

button[type="button"]:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

    </style>
</head>
<body>

    <h1>Welcome to <span>RevUp Rental!</span></h1>
    
    <div class="order" id="order">
        <h1>Book <span>Now!</span></h1>

        <div class="order_main">
            <div class="order_image">
                <img src="images/main 1.png">
            </div>

            <form action="" method="post">
                <div class="input">
                    <p>Name</p>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>
                </div>
            
                <div class="input">
                    <p>Email</p>
                    <input type="email" name="email" placeholder="example@gmail.com" required>
                </div>
            
                <div class="input">
                    <p>Phone Number</p>
                    <input type="text" name="phone_number" placeholder="Phone Number" required>
                </div>
            
                <div class="input">
                    <p>Desired Motorcycle</p>
                    <select name="desired_motorcycle" required>
                        <option value="none">Select Your Motorcycle Here</option>
                        <option value="Triumph Bobber">Triumph Bobber</option>
                        <option value="Yamaha YZF R1">Yamaha YZF R1</option>
                        <option value="RE Classic 350">RE Classic 350</option>
                        <option value="BMW 1250GS Adventure">BMW 1250GS Adventure</option>
                        <option value="BMW S1000RR">BMW S1000RR</option>
                        <option value="TVS Scooter">TVS Scooter</option>
                        <option value="Harley Davidson Fat Bob">Harley Davidson Fat Bob</option>
                        <option value="RE Himalayan 350">RE Himalayan 350</option>
                        <option value="Ducati Diavel">Ducati Diavel</option>
                        <option value="Ducati Panigale">Ducati Panigale</option>
                        <option value="Kawasaki ZX10R">Kawasaki ZX10R</option>
                        <option value="Yamaha YZF R15">Yamaha YZF R15</option>
                        <option value="Kawasaki Z900">Kawasaki Z900</option>
                        <option value="Honda CBR 650">Honda CBR 650</option>
                        <option value="MV Agusta">MV Agusta</option>
                        <option value="RE Classic 500">RE Classic 500</option>
                    </select>
                </div>
            
                <div class="input">
                    <p>Pickup Date</p>
                    <input type="date" name="pickup_date" required>
                </div>
            
                <div class="input">
                    <p>Drop off Date</p>
                    <input type="date" name="dropoff_date" required>
                </div>
            
                <div class="input">
                    <p>Address</p>
                    <input type="text" name="address" placeholder="Your Address" required>
                </div>
            
                <div class="input">
                    <p>Additional Accessories</p>
                    <select name="additional_accessory">
                        <option value="none">Select Your Accessory Here</option>
                        <option value="Helmet">Helmet</option>
                        <option value="Riding Gear">Riding Gear</option>
                        <option value="Panniers">Panniers</option>
                        <option value="Map System">Map System</option>
                    </select>
                </div>
            
                <button type="submit">Submit Booking!</button>
                <button type="button" onclick="goBack()">Back</button>
            </form>
            
            <!-- Popup section -->
            <div class="popup" id="popup"> 
                <img src="images/check2.png">
                <h2>Thank You!</h2>
                <p>Your Details Have Been Successfully Submitted! <br>
                   Stay Tuned to ride one of our BEASTS!</p>
                <button type="button" onclick="closePopup()">OK</button>
            </div>
        </div>
    </div>

    <script>
        let popup = document.getElementById("popup");

        function openPopup() {
            popup.classList.add("open-popup");
        }

        function closePopup() {
            popup.classList.remove("open-popup");
        }

        function goBack() {
            window.location.href = "index2.html";  // Redirects to index2.html
        }
    </script>

</body>
</html>

<?php
require_once("dbconfig.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $desired_motorcycle = $_POST['desired_motorcycle'];
    $pickup_date = $_POST['pickup_date'];
    $dropoff_date = $_POST['dropoff_date'];
    $address = $_POST['address'];
    $additional_accessory = $_POST['additional_accessory'];

    // SQL Insert statement
    $sql = "INSERT INTO MotorcycleBookings (name, email, phone_number, desired_motorcycle, pickup_date, dropoff_date, address, additional_accessory)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $email, $phone_number, $desired_motorcycle, $pickup_date, $dropoff_date, $address, $additional_accessory);

    if ($stmt->execute()) {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    openPopup();
                });
              </script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '");</script>';
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
