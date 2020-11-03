<?php
if(!isset($_POST["username"])){
    header("Location: ../index.php");
    die();
}
require_once __DIR__ . "/../tabele/korisnik.php";
$korisnik = Korisnik::prijavi($_POST["username"], $_POST["lozinka"]);
$korisnik2 = Korisnik::vratiKorisnikaZaUn($_POST["username"]);
if($korisnik != null){
    if($korisnik->uloga_id == 1){
        session_start();
        $_SESSION["korisnik_id"] = $korisnik->id;
        header("Location: ../administrator.php");
        die();
    }
    elseif($korisnik->pokusaji_prijavljivanja < 3){
        session_start();
        $_SESSION["korisnik_id"] = $korisnik->id;
        header("Location: ../korisnikk.php");
        die();
    }
    else{
        header("Location: ../index.php?login=fail");
        die();
    }
}
elseif($korisnik2 != null){
    if($korisnik2->uloga_id == 1){
        header("Location: ../index.php?login=false");
        die();
    }
    elseif($korisnik2->pokusaji_prijavljivanja < 3){
        $korisnik2->pokusajiPrijavljivanja($_POST["username"]);
        header("Location: ../index.php?login=false");
        die();
    }
    else{
        header("Location: ../index.php?login=fail");
        die();
    }
}
else{
    header("Location: ../index.php?login=false");
    die();
}