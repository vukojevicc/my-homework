<?php
session_start();
require_once __DIR__ . "/../tabele/korisnik.php";
Korisnik::izmeniLozinku($_SESSION["korisnik_id"], $_POST["nova_lozinka"]);
header("Location: ../promena_lozinke.php");
die();