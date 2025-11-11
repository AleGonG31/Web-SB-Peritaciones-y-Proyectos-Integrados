<?php
include 'db.php';

if (!$conn) {
    die("❌ Error de conexión con la base de datos");
}

$clientes = $conn->query("SELECT * FROM clientes ORDER BY fecha_registro DESC");
$contactos = $conn->query("SELECT * FROM contactos ORDER BY fecha_envio DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel de Administración - SB Peritaciones</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f2f4f8;
    color: #333;
    margin: 0;
    padding: 0;
  }
  h1 {
    background: #3b82f6;
    color: white;
    text-align: center;
    padding: 1rem 0;
    margin-bottom: 2rem;
  }
  section {
    width: 90%;
    max-width: 1100px;
    margin: 2rem auto;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
  }
  th, td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    text-align: left;
  }
  th {
    background: #3b82f6;
    color: white;
  }
  tr:hover {
    background: #f1f5ff;
  }
  .no-data {
    text-align: center;
    color: gray;
    font-style: italic;
  }
</style>
</head>
<body>

<h1>Panel de Administración</h1>

<section>
  <h2>👥 Clientes registrados</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>Contraseña</th>
      <th>Fecha de Registro</th>
    </tr>
    <?php if ($clientes->num_rows > 0): ?>
      <?php while ($row = $clientes->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['nombre']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['telefono']) ?></td>
          <td><?= htmlspecialchars(substr($row['password'], 0, 25)) ?>...</td>
          <td><?= $row['fecha_registro'] ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="6" class="no-data">No hay clientes registrados aún.</td></tr>
    <?php endif; ?>
  </table>
</section>

<section>
  <h2>📩 Formularios de Contacto</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>Motivo</th>
      <th>Mensaje</th>
      <th>Fecha</th>
    </tr>
    <?php if ($contactos->num_rows > 0): ?>
      <?php while ($row = $contactos->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['nombre']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['telefono']) ?></td>
          <td><?= htmlspecialchars($row['motivo']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['mensaje'])) ?></td>
          <td><?= $row['fecha_envio'] ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7" class="no-data">No hay mensajes aún.</td></tr>
    <?php endif; ?>
  </table>
</section>

</body>
</html>