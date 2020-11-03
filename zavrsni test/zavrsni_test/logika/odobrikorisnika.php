<?php
if(!isset($_POST["korisnik_id"])){
    header("Location: ../lista.php");
    die();
}
require_once __DIR__ . "/../tabele/korisnik.php";
Korisnik::odobriKorisnika($_POST["korisnik_id"], $_POST["status_odobrenja"]);
$odgovor = [
    "greska" => false
];
echo json_encode($odgovor);