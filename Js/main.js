function informaNome(){
    let titulo = document.getElementById('titulo').value;

    window.location.href = "index.php?name=" + titulo;
}