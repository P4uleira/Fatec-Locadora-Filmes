function informaNome(){
    let titulo = document.getElementById('titulo').value;
    titulo = titulo.replace(/\s+/g, "-");

    window.location.href = "index.php?name=" + titulo;
}

function alugarFilme(id, cat, title) {    
    window.location.href = "alugar.php?id=" + id + "&cat=" + cat + "&filme=" + title
}

var btnProcurar = document.getElementById("pesquisar");
var inputPesquisa = document.getElementById("titulo");


inputPesquisa.addEventListener("keydown", function(event) {
    if (event.keyCode === 13) { 
        event.preventDefault(); 
        informaNome();
    }
});