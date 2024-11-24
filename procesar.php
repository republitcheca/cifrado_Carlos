<?php
function cifradoCesar($mensaje, $clave, $tipo) {
    $resultado = "";
    $mensaje = mb_strtoupper($mensaje, 'UTF-8');
    $alfabeto = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    $longitudAlfabeto = mb_strlen($alfabeto, 'UTF-8');

    foreach (preg_split('//u', $mensaje, -1, PREG_SPLIT_NO_EMPTY) as $letra) {
        if ($letra !== " " && mb_strpos($alfabeto, $letra, 0, 'UTF-8') !== false) {
            $posicion = mb_strpos($alfabeto, $letra, 0, 'UTF-8');
            $nuevaPosicion = $tipo === "Encriptar"
                ? ($posicion + $clave) % $longitudAlfabeto
                : ($posicion - $clave + $longitudAlfabeto) % $longitudAlfabeto;
            $resultado .= mb_substr($alfabeto, $nuevaPosicion, 1, 'UTF-8');
        } else {
            $resultado .= $letra;
        }
    }

    return $resultado;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mensaje = $_POST["mensaje"] ?? '';
    $clave = intval($_POST["clave"] ?? 0);
    $tipo = $_POST["tipo"] ?? '';

    if (!empty($mensaje) && $clave > 0 && ($tipo === "Encriptar" || $tipo === "Desencriptar")) {
        $mensajeResultado = cifradoCesar($mensaje, $clave, $tipo);
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<h2>Resultado</h2>";
        echo "<p style='background-color: #e9f7e9; color: #2d572d; padding: 10px; border-radius: 4px; display: inline-block;'>" 
            . htmlspecialchars($mensajeResultado) . "</p>";
        echo "<br><a href='index.html' style='text-decoration: none; color: #007bff;'>Regresar</a>";
        echo "</div>";
    } else {
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<h2>Error</h2>";
        echo "<p style='color: #ff0000;'>Por favor complete todos los campos correctamente.</p>";
        echo "<br><a href='index.html' style='text-decoration: none; color: #007bff;'>Regresar</a>";
        echo "</div>";
    }
}
?>
