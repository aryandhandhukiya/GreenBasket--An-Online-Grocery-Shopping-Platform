<?php
include 'connection.php'; // Include your database connection

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $locality = trim($_POST['locality']);
    $pincode = trim($_POST['pincode']);
    $contact = (int)$_POST['contact'];
    $date = trim($_POST['date']);
    $time_slot = (float)$_POST['time_slot'];

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO orders (name, address, email, locality, pincode, contact, date, time_slot)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters to the query
    $stmt->bind_param("ssssssss", $name, $address, $email, $locality, $pincode, $contact, $date, $time_slot);
    if ($stmt->execute()) {
        // Redirect to the Home Page on successful insertion
        header('Location: http://localhost/GreenBasket/client/Payment HTML.html');
        exit;
    } else {
        // Handle execution error
        echo "Error inserting record: " . $stmt->error;
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
