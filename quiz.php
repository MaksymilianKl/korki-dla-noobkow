<?php
session_start();

// Jeśli to pierwsze uruchomienie, inicjujemy sesję
if (!isset($_SESSION['answers'])) {
    $_SESSION['answers'] = [];
    $_SESSION['current_question'] = 0;
}

// Definicja pytań i odpowiedzi
$questions =  [
    {
        "question": "Ile klas postaci jest w grze 'TeamFortress2'?",
        "answers": ["7", "8", "9", "10"],
        "correct": 1
    },
    {
        "question": "Kto jest głownym bohaterem w grze 'The Legend of Zelda'?",
        "answers": ["Link", "Zelda", "Ganondorf", "Ganon"],
        "correct": 1
    },
    {
        "question": "Jak nazywa się głowny antagonista gry 'Undertale'?",
        "answers": ["Flowey the Flower", "Sans", "Toriel", "Papyrus"],
        "correct": 1
    },
    {
        "question": "W jakiej z tych gier głowną postacią jest 'Kratos'?",
        "answers": ["God of War", "Uncharted", "Assassin's Creed", "The Last of Us"],
        "correct": 1
    },
    {
        "question": "W którym roku powstał Minecraft?",
        "answers": ["2010", "2011", "2012", "2013"],
        "correct": 1
    },
    {
        "question": "W której z tych gier występują zombie?",
        "answers": ["The Walking Dead", "Left 4 Dead", "Resident Evil", "The Last of Us"],
        "correct": 4
    },
    {
        "question": "Kto w 'Wiedzminie 3' jest wiedźminem?",
        "answers": ["Ciri", "Yennefer", "Geralt", "Triss"],
        "correct": 2
    },
    {
        "question": "Jak nazywa się głowna postać w 'Half-Life'?",
        "answers": ["Gordon Freeman", "Alyx Vance", "Eli Vance", "Barney Calhoun"],
        "correct": 1
    },
    {
        "question": "Która z tych gier została stworzona przez Valve?",
        "answers": ["Portal", "Halo", "Battlefield", "Red Dead Redemption"],
        "correct": 1
    },
    {
        "question": "W której grze główną tematyką są 'Spartianie' ?",
        "answers": ["God of War", "Halo", "Assassin's Creed", "Gears of War"],
        "correct": 1
    },
    {
        "question": "W której grze jest 'Pikachu'?",
        "answers": ["Super Mario", "The Legend of Zelda", "Pokemon", "Donkey Kong"],
        "correct": 2
    },
    {
        "question": "Która z tych gier jest grą FPS?",
        "answers": ["Counter-Strike 2", "Fortnite", "Minecraft", "League of Legends"],
        "correct": 1
    },
    {
        "question": "W której grze Battle Royale jest 100 graczy w jednej sesji?",
        "answers": ["Call of Duty: Warzone", "Fortnite", "Apex Legends", "PUBG"],
        "correct": 3
    },
    {
        "question": "Kto stworzył grę 'Fortnite'?",
        "answers": ["Epic Games", "EA", "Blizzard", "Ubisoft"],
        "correct": 1
    }
]


// Funkcja do obliczenia wyniku
function calculate_score($answers, $questions) {
    $score = 0;
    foreach ($answers as $question_id => $selected_answers) {
        $correct_answers = $questions[$question_id]['correct'];
        if (empty(array_diff($selected_answers, $correct_answers)) && empty(array_diff($correct_answers, $selected_answers))) {
            $score++;
        }
    }
    return $score;
}

// Obsługa formularzy
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_question = $_SESSION['current_question'];
    $_SESSION['answers'][$current_question] = isset($_POST['answers']) ? $_POST['answers'] : [];

    // Zwiększenie numeru pytania
    $_SESSION['current_question']++;

    // Przechodzimy do następnego pytania lub wyświetlamy wyniki
    if ($_SESSION['current_question'] >= count($questions)) {
        $score = calculate_score($_SESSION['answers'], $questions);
        header("Location: quiz.php?result=$score");
        exit;
    }
}

// Pobieranie bieżącego pytania
$current_question = $_SESSION['current_question'];
$question = $questions[$current_question];

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz o grach komputerowych</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            margin-right: 10px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .progress {
            width: 100%;
            background-color: #f3f3f3;
            margin: 20px 0;
            border-radius: 5px;
        }

        .progress-bar {
            width: <?= (100 * ($current_question + 1) / count($questions)) ?>%;
            height: 20px;
            background-color: #4CAF50;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quiz o grach komputerowych</h1>

        <?php if (isset($_GET['result'])): ?>
            <!-- Wyniki -->
            <h2>Twój wynik: <?= $_GET['result'] ?>/<?= count($questions) ?></h2>
            <a href="quiz.php" style="display: block; text-align: center;">Zacznij od nowa</a>
        <?php else: ?>
            <!-- Pytanie -->
            <p><?= $question['question'] ?></p>
            <form method="POST">
                <?php foreach ($question['answers'] as $index => $answer): ?>
                    <div>
                        <input type="checkbox" name="answers[]" value="<?= $index ?>" id="answer<?= $index ?>">
                        <label for="answer<?= $index ?>"><?= $answer ?></label>
                    </div>
                <?php endforeach; ?>
                <button type="submit">Przejdź do kolejnego pytania</button>
            </form>
            <div class="progress">
                <div class="progress-bar"></div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>


<!-- INSERT INTO questions (question, answer_1, answer_2, answer_3, answer_4, correct_answers) VALUES
("Ile klas postaci jest w grze 'TeamFortress2'?", "Siedem", "Osiem", "Dziewięć", "Dziesięć", "3"),
("Kto jest głownym bohaterem w grze 'The Legend of Zelda'?", "Link", "Zelda", "Ganondorf", "Ganon", "1"),
("Jak nazywa się głowny antagonista gry 'Undertale'?", "Flowey the Flower", "Sans", "Toriel", "Papyrus", "1"),
("W jakiej z tych gier głowną postacią jest 'Kratos'?", "God of War", "Uncharted", "Assassin's Creed", "The Last of Us", "1"),
("W której z tych gier występują zombie?", "The Walking Dead", "Left 4 Dead", "Resident Evil", "The Last of Us", "3"),
("Kto w 'Wiedzminie 3' jest wiedźminem?", "Ciri", "Yennefer", "Geralt", "Triss", "3"),
("Jak nazywa się głowna postać w 'Half-Life'?", "Gordon Freeman", "Alyx Vance", "Eli Vance", "Barney Calhoun", "1"),
("Która z tych gier została stworzona przez Valve?", "Portal", "Halo", "Battlefield", "Red Dead Redemption", "1"),
("W której grze główną tematyką są 'Spartianie'?", "God of War", "Halo", "Assassin's Creed", "Gears of War", "2"),
("W której grze jest 'Pikachu'?", "Super Mario", "The Legend of Zelda", "Pokemon", "Donkey Kong", "3"),
("Która z tych gier jest grą FPS?", "Counter-Strike 2", "Fortnite", "Minecraft", "League of Legends", "1"),
("W której grze Battle Royale jest 100 graczy w jednej sesji?", "Call of Duty: Warzone", "Fortnite", "Apex Legends", "PUBG", "4"),
("Kto stworzył grę 'Fortnite'?", "Epic Games", "EA", "Blizzard", "Ubisoft", "1"); -->
