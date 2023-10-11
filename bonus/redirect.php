<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>PHP Strong Password Generator</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <h1 class="text-center">Strong Password Generator</h1>
    </header>

    <main>
        <div class="container">
            <div class="row flex-column g-3">
                <h2>Ecco la tua nuova password!</h2>

                <?php

                include __DIR__ . '/response.php';
                ?>
                <a href="./index.php" class="btn btn-primary">Torna al form</a>
            </div>

        </div>
        </div>

    </main>

</body>

</html>