
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <style>
        <?php 
        require_once __DIR__ . "/css/layout.css";
        require_once __DIR__ . "/tabele/korisnik.php";
        ?>
    </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
        <form id="forma" action="logika/registrujse.php" method="post" enctype="multipart/form-data">
        <label for="email">Imejl</label><br>
        <input type="email" id="email" name="email" placeholder="Unesite vaš imejl"><br>
        <p id="isti_mejl">Već je registrovan nalog sa tom imejl adresom.</p>
        <?php 
            $korisnici = Korisnik::izlistaj();
            $mejlovi = array();
            foreach($korisnici as $korisnik){
                array_push($mejlovi, $korisnik->email);
            };
            ?>
            <script>
            $(document).ready(function(){
                var k = <?php
            echo json_encode($mejlovi);
        ?>; 
                var mejl_input = document.getElementById("email");
                mejl_input.addEventListener("keyup", function(e){
                    for(var i=0; i<k.length; i++){
                        if(k[i] == mejl_input.value){
                            $("#isti_mejl").show();
                            break;
                        }
                        else{
                            $("#isti_mejl").hide();
                        }
                    }
                });
                $("#lozinka1").on("keyup", function(e){
                    if($("#lozinka").val() != $(this).val()){
                        $("#razlicita_lozinka").show();
                    }
                    else{
                        $("#razlicita_lozinka").hide();
                    }
                })
                $("#lozinka").on("keyup", function(e){
                    if($(this).val() != $("#lozinka1").val()){
                        $("#razlicita_lozinka").show();
                    }
                    else{
                        $("#razlicita_lozinka").hide();
                    }
                });
                $("#forma").on("submit", function(e){
                    var upozorenje = document.getElementById("isti_mejl");
                    var lozinke = document.getElementById("razlicita_lozinka");
                    if(upozorenje.style.display == "block" || lozinke.style.display == "block"){
                        alert("Proverite ispravnost podataka u formularu.");
                        e.preventDefault();
                    }
                });
            });
        </script>
        <label for="lozinka">Lozinka</label><br>
        <input type="password" id="lozinka" name="lozinka" placeholder="Unesite lozinku"><br>
        <label for="lozinka1">Ponovo unesite lozinku</label><br>
        <input type="password" name="ponovljena_lozinka" id="lozinka1" placeholder="Unesite lozinku"><br>
        <p id="razlicita_lozinka">Lozinke se ne podudaraju.</p>
        <label for="ime_prezime">Ime i prezime</label><br>
        <input type="text" name="ime_prezime" id="ime_prezime" placeholder="Unesite vaše ime i prezime"><br>
        <label for="broj">Broj telefona</label><br>
        <input type="tel" name="broj" id="broj" placeholder="Unesite vaš broj telefona"><br>
        <label for="slika">Izaberite profilnu sliku</label><br>
        <input type="file" name="slika" id="slika">
        <br>
        <?php if(isset($_GET["registracija"]) && $_GET["registracija"] === "false"): ?>
        <script>
            alert("Sva polja moraju biti popunjena.");
        </script>
        <?php endif; ?>
        <button type="submit">Registruj se</button>
        <p>
            <a href="index.php">Prijavite se</a>
        </p>
        <p>
            <a href="lozinka.php">Promenite lozinku</a>
        </p>
        </form>
</body>
</html>