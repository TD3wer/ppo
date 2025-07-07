<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getByTipo($tipo) {
    $stmt = $this->pdo->prepare("SELECT id, nome FROM usuarios WHERE tipo = ?");
    $stmt->execute([$tipo]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($dados) {
        // Criptografar senha
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios 
            (nome, login, tipo, senha, idade) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $dados['nome'],
            $dados['login'],
            $dados['tipo'],
            $senhaHash,
            $dados['idade']
        ]);
    }

    public function update($id, $dados) {
        $senhaHash = $dados['senha'] ? password_hash($dados['senha'], PASSWORD_DEFAULT) : null;

        if ($senhaHash) {
            $stmt = $this->pdo->prepare("
                UPDATE usuarios SET 
                    nome = ?, 
                    login = ?, 
                    tipo = ?, 
                    senha = ?, 
                    idade = ? 
                WHERE id = ?
            ");
            return $stmt->execute([
                $dados['nome'],
                $dados['login'],
                $dados['tipo'],
                $senhaHash,
                $dados['idade'],
                $id
            ]);
        } else {
            $stmt = $this->pdo->prepare("
                UPDATE usuarios SET 
                    nome = ?, 
                    login = ?, 
                    tipo = ?, 
                    idade = ? 
                WHERE id = ?
            ");
            return $stmt->execute([
                $dados['nome'],
                $dados['login'],
                $dados['tipo'],
                $dados['idade'],
                $id
            ]);
        }
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>