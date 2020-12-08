var broj = Math.ceil(Math.random()*10);
for(i=2; i>-1; i--){
    var korisnik = prompt("Pogodite broj u rasponu od 1 do 10!").trim();
    if(korisnik==broj){
        alert("Pogodili ste broj!")
        break;
    }
    else if(korisnik>broj && korisnik<=10){
        alert("Uneli ste broj veci od sakrivenog. Imate jos "+i+" pokusaja.")
    }
    else if(korisnik<broj && korisnik>=1){
        alert("Uneli ste broj manji od sakrivenog. Imate jos "+i+" pokusaja.")
    }
    else{
        alert("Neispravan unos podataka. Imate jos "+i+" pokusaja.")
    }
};