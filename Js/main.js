function informaNome(){
    let titulo = document.getElementById('titulo').value;
    titulo = titulo.replace(/\s+/g, "-");


    window.location.href = "index.php?name=" + titulo;
}