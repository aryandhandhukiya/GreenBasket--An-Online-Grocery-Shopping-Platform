<?php
    include 'connection.php';

    if (isset($_POST['submit'])){

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $query= "SELECT email, pass FROM user_authentication where email= '$email' and pass= '$pass' ";
    $data= mysqli_query($conn, $query);
    $total =mysqli_num_rows($data);

    if ($total == 1) {
        header('Location: http://localhost/GreenBasket/client/Home Page HTML.html');
    } else {
        echo "Login failed";
    }
}
$conn->close();
?>