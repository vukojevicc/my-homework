<?php
    if(!isset($_POST["korisnik_id"])){
        header("Location: ../lista.php");
        die();
    }
    require_once __DIR__ . "/../tabele/korisnik.php";
    Korisnik::izmeniLozinku($_POST["korisnik_id"], $_POST["nova_lozinka"]);
    Korisnik::resetujBrojac($_POST["korisnik_id"]);
    $odgovor = [
        "greska" => false
    ];
    echo json_encode($odgovor);