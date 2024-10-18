<?php
require 'conexao.php'; // Conexão com o banco de dados 'BancoProjetoFeiraCiencias'

// Inicializa variáveis
$codigo = $nota = $comentario = $errorMessage = $projectName = "";
$projectId = isset($_GET['projectId']) ? $_GET['projectId'] : 0;

// Busca o nome do projeto
if ($projectId) {
    $stmt = $conexao->prepare("SELECT nome FROM Projetos WHERE id = ?");
    $stmt->bind_param('i', $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $projectName = $result->fetch_assoc()['nome'];
    } else {
        $errorMessage = "Projeto não encontrado.";
    }
}

// Lógica para salvar o voto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'] ?? '';
    $usuario_id = $_POST['usuario_id'];

    $sql = "INSERT INTO Votos (codigo, nota, comentario, usuario_id, projeto_id) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sssii', $codigo, $nota, $comentario, $usuario_id, $projectId);

    if ($stmt->execute()) {
        echo "<script>alert('Voto enviado com sucesso!'); window.location.reload();</script>";
    } else {
        $errorMessage = "Erro ao enviar voto: " . $conexao->error;
    }
}
?>

<!-- Modal HTML -->
<div class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" onclick="fecharModal()"></div>
    <div class="z-10 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-center">Votação</h2>
        <p class="mb-4 text-center"><?= htmlspecialchars($projectName) ?></p> <!-- Nome do projeto -->

        <form method="POST" action="">
            <input type="text" name="codigo" placeholder="Identificação" 
                class="w-full p-2 border border-gray-300 rounded-md mb-4" required>

            <div class="flex justify-center mb-4">
                <button type="button" class="text-green-500 rounded-full hover:scale-150"
                    onclick="document.getElementById('nota').value = 'bom'">
                    😊
                </button>
                <button type="button" class="mx-4 text-gray-500 rounded-full hover:scale-150"
                    onclick="document.getElementById('nota').value = 'médio'">
                    😐
                </button>
                <button type="button" class="text-red-500 rounded-full hover:scale-150"
                    onclick="document.getElementById('nota').value = 'ruim'">
                    😞
                </button>
            </div>
            
            <input type="hidden" id="nota" name="nota" value="" required>

            <textarea name="comentario" placeholder="Comentário (opcional)..." 
                class="w-full p-2 border border-gray-300 rounded-md resize-none mb-4"></textarea>

            <input type="hidden" name="usuario_id" value="<?= $_SESSION['user_id'] ?? 1 ?>"> <!-- ID do usuário -->

            <?php if ($errorMessage): ?>
                <p class="mb-4 text-red-500"><?= htmlspecialchars($errorMessage) ?></p>
            <?php endif; ?>

            <div class="text-center">
                <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-full hover:bg-green-600">
                    SALVAR
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function fecharModal() {
        document.querySelector('.fixed').style.display = 'none';
    }
</script>
