<?php
if(!isset($_POST["poruka_id"])){
    header("Location: ../chat.php");
    die();
}
require_once __DIR__ . "/../tabele/poruka.php";
Poruka::obrisiPoruku($_POST["poruka_id"]);

// header("Location: ../chat.php");
// die();

$odgovor = [
    "poruka" => "obrisan komentar",
    "greska" => false
];
echo json_encode($odgovor);