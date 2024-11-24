<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado César</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        .container {
            display: flex;
            gap: 20px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        form .input-group {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .radio-group {
            margin-bottom: 15px;
        }

        .radio-group label {
            display: inline-block;
            margin-right: 10px;
            font-weight: normal;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
            vertical-align: middle;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9f7e9;
            color: #2d572d;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            font-size: 16px;
            max-width: 400px;
            text-align: center;
        }

        .integrantes-container {
            background-color: #fff;
            padding: 15px;
            height: 200;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 200px;
            font-size: 14px;
        }

        .integrantes-container h3 {
            margin-top: 0;
            font-size: 16px;
            color: #333;
        }

        .integrantes-container ul {
            list-style: none;
            padding: 0;
        }

        .integrantes-container li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .integrantes-container li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h1>Cifrado César</h1>
            <form class="forms" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="input-group">
                    <label for="mensaje">Mensaje:</label>
                    <input type="text" id="mensaje" name="mensaje" required>
                </div>
                <div class="input-group">
                    <label for="clave">Clave (desplazamiento):</label>
                    <input type="number" id="clave" name="clave" required>
                </div>
                <div class="radio-group">
                    <label>Tipo de operación:</label>
                    <input type="radio" id="encriptar" name="tipo" value="Encriptar">
                    <label for="encriptar">Encriptar</label>
                    <input type="radio" id="desencriptar" name="tipo" value="Desencriptar">
                    <label for="desencriptar">Desencriptar</label>
                </div>
                <input type="submit" value="Procesar">
            </form>

            <?php
            function cifradoCesar($mensaje, $clave, $tipo)
            {
                $resultado = "";
                $mensaje = strtoupper($mensaje);
                $alfabeto = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
                $longitudAlfabeto = strlen($alfabeto);

                for ($i = 0; $i < strlen($mensaje); $i++) {
                    $letra = $mensaje[$i];
                    if ($letra != " ") {
                        $posicion = strpos($alfabeto, $letra);
                        if ($posicion !== false) {
                            if ($tipo == "Encriptar") {
                                $nuevaPosicion = ($posicion + $clave) % $longitudAlfabeto;
                            } elseif ($tipo == "Desencriptar") {
                                $nuevaPosicion = ($posicion - $clave + $longitudAlfabeto) % $longitudAlfabeto;
                            }
                            $resultado .= $alfabeto[$nuevaPosicion];
                        }
                    } else {
                        $resultado .= " ";
                    }
                }

                return $resultado;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $mensaje = $_POST["mensaje"];
                $clave = intval($_POST["clave"]);
                $tipo = $_POST["tipo"];

                $mensajeResultado = cifradoCesar($mensaje, $clave, $tipo);
                echo "<div class='result'>Resultado: " . htmlspecialchars($mensajeResultado) . "</div>";
            }
            ?>
        </div>

        <div class="integrantes-container">
            <h3>Integrantes</h3>
            <ul>
                <li>Traecy Salomé Quiroz Mio</li>
                <li>Wilder Santos Santos</li>
            </ul>
        </div>
    </div>

</body>
</html>