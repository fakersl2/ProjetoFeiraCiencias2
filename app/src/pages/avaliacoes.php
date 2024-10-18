<?php

// Obtém o ID do projeto da URL
$id = $_GET['id'] ?? null; // Captura o ID passado na URL

// Inicializa as variáveis de votos e comentários
$votos = [
    'positivos' => 0,
    'neutros' => 0,
    'negativos' => 0,
    'totalPositivos' => 0,
    'totalNeutros' => 0,
    'totalNegativos' => 0
];
$comentarios = [];

// Função para buscar votos e comentários
function fetchVotos($id) {
    global $votos, $comentarios;

    try {
        // Faz requisição para buscar votos
        $response = file_get_contents("https://projetofeiraciencias-5.onrender.com/votos/$id");
        $avaliacoes = json_decode($response, true); // Obtém dados da resposta

        // Conta votos positivos, neutros e negativos
        $positivos = count(array_filter($avaliacoes, function ($avaliacao) {
            return $avaliacao['nota'] === 'bom';
        }));
        $neutros = count(array_filter($avaliacoes, function ($avaliacao) {
            return $avaliacao['nota'] === 'médio';
        }));
        $negativos = count(array_filter($avaliacoes, function ($avaliacao) {
            return $avaliacao['nota'] === 'ruim';
        }));

        $total = $positivos + $neutros + $negativos; // Total de votos

        // Atualiza as variáveis com porcentagens de votos
        $votos['positivos'] = ($total > 0) ? ($positivos / $total) * 100 : 0;
        $votos['neutros'] = ($total > 0) ? ($neutros / $total) * 100 : 0;
        $votos['negativos'] = ($total > 0) ? ($negativos / $total) * 100 : 0;
        $votos['totalPositivos'] = $positivos;
        $votos['totalNeutros'] = $neutros;
        $votos['totalNegativos'] = $negativos;

        // Filtra comentários não vazios
        $comentarios = array_filter(array_map(function ($avaliacao) {
            return $avaliacao['comentario'];
        }, $avaliacoes), function ($comentario) {
            return !empty(trim($comentario));
        });

    } catch (Exception $e) {
        // Log de erro
        echo 'Erro ao buscar os votos: ' . $e->getMessage();
    }
}

fetchVotos($id); // Chama a função para buscar dados
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Substitua pelo caminho correto para o seu CSS -->
</head>
<body>
    <div class="p-4 rounded-lg bg-green-50">
        <div class="flex items-center justify-between mb-2">
            <span class="text-3xl font-bold text-black">Votos</span>
            <div class="flex space-x-2">
                <span class="flex items-center text-green-600" aria-label="<?= $votos['totalPositivos'] ?> votos positivos">
                    <span class="w-5 h-5 mr-1">😊</span> <!-- Emoji positivo -->
                    <?= $votos['totalPositivos'] ?> <!-- Mostra total de votos positivos -->
                </span>
                <span class="flex items-center text-gray-600" aria-label="<?= $votos['totalNeutros'] ?> votos neutros">
                    <span class="w-5 h-5 mr-1">😐</span> <!-- Emoji neutro -->
                    <?= $votos['totalNeutros'] ?> <!-- Mostra total de votos neutros -->
                </span>
                <span class="flex items-center text-red-600" aria-label="<?= $votos['totalNegativos'] ?> votos negativos">
                    <span class="w-5 h-5 mr-1">😞</span> <!-- Emoji negativo -->
                    <?= $votos['totalNegativos'] ?> <!-- Mostra total de votos negativos -->
                </span>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-xl text-green-500">
                😊
            </span>
            <div class="w-full h-4 bg-gray-200 rounded-full">
                <div class="flex h-4 overflow-hidden rounded-full">
                    <div class="bg-green-500" role="progressbar" style="width: <?= $votos['positivos'] ?>%;" aria-valuenow="<?= $votos['positivos'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="bg-gray-500" role="progressbar" style="width: <?= $votos['neutros'] ?>%;" aria-valuenow="<?= $votos['neutros'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="bg-red-500" role="progressbar" style="width: <?= $votos['negativos'] ?>%;" aria-valuenow="<?= $votos['negativos'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <span class="text-xl text-red-500">
                😞
            </span>
        </div>

        <h1 class="pt-20 text-3xl font-bold text-black dark:text-white">Comentários</h1>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            <?php foreach ($comentarios as $comentario): ?> <!-- Mapeia comentários para exibição -->
                <div class="p-4 rounded-md bg-green-50"><?= htmlspecialchars($comentario) ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
