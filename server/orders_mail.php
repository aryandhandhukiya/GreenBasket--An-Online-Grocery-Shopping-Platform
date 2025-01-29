<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
include 'connection.php';

if (isset($_POST['submit'])) {
    $query = "SELECT * FROM orders";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customerEmail = $row['email'];
            $orderDetails = "Order Details:\n";
            $orderDetails .= "Name: " . $row['name'] . "\n";
            $orderDetails .= "Address: " . $row['address'] . "\n";
            $orderDetails .= "Locality: " . $row['locality'] . "\n";
            $orderDetails .= "Pincode: " . $row['pincode'] . "\n";
            $orderDetails .= "Contact: " . $row['contact'] . "\n";
            $orderDetails .= "Date: " . $row['date'] . "\n";
            $orderDetails .= "Time Slot: " . $row['time_slot'] . "\n";

            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'dhandhukiyaaryan05@gmail.com';
                $mail->Password   = 'vfms lmfb uhxh fdfx';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('dhandhukiyaaryan05@gmail.com', 'GreenBasket');
                $mail->addAddress($customerEmail);

                $mail->isHTML(true);
                $mail->Subject = 'Order Confirmation - GreenBasket';
                $mail->Body    = nl2br($orderDetails);
                $mail->AltBody = $orderDetails;

                $mail->send();
                //echo "Order email sent to " . $customerEmail . "<br>";
            } catch (Exception $e) {
                error_log("Failed to send email to $customerEmail. Error: {$mail->ErrorInfo}");
            }
        }
    } else {
        echo "No orders found.";
    }
    $conn->close();
}
header("Location: http://localhost/GreenBasket/client/Payment Confirmation HTML and CSS.html");
exit();
?>
