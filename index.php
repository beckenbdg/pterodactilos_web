<?php
// index.php
date_default_timezone_set('America/Mexico_City');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pterodáctilos - Centro de Planes de Vuelo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #e0ecf8;
      color: #333;
    }

    header {
      background: #34495e;
      color: #fff;
      padding: 1em;
      text-align: center;
      font-size: 1.4em;
    }

    main {
      max-width: 600px;
      margin: 2em auto;
      background: #fff;
      padding: 2em;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    h2 {
      margin-top: 0;
      color: #2c3e50;
    }

    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin: 1em 0;
    }

    button {
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9;
    }

    .mensaje {
      padding: 10px;
      margin-bottom: 1em;
      border-radius: 5px;
      display: none;
    }

    .exito {
      background-color: #d4edda;
      color: #155724;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
    }

    .lista-archivos {
      margin-top: 2em;
    }

    .archivo {
      margin-bottom: 10px;
    }

    .archivo a {
      text-decoration: none;
      color: #2980b9;
    }

    .archivo a:hover {
      text-decoration: underline;
    }

    footer {
      text-align: center;
      margin-top: 4em;
      font-size: 0.9em;
      color: #888;
    }

    @media (max-width: 600px) {
      main {
        margin: 1em;
        padding: 1.5em;
      }
    }
  </style>
</head>
<body>

<header>
  <img src="img/LOGO-PTERO-PLAIN.png" alt="Pterodáctilos - Planes de Vuelo" style="width:100%; max-width:600px;">
</header>

<main>
  <h2>Subir archivo .fms</h2>

  <?php
  if (isset($_GET['status'])) {
    if ($_GET['status'] === 'ok') {
      echo '<div class="mensaje exito">✅ Archivo subido correctamente.</div>';
    } elseif ($_GET['status'] === 'error') {
      echo '<div class="mensaje error">❌ Error al subir el archivo.</div>';
    } elseif ($_GET['status'] === 'invalido') {
      echo '<div class="mensaje error">⚠️ Archivo inválido o estructura incorrecta.</div>';
    }
  }
  ?>

  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="archivo" accept=".fms" required>
    <button type="submit">Subir archivo</button>
  </form>

  <div class="lista-archivos">
    <h2>Archivos disponibles:</h2>
    <?php include("listar.php"); ?>
  </div>
</main>

<footer>
  © <?=date("Y")?> Grupo de Vuelo Virtual Pterodáctilos ✈️
</footer>

</body>
</html>
