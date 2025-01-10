<?php
include 'connection.php';

if (isset($_POST['submit'])) {

$name = $_POST['name'];
$subject = $_POST['subject'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];

$stmt= $conn->prepare("INSERT INTO contact_us (name,subject,phone,email,message) values(?,?,?,?,?)");

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("sssss", $name, $subject, $phone, $email, $message);

if ($stmt->execute()) {
    header('Location: http://localhost/GreenBasket/client/Contact Form Confirm HTML and CSS.html');
    exit;
} else {
    echo "Error executing query: " . $stmt->error;
}
$stmt->close();
}
$conn->close();

?>