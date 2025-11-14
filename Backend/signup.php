<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO clientes (fullname, email, phone, password) 
            VALUES ('$fullname', '$email', '$phone', '$hashedPassword')";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro guardado correctamente.";
    } else {
        echo "Error al guardar el registro: " . $conexion->error;
    }

    $conexion->close();
}
?>