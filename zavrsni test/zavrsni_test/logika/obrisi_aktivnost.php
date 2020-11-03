<?php
    if(!isset($_GET["id"])){
        header("Location: ../aktivnosti.php");
        die();
    }
    require_once __DIR__ . "/../tabele/aktivnost.php";
    Aktivnost::obrisiAktivnost($_GET["id"]);
    header("Location: ../aktivnosti.php");
    die();