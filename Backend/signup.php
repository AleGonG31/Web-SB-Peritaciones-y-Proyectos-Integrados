<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO clientes (fullname, email, phone, password)
            VALUES ('$fullname', '$email', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Registro guardado correctamente.";
    } else {
        echo "❌ Error al guardar el registro: " . $conn->error;
    }

    $conn->close();
}
?>
