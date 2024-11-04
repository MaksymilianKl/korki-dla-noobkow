<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generator Tabelek</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-weight: bold;
        }
        .container {
            border: 5px solid black;
            text-align: center;
            padding: 20px;
        }
        .form-table {
            margin: 0 auto;
            text-align: left;
        }
        .button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .generated-table {
            margin: 20px auto;
            border-collapse: collapse;
        }
        .generated-table td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Generator Tabelek</h2>

    <form method="POST">
        <table class="form-table">
            <tr>
                <td><label for="rows">Podaj liczbę wierszy:</label></td>
                <td><input type="number" id="rows" placeholder="rows" name="rows" min="1" required></td>
            </tr>
            <tr>
                <td><label for="cols">Podaj liczbę kolumn:</label></td>
                <td><input type="number" id="cols" placeholder="cols" name="cols" min="1" required></td>
            </tr>
            <tr>
                <td><label>Czy dodać obramowanie okienka?</label></td>
                <td><input type="radio" name="border" value="yes"> Tak</td>
            </tr>
            <tr>
                <td><label>Czy wypełnić okienka kolejno:</label></td>
                <td>
                    <input type="radio" name="fill" value="numbers" required> Numerami
                    <input type="radio" name="fill" value="letters"> Literami
                </td>
            </tr>
        </table>
        <button type="submit" class="button">Wygeneruj</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ustawienia domyślne
        $rows = (int)$_POST['rows'];
        $cols = (int)$_POST['cols'];
        $border = isset($_POST['border']) ? '1px solid black' : 'none';
        $fill = $_POST['fill'];
        
        // Generowanie tabeli
        echo "<h3>Wygenerowana Tabela:</h3>";
        echo "<table class='generated-table'>";
        
        for ($i = 0, $counter = 1, $letter = 'A'; $i < $rows; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $cols; $j++) {
                $cellValue = ($fill == "numbers") ? $counter++ : $letter++;
                if ($letter > 'Z') 
                
                echo "<td style='border: $border; padding: 10px;'>$cellValue</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</div>

</body>
</html>
