    var KamenPapirMakaze = ["kamen", "papir", "makaze"];
    var racunar=KamenPapirMakaze[Math.floor(Math.random()*3)];
    var korisnik = prompt("Kamen, papir ili makaze?").toLowerCase().trim();
    if(racunar==korisnik){
        alert("Racunar je izabrao "+racunar)
        alert("Nereseno!")
    }
    else if(racunar=="kamen" && korisnik=="makaze"){
        alert("Racunar je izabrao "+racunar)
        alert("Izgubili ste!")
    }
    else if(racunar=="kamen" && korisnik=="papir"){
        alert("Racunar je izabrao "+racunar)
        alert("Pobedili ste!")
    }
    else if(racunar=="papir" && korisnik=="kamen"){
        alert("Racunar je izabrao "+racunar)
        alert("Izgubili ste!")
    }
    else if(racunar=="papir" && korisnik=="makaze"){
        alert("Racunar je izabrao "+racunar)
        alert("Pobedili ste!")
    }
    else if(racunar=="makaze" && korisnik=="papir"){
        alert("Racunar je izabrao "+racunar)
        alert("Izgubili ste!")
    }
    else if(racunar=="makaze" && korisnik=="kamen"){
        alert("Racunar je izabrao "+racunar)
        alert("Pobedili ste!")
    }
        else{
            alert("Neispravan unos podataka")
        };
    