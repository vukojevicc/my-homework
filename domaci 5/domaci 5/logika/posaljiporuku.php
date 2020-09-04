<?php 
if($_POST["naslov_poruke"] == null || $_POST["sadrzaj_poruke"] == null || $_POST["korisnici"] == "Izaberite primaoca" || $_POST["urgencija"] == null){
    header("Location: ../chat.php?poruka=false");
    die();
}
require_once __DIR__ . "/../tabele/poruka.php";
session_start();
Poruka::unesiPoruku($_SESSION["korisnik_id"], $_POST["korisnici"], $_POST["sadrzaj_poruke"], $_POST["naslov_poruke"], $_POST["urgencija"]);

header("Location: ../chat.php");
die();