<?php
if(!isset($_POST["email"])){
    header("Location: ../index.php");
    die();
}
require_once __DIR__ . "/../tabele/korisnik.php";
$korisnik = Korisnik::prijavi($_POST["email"], $_POST["lozinka"]);
if($korisnik != null){
    session_start();
    $_SESSION["korisnik_id"] = $korisnik->id;
    header("Location: ../chat.php");
    die();
}
else{
    header("Location: ../index.php?login=false");
    die();
}