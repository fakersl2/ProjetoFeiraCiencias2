<?php

// Inicia a sessão para armazenamento de dados
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = ""; // Nome pode ser capturado conforme a necessidade
    $senha = $_POST['password'] ?? '';

    // Envia uma requisição POST para a API com os dados do usuário
    $url = 'https://projetofeiraciencias-5.onrender.com/usuarios';
    $data = json_encode(['nome' => $nome, 'senha' => $senha]);

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => $data,
        ],
    ];
    
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response !== false) {
        // Verifica o status da resposta
        $responseData = json_decode($response, true);
        if (isset($responseData['status']) && $responseData['status'] === 200) {
            header('Location: /login'); // Redireciona para a página de login
            exit;
        } else {
            // Tratar erro
            echo '<p class="text-red-500">Erro ao cadastrar</p>'; // Mensagem de erro ao cadastrar
        }
    } else {
        // Tratar erro
        echo '<p class="text-red-500">Erro ao cadastrar, por favor tente novamente.</p>'; // Mensagem de erro
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Substitua pelo caminho correto para o seu CSS -->
</head>
<body>
    <div class="flex items-center justify-center min-h-screen mx-2 bg-gray-100 select-none">
        <div class="flex flex-col w-full max-w-4xl overflow-hidden bg-white rounded-lg shadow-md md:flex-row">
            <div class="w-full p-8 mt-12 md:w-1/2">
                <div class="flex justify-center mb-8">
                    <!-- Espaço reservado para algum conteúdo adicional -->
                </div>
                <h2 class="mb-4 text-2xl font-bold text-gray-700 md:text-3xl">Cadastrar</h2>
                <p class="mb-6 text-sm text-gray-600 md:text-base">Já possui conta? <a href="/login" class="text-green-600 hover:underline">Entrar</a></p>
                <form method="POST" class="bg-white">
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
                    <img src="../assets/img/logobranca.webp" class="relative mx-auto h-2/3 top-1/2" style="transform: translateY(-50%);" alt="Logo" />
                </div>
            </div>
        </div>
    </div>
</body>
</html>
