<?php

/* 
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
 */

/*  Milestone 1
 Creare un form che invii in GET la lunghezza della password. Una nostra funzione utilizzerà questo dato per generare una password casuale (composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente. Scriviamo tutto (logica e layout) in un unico file index.php */

// RESPONSE BASE VALUE
$response = "Nessun Parametro Inserito";

// ASSEGNA ALLA VARIABILE IL VALORE DEL $_GET
$length = $_GET["length"];

function gen_pwd($length)
{

    //DIVIDE IN VARIABILI I VARI ELEMENTI CHE COMPONGONO UNA PASSWORD
    $letters = "abcdefghilmnopqrstuvzxywjkABCDEFGHILMNOPQRSTUVZXYWJK";

    $numbers = "1234567890";

    $symbols = "!$%&/()=?-_,;.:@#[+*]";

    // IL CONTENITORE DEI CARATTERI CHE COMPONGONO UNA PASSWORD (PER IL BONUS INSERIRE CONDIZIONI PER RIMUOVERE GLI ELEMENTI NON RICHIESTI)
    $char_container = $letters . $numbers . $symbols;

    // LA PASSWORD NON GENERATA E' VUOTA
    $password = "";

    // FINCHE' LA LUNGHEZZA DELLA PASSWORD E' MINORE DELL VALORE $lenght INSERITO DALL'UTENTE...
    while (strlen($password) < $length) {

        //GENERA UN NUMERO CHE PESCHERA' IL CORRISPETTIVO CARATTERE DAL CONTENITORE DI CARATTERI. E' UN NUMERO CASUALE TRA 0 e LA LUNGHEZZA DEL CONTENITORE. ESSENDO ELABORAT COME ARRAY, IL PRIMO VALORE E' 0 MENTRE L'ULTIMO E' LA LUNGHEZZA -1 (ZERO E' GIA' INSERITO, AVREMMO ALTRIMENTI UN VALORE EXTRA)
        $random_char = rand(0, strlen($char_container) - 1);

        // IL SINGOLO CARATTERE E' UGUALE A CIO' CHE E' PRESENTE IN $char_container ALL'INDICE RANDOMICO GENERATO PRECEDENTEMENTE
        $char = $char_container[$random_char];

        // PASSWORD E' UGUALE A SE STESSA + $char. QUESTO VIENE RIPETUTO FINO A FINE CICLO
        $password .= $char;
    }

    //RITORNA IL VALORE DI PASSWORD
    return $password;
};

// SE $_GET["length"] E' STATO SETTATO DAL FORM...
if (isset($_GET["length"])) {
    // LA RESPONSE VERRA' SOSTUITUITA DALLA PASSWORD GENERATA DALLA FUNZIONE
    $response = gen_pwd($length);
}

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
                <div class="col border rounded-2 p-3">
                    <p class="m-0"><?= $response ?></p>
                </div>

                <div class="col border rounded-2 py-3">
                    <form action="" method="get">
                        <div class="mb-3">
                            <label for="length" class="form-label">Quanti caratteri deve contenere la tua password?</label>
                            <input type="number" class="form-control" name="length" id="length" aria-describedby="helpId" placeholder="" min="8" max="32" value="8" style="width: 4.5rem;">
                            <small id="helpId" class="form-text text-muted">Il valore inserito deve essere un numero compreso tra 8 e 32</small>
                        </div>

                        <div>

                            <h4>Consenti la ripetizione dei caratteri</h4>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="no_repeat" id="no_repeat" value="repeat_chars">
                                <label class="form-check-label" for="no_repeat">
                                    No
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="repeat" id="repeat" value="repeat_chars" checked>
                                <label class="form-check-label" for="repeat">
                                    Si
                                </label>
                            </div>

                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="letters" value="letters" checked>
                            <label class="form-check-label" for="letters">Letere</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="numbers" value="numbers" checked>
                            <label class="form-check-label" for="numbers">Numeri</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="symbols" value="symbols" checked>
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

    <footer>
        <!-- place footer here -->
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>