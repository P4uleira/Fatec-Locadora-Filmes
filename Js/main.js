function informaNome(){
    let titulo = document.getElementById('titulo').value;
    titulo = titulo.replace(/\s+/g, "-");

    window.location.href = "index.php?name=" + titulo;
}

<<<<<<< HEAD
function alugarFilme(id, cat) {
    window.location.href = "alugar.php?id=" + id + "&cat=" + cat
}


function salvaAluguel(){
    var clienteCpf = document.getElementById('CpfCliente')
    var selectOption = document.getElementById('aluguel')
    var diasAlugados = selectOption.value;

    fs.access('alugueis.txt', (err) => {
        if (err) {
            // O arquivo não existe, cria o arquivo e adiciona os dados
            fs.writeFileSync('alugueis.txt', `${clienteCpf},${diasAlugados}\n`);
            console.log('Arquivo criado e dados salvos com sucesso.');
        } else {
            // O arquivo já existe, adiciona os dados na próxima linha
            fs.appendFileSync('alugueis.txt', `${clienteCpf},${diasAlugados}\n`);
            console.log('Dados adicionados ao arquivo existente.');
        }
    });
}
=======
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
>>>>>>> d03bc5965ec63488ffa8bcd83b185aa597d05df1
