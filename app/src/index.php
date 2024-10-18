<head><link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" /></head><body><script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script></body>
<?php
// Função simples para mapear as rotas
//teste de conexão
$servername = "db"; // ou "localhost"
$username = "user"; 
$password = "root"; 
$dbname = "projetofeiraciencias"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}
$conn->close();




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
        case 'login':
            require 'pages/login.php';
            break;
        case 'projetos':
            require 'pages/projetos.php';
            break;
        case 'inicio':
            require 'pages/inicio.php';
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
