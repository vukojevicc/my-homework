<?php
    session_start();
    if(isset($_SESSION["korisnik_id"])){
        header("Location: korisnikk.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        <?php require_once __DIR__ . "/css/layout.css";
        ?>
        body{
            height: 100vh;
        }
    </style>
</head>
<body>
    <form action="logika/prijavise.php" method="post">
        <label for="username">Korisničko ime</label><br>
        <input type="username" id="username" name="username" placeholder="Unesite vaše korisničko ime" value="<?php if(isset($_COOKIE["username"])){
            echo $_COOKIE["username"];
        } ?>"><br>
        <label for="lozinka">Lozinka</label><br>
        <input type="password" id="lozinka" name="lozinka" placeholder="Unesite lozinku" value="<?php if(isset($_COOKIE["pw"])){
            echo $_COOKIE["pw"];
        } ?>"><br>
        <?php if(isset($_GET["login"]) && $_GET["login"] === "false"): ?>
            <p class="upozorenje">Pogrešni podaci za prijavu.</p><br>
        <?php endif; ?>
        <?php if(isset($_GET["login"]) && $_GET["login"] === "fail"): ?>
            <p class="upozorenje">Pogrešili ste lozinku više od 3 puta. Administrator mora promeniti vašu lozinku da biste se prijavili.</p><br>
        <?php endif; ?>
        <label for="cookie">Upamti korisničko ime i lozinku</label><br>
        <input type="checkbox" id="cookie" name="kolacic"><br>
            <button type="submit">Prijavi se</button>
        <p>
            <a href="promena_lozinke.php">Promena lozinke</a>
        </p>
        <script>
            $(document).ready(function(){
                var un = $("#username");
                var pw = $("#lozinka");
                $("#cookie").on("click", function(e){
                    if(($(this).is(":checked"))){
                        var url = "logika/postavikolacic.php";
                        var method = "post";
                        var username = $("#username").val();
                        var password = $("#lozinka").val();
                        $.ajax({
                            "url": url,
                            "method": method,
                            "data":{
                                "username": username,
                                "password": password
                            },
                            "success": function(odg){
                                username = odg.username,
                                password = odg.password
                            }
                        });
                }
                else{
                    var username = $("#username");
                    var password = $("#lozinka");
                    var url = "logika/obrisikolacic.php";
                    $.ajax({
                        "url": url,
                        "success": function(){
                            username.val("");
                            password.val("");
                        }
                    });

                }
            });
            });
        </script>
    </form>
</body>
</html>