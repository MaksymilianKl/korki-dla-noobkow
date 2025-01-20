# korki-dla-noobkow
sigma
<?php

$file = 'plik_tekstowy.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file'])) {
       
        if ($_FILES['file']['error'] == 0) {
            
            $text = file_get_contents($_FILES['file']['tmp_name']);
        }
    } elseif (isset($_POST['text'])) {
        
        $text = $_POST['text'];
        file_put_contents($file, $text);
    }
} else {
    
    $text = file_exists($file) ? file_get_contents($file) : '';
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytor Tekstu</title>
    <style>
        textarea {
            width: 100%;
            height: 300px;
        }
        button {
            margin-top: 10px;
        }
        input[type="file"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Edytor Tekstu</h1>

    
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" accept=".txt"><br>
        <button type="submit">Wczytaj Plik</button>
    </form>

    
    <form method="POST">
        <textarea name="text"><?php echo htmlspecialchars($text); ?></textarea><br>
        <button type="submit">Zapisz</button>
    </form>
</body>
</html>


Zadanie
