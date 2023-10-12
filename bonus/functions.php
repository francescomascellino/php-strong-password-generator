<?php

/*  Milestone 1
 Creare un form che invii in GET la lunghezza della password. Una nostra funzione utilizzerà questo dato per generare una password casuale (composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente. Scriviamo tutto (logica e layout) in un unico file index.php */

// I VALORI DEI CARATTERI VENGONO ASSEGNATI COME ATTRIBUTO VALUE AI CHECKBOXES
$letters = "abcdefghilmnopqrstuvzxywjkABCDEFGHILMNOPQRSTUVZXYWJK";

$numbers = "1234567890";

$symbols = "!$%&/()=?-_,;.:@#[+*]";

function gen_pwd($length)
{

    /* Milestone 4 (BONUS)
    Gestire ulteriori parametri per la password: quali caratteri usare fra numeri, lettere e simboli. Possono essere scelti singolarmente (es. solo numeri) oppure possono essere combinati fra loro (es. numeri e simboli, oppure tutti e tre insieme). */

    // SE NON SONO STATI SELEZIONATI CHECKBOXES VISUALIZZA UN ALLERTA E NON EFFETTUA REDIRECT
    if (empty($_GET["characters"])) {

        $alert = "Seleziona la lunghezza della password e almeno un tipo di carattere!";

        var_dump($alert);

        return $alert;
    } else {

        // ESSENDO IL NAME DEL CHECKBOX DICHIARATO COME ARRAY PUO' ESSERE IMPLOSO. VENGONO AGGIUNTI ALL'ARRAY SOLO I VALORI DEI BOX SPUNTATI
        $char_container = implode("", $_GET["characters"]);

        // LA PASSWORD NON GENERATA E' VUOTA
        $password = "";

        // FINCHE' LA LUNGHEZZA DELLA PASSWORD E' MINORE DELL VALORE $lenght INSERITO DALL'UTENTE...
        while (strlen($password) < $length) {

            //GENERA UN NUMERO CHE PESCHERA' IL CORRISPETTIVO CARATTERE DAL CONTENITORE DI CARATTERI. E' UN NUMERO CASUALE TRA 0 e LA LUNGHEZZA DEL CONTENITORE. ESSENDO ELABORAT COME ARRAY, IL PRIMO VALORE E' 0 MENTRE L'ULTIMO E' LA LUNGHEZZA -1 (ZERO E' GIA' INSERITO, AVREMMO ALTRIMENTI UN VALORE EXTRA)
            $random_char = rand(0, strlen($char_container) - 1);

            // IL SINGOLO CARATTERE E' UGUALE A CIO' CHE E' PRESENTE IN $char_container ALL'INDICE RANDOMICO GENERATO PRECEDENTEMENTE
            $char = $char_container[$random_char];



            // Milestone 4: Dare all’utente anche la possibilità di permettere o meno la ripetizione di caratteri uguali. 

            // PASSWORD E' UGUALE A SE STESSA + $char. QUESTO VIENE RIPETUTO FINO A FINE CICLO A MENO CHE IL VALORE DEL RADIO NON SIA "no_repeat" E $password non contenga già $char
            if (($_GET["char_repeat"] == "no_repeat") && str_contains($password, $char)) {
                $password .= "";
            } else {
                $password .= $char;
            }
        }

        /*     
    Milestone 3 (BONUS)
    Invece di visualizzare la password nella index, effettuare un redirect ad una pagina dedicata che tramite $_SESSION recupererà la password da mostrare all’utente.
    leggete le slide sulla session e la documentazione */

        //RITORNA IL VALORE DI PASSWORD
        return $password;
    }
};
