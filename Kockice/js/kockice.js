var dugme = document.getElementById("dugme");
dugme.addEventListener("mouseover", function(){
    for(i=0; i<document.getElementsByClassName("kocka").length; i++){
        var j = document.getElementsByClassName("kocka")[i];
        var broj = Math.floor(Math.random()*6)+1;
        switch(broj){
            case 1:
                if(j.children.length < 1){
                var tacka = document.createElement('div');
                j.appendChild(tacka).classList.add("tacka");
                j.classList.add("kocka1");
                }
                break;
            case 2:
                if(j.children.length < 1){
                    j.classList.add("kocka2");
                    for(var k=0; k<4; k++){
                        if(k == 0 || k==3){
                            var tacka = document.createElement('div');
                            j.appendChild(tacka).classList.add("tacka", "provid");
                        }
                        else{
                            var tacka = document.createElement('div');
                            j.appendChild(tacka).classList.add("tacka");
                        }
                    }
                }
                break;
            case 3:
                if(j.children.length < 1){
                    j.classList.add("kocka3");
                    for(var k = 0; k<9; k++){
                        if(k==2 || k==4 || k==6){
                            var tacka = document.createElement('div');
                            j.appendChild(tacka).classList.add("tacka");
                        }
                        else{
                            var tacka = document.createElement('div');
                            j.appendChild(tacka).classList.add("tacka", "provid");
                        }
                    }
                }
                break;
            case 4:
                if(j.children.length < 1){
                    j.classList.add("kocka2");
                    for(var k = 0; k<4; k++){
                        var tacka = document.createElement('div');
                            j.appendChild(tacka).classList.add("tacka");
                    }
                }
                break;
            case 5:
                if(j.children.length < 1){
                    j.classList.add("kocka3", "kocka5");
                    for(var k = 0; k<9; k++){
                        if(!(k%2==0)){
                            var tacka = document.createElement('div');
                            j.appendChild(tacka).classList.add("tacka", "provid");
                        }
                        else{
                            var tacka = document.createElement('div');
                            j.appendChild(tacka).classList.add("tacka");
                        }
                    }
                }
                break;
            case 6:
                if(j.children.length < 1){
                    j.classList.add("kocka6");
                    for(var k = 0; k<6; k++){
                        var tacka = document.createElement('div');
                            j.appendChild(tacka).classList.add("tacka");
                    }
                }
                break;
        }
    }
});
dugme.addEventListener("mouseleave", function(){
    var strKocki = document.getElementsByClassName("kocka");    
    for(var j = 0; j<strKocki.length; j++){
        var nizKlasa = strKocki[j].classList;
        nizKlasa.remove("kocka1", "kocka2", "kocka3", "kocka4", "kocka5", "kocka6");
        while(strKocki[j].firstChild){
        strKocki[j].removeChild(strKocki[j].firstChild);
        }
    }
});



