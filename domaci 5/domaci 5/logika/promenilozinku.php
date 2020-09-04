<?php
if(!isset($_POST["email"])){
    header("Location: ../lozinka.php");
    die();
}
require_once __DIR__ . "/../tabele/korisnik.php";
$korisnik = Korisnik::prijavi($_POST["email"], $_POST["stara_lozinka"]);
if($korisnik == null){
    header("Location: ../lozinka.php?korisnik=false");
    die();
}
$id = $korisnik->id;
Korisnik::izmeniLozinku($id, $_POST["nova_lozinka"]);
header("Location: ../chat.php");
die();