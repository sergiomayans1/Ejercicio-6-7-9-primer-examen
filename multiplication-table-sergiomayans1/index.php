<!DOCTYPE html>
<html>
    <head>
        <title>Tablas de Multiplicar</title>
        <style>
            table {
                width: 50%;
                border-collapse: collapse;
                margin: 20px 0;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 10px;
                text-align: center;
            }
            .gray {
                background-color: grey;
            }
        </style>
    </head>
    <body>

        <form method="POST">
            <label for="input">Introduce los números o rangos (ej. 1-3,5,7): </label><br>
            <input type="text" id="input" name="input" required><br><br>
            <input type="submit" value="Generar Tablas">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = $_POST['input'];

            // Validar la cadena de entrada
            if (preg_match('/^(\d+(-\d+)?)(,\d+(-\d+)?)*$/', $input)) {
                $numeros = procesarCadena($input);
                mostrarTablas($numeros);
            } else {
                echo "<p>Formato incorrecto. Por favor, introduce una cadena válida.</p>";
            }
        }

        function procesarCadena($cadena) {
            $numeros = [];
            $partes = explode(',', $cadena);

            foreach ($partes as $parte) {
                if (strpos($parte, '-') !== false) {
                    list($inicio, $fin) = explode('-', $parte);
                    for ($i = $inicio; $i <= $fin; $i++) {
                        $numeros[] = $i;
                    }
                } else {
                    $numeros[] = $parte;
                }
            }

            return array_unique($numeros); // Eliminar duplicados
        }

        function mostrarTablas($numeros) {
            foreach ($numeros as $numero) {
                echo "<h3>Tabla de multiplicar del $numero</h3>";
                echo "<table>";
                for ($i = 1; $i <= 10; $i++) {
                    $colorClass = $i % 2 == 0 ? "gray" : ""; // Alternar colores
                    echo "<tr class='$colorClass'><td>$numero x $i</td><td>" . ($numero * $i) . "</td></tr>";
                }
                echo "</table>";
            }
        }
        ?>

    </body>
</html>

