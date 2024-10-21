<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Simulación de Lanzamiento de Dados</title>
    </head>
    <body>
        <h1>Simulación de Lanzamiento de Dados</h1>

        <form method="POST">
            <label for="num_tiradas">Número de tiradas:</label>
            <input type="number" id="num_tiradas" name="num_tiradas" min="1" required>
            <button type="submit">Lanzar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num_tiradas = $_POST["num_tiradas"];

            $resultados = array(0, 0, 0, 0, 0, 0);

            // Simulamos las tiradas
            for ($i = 0; $i < $num_tiradas; $i++) {
                $tirada = rand(1, 6); // Genera un número aleatorio entre 1 y 6
                $resultados[$tirada - 1]++; // Incrementamos el valor en el índice correspondiente
            }

            // Mostramos los resultados
            echo "<h2>Resultados del lanzamiento:</h2>";
            echo "<ul>";
            for ($i = 0; $i < 6; $i++) {
                echo "<li>Número " . ($i + 1) . ": " . $resultados[$i] . " veces</li>";
            }
            echo "</ul>";
        }
        ?>
    </body>
</html>

