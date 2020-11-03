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
    <title>Aktivnosti</title>
    <style>
        <?php 
            require_once __DIR__ . "/css/layout.css";
            require_once __DIR__ . "/tabele/aktivnost.php";
            $aktivnosti = Aktivnost::izlistajAktivnosti();
        ?>
        button{
            margin: 8px 0;
        }
        form{
            padding: 0px;
        }
        body{
            height: 100vh;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Korisnik koji je kreirao aktivnost</th>
            <th>Korisnik kome je aktivnost namenjena</th>
            <th>Naslov aktivnosti</th>
            <th>Rok izvršenja aktivnosti</th>
            <th>Status</th>
        </tr>
        <?php if($aktivnosti != null): ?>
        <?php foreach($aktivnosti as $a): ?>
            <tr <?php if($a->status_aktivnosti == "uradjeno"){
                echo "style='background-color:rgba(0, 255, 0, 0.55)'";
            } ?>>
                <td><?php echo $a->korisnikDodelilac()->ime_prezime ?></td>
                <td><?php echo $a->korisnikPrimalac()->ime_prezime ?></td>
                <td><?php echo $a->naslov_aktivnosti ?></td>
                <td><?php echo $a->rok_izvrsenja ?></td>
                <td><?php if($a->status_aktivnosti == "uradjeno"){
                    echo "Završeno";
                }
                else{
                    echo $a->status_aktivnosti;
                } ?></td>
                <td>
                <form method="get" action="logika/obrisi_aktivnost.php">
                    <input type="hidden" name="id" value="<?php echo $a->aktivnost_id ?>">
                    <button type="submit">
                        Obriši
                    </button>
                </form>
                </td>
            </tr>
        <?php endforeach ?>
        <?php endif ?>
    </table>
</body>
</html>