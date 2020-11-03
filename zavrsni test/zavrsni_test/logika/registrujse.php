<?php
require_once __DIR__ . "/../tabele/korisnik.php";
require_once __DIR__ . "/../includes/Upload.php";

if((isset($_POST["email"]) && $_POST["email"] == null) || (isset($_POST["lozinka"]) && $_POST["lozinka"] == null) || (isset($_POST["ime_prezime"]) && $_POST["ime_prezime"] == null) || (isset($_POST["lozinka1"]) && $_POST["lozinka1"] == null) || (isset($_POST["broj"]) && $_POST["broj"] == null) || (isset($_POST["username"]) && $_POST["username"] == null)){
    header("Location: ../registracija.php?registracija=false");
    die();
}

$file = Upload::factory("../slike");
$file->set_allowed_mime_types([
    "image/jpeg",
    "image/png",
    "image/gif"
]);
$file->set_max_file_size(2);
$file->file($_FILES["slika"]);
$file->set_filename(time() . $_FILES["slika"]["name"]);
$putanja = $file->upload();

Korisnik::registruj($_POST["username"], $_POST["email"], $_POST["lozinka"], $_POST["broj"], $_POST["ime_prezime"], $putanja["path"]);

header("Location: ../index.php");
die();