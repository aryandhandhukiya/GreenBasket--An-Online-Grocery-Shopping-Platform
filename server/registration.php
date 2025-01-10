<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email']; 
    $pass = $_POST['pass'];   

    $stmt = $conn->prepare("INSERT INTO user_authentication (email, pass) VALUES (?, ?)");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $pass);

    if ($stmt->execute()) {
        header('Location: http://localhost/GreenBasket/client/Home Page HTML.html');
        exit;
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
