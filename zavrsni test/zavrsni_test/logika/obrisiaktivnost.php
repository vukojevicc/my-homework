<?php
if(!isset($_POST["aktivnost_id"])){
    header("Location: ../korisnikk.php");
    die();
}
require_once __DIR__ . "/../tabele/aktivnost.php";
Aktivnost::obrisiAktivnost($_POST["aktivnost_id"]);

$odgovor = [
    "poruka" => "obrisana aktivnost",
    "greska" => false
];
echo json_encode($odgovor);