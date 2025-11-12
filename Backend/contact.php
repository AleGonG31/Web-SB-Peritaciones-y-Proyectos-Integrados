<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contactos (name, email, phone, reason, message)
            VALUES ('$name', '$email', '$phone', '$reason', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Mensaje guardado correctamente.";
    } else {
        echo "❌ Error al guardar el mensaje: " . $conn->error;
    }

    $conn->close();
}
?>