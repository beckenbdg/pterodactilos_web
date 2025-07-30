<?php 
date_default_timezone_set('America/Mexico_City');
$directorio = __DIR__ . "/archivos_fms/";

if (!is_dir($directorio)) {
  echo "<p>No hay archivos disponibles.</p>";
  return;
}

$archivos = array_diff(scandir($directorio), array('.', '..'));

// Ordenar por fecha de creación (más reciente al más antiguo)
usort($archivos, function($a, $b) use ($directorio) {
    return filectime($directorio . $b) - filectime($directorio . $a);
});

if (empty($archivos)) {
  echo "<p>No hay archivos disponibles.</p>";
  return;
}

echo "<ul style='list-style: none; padding: 0;'>";

foreach ($archivos as $archivo) {
    $ruta = $directorio . $archivo;

    $timestamp = filectime($ruta);
    $fecha = date("Y-m-d H:i:s", $timestamp);

    echo "<li class='archivo'>";
    echo "📄 <strong>$archivo</strong><br>";
    echo "<small>📅 Creado: $fecha</small><br>";
    echo "<a href='archivos_fms/$archivo' download>⬇️ Descargar</a>";
    echo "</li><hr>";
}

echo "</ul>";
?>
