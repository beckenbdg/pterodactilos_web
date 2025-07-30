<?php
date_default_timezone_set('America/Mexico_City');
$target_dir = "archivos_fms/";
$target_file = $target_dir . basename($_FILES["archivo"]["name"]);
$uploadOk = 1;
$tipoArchivo = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verifica si es un archivo txt
if($tipoArchivo != "fms") {
  echo "Solo se permiten archivos .fms.";
  $uploadOk = 0;
}

// Verifica si el archivo ya existe
if (file_exists($target_file)) {
  echo "El archivo ya existe.";
  $uploadOk = 0;
}

// Intenta subir el archivo si todo está bien
if ($uploadOk == 0) {
  echo "El archivo no se pudo subir.";
} else {
  if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
    echo "El archivo ". htmlspecialchars(basename($_FILES["archivo"]["name"])) . " ha sido subido.";

    // ✅ Comenzamos a leer el archivo para obtener origen y destino
    $lineas = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (count($lineas) >= 8) {
        $origen = trim(substr($lineas[3], 5));      // Línea 4, desde posición 6
        $destino = trim(substr($lineas[7], 5));     // Línea 8, desde posición 6
        $nombreArchivo = basename($_FILES["archivo"]["name"]);

        // Conexión a la base de datos
        $conn = new mysqli("localhost", "usrptero", "Pt3r0dactilos", "pterodactilos");


        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO flight_plans (file_name, origin_icao, destination_icao) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombreArchivo, $origen, $destino);

        if ($stmt->execute()) {
            echo "<br>Plan de vuelo registrado en la base de datos.";
        } else {
            echo "<br>Error al insertar en la base de datos: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<br>Error: el archivo no tiene suficientes líneas.";
    }

  } else {
    echo "Hubo un error al subir el archivo.";
  }
}
?>
