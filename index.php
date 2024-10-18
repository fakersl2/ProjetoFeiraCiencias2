<?php
// Função simples para mapear as rotas
function carregarPagina($rota) {
    switch ($rota) {
        case 'avaliacoes':
            require 'app/src/pages/avaliacoes.php';
            break;
        case 'cadastro':
            require 'app/src/pages/cadastro.php';
            break;
        case 'footer':
            require 'app/src/pages/footer.php';
            break;
        case 'gradient':
            require 'app/src/pages/gradient.php';
            break;
        case 'headernav':
            require 'app/src/pages/headernav.php';
            break;
        case 'home':
            require 'app/src/pages/home.php';
            break;
        case 'login':
            require 'app/src/pages/login.php';
            break;
        case 'projetos':
            require 'app/src/pages/projetos.php';
            break;
        case 'inicio':
            require 'app/src/pages/inicio.php';
            break;
        default:
            require 'app/src/pages/paginaErro.php'; // Página de erro
            break;
    }
}

// Captura a rota da URL
$rota = isset($_GET['rota']) ? $_GET['rota'] : 'home';

// Carrega a página correspondente
carregarPagina($rota);
?>
