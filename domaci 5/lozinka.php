<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promena Lozinke</title>
    <style>
        <?php require_once __DIR__ . "/css/layout.css"; ?>
    </style>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#lozinka_nova1").on("keyup", function(e){
                        if($(this).val() != $("#lozinka_nova").val()){
                            $("#razlicita_lozinka").show();
                        }
                        else{
                            $("#razlicita_lozinka").hide();
                        }
                    })
                    $("#lozinka_nova").on("keyup", function(e){
                        if($(this).val() != $("#lozinka_nova1").val()){
                            $("#razlicita_lozinka").show();
                        }
                        else{
                            $("#razlicita_lozinka").hide();
                        }
                    })
                    $("#forma").on("submit", function(event){
                        var lozinke = document.getElementById("razlicita_lozinka");
                        if(lozinke.style.display == "block"){
                            event.preventDefault();
                        }
                    })
                });
            </script>
</head>
<body>
<form action="logika/promenilozinku.php" method="post" id="forma">
        <label for="email">imejl</label><br>
        <input type="email" id="email" name="email" placeholder="Unesite vaš imejl"><br>
        <label for="lozinka_stara">Stara lozinka</label><br>
        <input type="password" id="lozinka_stara" name="stara_lozinka" placeholder="Unesite staru lozinku"><br>
        <label for="lozinka_nova">Nova lozinka</label><br>
        <input type="password" id="lozinka_nova" name="nova_lozinka" placeholder="Unesite novu lozinku"><br>
        <label for="lozinka_nova1">Ponovite novu lozinku</label><br>
        <input type="password" id="lozinka_nova1" name="nova_lozinka1" placeholder="Ponovo unesite novu lozinku"><br>
        <p id="razlicita_lozinka">Nove lozinke se ne podudaraju.</p>
        <button type="submit">Promenite lozinku</button>
        <?php if(isset($_GET["korisnik"]) && $_GET["korisnik"] == "false"): ?>
        <p class="upozorenje" style="margin-top: 15px;">
                Pogrešni podaci za prijavu.
        </p>
        <?php endif; ?>
        <p>
            <a href="index.php">Prijavite se</a>
        </p>
        <p>
            <a href="registracija.php">Registracija</a>
        </p>
        </form>
</body>
</html>