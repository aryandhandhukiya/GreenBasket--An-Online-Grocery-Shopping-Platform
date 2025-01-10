<?php
// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader (adjust the path if needed)
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
include 'connection.php'; // Include database connection

// Fetch order details
$query = "SELECT * FROM orders";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customerEmail = $row['email']; // Customer's email
        $orderDetails = "Order Details:\n";
        $orderDetails .= "Name: " . $row['name'] . "\n";
        $orderDetails .= "Address: " . $row['address'] . "\n";
        $orderDetails .= "Locality: " . $row['locality'] . "\n";
        $orderDetails .= "Pincode: " . $row['pincode'] . "\n";
        $orderDetails .= "Contact: " . $row['contact'] . "\n";
        $orderDetails .= "Date: " . $row['date'] . "\n";
        $orderDetails .= "Time Slot: " . $row['time_slot'] . "\n";

        // Send email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // Use Gmail's SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'dhandhukiyaaryan05@gmail.com'; // Gmail address
            $mail->Password   = 'vfms lmfb uhxh fdfx';          // App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Secure encryption
            $mail->Port       = 465;                                 // SMTP port

            // Recipients
            $mail->setFrom('dhandhukiyaaryan05@gmail.com', 'GreenBasket');      // Sender
            $mail->addAddress($customerEmail);                         // Add recipient

            // Content
            $mail->isHTML(true);                                       // Set email format to HTML
            $mail->Subject = 'Order Confirmation - GreenBasket';
            $mail->Body    = nl2br($orderDetails);                     // Convert newlines to <br> for HTML
            $mail->AltBody = $orderDetails;                            // Plain text version

            $mail->send();
            echo "Order email sent to " . $customerEmail . "<br>";
        } catch (Exception $e) {
            echo "Failed to send email to $customerEmail. Error: {$mail->ErrorInfo}<br>";
        }
    }
} else {
    echo "No orders found.";
}

// Close the database connection
$conn->close();
?>
