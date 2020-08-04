function alertVerifProf(){
    if(confirm("\312tes vous s\373r de vouloir acc\351der \340 la partie prof ?")) parent.location = 'prof.php';
}

function alertVerifEtudiant(){
    if(confirm("\312tes vous s\373r de vouloir acc\351der \340 la partie \351tudiant ?")) parent.location = 'Eleve.html';
}

var arr = [];
var idd = "";
var idButton = "";
var idPasSuivi = "";

function submitNote(idd, idButton,idPasSuivi){
    var inputs = document.getElementById(idd).value;
        if(confirm("Etes vous sur de vouloir mettre " + inputs + "/20 à cette UE ? ")) {
            hide(idd,idButton,idPasSuivi);
            arr.push(inputs);
        }

    console.log(arr);
}

function pasSuivi(idd,idButton,idPasSuivi){
    if(confirm("Vous n'avez pas suivi cette UE ?")){
        hide(idd,idButton,idPasSuivi);
        //console.log(arr);
    }
}


function hide(idd,idButton,idPasSuivi){
    var div = document.getElementById(idButton);
    var box = document.getElementById(idd);
    var pasSuivi = document.getElementById(idPasSuivi);
    div.style.display = 'none';
    box.style.display = 'none';
    pasSuivi.style.display = 'none';
    //console.log(pasSuivi);
}
