<?php
if(!isset($_POST["aktivnost_id"])){
    header("Location: ../korisnikk.php");
    die();
}
require_once __DIR__ . "/../tabele/aktivnost.php";
Aktivnost::zavrsiAktivnost($_POST["status_aktivnosti"], $_POST["aktivnost_id"]);

$odgovor = [
    "poruka" => "upisana aktivnost",
    "greska" => false
];

echo json_encode($odgovor);