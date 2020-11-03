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
    <title>Lista</title>
    <style>
        <?php 
            require_once __DIR__ . "/css/layout.css";
            $korisnik = Korisnik::izlistaj();
        ?>
        img{
            height:100px;
            width:100px;
            vertical-align: middle;
            outline: none;
        }
        body{
            height: 100vh;
        }
    </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                var method = "post";
                $(".snimi").on("click", function(){
                    var korisnik_id = $(this).parent().find("input[name='korisnik_id']").val();
                    var nova_lozinka = $(this).parent().parent().find("input[name='nova_lozinka']").val();
                    var url = "logika/promena_lozinke_admin.php";
                    var sifra = $(this).parent().parent().find("input[name='nova_lozinka']");
                    $.ajax({
                        "url": url,
                        "method": method,
                        "data":{
                            "korisnik_id": korisnik_id,
                            "nova_lozinka": nova_lozinka
                        },
                        "dataType":"json",
                        "success": function(odg){
                                if(odg.greska == false){
                                        alert("Uspešno promenjena lozinka");
                                        sifra.val("");
                                }
                            },
                        "error": function(odg){
                                if(odg.greska == undefined){
                                    alert("Lozinka nije promenjena");
                                    sifra.val("");
                                }
                            }
                    });
                });
                $(".obrisi").on("click", function(){
                    var korisnik_id = $(this).parent().find("input[name='korisnik_id']").val();
                    var url = "logika/obrisikorisnika.php";
                    var red = $(this).parent().parent();
                    $.ajax({
                        "url": url,
                        "method": method,
                        "data": {
                            "korisnik_id": korisnik_id
                        },
                        "dataType":"json",
                        "success": function(odgovor){
                                if(odgovor.greska == false){
                                        red.remove();
                                }
                            },
                        "error": function(odgovor){
                                if(odgovor.greska == undefined){
                                    alert("Greška");
                                }
                            }
                    });
                });
                $(".odobri").on("click", function(){
                    var korisnik_id = $(this).parent().find("input[name='korisnik_id']").val();
                    var url = "logika/odobrikorisnika.php";
                    var status_odobrenja = $(this).find("input[name='status_odobrenja']").val();
                    var dugme_odobri = $(this);
                    $.ajax({
                        "url": url,
                        "method": method,
                        "data":{
                            "korisnik_id": korisnik_id,
                            "status_odobrenja": status_odobrenja
                        },
                        "dataType":"json",
                        "success": function(odg){
                            if(odg.greska == false){
                                dugme_odobri.remove();
                            }
                        },
                        "error": function(odg){
                            if(odg.greska == undefined){
                                alert("Greška");
                            }
                        }
                    });
                });
            });
        </script>
</head>
<body>
    <table>
        <tr>
            <th>Ime i prezime</th>
            <th>Imejl</th>
            <th>Telefon</th>
            <th>Korisničko ime</th>
            <th>Lozinka</th>
            <th>Slika</th>
        </tr>
        <?php if($korisnik != null): ?>
        <?php foreach($korisnik as $k): ?>
            <?php
      $slike = str_replace("\\", "/", $k->slika);
      $slika = str_replace("../", "", $slike); 
      ?>
            <tr>
                <td><?php echo $k->ime_prezime ?></td>
                <td><?php echo $k->email ?></td>
                <td><?php echo $k->telefon ?></td>
                <td><?php echo $k->korisnicko_ime ?></td>
                <td>
                    <input type="password" name="nova_lozinka" style="width:100px;">
                </td>
                <td><?php echo "<img src='" . $slika . "' alt='fotografija korisnika' onerror = this.src='slike/download.png'>" ?></td>
                <td>
                    <button class="obrisi">Obriši</button>
                    <button class="snimi">Snimi</button>
                    <?php if($k->status_odobrenja != "odobren"): ?>
                    <button class="odobri">Odobri
                    <input type="hidden" name="status_odobrenja" value="odobren">
                    </button>
                    <?php endif; ?>
                    <input type="hidden" name="korisnik_id" value="<?= $k->id ?>">
                </td>
            </tr>
        <?php endforeach ?>
        <?php endif ?>
    </table>
</body>
</html>