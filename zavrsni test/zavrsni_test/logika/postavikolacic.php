<?php
    setcookie("username", $_POST["username"], time()+60*60*24*365, "/");
    setcookie("pw", $_POST["password"], time()+60*60*24*365, "/");

    $odgovor = [
        "username" => $_COOKIE["username"],
        "password" => $_COOKIE["pw"]
    ];
    echo json_encode($odgovor);
