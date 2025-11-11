<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $telefono = $_POST['phone'];
    $motivo = $_POST['reason'];
    $mensaje = $_POST['message'];

    $sql = "INSERT INTO contactos (nombre, email, telefono, motivo, mensaje)
            VALUES ('$nombre', '$email', '$telefono', '$motivo', '$mensaje')";

    if ($conn->query($sql) === TRUE) {
        echo "Mensaje guardado correctamente ✅";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>