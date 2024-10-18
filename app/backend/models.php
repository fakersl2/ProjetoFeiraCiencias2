<?php
include_once('conexao.php');

class Avaliacoes {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($nota, $comentario, $projeto_id, $usuario_id) {
        $stmt = $this->conn->prepare("INSERT INTO avaliacoes (nota, comentario, projeto_id, usuario_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nota, $comentario, $projeto_id, $usuario_id]);
        return $this->conn->lastInsertId();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM avaliacoes WHERE codigo = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

class Categorias {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($nome) {
        $stmt = $this->conn->prepare("INSERT INTO categorias (nome) VALUES (?)");
        $stmt->execute([$nome]);
        return $this->conn->lastInsertId();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM categorias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class Projetos {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($nome, $descricao, $categoria_id, $turma_id) {
        $stmt = $this->conn->prepare("INSERT INTO projetos (nome, descricao, categoria_id, turma_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $descricao, $categoria_id, $turma_id]);
        return $this->conn->lastInsertId();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM projetos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class ProjetosXcategorias {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($projeto_id, $categoria_id) {
        $stmt = $this->conn->prepare("INSERT INTO projetosXcategorias (projeto_id, categoria_id) VALUES (?, ?)");
        $stmt->execute([$projeto_id, $categoria_id]);
        return $this->conn->lastInsertId();
    }
}

class ProjetosXturmas {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($projeto_id, $turma_id) {
        $stmt = $this->conn->prepare("INSERT INTO projetosXturmas (projeto_id, turma_id) VALUES (?, ?)");
        $stmt->execute([$projeto_id, $turma_id]);
        return $this->conn->lastInsertId();
    }
}

class Turmas {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($nome) {
        $stmt = $this->conn->prepare("INSERT INTO turmas (nome) VALUES (?)");
        $stmt->execute([$nome]);
        return $this->conn->lastInsertId();
    }
}

class Usuarios {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($nome, $senha) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, senha) VALUES (?, ?)");
        $stmt->execute([$nome, $senha]);
        return $this->conn->lastInsertId();
    }
}
?>