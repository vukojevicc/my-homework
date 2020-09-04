<?php
    session_start();
    if(isset($_SESSION["korisnik_id"])){
        header("Location: chat.php");
        die();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        <?php require_once __DIR__ . "/css/layout.css" ?>
        body{
            height: 100vh;
        }
    </style>
</head>
<body>
    <form action="logika/prijavise.php" method="post">
        <label for="email">imejl</label><br>
        <input type="email" id="email" name="email" placeholder="Unesite vaš imejl"><br>
        <label for="lozinka">Lozinka</label><br>
        <input type="password" id="lozinka" name="lozinka" placeholder="Unesite lozinku"><br>
        <?php if(isset($_GET["login"]) && $_GET["login"] === "false"): ?>
        <p class="upozorenje">Pogrešni podaci za prijavu.</p><br>
        <?php endif ?>
        <button type="submit">Prijavi se</button>
        <p>
            <a href="lozinka.php">Promena lozinke</a>
        </p>
        <p>
            <a href="registracija.php">Registracija</a>
        </p>
    </form>
</body>
</html>