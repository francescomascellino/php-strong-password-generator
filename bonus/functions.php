<?php

// session_start();

/*  Milestone 1
 Creare un form che invii in GET la lunghezza della password. Una nostra funzione utilizzerà questo dato per generare una password casuale (composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente. Scriviamo tutto (logica e layout) in un unico file index.php */

// RESPONSE BASE VALUE
// $_SESSION["response"] = "Nessun Parametro Inserito";

// I VALORI DEI CARATTERI VENGONO ASSEGNATI COME ATTRIBUTO VALUE AI CHECKBOXES
$letters = "abcdefghilmnopqrstuvzxywjkABCDEFGHILMNOPQRSTUVZXYWJK";

$numbers = "1234567890";

$symbols = "!$%&/()=?-_,;.:@#[+*]";

function gen_pwd($length)
{

    // IL CONTENITORE DEI CARATTERI CHE COMPONGONO UNA PASSWORD (PER IL BONUS INSERIRE CONDIZIONI PER RIMUOVERE GLI ELEMENTI NON RICHIESTI)
    // $char_container = $letters . $numbers . $symbols;


    $char_container = implode("", $_GET["characters"]);


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

    /*     
    Milestone 3 (BONUS)
    Invece di visualizzare la password nella index, effettuare un redirect ad una pagina dedicata che tramite $_SESSION recupererà la password da mostrare all’utente.
    leggete le slide sulla session e la documentazione */
    header('Location: ./redirect.php');

    //RITORNA IL VALORE DI PASSWORD
    return $password;
};

// SE $_GET["length"] E' STATO SETTATO DAL FORM...
if (isset($_GET["length"])) {

    // ASSEGNA ALLA VARIABILE IL VALORE DEL $_GET
    $length = $_GET["length"];

    // LA RESPONSE VERRA' SOSTUITUITA DALLA PASSWORD GENERATA DALLA FUNZIONE
    $_SESSION["response"] = gen_pwd($length);
}
