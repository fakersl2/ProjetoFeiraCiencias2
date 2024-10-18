<?php
// Função simples para mapear as rotas
function carregarPagina($rota) {
    switch ($rota) {
        case 'avaliacoes':
            require 'pages/avaliacoes.php';
            break;
        case 'cadastro':
            require 'pages/cadastro.php';
            break;
        case 'footer':
            require 'pages/footer.php';
            break;
        case 'gradient':
            require 'pages/gradient.php';
            break;
        case 'headernav':
            require 'pages/headernav.php';
            break;
        case 'home':
            require 'pages/home.php';
            break;
        case 'login':
            require 'pages/login.php';
            break;
        case 'projetos':
            require 'pages/projetos.php';
            break;
        case 'inicio':
            require 'pages/inicio.php';
            break;
        case (preg_match('/^projeto\/(\d+)$/', $rota, $matches) ? true : false):
            $id = $matches[1];
            require 'pages/projeto2.php';
            break;
        default:
            require 'pages/paginaErro.php'; // Página de erro
            break;
    }
}

// Captura a rota da URL
$rota = isset($_GET['rota']) ? $_GET['rota'] : 'home';

// Carrega a página correspondente
carregarPagina($rota);
?>
