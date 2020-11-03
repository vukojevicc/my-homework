<?php
    session_start();
    require_once __DIR__ . "/tabele/korisnik.php";
    $korisnik = Korisnik::vratiKorisnikaZaId($_SESSION["korisnik_id"]);
    if(!isset($korisnik) || $korisnik->uloga_id != 1){
        header("Location: korisnikk.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <style>
        <?php 
            require_once __DIR__ . "/css/layout.css"
        ?>
        body{
            height: 100vh;
        }
        p{
            text-align: center;
        }
    </style>
</head>
<body>
<form action="logika/odjavise.php" method="post">
        <button id="odjavise" type="submit">odjavi se</button>
     </form>
         <p>
                <a href="lista.php">Lista korisnika</a>
            </p>
            <p>
                <a href="aktivnosti.php">Lista aktivnosti</a>
            </p>

</body>
</html>