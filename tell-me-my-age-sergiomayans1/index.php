<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calcular Edad</title>
    </head>
    <body>

        <h2>Introduce tu fecha de nacimiento (dd/mm/yyyy):</h2>
        <form method="POST">
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" required>
            <input type="submit" value="Calcular Edad">
        </form>

        <?php

        // Función para validar si el año es bisiesto
        function esBisiesto($anio) {
            return ($anio % 4 == 0 && ($anio % 100 != 0 || $anio % 400 == 0));
        }

        // Función para validar el formato y la fecha
        function validarFecha($fecha) {
            $partes = explode('/', $fecha);
            if (count($partes) == 3) {
                $dia = (int) $partes[0];
                $mes = (int) $partes[1];
                $anio = (int) $partes[2];

                // Comprobar si la fecha es válida
                if (checkdate($mes, $dia, $anio)) {
                    return true;
                } else {
                    echo "La fecha no es válida.<br>";
                }
            } else {
                echo "El formato de la fecha debe ser dd/mm/yyyy.<br>";
            }
            return false;
        }

        // Función para verificar si la fecha ingresada es futura
        function esFechaFutura($dia, $mes, $anio) {
            $fecha_actual = getdate();
            $dia_actual = $fecha_actual['mday'];
            $mes_actual = $fecha_actual['mon'];
            $anio_actual = $fecha_actual['year'];

            if ($anio > $anio_actual || ($anio == $anio_actual && $mes > $mes_actual) ||
                    ($anio == $anio_actual && $mes == $mes_actual && $dia > $dia_actual)) {
                return true; // Es una fecha futura
            }
            return false;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha_nacimiento = $_POST['fecha_nacimiento'];

            // Validar la fecha
            if (validarFecha($fecha_nacimiento)) {
                $partes = explode('/', $fecha_nacimiento);
                $dia = (int) $partes[0];
                $mes = (int) $partes[1];
                $anio = (int) $partes[2];

                // Verificar si la fecha ingresada es futura
                if (esFechaFutura($dia, $mes, $anio)) {
                    echo "La fecha ingresada es futura. Por favor, introduce una fecha válida.<br>";
                } else {
                    // Obtener la fecha actual
                    $fecha_actual = getdate();
                    $dia_actual = $fecha_actual['mday'];
                    $mes_actual = $fecha_actual['mon'];
                    $anio_actual = $fecha_actual['year'];

                    // Calcular la edad
                    $edad = $anio_actual - $anio;
                    if ($mes_actual < $mes || ($mes_actual == $mes && $dia_actual < $dia)) {
                        $edad--;
                    }

                    // Mostrar el resultado
                    echo "Tu edad es: $edad años.<br>";

                    // Comprobar si el año de nacimiento es bisiesto
                    if (esBisiesto($anio)) {
                        echo "El año $anio fue un año bisiesto.";
                    } else {
                        echo "El año $anio no fue un año bisiesto.";
                    }
                }
            }
        }
        ?>

    </body>
</html>


