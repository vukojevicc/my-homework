<?php
if($_POST["naziv_aktivnosti"] == null || $_POST["opis_aktivnosti"] == null || $_POST["urgencija"] == null){
    header("Location: ../korisnikk.php?aktivnost=false");
    die();
}

require_once __DIR__ . "/../tabele/aktivnost.php";
session_start();
$seconds = strtotime($_POST["rok_izvrsenja"]) - time();
$sekunde = $seconds;

$days = floor($seconds / 86400);
$seconds %= 86400;
                            
$hours = floor($seconds / 3600);
$seconds %= 3600;
                            
$minutes = floor($seconds / 60);
$seconds %= 60;
$dani_do_isteka = "$days dana i $hours:$minutes:$seconds";
$rok_izvrsenja = date("d.m.Y.", strtotime($_POST["rok_izvrsenja"]));
$vreme_dodeljivanja = date("d.m.Y. H:i", time());
Aktivnost::unesiAktivnost($_SESSION["korisnik_id"], $_POST["korisnici"], $_POST["opis_aktivnosti"], $_POST["naziv_aktivnosti"], $rok_izvrsenja, $dani_do_isteka, $_POST["urgencija"], $vreme_dodeljivanja, $sekunde);
header("Location: ../korisnikk.php");
die();