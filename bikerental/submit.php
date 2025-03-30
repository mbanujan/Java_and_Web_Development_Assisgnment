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
                let popup = document.getElementById("popup");
                function openPopup() {
                    popup.classList.add("open-popup");
                }
                function closePopup() {
                    popup.classList.remove("open-popup");
                }
                // Ensure the back button redirects to index2.html
                window.addEventListener("popstate", function () {
                    window.location.href = "index2.html";
                });
                // Add an entry to the history stack
                history.pushState(null, "", window.location.href);
                openPopup();
              </script>';
    } else {
        echo '<script>
                alert("Error: ' . $conn->error . '");
              </script>';
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>