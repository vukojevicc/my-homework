<?php
if(!isset($_POST["poruka_id"])){
    header("Location: ../chat.php");
    die();
}
require_once __DIR__ . "/../tabele/poruka.php";
require_once __DIR__ . "/../tabele/korisnik.php";
Poruka::procitajPoruku($_POST["status_pregleda"], $_POST["poruka_id"]);
session_start();
// header("Location: ../chat.php");
// die(); 
$korisnik = Korisnik::vratiKorisnikaZaId($_SESSION["korisnik_id"]);
$poruka = new Poruka;
$odgovor = [
    "poruka" => "procitana poruka",
    "greska" => false,
    "korisnik_id" => $korisnik->id,
    "posiljalac" => $poruka->korisnikPosiljalac(),
];

echo json_encode($odgovor);