<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['fullname'];
    $email = $_POST['email'];
    $telefono = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO clientes (nombre, email, telefono, password)
            VALUES ('$nombre', '$email', '$telefono', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado correctamente ✅";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
