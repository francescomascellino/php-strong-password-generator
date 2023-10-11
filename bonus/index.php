<!-- 
Descrizione
Dobbiamo creare una pagina che permetta ai nostri utenti di utilizzare il nostro generatore di password (abbastanza) sicure. L’esercizio è suddiviso in varie milestone ed è molto importante svilupparle in modo ordinato.

Milestone 1
Creare un form che invii in GET la lunghezza della password. Una nostra funzione utilizzerà questo dato per generare una password casuale (composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente. Scriviamo tutto (logica e layout) in un unico file index.php

Milestone 2
Verificato il corretto funzionamento del nostro codice, spostiamo la logica in un file functions.php che includeremo poi nella pagina principale

Milestone 3 (BONUS)
Invece di visualizzare la password nella index, effettuare un redirect ad una pagina dedicata che tramite $_SESSION recupererà la password da mostrare all’utente.
leggete le slide sulla session e la documentazione

Milestone 4 (BONUS)
Gestire ulteriori parametri per la password: quali caratteri usare fra numeri, lettere e simboli. Possono essere scelti singolarmente (es. solo numeri) oppure possono essere combinati fra loro (es. numeri e simboli, oppure tutti e tre insieme). Dare all’utente anche la possibilità di permettere o meno la ripetizione di caratteri uguali. 
-->

<?php
session_start();
//  Milestone 1 VEDI functions.php

/*  Milestone 2
 Verificato il corretto funzionamento del nostro codice, spostiamo la logica in un file functions.php che includeremo poi nella pagina principale */
include __DIR__ . '/functions.php';

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
                <h2>Genera una Password Sicura</h2>

                <?php

                //TEST INCLUSIONE MARKUP SU PAGINA DIVERSA - IN QUESTO BONUS IL VALORE RISULTA ESSERE "Nessun parametro inserito quando si torna indietro
                // include __DIR__ . '/response.php';
                ?>

                <div class="col border rounded-2 py-3">
                    <form action="" method="get">
                        <div class="mb-3">
                            <label for="length" class="form-label">Quanti caratteri deve contenere la tua password?</label>

                            <!-- SE E' STATO INSERITO UN VALORE, IL value dEL FORM RESTERA' INVARIATO -->
                            <input type="number" class="form-control" name="length" id="length" aria-describedby="helpId" placeholder="" min="8" max="32" value="<?php echo isset($_GET["length"]) ?  $_GET["length"] : 8 ?>" style="width: 4.5rem;">
                            <small id="helpId" class="form-text text-muted">Il valore inserito deve essere un numero compreso tra 8 e 32</small>
                        </div>

                        <div>

                            <h4>Consenti la ripetizione dei caratteri</h4>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="char_repeat" id="no_repeat" value="no_repeat">
                                <label class="form-check-label" for="no_repeat">
                                    No
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="char_repeat" id="repeat" value="repeat_chars" checked>
                                <label class="form-check-label" for="repeat">
                                    Si
                                </label>
                            </div>

                        </div>

                        <!-- IL VALUE DEI CHECKBOX E' CORRISPONDENTE A UNA DELLE VARIABILI DI CARATTERI. IL NAME VIENE DICHIARATO COME ARRAY -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="letters" value="<?= $letters ?>" name="characters[]" checked>
                            <label class="form-check-label" for="letters">Lettere</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="numbers" value="<?= $numbers ?>" name="characters[]" checked>
                            <label class="form-check-label" for="numbers">Numeri</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="symbols" value="<?= $symbols ?>" name="characters[]" checked>
                            <label class="form-check-label" for="symbols">Simboli</label>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Invia</button> <button type="reset" class="btn btn-warning">Annulla</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </main>

</body>

</html>