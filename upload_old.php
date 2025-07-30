<?php
$directorio = __DIR__ . "/archivos_fms/";

if (!is_dir($directorio)) {
    mkdir($directorio, 0755, true);
}

function redir($tipo) {
    header("Location: index.php?status=$tipo");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["archivo"])) {
    $archivo = $_FILES["archivo"];
    $nombre_original = basename($archivo["name"]);
    $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));

    if ($extension !== "fms") {
        redir("invalido");
    }

    // Validar MIME real
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $archivo["tmp_name"]);
    finfo_close($finfo);

    if ($mime !== "text/plain") {
        redir("invalido");
    }

    // Tamaño máximo 500KB
    if ($archivo["size"] > 500 * 1024) {
        redir("invalido");
    }

    // Validar contenido interno
    $lineas = file($archivo["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (count($lineas) < 8) {
        redir("invalido");
    }

    if (
        trim($lineas[0]) !== "I" ||
        stripos($lineas[1], "1100") !== 0 ||
        stripos($lineas[3], "ADEP") !== 0 ||
        stripos($lineas[7], "ADES") !== 0
    ) {
        redir("invalido");
    }

    // Validar si ya existe un archivo con ese nombre
    $ruta_destino = $directorio . $nombre_original;
    if (file_exists($ruta_destino)) {
        redir("duplicado");
    }

    // Subir con nombre original
    if (move_uploaded_file($archivo["tmp_name"], $ruta_destino)) {
        redir("ok");
    } else {
        redir("error");
    }

} else {
    redir("error");
}
