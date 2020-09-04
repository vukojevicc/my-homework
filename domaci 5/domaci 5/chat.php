<?php 
    session_start();
    if(!isset($_SESSION["korisnik_id"])){
        header("Location: index.php");
        die();
    }
    require_once __DIR__ . "/tabele/korisnik.php";
    require_once __DIR__ . "/tabele/poruka.php";
    $korisnici = Korisnik::izlistaj();
    $poruke = Poruka::izlistajPoruke();
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        komentar[i].style.backgroundColor = "rgb(255, 0, 0, 0.55)";
                    }
                    else{
                        komentar[i].style.backgroundColor = "rgb(0, 255, 0, 0.55)";
                    }
                }
                $("#poruka form").on("submit", function(e){
                    e.preventDefault();
                        var method = $(this).attr("method");
                        var poruka_id = $(this).find("input[name='poruka_id']").val();
                        var status_pregleda = $(this).find("input[name='status_pregleda']").val();
                    if($(this).find("button").html() == "Pročitano"){
                        var poruka = $(this).find(".komentar")[0];
                        var url = $(this).attr("action");
                        $.ajax({
                            "url": url,
                            "method": method,
                            "data": {
                                "status_pregleda": status_pregleda,
                                "poruka_id": poruka_id
                            },
                            "dataType": "json",
                            "success": function(odg){
                                if(odg.greska == false){
                                        $(poruka).append('<img src="slike/stikla.png" alt="check" id="seen">');
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
                        var poruka = $(this).parent();
                        $.ajax({
                            "url": url,
                            "method": method,
                            "data": {
                                "poruka_id": poruka_id
                            },
                            "dataType":"json",
                            "success": function(odgovor){
                                if(odgovor.greska == false){
                                    poruka.remove();
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
     <form action="logika/posaljiporuku.php" id="poruka_forma" method="post">
        <label for="naslov_poruke">Naslov poruke</label><br>
        <input type="text" name="naslov_poruke" id="naslov_poruke" placeholder="Unesite naslov poruke"><br>
        <label for="sadrzaj_poruke">Poruka</label><br>
        <textarea name="sadrzaj_poruke" id="sadrzaj_poruke" cols="30" rows="10" placeholder="Vaša poruka"></textarea><br>
        <select name="korisnici" id="korisnici">
            <option selected>Izaberite primaoca</option>
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
            <label for="nije_hitno">Nije hitno</label>
            <input type="radio" name="urgencija" id="nije_hitno" value="nije_hitno"><br>
        </div>
        <button type="submit">Pošalji poruku</button>
        <?php if(isset($_GET["poruka"]) && $_GET["poruka"] == "false"): ?>
            <script>
                alert("Sva polja moraju biti popunjena.")
            </script>
        <?php endif; ?>
     </form>
     <div id="flex">
     <?php  foreach($poruke as $poruka): ?>
     <?php
      $slika = str_replace("\\", "/", $poruka->korisnikPosiljalac()->slika);
      $slike = str_replace("../", "", $slika); 
      ?>
        <?php if($_SESSION["korisnik_id"] == $poruka->posiljalac_id || $_SESSION["korisnik_id"] == $poruka->primalac_id): ?>
            <div id="poruka">
                <form class="bez_padinga" method="post" action="<?php if($_SESSION["korisnik_id"] == $poruka->posiljalac_id){
                    echo "logika/obrisiporuku.php";
                }
                else{
                    echo "logika/procitajporuku.php";
                } ?>">
                    <div class="komentar">
                    <div class="flex_item item0"><img src="<?= $slike?>" alt="Profilna slika korisnika" style="width: 50px; height: 50px"></div>
                        <div class="flex_item item1"><?= $poruka->korisnikPosiljalac()->ime_prezime ?></div>
                        <div class="flex_item item2"><?= $poruka->naslov_poruke ?></div>
                        <div class="flex_item item3"><?= $poruka->vreme(); ?></div>
                        <div class="flex_item item4"><button id="komentar_dugme" type="submit"><?php if($_SESSION["korisnik_id"] == $poruka->posiljalac_id){
                            echo "Obriši";
                        }else{
                            echo "Pročitano";
                        } ?></button></div>
                        <div class="flex_item item5"><?= $poruka->poruka ?></div>
                        <input type="hidden" id="status_pregleda" name="status_pregleda" value="procitano">
                        <input type="hidden" class="urgencija" value="<?= $poruka->urgencija ?>">
                        <input type="hidden" id="poruka_id" name="poruka_id" value="<?= $poruka->poruka_id ?>">
                        <?php if($poruka->status_pregleda == "procitano"): ?>
                        <img src="slike/stikla.png" alt="check" id="seen">
                        <?php endif; ?>
                    </div>
                    </form>
            </div>
        <?php endif; ?>
     <?php endforeach; ?>
     </div>
</body>
</html>