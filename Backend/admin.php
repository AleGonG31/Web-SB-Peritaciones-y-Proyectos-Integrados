<?php
include 'db.php';

$clientes = $conexion->query("SELECT * FROM clientes ORDER BY fecha_registro DESC");
$contactos = $conexion->query("SELECT * FROM contactos ORDER BY fecha_envio DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel de Administración - SB Peritaciones</title>
<style>
  body { font-family: Arial; background: #f2f4f8; margin: 0; padding: 0; }
  h1 { background: #3b82f6; color: white; text-align: center; padding: 1rem; }
  section {
    width: 90%; max-width: 1100px; margin: 2rem auto; background: white;
    padding: 2rem; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }
  table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
  th, td { padding: 10px; border-bottom: 1px solid #ccc; text-align: left; }
  th { background: #3b82f6; color: white; }
  tr:hover { background: #f1f5ff; }
  .no-data { text-align: center; color: gray; font-style: italic; }
</style>
</head>
<body>

<h1>Panel de Administración</h1>

<section>
  <h2>👥 Clientes registrados</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre Completo</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>Contraseña</th>
      <th>Fecha</th>
    </tr>

    <?php if ($clientes->num_rows > 0): ?>
      <?php while ($row = $clientes->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['fullname']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= htmlspecialchars($row['password']) ?></td>
          <td><?= $row['fecha_registro'] ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7" class="no-data">No hay registros aún.</td></tr>
    <?php endif; ?>

  </table>
</section>

<section>
  <h2>📩 Formularios de contacto</h2>
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
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= htmlspecialchars($row['reason']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
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