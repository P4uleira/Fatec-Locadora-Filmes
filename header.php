<!DOCTYPE html>
<html lang="pt-br">
<body>
    <header>
        <div class="header">
            <h2 style="text-align: center;" class="display">
                <a class="tituloPrincipal" href="index.php">
                    <span style="cursor:pointer">Locadora Poggers</span>
                </a>
            </h2>
        </div>
        <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
        <label for="openSidebarMenu" class="sidebarIconToggle">
            <div class="spinner diagonal part-1"></div>
            <div class="spinner horizontal"></div>
            <div class="spinner diagonal part-2"></div>
        </label>
        <div id="sidebarMenu">
            <ul class="sidebarMenuInner">
                <li>
                    <div class="input-group mb-3">
                        <input id="titulo" type="text" class="form-control" placeholder="Buscar Filme"
                            aria-label="Buscar" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <a id="pesquisar" onclick="informaNome()" name="name" class="btn btn-outline-secondary" type="button">a</a>
                        </div>
                    </div>
                </li>
                <li><a style="color: #F0F0F0;" href="meusAlugados.php">Meus Filmes ALugados</a></li>
                <br>
                <li><a style="color: #F0F0F0;" href="index.php?cat=28">Ação</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=878">Ficção</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=16">Animação</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=35">Comedia</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=18">Drama</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=10751">Familia</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=27">Terror</a></li>
            </ul>
        </div>
    </header>  
</body>
</html>