<?php
session_start();
if(!isset($_SESSION["korisnik_id"])){
    header("Location: index.php");
    die();
}
require_once __DIR__ . "/tabele/korisnik.php";
require_once __DIR__ . "/tabele/aktivnost.php";
$korisnici = Korisnik::izlistaj();
$aktivnosti = Aktivnost::izlistajAktivnosti();
function sortiranje($a,$b)
{
    if ($a==$b) return 0;
  return ($a->vreme_do_isteka<$b->vreme_do_isteka)?-1:1;
}
usort($aktivnosti,"sortiranje");
// var_dump($aktivnosti);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korisnik</title>
    <style>
        <?php
            require_once __DIR__ . "/css/layout.css";
        ?>
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var komentar = $(".komentar");
                var j = $(".urgencija");
                for(var i = 0; i<komentar.length; i++){
                    if(j[i].value == "hitno"){
                        komentar[i].style.backgroundColor = "rgb(255,69,0, 0.55)";
                    }
                    else{
                        komentar[i].style.backgroundColor = "rgb(255, 255, 0, 0.55)";
                    }
                }
                $("#aktivnost form").on("submit", function(e){
                    e.preventDefault();
                        var method = $(this).attr("method");
                        var aktivnost_id = $(this).find("input[name='aktivnost_id']").val();
                        var status_aktivnosti = $(this).find("input[name='status_aktivnosti']").val();
                    if($(this).find("button").html() == "Uradjeno"){
                        var aktivnost = $(this).find(".komentar")[0];
                        var url = $(this).attr("action");
                        $.ajax({
                            "url": url,
                            "method": method,
                            "data": {
                                "status_aktivnosti": status_aktivnosti,
                                "aktivnost_id": aktivnost_id
                            },
                            "dataType": "json",
                            "success": function(odg){
                                if(odg.greska == false){
                                        $(aktivnost).css({
                                            "outline":"5px solid green"
                                        });
                                }
                            },
                            "error": function(odg){
                                if(odg.greska == undefined){
                                    console.log("greska");
                                }
                            }
                        });
                    }
                    else{
                        var url = $(this).attr("action");
                        var aktivnost = $(this).parent();
                        $.ajax({
                            "url": url,
                            "method": method,
                            "data": {
                                "aktivnost_id": aktivnost_id
                            },
                            "dataType":"json",
                            "success": function(odgovor){
                                if(odgovor.greska == false){
                                    aktivnost.remove();
                                }
                            },
                            "error": function(odgovor){
                                if(odgovor.greska == undefined){
                                    console.log("greska");
                                }
                            }
                        });
                    }
                });
        });
    </script>
</head>
<body>
<form action="logika/odjavise.php" method="post">
        <button id="odjavise" type="submit">odjavi se</button>
     </form>
<form action="logika/dodeliaktivnost.php" method="post">
    <label for="naziv_aktivnosti">Naziv aktivnosti</label><br>
    <input type="text" name="naziv_aktivnosti" placeholder="Naziv aktivnosti"><br>
    <label for="opis_aktivnosti">Opis aktivnosti</label><br>
    <textarea name="opis_aktivnosti" placeholder="Opis aktivnosti"></textarea><br>
    <select name="korisnici">
        <option value="<?= $_SESSION["korisnik_id"] ?>" selected>
            <?php
                $korisnik = Korisnik::vratiKorisnikaZaId($_SESSION["korisnik_id"]);
                echo $korisnik->ime_prezime;
            ?>
        </option>
        <?php foreach($korisnici as $korisnik): ?>
                <?php if($korisnik->id != $_SESSION["korisnik_id"]): ?>
                <option value="<?= $korisnik->id ?>">
                <?php
                    echo $korisnik->ime_prezime;
                ?>
            </option>
                <?php endif; ?>
            <?php endforeach; ?>
    </select><br>
    <div class="radio">
            <label for="hitno">Hitno</label>
            <input type="radio" name="urgencija" id="hitno" value="hitno"><br>
            <label for="nije hitno">Nije hitno</label>
            <input type="radio" name="urgencija" id="nije_hitno" value="nije hitno"><br>
        </div><br>
        <label for="rok_izvrsenja">Rok izvršenja</label><br>
        <input type="date" name="rok_izvrsenja" id="datum"><br>
        <?php if(isset($_GET["aktivnost"]) && $_GET["aktivnost"] == "false"): ?>
            <script>
                alert("Sva polja moraju biti popunjena.");
            </script>
        <?php endif ?>
    <button type="submit">Dodeli aktivnost</button>
    <p>
            <a href="promena_lozinke.php">Promena lozinke</a>
        </p>
</form>
<div id="flex">
<?php  foreach($aktivnosti as $aktivnost): ?>
     <?php
      $slika = str_replace("\\", "/", $aktivnost->korisnikDodelilac()->slika);
      $slike = str_replace("../", "", $slika); 
      ?>
        <?php if($_SESSION["korisnik_id"] == $aktivnost->aktivnost_dodelio || $_SESSION["korisnik_id"] == $aktivnost->aktivnost_primio): ?>
            <div id="aktivnost">
                <form class="bez_padinga" method="post" action="<?php if($_SESSION["korisnik_id"] == $aktivnost->aktivnost_dodelio){
                    echo "logika/obrisiaktivnost.php";
                }
                else{
                    echo "logika/zavrsenaaktivnost.php";
                } ?>">
                    <div class="komentar" <?php if($aktivnost->status_aktivnosti == "uradjeno"){
                        echo 'style="outline: 5px solid green;"';
                    } ?>>
                    <div class="flex_item item0"><img src="<?= $slike?>" onerror = this.src="slike/download.png" style="width: 50px; height: 50px"></div>
                        <div class="flex_item item1"><?= $aktivnost->korisnikDodelilac()->ime_prezime ?></div>
                        <div class="flex_item item2"><?= $aktivnost->naslov_aktivnosti ?></div>
                        <div class="flex_item item3"><?= $aktivnost->vreme(); ?></div>
                        <div class="flex_item item4"><button id="komentar_dugme" type="submit"><?php if($_SESSION["korisnik_id"] == $aktivnost->aktivnost_dodelio){
                            echo "Obriši";
                        }else{
                            echo "Uradjeno";
                        } ?></button></div>
                        <div class="flex_item item5"><?= $aktivnost->opis_aktivnosti ?></div>
                        <input type="hidden" id="status_aktivnosti" name="status_aktivnosti" value="uradjeno">
                        <input type="hidden" class="urgencija" value="<?= $aktivnost->urgencija ?>">
                        <input type="hidden" id="aktivnost_id" name="aktivnost_id" value="<?= $aktivnost->aktivnost_id ?>">
                    </div>
                    </form>
            </div>
        <?php endif; ?>
     <?php endforeach; ?>
</div>
</body>
</html>