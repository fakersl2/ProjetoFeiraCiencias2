<?php
session_start();
include '../../../backend/conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = ''; // Você pode alterar isso para pegar um valor de entrada, se necessário
    $senha = $_POST['password'];

    // Verifica se a senha foi informada
    if (empty($senha)) {
        echo "<script>alert('O código de identificação é obrigatório!');</script>";
    } else {
        // Prepara e executa a inserção no banco de dados
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, senha, createdAt, updatedAt) VALUES (?, ?, NOW(), NOW())");
        $stmt->bind_param("ss", $nome, $senha);

        if ($stmt->execute()) {
            // Redireciona para a página de login
            header('Location: /login.php');
            exit();
        } else {
            echo "<script>alert('Erro ao cadastrar: " . $conn->error . "');</script>";
        }

        // Fecha a declaração
        $stmt->close();
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Cadastro</title>
</head>
<body class="flex items-center justify-center min-h-screen mx-2 bg-gray-100 select-none">
    <div class="flex flex-col w-full max-w-4xl overflow-hidden bg-white rounded-lg shadow-md md:flex-row">
        <div class="w-full p-8 mt-12 md:w-1/2">
            <div class="flex justify-center mb-8">
                <h2 class="mb-4 text-2xl font-bold text-gray-700 md:text-3xl">Cadastrar</h2>
            </div>
            <p class="mb-6 text-sm text-gray-600 md:text-base">Já possui conta? <a href="/login.php" class="text-green-600 hover:underline">Entrar</a></p>
            <form method="POST" action="" class="bg-white">
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 md:text-base">Código de identificação:</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 leading-tight transition-all bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:bg-white focus:border-green-600 focus:mt-2" placeholder="Este código será seu nome de usuário!" required />
                </div>

                <div class="mb-6">
                    <button type="submit" class="flex items-center justify-center w-full px-4 py-2 text-white transition duration-300 ease-in-out bg-green-500 border-2 border-gray-200 rounded-lg hover:bg-green-600">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Espaço para Imagem -->
        <div class="hidden md:block md:w-1/2">
            <div class="object-cover w-full h-full bg-green-500">
                <img src="../../public/logo.png" alt="Logo" class="relative mx-auto h-2/3" style="transform: translateY(-50%);" />
            </div>
        </div>
    </div>
</body>
</html>
